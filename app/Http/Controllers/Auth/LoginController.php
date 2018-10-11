<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the OAuth Provider.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Show screen to notify user that hes account exists and he can continue
     *
     * @return Response
     */
    public function showExists()
    {
        return view('auth.exists');
    }

    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return view('auth.social.fail', ['message' => 'If it wasn\'t your decision, please contact us, use
                            contact information available on our website.']);
        }

        $authUser = User::where('provider_id', $user->id)->first();

        if($authUser) {
            Auth::login($authUser, true);

            return redirect()->intended($this->redirectTo);
        }

        return redirect()->route('social.register-confirmation')->with('providerData', [
            'name' => $user->name,
            'email' => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id,
            'intended' => session()->get('url.intended', url($this->redirectTo)),
        ]);
    }

    /**
     * Show form where user can agree with terms and accept creation of user using social/provider account.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSocialConfirmation() {
        session()->reflash();
        return view('auth.social.confirm');
    }

    /**
     * Creates and authenticates user using data received from provider like Facebook or Google
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|Illuminate\View\View
     */
    public function socialRegister(Request $request) {
        if(!$request->agree) {
            session()->reflash();
            return back()->with('should_agree', true);
        }

        $providerData = session()->get('providerData');

        $validator = Validator::make($providerData, [
            'name'     => 'required',
            'email'    => 'required',
            'provider' => 'required',
            'provider_id' => 'required'
        ]);

        if($validator->fails()) {
            return view('auth.social.fail', [
                'message' => 'Unexpected problem please contact us, using contact 
                information available on our website'
            ]);
        }

        $user = User::create($providerData);
        Auth::login($user);

        return redirect(array_get($providerData, 'intended', $this->redirectTo));
    }
}
