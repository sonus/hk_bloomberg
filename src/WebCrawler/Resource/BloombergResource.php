<?php
namespace WebCrawler\Resource;

class BloombergResource extends AbstractResource 
							  implements ResourceInterface
{
	public function getPrice()
	{
		$xpath = '//*[@id="root"]/div/div/section[2]/div[1]/div/section[1]/section/section[2]/section/div[1]/span[1]';
		return $this->getNodeValue($xpath);
	}

	public function getHighPrice()
	{
		$xpath = '//*[@id="root"]/div/div/section[2]/div[1]/div/section[1]/div/section/section[5]/div/div/span[2]';
		return $this->getNodeValue($xpath);
	}

	public function getLowPrice()
	{
		$xpath = '//*[@id="root"]/div/div/section[2]/div[1]/div/section[1]/div/section/section[5]/div/div/span[1]';
		return $this->getNodeValue($xpath);
	}
}