<?php

class dl_cloudghost_net extends Download {
	
    public function CheckAcc($cookie) {
        $data = $this->lib->curl("https://www.cloudghost.net/?op=my_account", $cookie, "");  
	  	  		if (stristr($data, 'Premium')) {
			$expire  = trim($this->lib->cut_str($data,'Premium account expire<br />','<'));
			$traffic  = trim($this->lib->cut_str($data,'<b>Traffic available today</b><br />','<'));
			return [true, "Expire le : {$expire}<br>Traffic : {$traffic}"];	  
				}	  
			else return array(true, "accfree");
	}
	
    public function Login($user, $pass) {
        $data = $this->lib->curl("https://www.cloudghost.net/", "lang=english", "login={$user}&password={$pass}&op=login");
        $cookie = "lang=en;{$this->lib->GetCookies($data)}";
        return array(true, $cookie);   
    }
	
   public function Leech($url)
    {
        list($url, $pass) = $this->linkpassword($url);
       echo $data = $this->lib->curl($url, $this->lib->cookie, "");
        if ($this->isRedirect($data) && stristr($this->redirect, "/download")) {
            $cook = $this->lib->GetCookies($data);
            $data = $this->lib->curl($this->redirect, "{$cook}{$this->lib->cookie}", "");
        }

        if ($pass) {
            $post = $this->parseForm($this->lib->cut_str($data, '<Form name="F1"', '</Form>'));
            $post["password"] = $pass;
            $data = $this->lib->curl($url, $this->lib->cookie, $post);
            if (stristr($data, 'Wrong password')) {
                $this->error("wrongpass", true, false, 2);
            } elseif (preg_match('/<a href="(.*?)" class="bbc_url"/', $data, $match)) {
                return trim($match[1]);
            }
        }

        if (stristr($data, 'type="password" name="password')) {
            $this->error("reportpass", true, false);
        } elseif (stristr($data, '<h2>Oops File Not Found</h2>') || stristr($data, '<b>File Not Found</b>')) {
            $this->error("dead", true, false, 2);
        } elseif ($this->isRedirect($data)) {
            return $this->redirect;
        } else {
            $post = $this->parseForm($this->lib->cut_str($data, '<Form name="F1"', '</Form>'));
            $data = $this->lib->curl($url, $this->lib->cookie, $post);
            if (preg_match('/<a href="(.*?)" class="bbc_url"/', $data, $match)) {
                return trim($match[1]);
            }
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

