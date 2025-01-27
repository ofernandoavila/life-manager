<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public static function get_all(Request $request, Response $response) {
        return self::response(
            data: User::all(), 
            message: 'Results found',
            statusCode: 200
        );
    }
    
    public static function create_new_user(Request $request, Response $response) {
        UserService::create_user($request->json()->all());

        return self::response(
            data: UserService::get_user_by_email($request->json()->all()['email']), 
            message: 'User created',
            statusCode: 201
        );
    }
    
    public static function delete_user(Request $request, Response $response) {
        $user = User::find($request->query('id'));
        
        if(!$user) {
            return self::response(
                message: 'User not found',
                statusCode: 404
            );
        }

        $user->delete();

        return self::response(
            data: [], 
            message: 'User deleted',
            statusCode: 200
        );
    }
}
