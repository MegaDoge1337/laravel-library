<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Services\PaymentCalculator;
use App\User;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Laravel\Socialite\Facades\Socialite;

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

    protected PaymentCalculator $discountService;

    public function __construct(PaymentCalculator $discountService)
    {
        $this->middleware('guest')->except('logout');
        $this->discountService = $discountService;
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $providerUser = Socialite::driver($provider)->stateless()->user();
        $user = User::where('email', $providerUser->email)->first();

        if(!$user)
        {
            return view('auth.register', [
                'providerName' => $providerUser->name,
                'providerEmail' => $providerUser->email,
                'fromGPlus' => 'disabled'
            ]);
        }

        Auth::login($user);

        $token = $user->createToken('Auth Token')->accessToken;

        $this->discountService->giveDiscountForCreateDate($user);

        return redirect('/home')->cookie('token', $token, 60);

    }

    public function authenticated(Request $request, $user)
    {
        $token = $user->createToken('Auth Token')->accessToken;

        $this->discountService->giveDiscountForCreateDate($user);

        return redirect('/home')->cookie('token', $token, 60);
    }
}
