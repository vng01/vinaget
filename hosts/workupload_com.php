<?php

class dl_ extends Download {

   public function FreeLeech($url) {
      	$data = $this->lib->curl($url, "", "");
	  $this->save($this->lib->GetCookies($data));
	  $url = str_replace('workupload.com/file/', 'workupload.com/start/', $url);
	  $data1 = $this->lib->curl($url, $this->lib->cookie, "");
	  
   $cap=$this->lib->cut_str($data1,'url: \'','\'');
	   $dl = "https://workupload.com/{$cap}";
	   $dl2 = $this->lib->curl($dl, $this->lib->cookie, "");
	    $cap2=$this->lib->cut_str($dl2,'{"url":"','"');
	  $cap3 = str_replace('\/', '/', $cap2);
	 
     return trim($cap3);
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
