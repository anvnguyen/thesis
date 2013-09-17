<?php
/**
 * @author James Morris <james@jmoz.co.uk>
 */
 
header( "content-type: text/html; charset=utf-8" );

$html = <<<'EOF'
<html>
	<body>
		<h1>Foo</h1>
		<div id="content">
			<div class="foo">
				<div><img class="fooimage" src="http://foo.com/bar.png" /></div>
				<p class="description">Nguyễn Văn Tèo</p>
			</div>
			<div class="foo">
				<div><img class="fooimage" src="http://foo.com/baz.png" /></div>
				<p class="description">Nguyễn Văn An</p>
			</div>
		</div>
	</body>
</html>
EOF;

$html = mb_convert_encoding($html, 'html-entities', 'utf-8'); 

$doc = new DOMDocument();
$doc->substituteEntities = TRUE;
$doc->loadHTML($html);

$xpath = new DOMXpath($doc);
 
$entries = $xpath->query("//div[@id='content']/div[@class='foo']");

// print_r('<pre>'); 
// print_r($entries);
// print_r('</pre>');
// exit();
 
$results = array();
 
foreach ($entries as $entry) {
    
    // pass in the $entry node as the context node, the the query is relative to it
    
    $node = $xpath->query("div/img[@class='fooimage']/attribute::src", $entry); // returns a DOMNodeList
    $result['image_src'] = $node->item(0)->value; // get the first node in the list which is a DOMAttr
    
    $node = $xpath->query("p[@class='description']", $entry);
    $result['desc'] = $node->item(0)->nodeValue;
    
    $results[] = $result;
}
 
print_r('<pre>'); 
print_r($results);
print_r('</pre>');