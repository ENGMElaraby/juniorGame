<?php

namespace App\Http\Controllers\API\Auth;

use App\{Http\Controllers\Controller, Http\Resources\UserResource, Models\User};
use Illuminate\{Contracts\Auth\Guard,
    Contracts\Auth\StatefulGuard,
    Foundation\Auth\RegistersUsers,
    Http\Request,
    Support\Facades\Auth,
    Support\Facades\Hash,
    Support\Facades\Validator
};
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
            'first_name' => $data['first_name'],
            'parent_name' => $data['parent_name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password']),
            'governorate_id' => $data['governorate_id'],
            'education_center_id' => $data['education_center_id'],
            'education_level_id' => $data['education_level_id'] ?? null,
            'device_token' => $data['device_token'] ?? null,
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
            'first_name' => ['required', 'string', 'min:3', 'max:20'],
            'parent_name' => ['required', 'string', 'min:3', 'max:20'],
            'email' => ['required_without:mobile', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required_without:email', 'string', 'digits:11', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'governorate_id' => ['required', 'integer', 'exists:governorates,id'],
            'education_center_id' => ['required', 'integer', 'exists:education_centers,id'],
            'education_level_id' => ['nullable', 'integer', 'exists:education_levels,id'],
        ], [
            // Todo message in arabic
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
                'user' => new UserResource($user),
            ],
        ]);
    }
}
