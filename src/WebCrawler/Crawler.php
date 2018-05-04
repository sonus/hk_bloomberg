<?php
namespace WebCrawler;

use WebCrawler\Resource\ResourceInterface;

class Crawler
{
	private function buildCurlOptions($curlHandler)
	{
		curl_setopt_array($curlHandler, array(
	        CURLOPT_HEADER => false,
	        CURLOPT_RETURNTRANSFER => true,
	        CURLOPT_HTTPHEADER => array('Content-Type: text/html; charset=utf-8'),
	        CURLOPT_USERAGENT => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 ' .
	        					 '(KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36',
		));
	}

	private function sendRequest($url)
	{
		$curlHandler = curl_init($url);
		$this->buildCurlOptions($curlHandler);
		$response = curl_exec($curlHandler);
		$error = curl_error($curlHandler);
		if($error) {
			throw new ConnectionError($error);
		}
		return $response;
	}

	public function crawleResource(ResourceInterface $resource)
	{
		$url = $resource->getUrl();
		$response = $this->sendRequest($url);
		$resource->prepareDocument($response);
		return $resource;
	}
}