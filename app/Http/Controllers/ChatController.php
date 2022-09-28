<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chat;
use Auth;
use App\Http\Requests\ChatRequest;

class ChatController extends Controller
{
    public function index($id){
          $contents=Chat::getContent($id);
          $user_info=User::find(Auth::id());
          $friend_info=User::find($id);
          /*ここでユーザー情報を取得これによりどの人が入力したものかを表示することができる */
          /*ddd($contents[0]->created_at->format("'Y年m月d日 H時i分"));*/
          /*ddd($contents[0]->user_id);*/
        return view("index",["friend_info"=>$friend_info,
                            "user_info"=>$user_info,
                            "contents"=>$contents]);
    }

    public function whole(){
        $friend_infos=Auth::user()->friends;
        /*多対多の場合modelに記載している、関数名に
        ->frinedsのようにアクセスすると情報を取得できる。
        今回はAuth::user()のインスタンスからfriends関数を指定して
        ログインユーザーの友達を全権取得している*/
        return view("whole",["friend_infos"=>$friend_infos]);
    }

    public function store(ChatRequest $request){
        $input=$request->all();
        Chat::create($input);
        return redirect(route("index",$input["friend_id"]));
    }
    
    public function friend_serch(Request $request){
        $serch_friends=User::serch_id($request->name)->all()[0]->friends_passive;
        /*この処理によってある名前の人のuserテーブルのidが何なのか調べている
        また多次元配列になっていたので[0]で要素にアクセスしている。
        これはusermodelのインスタンスにアクセスしており、userインスタンスだとusermodelで定義した
        メソッドにアクセスできる。今回はusermodelクラスのfriendsメソッドにアクセスしている*/
        /*serch_friendsには名前から取得したidとfriend_idが等しいものを全権取得して代入している*/
        foreach($serch_friends as $serch_friend){
            if($serch_friend["id"]==Auth::id()){
                ddd("一致しました");
                return redirect(route("whole"));
            }
        }
        return redirect(route("whole"));

        
    }
}

/*$passive_friend_infos=Auth::user()->friends_passive;
        逆にログインユーザーがどの人から友達追加されているかを取得する */

