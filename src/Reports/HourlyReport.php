<?php
/**
 * 每小时报表
 * User: lizhicheng
 * Date: 2019/8/14
 * Time: 16:35
 */

namespace MrSuperLi\Tencent\Ads\Reports;


use MrSuperLi\Tencent\Ads\MarketingApi;
use MrSuperLi\Tencent\Ads\Resources;

class HourlyReport extends MarketingApi
{
    protected $resource_name = Resources::HOURLY_REPORTS;

    protected $fields = [
        'campaign_id', 'adgroup_id', 'ad_id', 'hour', 'impression', 'view_count', 'valid_click_count',
        'activated_count','click', 'cost', 'download', 'conversion', 'activation', 'app_payment_count',
        'app_payment_amount', 'register', 'app_installation'
    ];

    /**
     * 获取所有合法的操作
     *
     * @return array
     */
    public function getValidActions() {
        return [ 'get' ];
    }
}