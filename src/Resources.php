<?php
/**
 * Marketing API 资源 常量
 *
 * User: lizhicheng@shiyuegame.com
 * Date: 2019/8/15
 * Time: 16:03
 */

namespace MrSuperLi\Tencent\Ads;


class Resources
{
    /* 账号管理 */

    /**
     * 广告帐号 (Advertiser)
     */
    const ADVERTISER = 'advertiser';

    /**
     * 资质 (Qualification)
     */
    const QUALIFICATION = 'qualifications';

    /**
     * 发起代理商与子客户之间的转账（fund_transfer/add）
     */
    const FUND_TRANSFER = 'fund_transfer';

    /**
     * 获取资金账户信息（funds/get）
     */
    const FUNDS = 'funds';

    /**
     * 获取资金账户日结明细（fund_statements_daily/get）
     */
    const FUND_STATEMENTS_DAILY = 'fund_statements_daily';

    /**
     * 获取资金账户流水（fund_statements_detailed/get）
     */
    const FUND_STATEMENTS_DETAILED = 'fund_statements_detailed';

    /**
     * 获取微信广告账号资金账户信息（wechat_funds/get）
     */
    const WECHAT_FUNDS = 'wechat_funds';

    /* 营销资产 */

    /**
     * 推广目标 (Promoted object)
     */
    const PROMOTED_OBJECTS = 'promoted_objects';

    /**
     * 落地页
     */
    const PAGES = 'pages';

    /**
     * 视频
     */
    const VIDEOS = 'videos';

    /**
     * 图片
     */
    const IMAGE = 'images';

    /**
     * 商品库目录
     */
    const PRODUCT_CATALOGS = 'product_catalogs';

    /**
     * 商品信息
     */
    const PRODUCT_ITEMS = 'product_items';

    /**
     * 动态模板
     */
    const DYNAMIC_AD_TEMPLATES = 'dynamic_ad_templates';

    /**
     * 动态广告图片
     */
    const DYNAMIC_AD_IMAGES = 'dynamic_ad_images';

    /* 广告管理 */

    /**
     * 广告计划
     */
    const CAMPAIGNS = 'campaigns';

    /**
     * 广告组
     */
    const AD_GROUPS = 'adgroups';

    /**
     * 广告创意
     */
    const AD_CREATIVES = 'adcreatives';

    /**
     * 动态创意
     */
    const DYNAMIC_CREATIVES = 'dynamic_creatives';

    /**
     * 广告
     */
    const ADS = 'ads';

    /**
     * 广告定向
     */
    const TARGETINGS = 'targetings';

    /* 数据洞察 */

    /**
     * 每日报表
     */
    const DAILY_REPORTS = 'daily_reports';

    /**
     * 每小时报表
     */
    const HOURLY_REPORTS = 'hourly_reports';

    /**
     * 定向标签报表
     */
    const TARGETING_TAG_REPORTS = 'targeting_tag_reports';

    /**
     * 人群洞察分析
     */
    const CUSTOM_AUDIENCE_INSIGHTS = 'custom_audience_insights';

    /**
     * 点击追踪报表
     */
    const TRACKING_REPORTS = 'tracking_reports';

    /**
     * 订单数据
     */
    const ECOMMERCE_ORDER = 'ecommerce_order';

    /**
     * 获取微信广告平台带来的线索
     */
    const WECHAT_LEADS = 'wechat_leads';

    /**
     * 获取API投放微信表单广告带来的线索
     */
    const LEADS = 'leads';

    /* 辅助工具 */

    /**
     * 定向标签
     */
    const TARGETING_TAGS = 'targeting_tags';

    /**
     * 创意规格
     */
    const AD_CREATIVE_TEMPLATES = 'adcreative_templates';

    /**
     * 广告相关权限
     */
    const CAPABILITIES = 'capabilities';

    /**
     * 覆盖人数
     */
    const ESTIMATION = 'estimation';

    /**
     * 广告预览
     */
    const AD_CREATIVE_PREVIEWS = 'adcreative_previews';

    /**
     * 实时消耗
     */
    const REAL_TIME_COST = 'realtime_cost';

    /**
     * 异步任务
     */
    const ASYNC_TASKS = 'async_tasks';

    /**
     * compliance_validation
     */
    const COMPLIANCE_VALIDATION = 'compliance_validation';

    /**
     * 联盟流浪包
     */
    const UNION_POSITION_PACKAGES = 'union_position_packages';

    /**
     * 拆分对比实验
     */
    const SPLIT_TESTS = 'split_tests';

    /**
     * 广告诊断
     */
    const DIAGNOSIS = 'diagnosis';

    /**
     * 广告组系统状态
     */
    const SYSTEM_STATUS = 'system_status';

    /* 用户行为 */

    /**
     * 用户行为数据源
     */
    const USER_ACTION_SETS = 'user_action_sets';

    /**
     * 用户行为数据源报表
     */
    const USER_ACTION_SET_REPORTS = 'user_action_set_reports';

    /**
     * 用户行为数据
     */
    const USER_ACTIONS = 'user_actions';

    /* 用户人群 */

    /**
     * 客户人群
     */
    const CUSTOM_AUDIENCES = 'custom_audiences';

    /**
     * 客户人群数据文件
     */
    const CUSTOM_AUDIENCE_FILES = 'custom_audience_files';

    /**
     * 人群覆盖数预估
     */
    const CUSTOM_AUDIENCE_ESTIMATIONS = 'custom_audience_estimations';

    /* 用户标签 */

    /**
     * 客户标签
     */
    const CUSTOM_TAGS = 'custom_tags';

    /**
     * 标签数据文件
     */
    const CUSTOM_TAG_FILES = 'custom_tag_files';

    /* 用户属性 */

    /**
     * 用户属性数据源
     */
    const USER_PROPERTY_SETS = 'user_property_sets';

    /**
     * 用户属性
     */
    const USER_PROPERTIES = 'user_properties';

    /**
     * @param $resourceName
     * @return bool
     */
    public static function checkResource($resourceName) {

        static $_resource_names = null;

        $resourceName = strval($resourceName);

        if (! $resourceName) {
            return false;
        }

        if ($_resource_names === null) {
            try {
                $reflect = new \ReflectionClass(__CLASS__);

                $_resource_names = array_flip(array_values($reflect->getConstants()));

            } catch (\Exception $e) {
                return false;
            }
        }

        return isset($_resource_names[$resourceName]);
    }

}
