<?php

namespace Woodpecker\Requests;

use \Woodpecker\Prospect;

class DeleteProspectFromCampaign
    extends AbstractRequest
{
    const METHOD = 'DELETE';

    const QUERY_CAMPAIGNS_ID = 'campaigns_id';

    public function _getQueryString()
    {
        return [
            Prospect::FIELD_ID => $this->_getParam(Prospect::FIELD_ID),
            self::QUERY_CAMPAIGNS_ID => $this->_getParam(
                self::QUERY_CAMPAIGNS_ID
            )
        ];
    }

    public function _getPostBody()
    {
        return [];
    }

    public function _getPath()
    {
        return '/rest/v1/prospects';
    }
}
