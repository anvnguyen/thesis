<?php

class Constant
{
	public function init()
	{
		
	}

	/*This function is to get the html content of a url
	*/
	public function getContentURL($url)
	{
		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}

	public function getGlobalVar()
	{
		return 1;
	}

	public function debug($message)
	{
		print_r('<pre>');
		var_dump($message);
		print_r('</pre>');
		die();
	}
}

?>