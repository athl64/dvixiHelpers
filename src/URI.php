<?php

namespace dvixi;

/**
 * @version 1.0.1
 * */
class URI
{
    /**
     * Extract domain prefix for requested url string
     * extracting only one domain prefix ( http(s)://XXX.domain.com )
     *
     * @param $url string
     * @param $domainBaseName string
     *
     * @return mixed
     * */
    public static function extractDomainPrefix( $url, $domainBaseName )
    {
        $domainBaseName = str_replace('.', '\.', $domainBaseName);
        $re = "/http[s]?:\\/\\/([0-9a-zA-Z-_\.]+)\\." . $domainBaseName . "/";
        preg_match($re, $url, $matches);

        return isset($matches[1]) ? $matches[1] : null;
    }

    /**
     * Extract protocol from request string
     * example string: http://some_domain.net[params of request] - will return http
     *
     * @param $url string
     *
     * @return mixed
     * */
    public static function extractProtocol( $url )
    {
        $re = "/([a-zA-Z]+):\/\//";
        preg_match($re, $url, $matches);

        return isset($matches[1]) ? $matches[1] : null;
    }

    /**
     * Get full domain url, example:
     * 'http://site.com.dev/index' will return 'http://site.com.dev'
     *
     * @param $url string
     *
     * @return mixed
     * */
    public static function extractFullDomainUrl( $url )
    {
        $re = "/(http[s]?:\\/\\/[0-9a-zA-Z-_\.]+)/";
        preg_match($re, $url, $matches);

        return isset($matches[1]) ? $matches[1] : null;
    }

    /**
     * Extract video ID from valid Youtube's video URL
     * Return null if URL have invalid format (format valid at 30.09.2015)
     *
     * @return mixed
     * */
    public static function extractYoutubeVideoId( $url )
    {
        $re = "/^(?:http(?:s)?:\\/\\/)?(?:www\\.)?(?:m\\.)?(?:youtu\\.be\\/|youtube\\.com\\/(?:(?:watch)?\\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\\/))([^\\?&\\\"'>]+)/";
        $str = $url;

        preg_match($re, $str, $matches);

        return isset($matches[1]) ? $matches[1] : null;
    }

}