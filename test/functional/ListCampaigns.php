<?php

/**
 * @author Matty Glancy
 */

namespace Woodpecker;

class FunctionalTest_ListCampaigns
    extends Functional_TestCase
{
    private $_strAccessToken = "";
    private $_strBaseUri = 'https://api.woodpecker.co/';

    public function testListCampaigns()
    {
        $instance = Request::getInstance($this->_strBaseUri, $this->_strAccessToken);

        $response = $instance->listCampaigns();

        print_r($response);
    }
}
