<?php

class dl_file_upload_net extends Download {

   public function FreeLeech($url) {
   $data = $this->lib->curl($url, "", "");
   $action=$this->lib->cut_str($data,'<form method="post" id="downloadstart" action="','"');
	 $valider=$this->lib->cut_str($data,'id=\'valid\' name=\'valid\' value=\'','\'');
	 $red = $this->lib->curl($action,"","valid=$valider");
	    if (!preg_match('@https?:\/\/data\.simpleupload\.net\/[^"\'><\r\n\t]+@i', $red, $dl)) 
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
