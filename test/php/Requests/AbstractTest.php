<?php
namespace Woodpecker\Requests;

use Canddi\TriggerActionModel\Test;

class TestRequest
    extends AbstractRequest
{
    const METHOD = 'GET';

    const PATH = '/123';
    const QUERY = [
        'query' => 'string'
    ];
    const BODY = [
        'body' => 'json'
    ];

    public function _getQueryString()
    {
        return self::QUERY;
    }

    public function _getPostBody()
    {
        return self::BODY;
    }

    public function _getPath()
    {
        return self::PATH;
    }
}

class AbstractTest
    extends \Woodpecker\TestCase
{
    public function testConstruct()
    {
        $strURL = 'url';
        $strAccessToken = 'AccessToken';
        $arrParams = [
            'parameter' => true
        ];
        $request = new TestRequest(
            $strURL,
            $strAccessToken,
            $arrParams
        );

        $this->assertEquals(
            $strURL,
            $this->_getProtAttr($request, '_strURL')
        );
        $this->assertEquals(
            $strAccessToken,
            $this->_getProtAttr($request, '_strAccessToken')
        );
        $this->assertEquals(
            $arrParams,
            $this->_getProtAttr($request, '_arrParams')
        );
    }

    public function testGetParam()
    {
        $strKey = 'parameter';
        $strValue = '123';
        $strURL = 'url';
        $strAccessToken = 'AccessToken';
        $arrParams = [
            $strKey => $strValue
        ];
        $request = new TestRequest(
            $strURL,
            $strAccessToken,
            $arrParams
        );


        $this->assertEquals(
            $strValue,
            $this->_invokeProtMethod(
                $request, '_getParam', 'parameter'
            )
        );
    }

    public function testCall()
    {
        $strKey = 'parameter';
        $strValue = '123';
        $strURL = 'url';
        $strAccessToken = 'AccessToken';
        $arrParams = [
            $strKey => $strValue
        ];
        $request = new TestRequest(
            $strURL,
            $strAccessToken,
            $arrParams
        );

        $arrResponse = [
            'response' => 123
        ];

        $mockGuzzleResponse = \Mockery::mock("GuzzleHttp\Psr7\Response")
            ->shouldReceive('getStatusCode')
            ->once()
            ->withNoArgs()
            ->andReturn(200)
            ->shouldReceive('getBody')
            ->once()
            ->withNoArgs()
            ->andReturn(json_encode($arrResponse))
            ->mock();

        $mockGuzzle = \Mockery::mock(\GuzzleHttp\Client::class)
            ->shouldReceive('request')
            ->once()
            ->with(
                TestRequest::METHOD,
                TestRequest::PATH,
                [
                    'query' => TestRequest::QUERY,
                    'json' => TestRequest::BODY
                ]
            )
            ->andReturn($mockGuzzleResponse)
            ->mock();

        TestRequest::injectGuzzle(
            $mockGuzzle
        );

        $this->assertEquals(
            $arrResponse,
            $request->call()
        );
    }
}
