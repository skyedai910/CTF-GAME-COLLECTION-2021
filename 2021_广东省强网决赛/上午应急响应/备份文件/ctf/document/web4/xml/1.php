<?php
//libxml_disable_entity_loader(true);
$xml = <<<EOD
<?xml version="1.0" ?>
<root xmlns:xi="http://www.w3.org/2001/XInclude">
 <xi:include href="file://d:/flag.txt" parse="text"/>
</root>
EOD;
$dom = new DOMDocument;
// let's have a nice output
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
// load the XML string defined above
//$dom->loadXML($xml);
$dom->loadXML($xml,LIBXML_NOENT);
// substitute xincludes
echo $dom->saveXML();
echo LIBXML_DOTTED_VERSION;
?>