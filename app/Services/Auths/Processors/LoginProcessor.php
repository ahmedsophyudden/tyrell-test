<?php

namespace App\Services\Auths\Processors;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Constants\LoginType;

class LoginProcessor
{
    
    private $loginType;

    private $credentials;

    private $email;

    private $user_id;

    public function execute(Request $request, int $loginType)
    {

        $this->loginType = $loginType;

        $this->credentials = $request->only('email', 'password');
        
        try {
            if($this->loginType == LoginType::NORMAL){
                return $this->_attemptLogin();
            }else if($this->loginType == LoginType::TOKEN){
                $this->email = $request->email;
                return $this->_attemptLoginToken();
            }else if($this->loginType == LoginType::SOCIALITE){
                $this->user_id = rtrim(strtr(base64_decode($request->userid), '+/', '-_'), '=');

                return $this->_attemptLoginSocialite();
            }
        } catch (Exception $error) {
            abort(401, $error->getMessage());
            // throw $error;
        }

    }
    
    private function _attemptLogin(){

        if (Auth::attempt($this->credentials)) {
            $user = User::where('email', $this->email)->first();

            Session::put('user_id', @$user->id);

            return ['data' => Auth::user()];
        }else{
            throw new Exception('Username or Password don\'t match');
        }

    }
    
    private function _attemptLoginToken(){

        if (Auth::attempt($this->credentials)) {
            $user = User::where('email', $this->email)->first();

            $token = $user->createToken('Auth Token', [
                    'user_id:' . @$user->id, 
                ]
            )->plainTextToken;

            return ['data' => $token];
        }else{
            throw new Exception('Username or Password don\'t match');
        }

    }
    
    private function _attemptLoginSocialite(){

        if($this->user_id != 0){
            if (Auth::loginUsingId($this->user_id)) {

                Session::put('user_id', $this->user_id);

                return ['data' => Auth::user()];
            }
        }
        throw new Exception('Username or Password don\'t match');

    }

}
