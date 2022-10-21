<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Services\Core\User\CreateUserParams;
use App\Services\Core\UserService;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

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
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    private UserService $userService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->middleware('guest')->except('logout');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            $findUser = User::where('google_id', $user->id)->first();

            if ($findUser) {
                Auth::login($findUser);
                return redirect('/');
            } else {

                $userFromDB = $this->userService->getUserEmail($user->email);
                if ($userFromDB) {
                    $userFromDB->google_id = $user->id;
                    $userFromDB->save();
                    Auth::login($userFromDB);
                } else {
                    $newUser = $this->userService->createUser(new CreateUserParams(
                        $user->name, $user->email, encrypt(''), $user->id, ""
                    ));
                    $newUser->email_verified_at = Carbon::now();
                    $newUser->save();
                    Auth::login($newUser);
                }

                // go to the dashboard
                return redirect('/');
            }
            //catch exceptions
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {

            $user = Socialite::driver('facebook')->user();
            $isUser = User::where('fb_id', $user->id)->first();

            if ($isUser) {
                Auth::login($isUser);
                return redirect('/');
            } else {
                $userFromDB = $this->userService->getUserEmail($user->email);

                if ($userFromDB) {
                    $userFromDB->google_id = $user->id;
                    $userFromDB->save();
                    Auth::login($userFromDB);
                } else {
                    $newUser = $this->userService->createUser(new CreateUserParams(
                        $user->name, $user->email, encrypt(''), '', $user->id
                    ));
                    $newUser->email_verified_at = Carbon::now();
                    $newUser->save();
                    Auth::login($newUser);
                }

                return redirect('/');
            }

        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
