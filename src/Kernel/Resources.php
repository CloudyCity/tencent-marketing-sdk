<?php

namespace CloudyCity\TencentMarketingSDK;

class Resources
{
    /**
     * Account management.
     *
     * @see https://developers.e.qq.com/docs/api/account
     */
    const ADVERTISER = 'advertiser';

    const QUALIFICATION = 'qualifications';

    const FUND_TRANSFER = 'fund_transfer';

    const FUNDS = 'funds';

    const FUND_STATEMENTS_DAILY = 'fund_statements_daily';

    const FUND_STATEMENTS_DETAILED = 'fund_statements_detailed';

    const WECHAT_FUNDS = 'wechat_funds';

    /**
     * Marketing assets.
     *
     * @see https://developers.e.qq.com/docs/api/business_assets
     */
    const PROMOTED_OBJECTS = 'promoted_objects';

    const PAGES = 'pages';

    const VIDEOS = 'videos';

    const IMAGE = 'images';

    const PRODUCT_CATALOGS = 'product_catalogs';

    const PRODUCT_ITEMS = 'product_items';

    const DYNAMIC_AD_TEMPLATES = 'dynamic_ad_templates';

    const DYNAMIC_AD_IMAGES = 'dynamic_ad_images';

    /**
     * Advertising management.
     *
     * @see https://developers.e.qq.com/docs/api/adsmanagement
     */
    const CAMPAIGNS = 'campaigns';

    const AD_GROUPS = 'adgroups';

    const AD_CREATIVES = 'adcreatives';

    const DYNAMIC_CREATIVES = 'dynamic_creatives';

    const ADS = 'ads';

    const TARGETINGS = 'targetings';

    const DAILY_REPORTS = 'daily_reports';

    const HOURLY_REPORTS = 'hourly_reports';

    const TARGETING_TAG_REPORTS = 'targeting_tag_reports';

    const CUSTOM_AUDIENCE_INSIGHTS = 'custom_audience_insights';

    const TRACKING_REPORTS = 'tracking_reports';

    const ECOMMERCE_ORDER = 'ecommerce_order';

    const WECHAT_LEADS = 'wechat_leads';

    const LEADS = 'leads';

    /**
     * Tools.
     *
     * @see https://developers.e.qq.com/docs/api/tools
     */
    const TARGETING_TAGS = 'targeting_tags';

    const AD_CREATIVE_TEMPLATES = 'adcreative_templates';

    const CAPABILITIES = 'capabilities';

    const ESTIMATION = 'estimation';

    const AD_CREATIVE_PREVIEWS = 'adcreative_previews';

    const REAL_TIME_COST = 'realtime_cost';

    const ASYNC_TASKS = 'async_tasks';

    const COMPLIANCE_VALIDATION = 'compliance_validation';

    const UNION_POSITION_PACKAGES = 'union_position_packages';

    const SPLIT_TESTS = 'split_tests';

    const DIAGNOSIS = 'diagnosis';

    const SYSTEM_STATUS = 'system_status';

    /**
     * User action.
     *
     * @see https://developers.e.qq.com/docs/api/user_data
     */
    const USER_ACTION_SETS = 'user_action_sets';

    const USER_ACTION_SET_REPORTS = 'user_action_set_reports';

    const USER_ACTIONS = 'user_actions';

    /**
     * Audiences.
     *
     * @see https://developers.e.qq.com/docs/api/audiences
     */
    const CUSTOM_AUDIENCES = 'custom_audiences';

    const CUSTOM_AUDIENCE_FILES = 'custom_audience_files';

    const CUSTOM_AUDIENCE_ESTIMATIONS = 'custom_audience_estimations';

    /**
     * User tags.
     *
     * @see https://developers.e.qq.com/docs/api/custom_tags
     */
    const CUSTOM_TAGS = 'custom_tags';

    const CUSTOM_TAG_FILES = 'custom_tag_files';

    /**
     * User property.
     *
     * @see https://developers.e.qq.com/docs/api/user_property
     */
    const USER_PROPERTY_SETS = 'user_property_sets';

    const USER_PROPERTIES = 'user_properties';

    /**
     * @param $resourceName
     *
     * @return bool
     */
    public static function checkResource($resourceName)
    {
        static $resourceNames = null;

        $resourceName = strval($resourceName);

        if (!$resourceName) {
            return false;
        }

        if ($resourceNames === null) {
            try {
                $reflect = new \ReflectionClass(__CLASS__);

                $resourceNames = array_flip(array_values($reflect->getConstants()));
            } catch (\Exception $e) {
                return false;
            }
        }

        return isset($resourceNames[$resourceName]);
    }
}
