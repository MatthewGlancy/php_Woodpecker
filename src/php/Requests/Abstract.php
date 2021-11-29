<?php

namespace Woodpecker\Requests;

abstract class AbstractRequest
{
    const QUERY_PAGE = 'page';
    const QUERY_PER_PAGE = 'per_page';
    const QUERY_SORT = 'sort';

    private $_strURL;
    private $_strAccessToken;
    private static $_guzzleConnection;
    protected $_arrParams;

    abstract protected function _getPostBody();
    abstract protected function _getQueryString();
    abstract protected function _getPath();

    final public function __construct(
        $strURL,
        $strAccessToken,
        Array $arrParams = []
    )
    {
        if (empty($strURL) || empty($strAccessToken)) {
            throw new \Exception(
                "Unable to create instance - Missing URL OR Key"
            );
        }

        if(!defined('static::METHOD')) {
            throw new \Exception('DEV ERROR: Define METHOD on any request class');
        }

        $this->_strURL          = $strURL;
        $this->_strAccessToken  = $strAccessToken;
        $this->_arrParams       = $arrParams;
    }

    /**
     * Used for testing
     *      This injects in a GuzzleConnection so we can
     *      mock this
     *
     * @param \GuzzleHttp\Client $guzzleConnection
     **/
    public static function injectGuzzle(
        \GuzzleHttp\Client $guzzleConnection
    )
    {
        static::$_guzzleConnection    = $guzzleConnection;
    }

    /**
     * @return \GuzzleHttp\Client
     */
    protected static function _getGuzzle($strBaseUri, $strAccessToken)
    {
        if (!static::$_guzzleConnection) {
            $arrDefaults                = [
                'base_uri'              => $strBaseUri,
                'timeout'               => 10,
                'connect_timeout'       => 10,
                'headers'               => [
                    'Accept'            => 'application/json',
                    'Accept-Encoding'   => 'gzip, deflate',
                    'Authorization'         => $strAccessToken
                ],
                "verify"                => false
            ];
            static::$_guzzleConnection    = new \GuzzleHttp\Client($arrDefaults);
        }
        return static::$_guzzleConnection;
    }
    /**
     * @return Array json decoded body
     * 
     * @throws Exception if response code !== 200
     */
    public function call()
    {
        $guzzleConnection = static::_getGuzzle($this->_strURL, $this->_strAccessToken);

        $response                   = $guzzleConnection
            ->request(
                static::METHOD,
                $this->_getPath(),
                [
                    'query'         => $this->_getQueryString(),
                    'body'          => $this->_getPostBody()
                ]
            );

        if (200 !== intval($response->getStatusCode())) {
            throw new \Exception(
                $response->getStatusCode().'-'.$response->getReasonPhrase()
            );
        }

        return json_decode(
            (string)$response->getBody(), true
        );
    }

    protected function _getParam(
        string $strKey,
        $defaultValue = null
    ) {
        if(!array_key_exists($strKey, $this->_arrParams)) {
            return $defaultValue;
        }
        return $this->_arrParams[$strKey];
    }
}