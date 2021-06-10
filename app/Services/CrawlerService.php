<?php
namespace App\Services;

use Symfony\Component\DomCrawler\Crawler;

trait CrawlerService
{
    public static function getCrawledData($url)
    {
        $html = file_get_contents($url);
        $crawler = new Crawler($html);
        try
        {
            $title = $crawler->filterXPath('//title')->text();
        }
        catch (\Exception $e)
        {
            $title = null;
        }

        try
        {
            $image =  $crawler->filterXPath("//meta[@property='og:image']")->attr('content');
        }
        catch (\Exception $e)
        {
            $image = null;
        }

        try
        {
            $desc =  $crawler->filterXPath("//meta[@property='og:description']")->attr('content');
        }
        catch (\Exception $e)
        {
            $desc = null;
        }

        $data = [
            'title' => $title,
            'image' => $image,
            'description'  => $desc
        ];

        return $data;
    }

}
