<?php
class Oauth
{
    function __construct()
    {
        global $siteurl;
        $this->callback = $siteurl . 'user/connect.php';//登录回调地址
    }
    public function login()
    {
        global $allapi;
		
		//-------生成唯一随机串防CSRF攻击
        $state = md5(uniqid(rand(), TRUE));
		
		setcookie("Oauth_state",$state,time()+600,'/');
		
        $keysArr = array("redirect_uri" => $this->callback, "state" => $state);
		
        $login_url = $allapi . 'qqlogin/qqlogin.php?' . http_build_query($keysArr);
		
		header("Location:{$login_url}");
		
	    }
    public function callback()
    {
        global $allapi;
		
		//--------验证state防止CSRF攻击
		if ($_GET['state'] != $_COOKIE['Oauth_state']) {
			
         echo"<h2>The state does not match. You may be a victim of CSRF.</h2>";
		 
		}else{
			
        $keysArr = array("code" =>$_GET['code'], "state" =>$_COOKIE['Oauth_state'], "key" =>"zero2109877665");
		
        $token_url = $allapi . 'qqlogin/qqlogin.php?' . http_build_query($keysArr);
		
        $response = file_get_contents($token_url);
		
        $arr = json_decode($response, true);
		
        if ($arr['code']!=1) {
			
         echo'<h3>msg  :</h3>' . $arr['msg'];
        }		
        return $arr;
		}
    }
}
?>