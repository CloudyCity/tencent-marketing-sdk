<?php

namespace CloudyCity\TencentMarketingSDK\Advertising\Campaign;

use CloudyCity\TencentMarketingSDK\Kernel\BaseClient;
use CloudyCity\TencentMarketingSDK\Resources;

class Client extends BaseClient
{
    protected $resource = Resources::CAMPAIGNS;

    protected $fields = [
        'campaign_id', 'campaign_name', 'configured_status', 'campaign_type', 'promoted_object_type', 'daily_budget',
        'budget_reach_date', 'created_time', 'last_modified_time', 'speed_mode', 'is_deleted'
    ];
}
