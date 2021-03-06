<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Passport\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = Client::find(2);
    }

    public function login(Request $request){

        $http = new \GuzzleHttp\Client;

        $user = [
            'email'=>$request->email,
            'password'=>$request->password,
            'role_id'=>3,
            'is_login'=>'0',
            'is_active'=>'1',
            'is_verified'=>'1',
        ];
        $staff = [
            'email'=>$request->email,
            'password'=>$request->password,
            'role_id'=>2,
            'is_login'=>'0',
            'is_active'=>'1',
            'is_verified'=>'1',
        ];
        $admin = [
            'email'=>$request->email,
            'password'=>$request->password,
            'role_id'=>1,
            'is_login'=>'0',
            'is_active'=>'1',
            'is_verified'=>'1',
        ];
        $check = DB::table('uctc_users')->where('email',$request->email)->first();

        if ($check->is_verified == '1'){
            if ($check->is_active =='1'){
                if ($check->is_login =='0'){
                    if (Auth::attempt($user)||Auth::attempt($staff)||Auth::attempt($admin)){
                        $this->isLogin(Auth::id());
                        $response = $http->post('http://uctc.test/oauth/token',[
                            'form_params'=>[
                                'grant_type' => 'password',
                                'client_id' => $this->client->id,
                                'client_secret' => $this->client->secret,
                                'username' => $request->email,
                                'password' => $request->password,
                                'scope' => '*',
                            ]
                        ]);
                        return json_decode((string)$response->getBody(),true);
                    }
                    else{
                        return response([
                            'message' => ' Login Failed'
                        ]);
                    }
                }
                else{
                    return response([
                        'message' => 'Account in use'
                    ]);
                }
            }
            else{
                return response([
                    'message' => 'Account Suspended'
                ]);
            }
        }
        else{
            return response([
                'message' => 'Please Verify'
            ]);
        }
    }

    private function isLogin(int $id){
        $acc = User::findOrFail($id);
        return $acc->update([
            'is_login' => '1',
        ]);
    }

    public function refresh(Request $request){
        $this->validate($request,[
            'refresh_token' => 'required',
        ],[
            'refresh_token' => 'refresh token is required',
        ]);

        $http = new \GuzzleHttp\Client;

        $response = $http->post('http://guestbook.test/oauth/token',[
            'form_params'=>[
                'grant_type' => 'refresh_token',
                'client_id' => $this->client->id,
                'client_secret' => $this->client->secret,
                'refresh_token' => $request->refresh_token,
                'scope' => '*',
            ]
        ]);

        return json_decode((string)$response->getBody(),true);

    }

    public function logout(){
        $currentUser = Auth::user();
        $accessToken = Auth::user()->token();
        DB::table("oauth_refresh_tokens")
            ->where('access_token_id', $accessToken->id)
            ->update(['revoked'=>true]);

        $currentUser->update([
            'is_login' => '0',
        ]);
        $accessToken->revoke();

        return response([
            'message' => 'Logged Out'
        ]);
    }

}
