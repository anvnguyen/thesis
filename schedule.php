<?php 

startJob();

function startJob()
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_URL, "localhost/thesis/index.php?r=site/schedule"); 
	curl_setopt($ch, CURLOPT_TIMEOUT_MS, 36000);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  			
	$result = curl_exec($ch);		

	var_dump($result);
}

?>