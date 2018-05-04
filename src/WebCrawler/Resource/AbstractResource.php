<?php
namespace WebCrawler\Resource;

use \DOMDocument;
use \DOMXPath;
use WebCrawler\Exception\EmptyResultError;

abstract class AbstractResource
{
	private $document;

	protected $url;

	public function prepareDocument($content)
	{
		libxml_use_internal_errors(true);
		$doc = new DOMDocument();
		$doc->loadHTML($content);
		$xpathDoc = new DOMXPath($doc);
		$this->document = $xpathDoc;
	}

	protected function getDocument()
	{
		return $this->document;
	}

	private function getItem($xpath)
	{
		$item = $this->getDocument()->query($xpath);
		if(!$item->length) {
			throw new EmptyResultError('Empty result in :' . $xpath);
		}
		return $item->item(0);
	}

	public function getUrl()
	{
		return $this->url;
	}

	protected function getBaseUrl()
	{
		$parsedUrl = parse_url($this->url);
		return sprintf('%s://%s', $parsedUrl['scheme'], $parsedUrl['host']);
	}

	protected function getNodeValue($xpath)
	{
		return $this->getItem($xpath)->textContent;
	}

	protected function getAttributeValue($xpath, $attribute)
	{
		return $this->getItem($xpath)->attributes->getNamedItem($attribute)->textContent;
	}

	public function __construct($url)
	{
		$this->url = $url;
	}
}