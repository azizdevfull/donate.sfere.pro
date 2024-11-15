<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;

use Illuminate\Foundation\Application;
use App\Http\Controllers\Controller;


class OauthController extends Controller
{
    public function redirectToProId($isMobileOrWeb): JsonResponse|Redirector|Application|RedirectResponse
    {
        // info('salom');
        $client_id_map = [
            'web_client' => '60',
        ];

        $client_id = $client_id_map[$isMobileOrWeb] ?? '';
        $callbackUri = "https://donate.sfere.pro/oauth/proid/web_client/callback";
        if (!empty($client_id) && !empty($callbackUri)) {
            $query = http_build_query([
                'client_id' => $client_id,
                'redirect_uri' => $callbackUri,
                'response_type' => 'code',
                'scope' => '',
                'state' => 'abcdabcdabcdabcdabcd',
                'prompt' => 'consent',
            ]);
            return redirect('https://id.sfere.pro/oauth?' . $query);
        } else {
            return response()->json([
                'message' => __('errors client does not have permission')
            ]);
        }
    }

    public function handleProIdCallback($isMobileOrWeb, Request $request): JsonResponse|Redirector|Application|RedirectResponse
    {
        // info($request->all());
        // dd($request->all());
        $clientData = [
            'web_client' => [
                'client_id' => 60,
                'client_secret' => 'zOd8rVaqsnOrzVIsswREw5i4dUL672471432b6e3',
            ],
        ];

        $clientSecret = $clientData[$isMobileOrWeb]['client_secret'];
        $clientId = $clientData[$isMobileOrWeb]['client_id'];
        $callbackUri = "https://donate.sfere.pro/oauth/proid/$isMobileOrWeb/callback";
        // dd($request->code);
        //getting user data
        $response = Http::asForm()->post('https://api.id.sfere.pro/api/v2/oauth/token', [
            'grant_type' => 'authorization_code',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'redirect_uri' => $callbackUri,
            'code' => $request->code,
        ]);

        $responseData = $response->json();
        // info($responseData);
       if (!isset($responseData['access_token'])) {
            return redirect()->route('proid.login','web_client');
        }

        $accessToken = $responseData['access_token'];

        $userRes = Http::withToken($accessToken)->get('https://api.id.sfere.pro/api/user');

        $userData = $userRes->json();
        // dd($userData);
        $user = User::where('phone_number', $userData['phone_number'])->orWhere('email', $userData['phone_number'])->orWhere('email', $userData['email'])->first();
        if ($user) {
            auth()->login($user);
            return redirect('/');
        } else {
            auth()->logout();
            $user = User::create([
                'role' => $userData['is_admin'] ? 'admin' : 'normal',
                'name' => $userData['name'],
                'username' => $userData['phone_number'],
                'avatar' => $userData['avatar_full_url'],
                'coutries_id' => 229,
                'date' => $userData['date_of_birth'],
                'email' => $userData['email'] ? $userData['email'] : $userData['phone_number'],
                'phone_number' => $userData['phone_number'],
                'password' => bcrypt($userData['phone_number']),
            ]);
           
        auth()->login($user);

            return redirect('/');
        }
        return redirect('/');
    }
}
