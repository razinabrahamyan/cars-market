<?php

namespace App\Classes\Crawler\CrawlTypes;

interface CrawlTypeInterface
{
    public function crawl();

    public function setContent($content): CrawlTypeInterface;

    public function setQuery($query): CrawlTypeInterface;
}
