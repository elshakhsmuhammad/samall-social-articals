<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Home extends Model
{
     public static function getPostData($id=null){

        $value=DB::table('posts')->orderBy('id', 'desc')->get();
        return $value;

    }

    public static function insertPostData($data){

        $value=DB::table('posts')->where('body', $data['body'])->get();
        if($value->count() == 0){
            $insertid = DB::table('posts')->insertGetId($data);
            return $insertid;
        }else{
            return 0;
        }

    }

    public static function updatePostData($id,$data){
        DB::table('posts')->where('id', $id)->update($data);
    }

    public static function deletePostData($id=0){
        DB::table('posts')->where('id', '=', $id)->delete();
    }
    public static function getCommentData($id=null){

        $value=DB::table('comments')->orderBy('id', 'asc')->get();
        return $value;

    }

    public static function insertCommentData($data){

        $value=DB::table('comments')->where('body', $data['body'])->get();
        if($value->count() == 0){
            $insertid = DB::table('posts')->insertGetId($data);
            return $insertid;
        }else{
            return 0;
        }

    }

    public static function updateCommentData($id,$data){
        DB::table('comments')->where('id', $id)->update($data);
    }

    public static function deleteCommentData($id=0){
        DB::table('comments')->where('id', '=', $id)->delete();
    }

}
