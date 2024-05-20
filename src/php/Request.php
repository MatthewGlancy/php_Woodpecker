<?php

namespace Woodpecker;

class Request
{
    protected $_strURL;
    protected $_strAccessToken;

    /**
     * Prevent instantiation and cloning
     * ONLY use getInstance()
    **/
    final protected function __construct(
        $strURL,
        $strAccessToken
    )
    {
        if (empty($strURL) || empty($strAccessToken)) {
            throw new \Exception(
                "Unable to create instance - Missing URL OR Key"
            );
        }

        $this->_strURL      = $strURL;
        $this->_strAccessToken   = $strAccessToken;
    }

    final protected function __clone()
    {
        throw new \Exception('Cannot clone');
    }

    /**
     *  Implements the singleton pattern
     *  @return $this       - this is a fluent interface
    **/
    protected static $_locater;

    /**
     * Gets an instance of the current class
     *
     * @return static
     * @author Tim Langley
    **/
    public static function getInstance(
        $strURL     = null,
        $strAccessToken  = null
    )
    {
        if (is_null(self::$_locater)) {
            self::$_locater   = new self(
                $strURL,
                $strAccessToken
            );
        }

        return self::$_locater;
    }
    /**
     * This method is used for testing
     *  @param static $locator    - this is mainly for testing
     *                      - it allows a mock version of the
     *                          Common_Gateway to be injected
    **/
    public static function inject(
        self $locator = null
    )
    {
        self::$_locater   = $locator;
    }
    /**
     * This wipes out anything cached
     *
     **/
    public static function reset()
    {
        self::$_locater = null;
    }

    public function listCampaigns(
        string $strStatus = null
    )
    {
        $request = new Requests\ListCampaigns(
            $this->_strURL,
            $this->_strAccessToken,
            [
                Campaign::FIELD_STATUS => $strStatus
            ]
        );
        return $request->call();
    }

    public function getProspects(
        int $intPerPage,
        int $intPage
    )
    {
        $request = new Requests\GetProspects(
            $this->_strURL,
            $this->_strAccessToken,
            [
                Requests\GetProspects::QUERY_PAGE => $intPage,
                Requests\GetProspects::QUERY_PER_PAGE => $intPerPage
            ]
        );
        return $request->call();
    }

    public function deleteProspectFromCampaign(
        $intProspectId,
        $intCampaignId
    )
    {
        $request = new Requests\DeleteProspectFromCampaign(
            $this->_strURL,
            $this->_strAccessToken,
            [
                Requests\DeleteProspectFromCampaign::QUERY_CAMPAIGNS_ID
                    => $intCampaignId,
                Prospect::FIELD_ID => $intProspectId
            ]
        );
        return $request->call();
    }

    public function addProspectToCampaign(
        $intCampaignId,
        string $strProspectEmail,
        Array $arrProspectDetails
    )
    {
        $request = new Requests\AddProspectToCampaign(
            $this->_strURL,
            $this->_strAccessToken,
            array_merge(
                [
                    Campaign::FIELD_CAMPAIGN_ID => $intCampaignId,
                ],
                [
                    Prospect::FIELD_EMAIL => $strProspectEmail
                ],
                $arrProspectDetails
            )
        );
        return $request->call();
    }
}
