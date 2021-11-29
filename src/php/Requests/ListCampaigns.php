<?php

namespace Woodpecker\Requests;

use \Woodpecker\Campaign;

class ListCampaigns
    extends AbstractRequest
{
    const METHOD = 'GET';

    public function _getQueryString()
    {
        return [
            Campaign::FIELD_STATUS => $this->_getParam(Campaign::FIELD_STATUS)
        ];
    }

    public function _getPostBody()
    {
        return [];
    }

    public function _getPath()
    {
        return '/rest/v1/campaign_list';
    }
}