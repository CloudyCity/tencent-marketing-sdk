<?php

namespace CloudyCity\TencentMarketingSDK\Asset\Image;

use CloudyCity\TencentMarketingSDK\Kernel\BaseClient;
use CloudyCity\TencentMarketingSDK\Resources;

class Client extends BaseClient
{
    protected $resource = Resources::IMAGE;

    protected $fields = [
        'image_id', 'width', 'height', 'file_size', 'type', 'signature', 'source_signature', 'preview_url',
        'source_type', 'create_time', 'last_modified_time',
    ];

    /**
     * @return array
     */
    public function getValidActions()
    {
        return ['get', 'add'];
    }
}
