<?php

namespace App\Classes\Crawler\CrawlTypes;

class Selector implements CrawlTypeInterface
{
    private $content;
    private $query;

    /**
     * @return array
     */
    public function crawl() : array
    {
        $extractedContent = [];
        try {
            $titles = $this->getPageXPath()->evaluate($this->query);
            foreach ($titles as $title) {
                $extractedContent[] = $title->textContent.PHP_EOL;
            }
        } catch (\Exception $exception) {

        }

        return $extractedContent;
    }


    /**
     * @return \DOMDocument
     */
    public function getPageContent() : \DOMDocument
    {
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML($this->content);
        return $doc;
    }

    /**
     * @return \DOMXPath
     */
    public function getPageXPath() : \DOMXPath
    {
        return new \DOMXPath($this->getPageContent());
    }

    /**
     * @param $content
     * @return \App\Classes\Crawler\CrawlTypes\CrawlTypeInterface
     */
    public function setContent($content) : CrawlTypeInterface
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @param string $query
     * @return \App\Classes\Crawler\CrawlTypes\CrawlTypeInterface
     */
    public function setQuery(string $query) : CrawlTypeInterface
    {
        $this->query = $query;
        return $this;
    }
}
