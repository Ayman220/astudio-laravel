<?php

namespace App\Http\Controllers\Api;

use App\Helper\_RuleHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\BaseResource;
use App\Http\Resources\UserResource;
use App\Services\Interfaces\IUser;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected IUser $user;

    public function __construct(IUser $user)
    {
        $this->user = $user;
    }
    public function index(Request $request)
    {
        try {
            return $this->user->index($request);
        } catch (Exception $e) {
            return UserResource::exception($e);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $res = $this->user->store($request);
            if ($res) {
                return new UserResource($res);
            }
            return BaseResource::return();
        } catch (Exception $e) {
            return UserResource::exception($e);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $res = $this->user->show($id);
            if ($res) {
                return new UserResource($res);
            }
            return BaseResource::return();
        } catch (Exception $e) {
            return UserResource::exception($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $res = $this->user->update($id, $request);
            if ($res) {
                return new UserResource($res);
            }
            return BaseResource::return();
        } catch (Exception $e) {
            return UserResource::exception($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $res = $this->user->destroy($id);
            if ($res) {
                return BaseResource::ok("Deleted successfully");
            }
            return BaseResource::return();
        } catch (Exception $e) {
            return UserResource::exception($e);
        }
    }

    public function login(Request $request)
    {
        try {
            $user = $this->user->loginByEmail($request);
            if ($user) {
                return new UserResource($user, true);
            }
            return BaseResource::errors('User not found!');
        } catch (Exception $exception) {
            return BaseResource::errors($exception->getMessage());
        }
    }
    
    public function register(Request $request)
    {
        try {
            $user = $this->user->register($request);
            if ($user) {
                return BaseResource::create([
                    'user_id' => $user->id,
                    'email' => $request->email
                ]);

            }
            return BaseResource::return();
        } catch (Exception $exception) {
            return BaseResource::return($exception->getMessage());
        }
    }
        
    public function logout()
    {
        try {
            $result = $this->user->logout();
            if ($result) {
                return BaseResource::ok();
            }
            return BaseResource::return();
        } catch (Exception $exception) {
            return BaseResource::return($exception->getMessage());
        }
    }
}
