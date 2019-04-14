<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use App\Home;
class HomeAjaxController extends Controller
{
       public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $posts = Post::orderBy('created_at', 'desc')->paginate(15);
        $comments =Comment::all();
        return view('home', ['posts' => $posts,'comments'=>$comments]);
    }

    // Fetch records
    public function getPosts(){
        // Call getPostData() method of Home Model
        $PostData['data'] = Home::getPostData();

        echo json_encode($PostData);
        exit;
    }

    // Insert record
    public function addPost(Request $request){

        $title = $request->input('title');
        $body = $request->input('body');
        $user_id = auth()->user()->id;

        if($title !='' && $body !='' && $user_id != ''){
            $data = array('title'=>$title,"body"=>$body,"user_id"=>$user_id);

            // Call insertData() method of Home Model
            $value = Home::insertPostData($data);
            if($value){
                echo $value;
            }else{
                echo 0;
            }

        }else{
            echo 'Fill all fields.';
        }

        exit;
    }

    // Update record
    public function updatePost(Request $request){

         $title = $request->input('title');
        $body = $request->input('body');
        $editid = $request->input('editid');

        if($title !='' && $body != ''){
            $data = array('title'=>$title,"body"=>$body);

            // Call updateData() method of Home Model
            Home::updatePostData($editid, $data);
            echo 'Update successfully.';
        }else{
            echo 'Fill all fields.';
        }

        exit;
    }

    // Delete record
    public function deletePost($id=0){
        // Call deleteData() method of Home Model
        Home::deletePostData($id);

        echo "Delete successfully";
        exit;
    }
}

