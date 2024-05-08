<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface IUser extends ICrudBase
{
    public function loginByEmail(Request $request);

    public function register(Request $request);

    public function logout();
}
