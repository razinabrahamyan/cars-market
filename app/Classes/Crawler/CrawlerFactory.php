<?php

namespace App\Classes\Crawler;

use App\Classes\Crawler\CrawlTypes\CrawlTypeInterface;
use GuzzleHttp\Client;

class CrawlerFactory
{
    protected $crawlType;
    protected $query = '';

    /**
     * @param \App\Classes\Crawler\CrawlTypes\CrawlTypeInterface $crawlType
     */
    public function __construct(CrawlTypeInterface $crawlType)
    {
        $this->crawlType = $crawlType;
    }

    /**
     * Crawling Factory
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function crawl()
    {
        $result = null;
        try {
            $result = $this->crawlType->setContent($this->getPageBody()) //set page DOM content
                                      ->setQuery($this->query) //set regexp for crawling
                                      ->crawl(); //start crawling

        } catch (\Exception $exception) {
            dd($exception);
        }

        return $result;
    }

    /**
     * Preparing website content
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPageBody() : string
    {
        $httpClient = new Client(['http_errors' => false]);
        $response = $httpClient->get($this->pageUrl);
        return (string)$response->getBody();
    }

    /**
     * @param string $pageUrl
     * @return \App\Classes\Crawler\CrawlerFactory
     */
    public function setPageUrl(string $pageUrl) : CrawlerFactory
    {
        $this->pageUrl = $pageUrl;
        return $this;
    }

    /**
     * @param $query
     * @return \App\Classes\Crawler\CrawlerFactory
     */
    public function setQuery($query) : CrawlerFactory
    {
        $this->query = $query;
        return $this;
    }
}
