<?php

namespace Woodpecker\Requests;

class GetProspects
    extends AbstractRequest
{
    const METHOD = 'GET';

    public function _getQueryString()
    {
        return [
            self::QUERY_PAGE => $this->_getParam(self::QUERY_PAGE),
            self::QUERY_PER_PAGE => $this->_getParam(self::QUERY_PER_PAGE),
            self::QUERY_SORT => $this->_getParam(self::QUERY_SORT)
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