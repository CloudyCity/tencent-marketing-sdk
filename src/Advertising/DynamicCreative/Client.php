<?php

namespace CloudyCity\TencentMarketingSDK\Advertising\DynamicCreative;

use CloudyCity\TencentMarketingSDK\Kernel\BaseClient;
use CloudyCity\TencentMarketingSDK\Resources;

class Client extends BaseClient
{
    protected $resource = Resources::DYNAMIC_CREATIVES;

    protected $fields = [
        'dynamic_creative_id', 'outer_adcreative_id', 'dynamic_creative_name', 'dynamic_creative_template_id',
        'dynamic_creative_elements', 'page_type', 'page_spec', 'deep_link_url', 'site_set', 'promoted_object_type',
        'promoted_object_id', 'created_time', 'last_modified_time', 'is_deleted', 'campaign_type',
        'impression_tracking_url', 'click_tracking_url',
    ];

    /**
     * Get all valid actions for resource.
     *
     * @return array
     */
    public function getValidActions()
    {
        return ['get', 'add', 'update'];
    }
}
