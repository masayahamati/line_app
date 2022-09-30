<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Chat extends Model
{
    use HasFactory;
    protected $table="chats";
    protected $fillable=[
        "created_at",
        "content",
        "user_id",
        "friend_id"
    ];
    public static function getContent($friend_id){
        $user_id=Auth::id();
        return self::where(function($query) use ($user_id,$friend_id){
                        $query->where("user_id",$user_id)
                              ->where("friend_id",$friend_id);
                    })->orWhere(function($query) use ($user_id,$friend_id){
                        $query->where("user_id",$friend_id)
                              ->where("friend_id",$user_id);
                    })
                    ->orderBy("created_at")
                    ->get();
        /*ここでユーザーが、ログインしている人である条件とユーザーが、受け取ったfriend_idである人の条件で情報を取得している
        これによって会話している人によって吹き出しの向きをラインのように変えることができる*/
    }
    /*public static function getFriendContent($friend_id){
        $user_id=Auth::id();
        return self::where("user_id",$friend_id)
        ->where("friend_id",$user_id)->get();
    }*/

}



                    /*where("user_id",$user_id)
                    ->where("friend_id",$friend_id)
                    ->orwhere("user_id",$friend_id)
                    ->where("friend_id",$user_id)*/