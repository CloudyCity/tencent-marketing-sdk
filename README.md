## 腾讯广告 API
> 文档： https://developers.e.qq.com/docs/start

> 本SDK能使用所有接口。下面打勾的是已经单独实现，没有打勾的可以使用通用实例


- 腾讯广告 Marketing API
    - [ ] Oauth2 授权认证 单独一个库
    - [ ] Advertisers 账号管理
    - [ ] Assets 营销资产
      - [x] Pages 落地页
    - [ ] Managers 广告管理相关接口
      - [x] AdGroupManager 广告组管理
      - [x] AdManager 广告管理
      - [x] CampaignManager 推广计划管理
    - [ ] Reports 数据洞察相关接口
      - [x] DailyReport 每日报表
      - [x] HourlyReport 每小时报表
    - [ ] AssistTools 辅助工具相关接口
    - [ ] UserActions 用户行为相关接口
    - [ ] CustomAudiences 用户人群相关接口
    - [ ] CustomTags 用户标签相关接口
    - [ ] UserProperties 用户属性相关接口

# 安装

`composer install mrsuperli/tencent-marketing-api-php-sdk`

## 1. 使用

### 1.1 基础使用

```php
use MrSuperLi\Tencent\Ads\Managers\AdManager;

$accessToken = 'xxx';

$api = new AdManager($accessToken);
$api->setSandbox(); // 开启沙箱模式

$api->setSandbox(false); // 关闭沙箱模式

$api->setFields(['field1', 'field2']); // 自定义查询字段
```

### 1.2 获取所有每日报表
```php

use MrSuperLi\Tencent\Ads\Reports\DailyReport;
use MrSuperLi\Tencent\Ads\Parameters\Builder;

// 授权登录获得的 accessToken
$accessToken = 'xxxxx';
// 账号
$account = 'xxxx';
// 开始日期
$start = '2019-08-01';
// 结束日期
$end = '2019-08-15';

$api = new DailyReport($accessToken);

// 构造查询参数
$params = Builder::make()->groupBy('adgroup_id', 'date')
    ->setDateRange($start, $end)
    ->set('level', 'REPORT_LEVEL_ADGROUP')
    ->set('account_id', $account);

// 每一页数据。因为这里使用生成器的方式
foreach ($api->getAllRecordIterator($params) as $pageRescords) {

    if ($pageRescords instanceof \Exception) {
        echo '获取失败:', $reports->getMessage();
        continue;
    }

    foreach($pageRescords as $record) {
        // 每一条数据
    }
}

```

### 1.3 获取所有广告

```php

use MrSuperLi\Tencent\Ads\Managers\AdManager;

$api = new AdManager($accessToken);

$builder = new Builder();
$builder->set('account_id', 'xxx');
$builder->getFilter()->gtEqual('created_time', time() - 86400);
$builder->getFilter()->ltEqual('created_time', time());

foreach ($api->getAllRecordIterator($builder) as $pageRescords) {
    // 同上
}

// 获取第一页
$api->get($builder);

```

## 2 增删改

```php
use MrSuperLi\Tencent\Ads\Managers\AdManager;

$accessToken = 'xxx';

$api = new AdManager($accessToken);

$builder = Builder:make()
    ->set('field1', 'value1')
    ->set('field2', 'value2');

$api->update($builder); // 更新
$api->add($builder); // 新增
$api->delete($builder); // 删除
```

## 3. 其他接口
> 因为接口众多，目前并没有把所有接口都一一实现，但是 SDK 同样支持这些接口的请求

```php
use MrSuperLi\Tencent\Ads\ApiFactory;
use MrSuperLi\Tencent\Ads\Resources;

// 授权登录获得的 accessToken
$accessToken = 'xxxxx';

// 获取订单数据, 第二个参数指定对应资源
$api = ApiFactory::factory($accessToken, Resources::ECOMMERCE_ORDER);

$builder = Builder:make()
    ->set('field1', 'value1')
    ->set('field2', 'value2');

// 对资源进行具体操作
$page1 = $api->get($builder);
```