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
		$data = @$this->getRawHTML($url);

		return @$this->repairHtmlContent($data);
	}

	public function getTidyHTML($rawHTML)
	{
		return @$this->repairHtmlContent($rawHTML);
	}

	public function getRawHTML($url)
	{	
		$ch = curl_init();
		$timeout = 3600;
		curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17');
		curl_setopt($ch, CURLOPT_HEADER, 0); 
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_TIMEOUT_MS, $timeout);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);				
		$html = @curl_exec($ch);		
		return $html;
	}

	/* Use HTML Tidy extension of PHP to repair and clean invalid html content
	*/

	private function repairHtmlContent($html)
	{
		if (function_exists('tidy_repair_string')) {
			$config = array(
				'clean'=>true, 
				'show-body-only'=>true
				);
			$encoding = 'utf8';
			$html = @tidy_repair_string($html, $config, $encoding);
			$html = mb_convert_encoding($html, 'html-entities', 'utf-8'); 

			return $html;
		}else{
			die('Function "tidy_repair_string" does not exist');
		}
	}
}

?>