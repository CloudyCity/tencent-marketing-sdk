<?php


namespace CloudyCity\TencentMarketingSdk\Advertiser;

use CloudyCity\TencentMarketingSDK\Kernel\BaseClient;
use CloudyCity\TencentMarketingSDK\Resources;

class Client extends BaseClient
{
    protected $resource = Resources::ADVERTISER;

    protected $fields = [
        'account_id', 'daily_budget', 'system_status', 'reject_message', 'corporation_licence',
        'certification_image_id', 'certification_image', 'identity_number', 'individual_qualification',
        'corporate_image_name', 'corporate_image_logo', 'system_industry_id', 'customized_industry', 'introduction_url',
        'industry_qualification_image_id_list', 'industry_qualification_image', 'ad_qualification_image_id_list',
        'ad_qualification_image', 'contact_person', 'contact_person_email', 'contact_person_telephone',
        'contact_person_mobile', 'wechat_spec', 'websites', ''
    ];
}
