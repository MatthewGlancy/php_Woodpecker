<?php

namespace Woodpecker;

class Campaign
{
    const FIELD_CAMPAIGN_ID = 'campaign_id';
    const FIELD_STATUS      = 'status';

    const STATUS_DRAFT      = 'DRAFT';
    const STATUS_RUNNING    = 'RUNNING';
    const STATUS_EDITED     = 'EDITED';
    const STATUS_COMPLETED  = 'COMPLETED';
    const STATUS_PAUSED     = 'PAUSED';
    const STATUS_DELETED    = 'DELETED';
}