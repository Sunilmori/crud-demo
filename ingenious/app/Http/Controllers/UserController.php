<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UsersService;

class UserController extends Controller
{
    protected $userService;

    public function __construct()
    {
        $this->userService = new UsersService;
    }

    public function createOrUpdate(Request $request)
    {

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required|alpha|max:255',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'gender' => 'required',
            'education' => 'required',
            'hobby' => 'required',
            'exprience' => 'required',
            'message' => 'required',
        ]);
        
        if ($validator->fails()) {
            $errorMessages = $validator->errors()->all();
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $errorMessages
            ], 422);
        }

        $checkEmail = $this->userService->UserByEmail($request->email)?->email ?? '';

        if (empty($checkEmail)) {

            $users = $this->userService->createOrUpdateByEmail($request);

            $success = true;
            $msg = 'user create successfully!.';
            $code = 200;
            $result = $users;
        } else {

            $users = $this->userService->createOrUpdateByEmail($request);

            $success = true;
            $msg = 'user updated successfully!.';
            $code = 200;
            $result = $users;
        }

        return [
            'success' => $success,
            'msg' => $msg,
            'code' => $code,
            'result' => $result
        ];
    }


    public function getAllUser(Request $request)
    {

        $users = $this->userService->getAll();

        if (!empty($users)) {

            foreach ($users as $user) {
                $user = $user;
                $user->picture = asset('storage/app/public/images/' . $user->picture);
    
                $users[] = $user;
            }
            return $users;


            $success = true;
            $msg = 'users data found!.';
            $code = 200;
            $result = $users;
        } else {
            $success = false;
            $msg = 'users data not found!.';
            $code = 500;
            $result = null;
        }

        return [
            'success' => $success,
            'msg' => $msg,
            'code' => $code,
            'result' => $result
        ];
    }

    public function getUserByEmail(Request $request)
    {
        $checkuser = $this->userService->UserByEmail($request->email);
        
        if (!empty($checkuser)) {
            
            $checkuser->picture = asset('storage/app/public/images/' . $checkuser->picture);

            $success = true;
            $msg = 'user data found!.';
            $code = 200;
            $result = $checkuser;
        } else {
            $success = false;
            $msg = 'user data not found!.';
            $code = 500;
            $result = null;
        }

        return [
            'success' => $success,
            'msg' => $msg,
            'code' => $code,
            'result' => $result
        ];
    }
}
