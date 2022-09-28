<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chat;
use Auth;

class ChatController extends Controller
{
    public function index($id){
          $contents=Chat::getContent($id);
          /*ddd($contents[0]->created_at->format("'Y年m月d日 H時i分"));*/
          /*ddd($contents[0]->user_id);*/
        return view("index",["friend_id"=>$id,
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
}

/*$passive_friend_infos=Auth::user()->friends_passive;
        逆にログインユーザーがどの人から友達追加されているかを取得する */

