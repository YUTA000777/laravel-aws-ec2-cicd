<?php
namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class ManageUserController extends Controller
{
	function showUserList(){
		$user_list = User::orderBy("id", "desc")->paginate(10);
		return view("admin.user_list", [
			"user_list" => $user_list
		]);
	}
	function showUserDetail($id){
		$user = User::find($id);
		return view("admin.user_detail", [
			"user" => $user
		]);
    }
    
    function delete($id){
        $user = User::find($id);
        $user->delete();
		return redirect("admin/user_list");
	}
}