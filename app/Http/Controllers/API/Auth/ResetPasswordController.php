<?php

namespace App\Http\Controllers\API\Auth;

use App\{Http\Controllers\Controller, Models\PasswordReset};
use Illuminate\{Foundation\Auth\ResetsPasswords,
    Http\JsonResponse,
    Http\RedirectResponse,
    Http\Request,
    Support\Facades\Password,
    Validation\ValidationException};
use MElaraby\Emerald\HttpFoundation\Response;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Reset the given user's password.
     *
     * @param Request $request
     * @return JsonResponse|Response|RedirectResponse
     * @throws ValidationException
     */
    public function reset(Request $request): JsonResponse|Response|RedirectResponse
    {
        $request->validate($this->rules(), $this->validationErrorMessages());

        if ($password = $this->checkCode($request->get('token'))) {
            $request->request->add(['token' => $password->clear_token]);
        }

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise, we will parse the error and return the response.
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
            $this->resetPassword($user, $password);
        }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $response == Password::PASSWORD_RESET
            ? $this->sendResetResponse($request, $response)
            : $this->sendResetFailedResponse($request, $response);
    }

    /**
     * @param $token
     * @return PasswordReset|null
     */
    public function checkCode($token): ?PasswordReset
    {
        return PasswordReset::where('code', $token)->first();
    }

    /**
     * Get the response for a successful password reset.
     *
     * @param Request $request
     * @param string $response
     * @return Response
     */
    protected function sendResetResponse(Request $request, $response): Response
    {
        return Response::response(['message' => trans($response), 'data' => true]);
    }
}
