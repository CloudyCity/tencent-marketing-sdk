<?php


namespace CloudyCity\TencentMarketingSdk;

use CloudyCity\TencentMarketingSDK\Kernel\BaseClient;
use CloudyCity\TencentMarketingSDK\Kernel\BaseInvoker;

/**
 * Class Client.
 *
 * @property \CloudyCity\TencentMarketingSDK\Advertiser\Client $advertiser
 * @property \CloudyCity\TencentMarketingSDK\Advertiser\Fund\Client $funds
 * @property \CloudyCity\TencentMarketingSDK\Advertising\Campaign\Client $campaigns
 * @property \CloudyCity\TencentMarketingSDK\Advertising\AdGroup\Client $adgroups
 * @property \CloudyCity\TencentMarketingSDK\Advertising\AdCreative\Client $adcreatives
 * @property \CloudyCity\TencentMarketingSDK\Advertising\DynamicCreative\Client $dynamic_creatives
 * @property \CloudyCity\TencentMarketingSDK\Advertising\AD\Client $ads
 * @property \CloudyCity\TencentMarketingSDK\Advertising\Targeting\Client $targetings
 * @property \CloudyCity\TencentMarketingSDK\Report\Daily\Client $daily_reports
 * @property \CloudyCity\TencentMarketingSDK\Report\Hourly\Client $hourly_reports
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $qualifications
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $fund_transfer
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $fund_statements_daily
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $fund_statements_detailed
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $promoted_objects
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $product_catalog
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $dynamic_ad_templates
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $dynamic_ad_images
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $wechat_pages
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $android_channel_packages
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $targeting_tag_reports
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $product_catalogs_reports
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $custom_audience_insights
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $tracking_reports
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $ecommerce_order
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $wechat_leads
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $leads
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $custom_audience_reports
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $wechat_ad_followers
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $targeting_tags
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $adcreative_templates
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $adcreative_template_detail
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $capabilities
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $estimation
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $adcreative_previews
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $realtime_cost
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $async_tasks
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $async_task_file
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $compliance_validation
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $union_position_packages
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $split_tests
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $diagnosis
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $system_status
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $user_action_sets
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $user_action_set_reports
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $user_actions
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $custom_audiences
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $custom_audience_files
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $custom_audience_estimations
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $custom_tag_files
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $custom_tags
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $user_property_sets
 * @property \CloudyCity\TencentMarketingSDK\Kernel\BaseClient $user_properties
 *
 */
class Client extends BaseInvoker
{
    protected $providers = [
        'advertiser' => \CloudyCity\TencentMarketingSDK\Advertiser\Client::class,
        'funds' => \CloudyCity\TencentMarketingSDK\Advertiser\Fund\Client::class,
        'campaigns' => \CloudyCity\TencentMarketingSDK\Advertising\Campaign\Client::class,
        'adgroups' => \CloudyCity\TencentMarketingSDK\Advertising\AdGroup\Client::class,
        'adcreatives' => \CloudyCity\TencentMarketingSDK\Advertising\AdCreative\Client::class,
        'dynamic_creatives' => \CloudyCity\TencentMarketingSDK\Advertising\DynamicCreative\Client::class,
        'ads' => \CloudyCity\TencentMarketingSDK\Advertising\Ad\Client::class,
        'targetings' => \CloudyCity\TencentMarketingSDK\Advertising\Targeting\Client::class,
        'daily_reports' => \CloudyCity\TencentMarketingSDK\Report\Daily\Client::class,
        'hourly_reports' => \CloudyCity\TencentMarketingSDK\Report\Hourly\Client::class,
    ];

    /**
     * This method is called automatically when accessing member properties which is a valid resource name.
     * You should only call this method manually when the resource name you need does not exist in the preset
     * member properties.
     *
     * @param $resource
     * @param $checkSource
     * @return BaseClient
     * @throws \CloudyCity\TencentMarketingSDK\Kernel\Exceptions\InvalidResourceException
     */
    public function factory($resource, $checkSource = true)
    {
        $advertiserId = $this->getAdvertiserId();
        $accessToken = $this->getAccessToken();
        $responseType = $this->getResponseType();

        return Factory::getClient($resource, $advertiserId, $accessToken, $responseType, $checkSource);
    }
}
