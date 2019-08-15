<?php
/**
 * 推广计划 管理
 *
 * User: lizhicheng@shiyuegame.com
 * Date: 2019/8/13
 * Time: 16:53
 */

namespace MrSuperLi\Tencent\Ads\Managers;

use MrSuperLi\Tencent\Ads\MarketingApi;
use MrSuperLi\Tencent\Ads\Resources;

class CampaignManager extends MarketingApi
{
    protected $resource_name = Resources::CAMPAIGNS;

    protected $fields = [
        'campaign_id', 'campaign_name', 'configured_status', 'campaign_type', 'promoted_object_type', 'daily_budget',
        'budget_reach_date', 'created_time', 'last_modified_time', 'speed_mode', 'is_deleted'
    ];
}