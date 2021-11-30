<?php

/**
 * @author Matty Glancy
 */

namespace Woodpecker;

class FunctionalTest_GetProspects
    extends Functional_TestCase
{
    private $_strAccessToken = "";
    private $_strBaseUri = 'https://api.woodpecker.co/';

    public function testGetProspects()
    {
        $instance = Request::getInstance($this->_strBaseUri, $this->_strAccessToken);

        $response = $instance->getProspects(
            1,
            1
        );

        print_r($response);
    }
}
