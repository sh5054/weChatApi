<?php
	function httpGet($url) {
	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
	    // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
	    // 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
	    // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, true);
	    curl_setopt($curl, CURLOPT_URL, $url);

	    $res = curl_exec($curl);
	    curl_close($curl);

	    return $res;
	  }


	$appid = "wx9ceef590e940454b";
	$appsecret = "f5822eef65d1159c55c118fcbecc67fa";
	$tokenapi = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$appsecret}";
//	$str = file_get_contents($tokenapi); //不稳定 ,微信推荐使用curl()
	$str = httpGet($tokenapi);
	$token = json_decode($str);
	$token = $token->access_token;
	
	
	$userApi = "https://api.weixin.qq.com/cgi-bin/user/get?access_token={$token}";
	$userStr = httpGet($userApi);
	$userlist = json_decode($userStr);
	var_dump($userlist);
	?>