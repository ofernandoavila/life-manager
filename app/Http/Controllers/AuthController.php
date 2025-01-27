<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use App\Services\UserService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public static function login(Request $request)
    {
        if($result = AuthService::login($request->email, $request->password))
        {
            $result['user'] = UserService::get_user_by_email($request->email);

            return self::response(
                message: 'Authenticated successfully',
                data: $result
            );
        }
    }

    public static function me(Request $request)
    {
        $user = $request->user();

        if(!$user) throw new \Exception("User not found");

         return self::response(
            message: "Hello, " . $user->name ,
            data: $user
         );
    }
}
