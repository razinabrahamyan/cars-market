<?php

namespace App\Classes\Crawler\CrawlTypes;

class RegExp implements CrawlTypeInterface
{
    private $content;
    private $query;

    /**
     * WebSite Crawling By Regular Expressions
     * @return array
     */
    public function crawl() : array
    {
        $details = [];
        if (is_array($this->query)) {
            foreach ($this->query as $key => $regexp) {
                if (is_array($regexp)) { //If regexp is array, then we will crawl by both expressions and implode them
                    $subDetails = [];
                    foreach ($regexp as $subRegExp) {
                        preg_match($subRegExp, $this->content, $subMatches);
                        $subDetails[] = !empty($subMatches[1]) ? strip_tags(trim($subMatches[1])) : null;
                    }
                    $details[$key] = implode(', ', $subDetails);
                } else { //Simple crawling by regular expression
                    preg_match($regexp, $this->content, $matches);
                    $details[$key] = !empty($matches[1]) ? strip_tags(trim($matches[1])) : null;
                }
            }
        } else {
            preg_match($this->query, $this->content, $matches);
            $details[] = !empty($matches[1]) ? strip_tags(trim($matches[1])) : null;
        }

        return $details;
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
    public function setQuery($query) : CrawlTypeInterface
    {
        $this->query = $query;
        return $this;
    }
}
