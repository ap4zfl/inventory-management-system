<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserRegister;
class userController extends Controller
{
    public function view_users(){
        $users = UserRegister::orderBy('id', 'desc')->get();
        return response()->json([
            'users' => $users,
            'status' => 200,
        ]);
    }
    public function updateStatus(Request $request)
        {
            $user = UserRegister::find($request->id);
            $user->userrole = $request->status;
            $user->save();
            return response()->json([
                'status' => 200,
                'message'=>'<div class="alert alert-success confirm_msgs" role="alert">
                    Status Updates Successsfully!
                </div>'
            ]);
        }

        public function updateUserRole(Request $request)
        {
            $user = UserRegister::find($request->id);
            if ($user) {
                $user->userrole = $request->userrole;
                $user->save();

                return response()->json([
                    'status' => 200,
                    'message' => '<div class="alert alert-success confirm_msgs">User role updated successfully!</div>'
                ]);
            }

            return response()->json([
                'status' => 400,
                'message' => 'User not found!'
            ]);
        }


        public function editUser(Request $request)
        {
            $user = UserRegister::find($request->id);
            if ($user) {
                $user->username = $request->username;
                $user->useremail = $request->useremail;
                $user->userrole = $request->userrole;
                $user->save();

                return response()->json([
                    'status' => 200,
                    'message' => '<div class="alert alert-success confirm_msgs">User updated successfully!</div>'
                ]);
            }

            return response()->json([
                'status' => 400,
                'message' => 'User not found!'
            ]);
        }
        public function deleteUser(Request $request)
        {
            $user = UserRegister::find($request->id);
            if ($user) {
                $user->delete();

                return response()->json([
                    'status' => 200,
                    'message' => '<div class="alert alert-success confirm_msgs">User deleted successfully!</div>'
                ]);
            }

            return response()->json([
                'status' => 400,
                'message' => 'User not found!'
            ]);
        }


}
