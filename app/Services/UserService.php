<?php

namespace App\Services;

use App\Models\User;
use Exception;

class UserService {
    public static function delete_user(string $id)
    {
        $user = User::find($id);
        
        return !is_null($user) ? $user->delete() : false; 
    }

    public static function get_user_by_email(string $email)
    {
        return User::where('email', $email)->first();
    }

    public static function create_user(array $user)
    {
        $user = new User($user);

        if(User::where('email', $user->email)->first()) 
            throw new Exception('E-mail already in use, plese enter another e-mail.');

        $user->save();

        return response([
            'mesage' => 'User created',
            'data' => $user
        ]);
    }

}