<?php

class dl_sundryfiles_com extends Download {
	
    public function CheckAcc($cookie)
    {
		$data = $this->lib->curl("https://sundryfiles.com/account_edit.html", "{$cookie}", "");		  
		  if (stristr($data, 'logout')) {
			$expire  = trim($this->lib->cut_str($data,'Account Expiry Date</label>','Keep'));
			$expire2  = trim($this->lib->cut_str($expire,'>','<'));
			return [true, "Expire le: {$expire2}"];
		}	
			else return array(true, "accfree");
	}
	
    public function Login($user, $pass)
    {
		$data = $this->lib->curl("https://sundryfiles.com/ajax/_account_login.ajax.php", "", "username={$user}&password={$pass}&submitme=1");
        $cookie = $this->lib->GetCookies($data);
        return $cookie;
    }

    public function Leech($url)
    {
       $data = $this->lib->curl($url, $this->lib->cookie, "");

        if (stristr($data, 'File not Found')) {
            $this->error("dead", true, false, 2);
        } elseif (stristr($data, 'daily download traffic has been used')) {
            $this->error("LimitAcc");
        } elseif ($this->isredirect($data)) {
            return trim($this->redirect);
        }

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
