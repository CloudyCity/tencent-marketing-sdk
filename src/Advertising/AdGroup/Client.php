<?php

namespace CloudyCity\TencentMarketingSDK\Advertising\AdGroup;

use CloudyCity\TencentMarketingSDK\Kernel\BaseClient;
use CloudyCity\TencentMarketingSDK\Resources;

class Client extends BaseClient
{
    protected $resource = Resources::AD_GROUPS;

    protected $fields = [
        'adgroup_id', 'adgroup_name', 'configured_status', 'campaign_id', 'site_set', 'optimization_goal',
        'billing_event', 'bid_amount', 'promoted_object_type', 'time_series', 'time_series', 'daily_budget',
        'targeting', 'app_android_channel_package_id', 'targeting_id', 'configured_status', 'promoted_object_id',
        'user_action_sets', 'is_deleted', 'created_time', 'last_modified_time',
    ];
}
