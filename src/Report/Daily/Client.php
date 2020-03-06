<?php

namespace CloudyCity\TencentMarketingSDK\Report\Daily;

use CloudyCity\TencentMarketingSDK\Kernel\BaseClient;
use CloudyCity\TencentMarketingSDK\Resources;

class Client extends BaseClient
{
    protected $resource = Resources::DAILY_REPORTS;

    protected $fields = [
        'campaign_id', 'adgroup_id', 'ad_id', 'date', 'impression', 'view_count', 'valid_click_count',
        'activated_count', 'click', 'cost', 'download', 'conversion', 'activation', 'app_payment_count',
        'app_payment_amount', 'register', 'app_installation',
    ];

    /**
     * Get all valid actions for resource.
     *
     * @return array
     */
    public function getValidActions()
    {
        return ['get'];
    }
}
