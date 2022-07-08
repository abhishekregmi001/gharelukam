<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $data = [
            'FirstName' =>'abhishek',
            'LastName' => 'regmi',
            'UserName' => $user->email,
            'Password' => encrypt('12345678'),
            'Source' => 'GOOGLE',
            'Device' => 'WEB',
            'ImgType'=> '1',
            'Img'=>'',
        ];

        $apiURL = 'http://gharelukam.com/gharelukam/api/register';

        $headers = [
            'X-header' => 'value'
        ];

        $response = Http::withHeaders($headers)->post($apiURL, $data);

        $statusCode = $response->status();
        $responseBody = json_decode($response->getBody(), true);

        dd($responseBody);
    }
}
