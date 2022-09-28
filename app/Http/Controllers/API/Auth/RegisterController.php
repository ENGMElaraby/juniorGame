<?php

namespace App\Http\Controllers\API\Auth;

use App\{Http\Controllers\Controller, Http\Resources\UserResource, Models\User};
use Illuminate\{Foundation\Auth\RegistersUsers, Http\Request, Support\Facades\Hash, Support\Facades\Validator};
use MElaraby\Emerald\HttpFoundation\Response;

class RegisterController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default, this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return User
     */
    final public function create(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'school' => $data['school'],
            'years_old' => $data['age'],
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'min:3', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'school' => ['required', 'string'],
            'age' => ['required', 'string'],
        ]);
    }

    /**
     * The user has been registered.
     *
     * @param Request $request
     * @param mixed $user
     * @return Response
     */
    protected function registered(Request $request, User $user): Response
    {
        return Response::response([
            'message' => 'User registered successfully',
            'userMessage' => 'Congratulations registered successfully',
            'data' => [
                'token' => $user->createToken(User::TokenName)->plainTextToken,
            ],
        ]);
    }
}
