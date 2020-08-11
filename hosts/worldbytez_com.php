<?php

class dl_worldbytez_com extends Download
{

    public function CheckAcc($cookie)
    {

		$data = $this->lib->curl("https://worldbytez.com/?op=my_account", $cookie, "");		
		if (stristr($data, 'logout')) {
			$expire  = trim($this->lib->cut_str($data,'<span class="label label-success">','<'));			
			return [true, "Expire le: {$expire}"];
		}	
			else return array(true, "accfree");
	}
	

    public function Login($user, $pass)
    {
        $page = $this->lib->curl("https://worldbytez.com/?op=login", "", "");
		$cook = $this->lib->cut_str($page, 'name="token" value="', '"');
		$data = $this->lib->curl("https://worldbytez.com/", $this->lib->GetCookies($page), "op=login&token={$cook}&login={$user}&password={$pass}");
        $cookie = $this->lib->GetCookies($data);
        return array(true, $cookie);		
		
    }

    public function Leech($url)
    {		
		 list($url, $pass) = $this->linkpassword($url);
	  $id = $this->lib->cut_str($url, '/worldbytez.com/','/');
      $data1 = $this->lib->curl("https://worldbytez.com/download", $this->lib->cookie,"op=download2&id={$id}&rand=&referer=&method_free=&method_premium=1&adblock_detected=1", 0);	  
        if (!preg_match('@http?:\/\/\w+\.worldbytez\.com:182\/[^"\'><\r\n\t]+@i', $data1, $dl)) 
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
* sendspace.com Download Plugin by vng01 [12.8.2020]
* Downloader Class By [FZ]
?>
