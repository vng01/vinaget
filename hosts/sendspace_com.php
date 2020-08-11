<?php

class dl_sendspace_com extends Download {
		
	    public function CheckAcc($cookie)    {
		$data = $this->lib->curl("https://www.sendspace.com/mysendspace/myindex.html", $cookie, "");		
		
			  		if (stristr($data, 'Your account status')) {			
			$expire=$this->lib->cut_str($data,'<h1>Your account status:</h1>','</');
			$expire1  = trim($this->lib->cut_str($expire,' <b>',''));
			$traffic  = trim($this->lib->cut_str($data,'<li class="">You have','available'));
			return [true, "Type de compte : {$expire1}<br>Traffic : {$traffic}"];
		}	  	  				
			else return array(true, "accfree");
	}
				
    public function Login($user, $pass){
        $data = $this->lib->curl("http://www.sendspace.com/login.html", "", "remember=on&action=login&submit=login&username={$user}&password={$pass}");
        $cookie = $this->lib->GetCookies($data);
		return $cookie;
    }
	
    public function Leech($url) {
		$data = $this->lib->curl($url, $this->lib->cookie, "");
		if(stristr($data,"Sorry, the file you requested is not available.")) $this->error("LienDead", true, false, 2);
		elseif(!$this->isredirect($data)) {
			if(preg_match('@https?:\/\/fs(\d+)?n(\d+)?\.sendspace\.com(:\d+)?\/dlp\/[^"\'><\r\n\t]+@i', $data, $giay))  
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
* sendspace.com Download Plugin by giaythuytinh176 [17.8.2013]
* Downloader Class By [FZ]
*/
?>
