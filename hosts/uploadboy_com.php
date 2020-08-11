<?php		 
class dl_uploadboy_com extends Download {
    
   public function CheckAcc($cookie){
        $data = $this->lib->curl("https://uploadboy.com/?op=my_account", "lang=english;{$cookie}", "");
	 
	 	  		if (stristr($data, 'User Type')) {
			$expire  = trim($this->lib->cut_str($data,'<span style="direction: ltr; display: inline-flex;">','<'));
			return [true, "Expire le : {$expire}"];
		}		 	 
		else return array(false, "accinvalid");
    }
    
    public function Login($user, $pass){
        $data = $this->lib->curl("https://uploadboy.com", "lang=english", "login={$user}&password={$pass}&op=login&rand=&redirect=");
		$cookie = "lang=english;{$this->lib->GetCookies($data)}";
		return $cookie;
    }

    public function Leech($url) {
list($url, $pass) = $this->linkpassword($url);
	 $data = $this->lib->curl($url, $this->lib->cookie, "");
		if(stristr($data,'The file was deleted by its owner')) $this->error("dead", true, false, 2);
		if(stristr($data,'The file you were looking for could not be found')) $this->error("dead", true, false, 2);
		if($pass) {
			$post0 = $this->parseForm($this->lib->cut_str($data, '<Form name="F1" method="POST"', '</Form>'));
			$post0["password"] = $pass;
			$data0 = $this->lib->curl($url, $this->lib->cookie, $post0);
			if(stristr($data0,'Wrong password')) $this->error("wrongpass", true, false, 2);
			elseif(preg_match('@https?:\/\/(\w+\.)?uploadboy\.com\/d\/[^"\'><\r\n\t]+@i', $data0, $giay))
			return trim($giay[0]);
		}
		if(stristr($data,'type="password" name="password')) 	$this->error("reportpass", true, false);
        elseif(!$this->isredirect($data)) {
		    $post0 = $this->parseForm($this->lib->cut_str($data, '<Form name="F1" method="POST"', '</Form>'));
			$data0 = $this->lib->curl($url, $this->lib->cookie, $post0);
			if(preg_match('@https?:\/\/(\w+\.)?uploadboy\.com\/d\/[^"\'><\r\n\t]+@i', $data0, $giay))
			return trim($giay[0]);
		}
		else  
		return trim($this->redirect);
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
