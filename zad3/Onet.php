<?php

/**
 * Onet Model Class
 */
class Onet
{
    private const ONET_URL_FEED = 'https://wiadomosci.onet.pl/.feed';

    /**
     *
     * @return false|SimpleXMLElement
     */

    private function getFeed()
    {
        $content = file_get_contents(self::ONET_URL_FEED);
        if($content){
            $xml = simplexml_load_string($content, 'SimpleXMLElement', LIBXML_NOCDATA);
            if($xml){
                return $xml;
            }
        }

        return false;
    }

    /**
     * Returns list of onet news
     *
     * @return array Associative
     */

    public function getList()
    {
        $xml = $this->getFeed();
        $list = [];

        if(!$xml)
            return [];

        foreach ($xml->entry as $entry) {
            $title = strval($entry->title);
            $url = strval($entry->link['href']);
            $summary = trim(strval($entry->summary));
            $strStart = strpos($summary, 'src="') + 5;
            $strEnd = strpos($summary, '"', $strStart);
            $strLength = $strEnd - $strStart;
            $imgUrl = substr($summary, $strStart, $strLength);

            $list[] = [
                'title' => $title,
                'url' => $url,
                'img' => $imgUrl,
            ];

        }

        return $list;
    }
}