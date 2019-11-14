<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;
use Session;
use App\UserSettings;
use Unirest\Request as Unirest;

class shopifyAppInstallContoller extends Controller
{
    protected $key;
    protected $secret;
    protected $redirect;
    protected $scopes;

    public function __construct()
    {
        $config = (object)Config::get('shopifyApp');
        $this->key = $config->key;
        $this->secret = $config->secret;
        $this->redirect = $config->redirect;
        $this->permission = $config->permission;
    }

    public function index()
    {
    	return view('welcome');
    }

    public function install(Request $request)
    {  
    	$store = UserSettings::where('storename', $request->shop)->get();
    	if(count($store) == 0){
	    	$nonce = base64_decode(rand(1, 1000));
	        $url = 'https://{shop}.myshopify.com/admin/oauth/authorize?client_id={key}&scope={permission}&redirect_uri={redirect}&state={nonce}';
	        $search = ['{shop}', '{key}', '{permission}', '{redirect}', '{nonce}'];
	        $replace = [$request->shop, $this->key, $this->permission, $this->redirect, $nonce];
	        $installUrl = str_replace($search, $replace, $url);
	        return redirect()->to($installUrl);
	    }else{
	    	Session::put('storename', $request->shop);
            return redirect()->route('appMain', ['shop' => $request->shop]);

	    }
    }

    public function getToken(Request $request)
    {
    	UserSettings::where('storename', $request->shop)->delete();
    	$store = UserSettings::where('storename', $request->shop)->get();
    	if(count($store) == 0){
    		$url = 'https://' . $request->shop . '/admin/oauth/access_token';
            $header = array(
                'Accept' => 'application/json',
            );
            $data = array(
                'client_id' => $this->key,
                'client_secret' => $this->secret,
                'code' => $request->code
            );
            $requestOptions = Unirest::verifyPeer(false);
            $response = Unirest::post($url, $header, $data);
            Session::put('storename', $request->shop);
            Session::put('accessToken', $response->body->access_token);
            
            $store = new UserSettings;
            $store->accesstoken = $response->body->access_token;
            $store->storename = $request->shop;
            $store->save();
    	}
    	return redirect()->to("https://" . $request->shop . "/admin/apps/chop-app");
    }

}
