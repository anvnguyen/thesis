<?php

//To encode the html content to utf-8 
header( "content-type: text/html; charset=utf-8" );

class Crawler
{
	public function init()
	{
		
	}

	/*This function is to get the html content of a url
	*/
	public function getContentURL($url)
	{
		$data = $this->getRawHTML($url);

		return $this->repairHtmlContent($data);
	}

	public function getRawHTML($url)
	{
		$ch = curl_init();
		$timeout = 60;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$data = curl_exec($ch);
		curl_close($ch);

		return $data;
	}

	/* Use HTML Tidy extension of PHP to repair and clean invalid html content
	*/

	private function repairHtmlContent($html)
	{
		if (function_exists('tidy_repair_string')) {
			$config = array(
				'clean'=>true, 
				// 'show-body-only'=>true
				);
			$encoding = 'utf8';
			$html = tidy_repair_string($html, $config, $encoding);

			$html = mb_convert_encoding($html, 'html-entities', 'utf-8'); 

			return $html;
		}else{
			die('Function "tidy_repair_string" does not exist');
		}
	}
}

?>