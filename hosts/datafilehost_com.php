<?php

class dl_datafilehost_com extends Download {

	public function FreeLeech($url){
		$data = $this->lib->curl($url, "", "");
		$this->save($this->lib->GetCookies($data));
        if (!preg_match('@https?:\/\/www\.datafilehost\.com\/get\.php\?file\=[^"\'><\r\n\t]+@i', $data, $dl)) 
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


?>
