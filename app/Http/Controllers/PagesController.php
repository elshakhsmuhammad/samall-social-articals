<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;

class PagesController extends Controller {
    public function index(){
        return view('index');
    }

    // Fetch records
    public function getUsers(){
        // Call getuserData() method of Page Model
        $userData['data'] = Page::getuserData();

        echo json_encode($userData);
        exit;
    }

    // Insert record
    public function addUser(Request $request){

        $name = $request->input('name');
        $username = $request->input('username');
        $email = $request->input('email');

        if($name !='' && $username !='' && $email != ''){
            $data = array('name'=>$name,"username"=>$username,"email"=>$email);

            // Call insertData() method of Page Model
            $value = Page::insertData($data);
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
    public function updateUser(Request $request){

        $name = $request->input('name');
        $email = $request->input('email');
        $editid = $request->input('editid');

        if($name !='' && $email != ''){
            $data = array('name'=>$name,"email"=>$email);

            // Call updateData() method of Page Model
            Page::updateData($editid, $data);
            echo 'Update successfully.';
        }else{
            echo 'Fill all fields.';
        }

        exit;
    }

    // Delete record
    public function deleteUser($id=0){
        // Call deleteData() method of Page Model
        Page::deleteData($id);

        echo "Delete successfully";
        exit;
    }
}
