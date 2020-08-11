<?php

class dl_uploadgig_com extends Download
{

    public function CheckAcc($cookie)
    {
		$data = $this->lib->curl("https://uploadgig.com/user/my_account", $cookie, "");
		if (stristr($data, 'P')) return array(true, "Premium Until: ".$this->lib->cut_str($data, "Package expire date:","Renew"));
			else return array(true, "accfree");
	}
	
    public function Login($user, $pass)
       {
        $data = $this->lib->curl("https://uploadgig.com/login/form", "", "");
        $cook = $this->lib->GetCookies($data);
        if (preg_match('/<input type="hidden" name="csrf_tester" value="(.*?)"/', $data, $match)) {
            $csrf_tester = $match[1];
        }

        $data = $this->lib->curl("https://uploadgig.com/login/do_login", $cook, "csrf_tester={$csrf_tester}&email={$user}&pass={$pass}&rememberme=1");
        if (stristr($data, '"state":"3"')) {
            $this->error("Uploadgig.com: " . $this->lib->cut_str($data, '"msg":"', '"}'), true, true);
        }
        $cookie = preg_replace('/(firewall=.*?; )/', '', $this->lib->GetCookies($data));

        return $cookie;
    }

    public function Leech($url)
    {
        $data = $this->lib->curl($url, $this->lib->cookie, "");
        if (stristr($data, '<h2>File not found</h2>')) {
            $this->error("LienDead", true, false, 2);
        } 
	    $data = str_replace("/g/", "/go/", $data);
	          if (!preg_match('@https?:\/\/\w+\.uploadgig\.com\/[^"\'><\r\n\t]+@i', $data, $dl))				  
		$this->error("notfound", true, false, 2);  
		else  	
		return trim($dl[0]);
		return false;	 

    }

}

/*
* Open Source Project
* Vinaget by ..::[H]::..
* Version: 2.7.0
* Download Plugin by vng01 [12.8.2020]
* Downloader Class By [FZ]
*/
?>
