<?php

namespace App\Api\Controllers;

use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Dingo\Api\Exception\StoreResourceFailedException;

class RegisterController extends BaseController
{
    use RegistersUsers;

    public function register(Request $request)
    {

        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            throw new StoreResourceFailedException("Validation Error", $validator->errors());
        }

        $user = $this->create($request->all());

        if ($user->save()) {

//            $token = JWTAuth::fromUser($user);
            $token = "11111";
            return $this->response->array([
                "token" => $token,
                "message" => "User created",
                "status_code" => 201
            ]);
        } else {
            return $this->response->error("User Not Found...", 404);
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

}