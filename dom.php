
<?php
/**
 * @author James Morris <james@jmoz.co.uk>
 */

header( "content-type: text/html; charset=utf-8" );

//TODO: get html content then clean using tidy

//get html 
// $html = file_get_contents('http://muachung.vn/tp-ho-chi-minh');
// $html = mb_convert_encoding($html, 'html-entities', 'utf-8'); 


if (function_exists('tidy_repair_string')) {
	// $config = array('clean'=>true, 'show-body-only'=>true);
	// $encoding = 'utf8';
	// $html = tidy_repair_string($html, $config, $encoding);

	// $html = mb_convert_encoding($html, 'html-entities', 'utf-8'); 

	// file_put_contents('data.html', $html);
 
	$doc = new DomDocument();
	@$doc->loadHTMLFile('data.html');

	// print_r('<pre>');
	// var_dump($doc);
	// print_r('</pre>');
	// exit();

	$xpath = new DomXpath($doc);
	 
	// $entries = $xpath->query("//div[@class='v6ItemContent']/div[@class='v6ItemTitle']");
	$entries = $xpath->query("//div[@class='v6ItemCon v6ItemContent']");
	// $entries = $xpath->query("html/body/div[2]/div[2]/div[2]/div[2]/div/div[2]/div/div");

	var_dump($entries);
	exit();
	 
	$results = array();
	 
	foreach ($entries as $entry) {
	    
	    // pass in the $entry node as the context node, the the query is relative to it
	    
	    $node = $xpath->query("div/img[@class='fooimage']/attribute::src", $entry); // returns a DOMNodeList
	    $result['image_src'] = $node->item(0)->value; // get the first node in the list which is a DOMAttr
	    
	    $node = $xpath->query("p[@class='description']", $entry);
	    $result['desc'] = $node->item(0)->nodeValue;
	    
	    $results[] = $result;
	}
	 
	// print_r($results);
	print_r('<pre>');
	var_dump($results);

	print_r('</pre>');
	die();
}

?>