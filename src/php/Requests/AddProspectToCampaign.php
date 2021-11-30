<?php

namespace Woodpecker\Requests;

use \Woodpecker\Campaign;
use \Woodpecker\Prospect;

class AddProspectToCampaign
    extends AbstractRequest
{
    const METHOD = 'POST';

    public function _getQueryString()
    {
        return [];
    }

    public function _getPostBody()
    {
        return [
            'update' => true,
            'campaign' => [
                Campaign::FIELD_CAMPAIGN_ID => $this->_getParam(Campaign::FIELD_CAMPAIGN_ID),
            ],
            'prospects' => [
                [
                    Prospect::FIELD_EMAIL => $this->_getParam(Prospect::FIELD_EMAIL),
                    Prospect::FIELD_FIRST_NAME => $this->_getParam(Prospect::FIELD_FIRST_NAME),
                    Prospect::FIELD_LAST_NAME => $this->_getParam(Prospect::FIELD_LAST_NAME),
                    Prospect::FIELD_STATUS => $this->_getParam(Prospect::FIELD_STATUS),
                    Prospect::FIELD_TAGS => $this->_getParam(Prospect::FIELD_TAGS),
                    Prospect::FIELD_COMPANY => $this->_getParam(Prospect::FIELD_COMPANY),
                    Prospect::FIELD_INDUSTRY => $this->_getParam(Prospect::FIELD_INDUSTRY),
                    Prospect::FIELD_LINKEDIN_URL => $this->_getParam(Prospect::FIELD_LINKEDIN_URL),
                    Prospect::FIELD_TITLE => $this->_getParam(Prospect::FIELD_TITLE),
                    Prospect::FIELD_PHONE => $this->_getParam(Prospect::FIELD_PHONE),
                    Prospect::FIELD_ADDRESS => $this->_getParam(Prospect::FIELD_ADDRESS),
                    Prospect::FIELD_CITY => $this->_getParam(Prospect::FIELD_CITY),
                    Prospect::FIELD_STATE => $this->_getParam(Prospect::FIELD_STATE),
                    Prospect::FIELD_COUNTRY => $this->_getParam(Prospect::FIELD_COUNTRY),
                ]
            ]
        ];
    }

    public function _getPath()
    {
        return '/rest/v1/add_prospects_campaign';
    }
}