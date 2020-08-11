<?php

class dl_anonfile_com extends Download {

public function FreeLeech($url){
		$data = $this->lib->curl($url, "", "");
		   if(stristr($data, "The file you are looking for does not exist")) $this->error("LienDead", true, false, 2);
       if (!preg_match('@https?:\/\/cdn-(\d+\.)anonfile\.com\/[^"\'><\r\n\t]+@i', $data, $dl))  
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
