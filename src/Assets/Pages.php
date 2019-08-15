<?php
/**
 * 落地页 管理
 * User: lizhicheng
 * Date: 2019/8/14
 * Time: 15:38
 */

namespace MrSuperLi\Tencent\Ads\Assets;


use MrSuperLi\Tencent\Ads\MarketingApi;
use MrSuperLi\Tencent\Ads\Resources;

//  preview_url 预览地址，24 小时内有效

class Pages extends MarketingApi
{
    protected $resource_name = Resources::PAGES;

    protected $fields = [
        'page_id', 'page_name', 'preview_url', 'created_time', 'last_modified_time', 'promoted_object_id'
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