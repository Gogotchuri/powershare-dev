<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            //TODO: Return social-fail view.
        }

        // 1 If user exists for this provider login user

        // 2 If user does not exist
        //   Save provider data in session variables
        //   return view social-create, this view should take variables from session like 'email' and 'provider'
        //     also initial indented page


        $authUser = User::where('provider_id', $user->id)->first();

        // If user already exists for this provider simply redirect it to login page and suggest login
        if($authUser) {
            Auth::login($authUser, true);

            return view('auth.exists', [
                'continue' => session()->pull('url.intended', $this->redirectTo)
            ]);
        }

        $authUser = User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id
        ]);

        Auth::login($authUser, true);

        return redirect()->intended($this->redirectTo);
    }

    // Called from create-social view
    public function socialRegister(Request $request) {
        // Called from create-social view

        // Check if 'agree' parameter received
        //   Create new user, using provider data saved in session
        //      if we fail to retrieve required data from session
        //         return back with message that unresolvable error ocurred and ask user to contact administrator
        //   Login new user
        //   redirect to 'initial-indented'

        // if 'agree' parameter did not arrive
        //   return back with message that we cannot register without agreement
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    protected function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        return User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id
        ]);
    }
}
