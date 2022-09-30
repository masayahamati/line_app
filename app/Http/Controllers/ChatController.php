<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chat;
use App\Models\image;
use Auth;
use App\Http\Requests\ChatRequest;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller
{
    public function index($id){
          $contents=Chat::getContent($id);
          $user_info=User::find(Auth::id());
          $friend_info=User::find($id);
          /*ここでユーザー情報を取得これによりどの人が入力したものかを表示することができる */
          /*ddd($contents[0]->created_at->format("'Y年m月d日 H時i分"));*/
          /*ddd($contents[0]->user_id);*/
          $user_image=image::get_user_image(Auth::id());
        return view("index",["friend_info"=>$friend_info,
                            "user_info"=>$user_info,
                            "contents"=>$contents,
                            "user_image"=>$user_image]);
    }

    public function whole(){
        $friend_infos=Auth::user()->friends;
        $request_friend_infos=Auth::user()->request_friends_passive;
        /*多対多の場合modelに記載している、関数名に
        ->frinedsのようにアクセスすると情報を取得できる。
        今回はAuth::user()のインスタンスからfriends関数を指定して
        ログインユーザーの友達を全権取得している*/
        return view("whole",["friend_infos"=>$friend_infos,
                            "request_friend_infos"=>$request_friend_infos]);
    }

    public function store(ChatRequest $request){
        $input=$request->all();
        Chat::create($input);
        return redirect(route("index",$input["friend_id"]));
    }
    
    public function friend_serch(Request $request){
        if(User::friend_exist($request->name)){
        $friend_info=User::serch_id($request->name)->all()[0];
        $serch_friends=User::serch_id($request->name)->all()[0]->friends_passive;
        /*この処理によってある名前の人のuserテーブルのidが何なのか調べている
        また多次元配列になっていたので[0]で要素にアクセスしている。
        これはusermodelのインスタンスにアクセスしており、userインスタンスだとusermodelで定義した
        メソッドにアクセスできる。今回はusermodelクラスのfriendsメソッドにアクセスしている*/
        /*serch_friendsには名前から取得したidとfriend_idが等しいものを全権取得して代入している*/
        foreach($serch_friends as $serch_friend){
            if($serch_friend["id"]==Auth::id()){
                $friend_exist_bool=true;
                return redirect(route("whole"))->with("friend_exist_bool",$friend_exist_bool);
                /*redirect処理で変数を渡す場合、変数は一時的に保存すればいいものなのでsessionに保存される。
                withメソッドは変数をviewに渡すための関数。
                view側でこの変数を呼び出すときは {{ session('test') }}で呼び出す。*/
            }
        } 	
        Auth::user()->request_friends()->attach($friend_info["id"]);
        $frined_request_bool=true;
        return redirect(route("whole"))->with("friend_request_bool",$frined_request_bool);
        }
        else{
        $friendname_notexist_bool=true;
        return redirect(route("whole"))->with("friendname_notexist_bool",$friendname_notexist_bool);
            }
    }

    public function request_permit(Request $request){
        /*ddd($request->friend_request);*/
        $request_friend_bool=((int) $request->friend_request);
        /*文字列をint型にキャスト*/
        if($request_friend_bool){
            Auth::user()->friends()->attach($request->friend_id);
            Auth::user()->request_friends_passive()->detach($request->friend_id);
        }
        else{
            Auth::user()->request_friends_passive()->detach($request->friend_id);
        }
        return redirect(route("whole"));
    }

    public function image_store($id){
        return view("image_store",["friend_id"=>$id]);
    }
    public function upload(Request $request){
        if(file_exists($request->file("image"))){
            $path=$request->file('image')->store('image',"public");
            /*返り値に新たに作ったファイルのpathを返す。*/
            $db_save_ary=array("user_id"=>Auth::id(),"path"=>$path);
            /*リサイズするならここでするべき*/
            image::create($db_save_ary);

            $contents=Chat::getContent($request->friend_id);
            $user_info=User::find(Auth::id());
            $friend_info=User::find($request->friend_id);
            $user_image=image::get_user_image(Auth::id());
            return view("index",["friend_info"=>$friend_info,
                                "user_info"=>$user_info,
                                "contents"=>$contents,
                                "user_image",$user_image]);
        }
        else{
            return view("image_store",["friend_id"=>$request->friend_id]);
        }
        /*viewから送られてくるファイルはファイルインスタンスとして
        ファイルを操作するためのメソッドを使うことができる。
        file->storeでファイルをpublic/$dirに保存することができる
        ディレクトリに保存ができても、どういう条件で取り出す、とかをするには
        データベースに保存しておく必要がのでデータベースに画像のパスを保存しておく。*/
    }
}

/*$passive_friend_infos=Auth::user()->friends_passive;
逆にログインユーザーがどの人から友達追加されているかを取得する */

