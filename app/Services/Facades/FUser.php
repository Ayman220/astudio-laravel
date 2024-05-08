<?php

namespace App\Services\Facades;

use App\Helper\_RuleHelper;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\Interfaces\IUser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class FUser implements IUser
{
    public function index(Request $request)
    {
        $query = User::query();
        $filters = $request->all();
        if (!empty($filters)) {
            foreach ($filters as $key => $filter) {
                $query->where($key, 'LIKE', "%$filter%");
            }
        }

        return $query->paginate();
    }

    public function show($id)
    {
        $user = User::query()->findOrFail($id);
        return new UserResource($user);
    }

    public function store(Request $request)
    {
        $rulues = _RuleHelper::getRule('user_store_rules');
        $request->validate($rulues);
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'dob' => $request->date_of_birth,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return $user;
    }

    public function update($id, Request $request)
    {
        $rulues = _RuleHelper::getRule('user_update_rules');
        $request->validate($rulues);
        $user = User::query()->findOrFail($id);
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'dob' => $request->date_of_birth,
            'gender' => $request->gender,
        ]);
        return $user;
    }

    public function destroy($id)
    {
        $user = User::query()->findOrFail($id);
        try {
            DB::beginTransaction();
            $user->timesheets()->delete();
            $user->delete();
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw ($e);
        }
    }

    public function loginByEmail(Request $request)
    {
        $request->validate(_RuleHelper::getRule('login_by_email'));
        $user = User::query()->where([
            'email' => $request->email,
        ])->first();
        if ($user && Hash::check($request->password, $user->password)) {
            return $user;
        }
        return null;
    }

    public function register(Request $request)
    {
        return $this->store($request);
    }

    public function logout()
    {
        try {
            $user = Auth::guard('api')->user()->token();
            $user->revoke();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
