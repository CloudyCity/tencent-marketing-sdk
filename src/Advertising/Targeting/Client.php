<?php

namespace CloudyCity\TencentMarketingSDK\Advertising\Targeting;

use CloudyCity\TencentMarketingSDK\Kernel\BaseClient;
use CloudyCity\TencentMarketingSDK\Resources;

class Client extends BaseClient
{
    protected $resource = Resources::TARGETINGS;

    protected $fields = [
        'targeting_id', 'targeting_name', 'targeting', 'is_include_unsupported_targeting', 'description', 'is_deleted',
        'created_time', 'last_modified_time', 'targeting_translation',
    ];
}
