<?php

namespace App\Crawler;

class Crawler
{
    protected $website;

    public function __construct($website)
    {
        $this->website = $website;
    }

    public function containsText($query)
    {
        try {
            $html = $this->getHtml();

            if (stripos($html, $needle) === false) {
                return false;
            }

            return true;

        } catch (Exception $e) {
            return false;
        }
    }

    public function getHtml()
    {
        return file_get_contents($this->website);
    }
}