<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginAPIController extends ApiController
{
    public function login(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        $queryUser = User::where('email', $email)->first();
        if (empty($queryUser)) {
            return $this->sendError(
                'Incorrect credentials',
                422,
                [
                    'email' => $email
                ]
            );
        }

        if (!Hash::check($password, $queryUser->password)) {
            return $this->sendError(
                'Incorrect credentials',
                422,
                [
                    'email' => $email
                ]
            );
        }


        $token = $queryUser->createToken($queryUser->email);
        return $this->sendSuccess(
            [
                'token' => $token->plainTextToken
            ],
            'Login is success',
        );
    }
}
