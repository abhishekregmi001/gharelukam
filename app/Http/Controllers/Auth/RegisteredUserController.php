<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Http;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $data = [
            'FirstName' => $request->first_name,
            'lastName' => $request->last_name,
            'UserName' => $request->user_name,
            'Password' => Hash::make($request->password),
            'UserType' => 2,
            'ServiceID' => 1,
            'Source' => 'GOOGLE',  
            'Device' => 'ANDROID',
        ];
        $apiURL = 'http://gharelukam.com/gharelukam/api/register';
  
  
        $response = Http::post($apiURL, $data);
  
        $statusCode = $response->status();
        $responseBody = json_decode($response->getBody(), true);
     
        dd($responseBody);
        // event(new Registered($user));

        // Auth::login($user);

        // return redirect(RouteServiceProvider::HOME);
    }
}
