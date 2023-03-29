<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Notifications\SendPasswordNotification;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id', '<>', auth()->id())->latest()->get();
        $success['users'] = UserResource::collection($users);

        return $this->sendResponse($success, 'Data Retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
       // return $request->validated();
        $user = User::create($request->validated());
        $success['user'] = UserResource::make($user);

        return $this->sendResponse($success, 'User Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $success['user'] = UserResource::make($user);

        return $this->sendResponse($success, 'Data Retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->validated());
        $success['user'] = UserResource::make($user);

        return $this->sendResponse($success, 'User Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        $success['user'] = UserResource::make($user);

        return $this->sendResponse($success, 'User Created Successfully.');
    }

    public function login(UserLoginRequest $request)
    {
        $user = User::whereEmail($request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                $success['token'] = $user->createToken('MyApp')->plainTextToken;
                $success['user'] = UserResource::make($user);
                return $this->sendResponse($success, 'User login successfully.');
            } else {
                return $this->sendError('Validation Error.', 'Password does not match');
            }
        } else {
            return $this->sendError('Unauthorised.','Unauthorised');
        }
    }

    public function changePassword(Request $request, User $user)
    {
        //$user = User::whereId(auth()->user()->id)->first();
        $new_pass_random = Str::random(10);
        $user->update(['password' => Hash::make($new_pass_random)]);

        $user->notify(new SendPasswordNotification($new_pass_random));

        $success['user'] = new UserResource($user);
        return $this->sendResponse($success, 'Password change successfully.');
    }
}


