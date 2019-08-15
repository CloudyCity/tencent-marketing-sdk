<?php
/**
 * 广告组 管理
 *
 * User: lizhicheng@shiyuegame.com
 * Date: 2019/8/13
 * Time: 16:53
 */

namespace MrSuperLi\Tencent\Ads\Managers;

use MrSuperLi\Tencent\Ads\MarketingApi;
use MrSuperLi\Tencent\Ads\Resources;

class AdGroupManager extends MarketingApi
{
    protected $resource_name = Resources::AD_GROUPS;

    protected $fields = [
        'adgroup_id', 'adgroup_name', 'configured_status', 'campaign_id', 'site_set', 'optimization_goal',
        'billing_event', 'bid_amount', 'promoted_object_type', 'time_series', 'time_series', 'daily_budget',
        'targeting', 'app_android_channel_package_id', 'targeting_id', 'configured_status', 'promoted_object_id',
        'user_action_sets', 'is_deleted', 'created_time', 'last_modified_time'
    ];
}