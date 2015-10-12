<?php

namespace MattCannon\EstateAgents\Media;


/**
 * Class Media
 * @package MattCannon\EstateAgents\Media
 */
abstract class Media
{

    /**
     * @var string
     */
    protected $url = '';
    /**
     * @var string
     */
    protected $caption = '';

    /**
     * @param $url
     * @param $caption
     * @return static
     */
    public static function fromUrlAndCaption($url, $caption)
    {
        $media = new Static();

        $media->url = $url;
        $media->caption = $caption;

        return $media;
    }

    /**
     * @return string
     */
    public function url()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function caption()
    {
        return $this->caption;
    }
}