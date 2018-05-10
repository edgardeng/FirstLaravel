<?php

namespace App\Api\Controllers;

use App\User;

class UserController extends BaseController
{

    public function index() {
        $user = User::All();
        return $user;
    }


    public function show($id)
    {
        $user = User::findOrFail($id);

        return $this->response->array($user->toArray());
    }
}
