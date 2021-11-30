<?php

/**
 * @author Matty Glancy
 */

namespace Woodpecker;

class FunctionalTest_DeleteProspectFromCampaign
    extends Functional_TestCase
{
    private $_strAccessToken = "";
    private $_strBaseUri = 'https://api.woodpecker.co/';

    public function testDeleteProspectFromCampaign()
    {
        $intProspectId = 591896005;
        $intCampaignId = 1360359;

        $instance = Request::getInstance($this->_strBaseUri, $this->_strAccessToken);

        $response = $instance->deleteProspectFromCampaign(
            $intProspectId,
            $intCampaignId
        );

        print_r($response);
    }
}
