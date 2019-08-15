<?php
/**
 * 广告 管理
 *
 * User: lizhicheng@shiyuegame.com
 * Date: 2019/8/13
 * Time: 16:53
 */

namespace MrSuperLi\Tencent\Ads\Managers;

use MrSuperLi\Tencent\Ads\MarketingApi;
use MrSuperLi\Tencent\Ads\Resources;

class AdManager extends MarketingApi
{
    protected $resource_name = Resources::ADS;

    protected $fields = [
        'campaign_id', 'adgroup_id', 'ad_id', 'ad_name', 'adcreative', 'configured_status', 'system_status',
        'is_deleted', 'is_dynamic_creative', 'created_time', 'last_modified_time'
    ];
}