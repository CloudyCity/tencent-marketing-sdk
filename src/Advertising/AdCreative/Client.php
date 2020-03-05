<?php

namespace CloudyCity\TencentMarketingSDK\Advertising\AdCreative;

use CloudyCity\TencentMarketingSDK\Kernel\BaseClient;
use CloudyCity\TencentMarketingSDK\Resources;

class Client extends BaseClient
{
    protected $resource = Resources::AD_CREATIVES;

    protected $fields = [
        'campaign_id', 'adcreative_id', 'adcreative_name', 'adcreative_template_id', 'adcreative_elements', 'page_type',
        'page_spec', 'qq_mini_game_tracking_query_string', 'deep_link_url', 'universal_link_url', 'site_set',
        'automatic_site_enabled', 'promoted_object_type', 'promoted_object_id', 'created_time', 'last_modified_time',
        'share_content_spec', 'dynamic_adcreative_spec', 'is_deleted', 'is_dynamic_creative',
        'multi_share_optimization_enabled', 'component_id', 'online_enabled', 'revised_adcreative_spec', 'category',
        'label'
    ];
}
