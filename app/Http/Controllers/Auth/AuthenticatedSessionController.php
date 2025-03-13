<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Users_info;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    // /**
    //  * Handle an incoming authentication request.
    //  */
    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     // Authenticate the user
    //     $request->authenticate();
    
    //     // Get the authenticated user
    //     $user = Auth::user();
        
    //     // Optionally, retrieve additional user info if needed
    //     $userinfo = Users_info::where('ui_id', $user->id)->first();
    //     session(['user_info' => $userinfo]); // Store user info in the session
    
    //     // Regenerate session to prevent session fixation attacks
    //     $request->session()->regenerate();
    
    //     // Check if the user is an admin (ID 1) and redirect accordingly
    //     if (Auth::id() == 1) { // Check if the user has ID 1 (Admin)
    //         return redirect()->intended(route('dashboard', absolute: false));
    //     }
    
    //     // If the user is not an admin, redirect to the home page
    //     return redirect()->intended(route('home', absolute: false));
    // }
    
    /**
 * Handle an incoming authentication request.
 */
public function store(LoginRequest $request): RedirectResponse
{
    // Authenticate the user
    $request->authenticate();

    // Get the authenticated user
    $user = Auth::user();

    // Retrieve user info from users_info table
    $userinfo = Users_info::where('ui_id', (string) $user->id)->first();
    // dd($user->id, $userinfo);


    // If user info does not exist, create a new entry
    if (!$userinfo) {
        $userinfo = Users_info::create([
            'ui_id' => $user->id,
            'ui_user' => $user->email,
            'ui_name' => $user->name,
            'ui_mobile' => '',
            'ui_type' => '2',
            'ui_para' => '',
            'ui_log' => 'Auto Created After Login',
        ]);
    }

    // Store user info in the session
    session(['user_info' => $userinfo]);

    // Regenerate session to prevent session fixation attacks
    $request->session()->regenerate();

    // Redirect based on user role
    if ($userinfo->ui_type == '1') { // افترضنا أن "1" تعني الأدمن
        return redirect()->intended(route('dashboard', absolute: false));
    }
    if ($userinfo->ui_type == '2') { // افترضنا أن "1" تعني الأدمن
        return redirect()->intended(route('home', absolute: false));
    }

    return redirect()->intended(route('home', absolute: false));
}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
