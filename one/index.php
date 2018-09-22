<?php

$url = 'http://fr.wikipedia.org/wiki/Wikip%C3%A9dia:Image_du_jour/mars_2015';
$cacheDir = '.cache';
$cacheFile = $cacheDir.'/'.sha1($url);

//avoid  malformed html error
libxml_use_internal_errors(true);

if(!file_exists($cacheDir)){
    mkdir($cacheDir);
}

if(file_exists($cacheFile)){
    $content = file_get_contents($cacheFile);
}else{
    $content = file_get_contents($url);
    file_put_contents($cacheFile, $content);
}



$doc = new DOMDocument();
$doc->loadHTML($content);

//create DOmXpath
$xpath = new DOMXpath($doc);
$elements = $xpath->query('//table');


$table = new DOMDocument();
foreach ($elements as $element){
    $copy = $table->importNode($element, true);
    $table->appendChild($copy);
}

$table->save('.cache/table.xml');


$xslt = new DOMDocument();
$xslt->load('xsltocsv.xsl');

$proc = new XSLTProcessor();
$proc->importStylesheet($xslt);

$contentCSV = $proc->transformToXml($table);
file_put_contents('.cache/final.csv', $contentCSV);

libxml_use_internal_errors(false);


