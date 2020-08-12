<?php

class dl_filefox_cc extends Download
{
	public function CheckAcc($cookie)
	{
		$data = $this->lib->curl("https://filefox.cc/profile", $cookie, "");
		
		if (stristr($data, 'premium account expire'))
		{
			return array(true, "Valid until: " . $this->lib->cut_str(end(explode("Premium account expires", $data)), '<a href="/premium">', '</') . "<br>Traffic restant: ".$this->lib->cut_str(explode("Traffic Available", $data)[1], '<div style="width', '</div>'));
		}
		elseif (stristr($data, 'Free member'))
		{
			return array(false, "Error getting the link from this account.");
		} 
		return array(false, "Error getting the link from this account.");
	}

	public function Login($user, $pass)
	{
		$data = $this->lib->curl("https://filefox.cc/login", "lang=english;", "email={$user}&password={$pass}&op=login&redirect=&rand=");
		$cookie = "lang=english;{$this->lib->GetCookies($data)}";
		 return array(true, $cookie);
	}

	public function Leech($url)
	{
		$data   = $this->lib->curl($url,$this->lib->cookie,"");
		$post	= $this->parseForm($this->lib->cut_str($data, '<form', '</form>'));
		$data   = $this->lib->curl($url,$this->lib->cookie,$post);
		if (stristr($data, 'You have reached your download limit')) $this->error("quota atteint", true, false);
		$link   = $this->lib->cut_str($data,'<a class="btn btn-default" href="','"');
		
		if($link !="") return str_replace(" ","_",$link);
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
