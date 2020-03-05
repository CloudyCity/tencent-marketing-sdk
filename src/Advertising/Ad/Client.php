<?php

namespace CloudyCity\TencentMarketingSDK\Advertising\Ad;

use CloudyCity\TencentMarketingSDK\Kernel\BaseClient;
use CloudyCity\TencentMarketingSDK\Resources;

class Client extends BaseClient
{
    protected $resource = Resources::ADS;

    protected $fields = [
        'campaign_id', 'adgroup_id', 'ad_id', 'ad_name', 'adcreative', 'configured_status', 'system_status',
        'is_deleted', 'is_dynamic_creative', 'created_time', 'last_modified_time'
    ];
}
