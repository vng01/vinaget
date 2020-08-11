<?php
class dl_rapidu_net extends Download {
	
    public function CheckAcc($cookie) {
        
		$data = $this->lib->curl("https://rapidu.net/settings/", $cookie, "");
		if (stristr($data, 'logout')) {
			$expire  = trim($this->lib->cut_str($data,'Account: <b>Premium','<'));
			$traffic  = trim($this->lib->cut_str($data,'class="tipsyS"><b>','<'));
			return [true, "Expire dans : {$expire}<br>Traffic : {$traffic}"];
		}			
			else return array(true, "accfree");
	}
    public function Login($user, $pass) {
        $data = $this->lib->curl("https://rapidu.net/ajax.php?a=getUserLogin", "lang=english", "login={$user}&pass={$pass}&_go=");
        $cookie = "lang=english;{$this->lib->GetCookies($data)}";
        return $cookie;
    }
    public function Leech($url) {

		$data = $this->lib->curl($url, $this->lib->cookie, "");		
		 $data = str_replace('https:', 'http:', $data);
		 $dl = str_replace('https:', 'http:', $dl);
		 if(stristr($data, "File not found")) $this->error("LienDead", true, false, 2);
        if (!preg_match('@https?:\/\/s(\d+\.)rapiduservers\.net\/[^"\'><\r\n\t]+@i', $data, $dl)); 
		return trim($dl[0]);
		if(stristr($data, "File not found")) $this->error("LienDead", true, false, 2);     
		elseif($this->isredirect($data)) return trim($this->redirect);
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
