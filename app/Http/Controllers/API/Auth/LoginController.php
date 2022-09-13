<?php

namespace App\Http\Controllers\API\Auth;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\{Foundation\Auth\AuthenticatesUsers, Http\Request};
use MElaraby\Emerald\HttpFoundation\Response;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function socialLogin(Request $request): Response
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        if (!User::where('email', $request->email)->first()) {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);
        }

        return Response::response([
            'message' => 'User login successfully',
        ]);
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param Request $request
     * @return array
     */
    protected function credentials(Request $request): array
    {
        return [
            'password' => $request->get('password'),
            'email' => $request->get($this->username()),
        ];
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username(): string
    {
        return 'email';
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param Request $request
     * @return Response
     */
    final protected function sendLoginResponse(Request $request): Response
    {
        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user());
    }

    /**
     * The user has been authenticated.
     *
     * @param Request $request
     * @param mixed $user
     * @return Response
     */
    final protected function authenticated(Request $request, User $user): Response
    {
        return Response::response([
            'message' => 'User login successfully',
            'data' => [
                'token' => $user->createToken(User::TokenName)->plainTextToken,
            ],
        ]);
    }
}
