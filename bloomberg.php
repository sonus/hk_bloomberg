<?php
require('vendor/autoload.php');

use WebCrawler\Crawler;
use WebCrawler\Resource\BloombergResource;

$crawler = new Crawler();
$resource = new BloombergResource(
	'https://www.bloomberg.com/' .
	'quote/ASX:US'
);
$crawler->crawleResource($resource);

echo "Price :". $resource->getPrice();
echo "\n";
echo "Low Price :". $resource->getLowPrice();
echo "\n";
echo "Hight Price :". $resource->getHighPrice();
echo "\n";


