<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class image extends Model
{
    use HasFactory;
     protected $table="image";
    protected $fillable=[
        "user_id",
        "path"
    ];

    public static function get_user_image($user_id){
        return self::where("user_id",$user_id)->first();
        /*データベースから取ってくる値が単一の時は
        getではなくfirstを使う。*/
    }

}
