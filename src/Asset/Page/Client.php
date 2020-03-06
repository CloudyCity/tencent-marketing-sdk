<?php

namespace CloudyCity\TencentMarketingSDK\Asset\Page;

use CloudyCity\TencentMarketingSDK\Kernel\BaseClient;
use CloudyCity\TencentMarketingSDK\Resources;

class Client extends BaseClient
{
    protected $resource = Resources::PAGES;

    protected $fields = [
        'page_id', 'page_name', 'preview_url', 'created_time', 'last_modified_time', 'promoted_object_id', 'page_type',
    ];

    /**
     * @return array
     */
    public function getValidActions()
    {
        return ['get'];
    }
}
