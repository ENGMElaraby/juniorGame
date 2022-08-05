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
//        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param Request $request
     * @return array
     */
    protected function credentials(Request $request): array
    {
        $columnName = is_numeric($request->get('username')) ? 'mobile' : 'email';
        return [
            'password' => $request->get('password'),
            $columnName => $request->get($this->username()),
        ];
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username(): string
    {
        return 'username';
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
//        Log::channel('emerald')->info(json_encode($request->all()));

        if (!empty($user->device_token)) {
            if ($user->device_token !== $request->get('token_device')) {
                return Response::response([
                    'message' => __('هذه المستخدمة مسجلة بجهاز اخر'),
                    'status' => 422
                ]);
            }
        }

//        if ($request->has('token_device') && !empty($request->get('token_device'))) {
//            ::updateDeviceToken($user, $request->get('token_device'));
//        }

        return Response::response([
            'message' => 'User login successfully',
            'data' => [
                'token' => $user->createToken(User::TokenName)->plainTextToken,
            ],
        ]);
    }
}
