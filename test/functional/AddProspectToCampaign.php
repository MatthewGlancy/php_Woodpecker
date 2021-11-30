<?php

/**
 * @author Matty Glancy
 */

namespace Woodpecker;

class FunctionalTest_AddProspectToCampaign
    extends Functional_TestCase
{
    private $_strAccessToken = "";
    private $_strBaseUri = 'https://api.woodpecker.co/';

    public function testAddProspectToCampaign()
    {
        $intCampaignId = 1360359;
        $strProspectEmail = 'matty+test@canddi.com';
        $strFirstName = 'Matty';
        $strLastName = 'Glancy';

        $instance = Request::getInstance($this->_strBaseUri, $this->_strAccessToken);

        $response = $instance->addProspectToCampaign(
            $intCampaignId,
            $strProspectEmail,
            [
                Prospect::FIELD_FIRST_NAME => $strFirstName,
                Prospect::FIELD_LAST_NAME => $strLastName
            ]
        );

        print_r($response);
    }
}
