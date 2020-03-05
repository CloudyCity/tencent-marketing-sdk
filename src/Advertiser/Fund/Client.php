<?php


namespace CloudyCity\TencentMarketingSDK\Advertiser\Fund;

use CloudyCity\TencentMarketingSDK\Kernel\BaseClient;
use CloudyCity\TencentMarketingSDK\Resources;

class Client extends BaseClient
{
    protected $resource = Resources::FUNDS;

    protected $fields = ['fund_type', 'balance', 'fund_status', 'realtime_cost'];

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
