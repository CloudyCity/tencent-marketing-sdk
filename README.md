# 广点通SDK

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]
[![standard-readme compliant](https://img.shields.io/badge/readme%20style-standard-brightgreen.svg?style=flat-square)](https://github.com/RichardLitt/standard-readme)

简体中文 | [English](./README.en.md)

## 内容列表

- [简介](#简介)
- [安装](#安装)
- [使用说明](#使用说明)
	- [授权](#授权)
	- [基础调用](#基础调用)
	- [请求参数与响应类型](#请求参数与响应类型)
	- [自动翻页](#自动翻页)
	- [工厂](#工厂)
- [维护者](#维护者)
- [如何贡献](#如何贡献)
- [使用许可](#使用许可)

## 简介

> 当前支持的API版本: v1.1

本仓库从 `MrSuperLi/tencent-marketing-api-php-sdk` 分支

相较于原仓库上的改动:
1. 集成授权
2. 客户端传入`advertiser_id`参数
3. 客户端按业务(资源)模块调用
4. 请求参数支持数组
5. 支持多种响应类型
6. 使用PSR-2

## 安装

`composer install cloudycity/tencent-marketing-sdk`

## 使用说明

- `Auth`: 获取、刷新令牌

- `Client`: 调用各资源的主客户端

- `BaseClient`: 发起动作的资源

- `Factory`: 用于获取自定义资源实例的工厂

### 授权

```php

use CloudyCity\TencentMarketingSDK\Auth;
use CloudyCity\TencentMarketingSDK\Kernel\Exceptions\Exception;

$clientId = '';
$clientSecret = '';
$authCode = '';
$redirectUri = '';

$auth = new Auth($clientId, $clientSecret);

try {
    $res = $auth->getTokens($authCode, $redirectUri);
    $refreshToken = $res['data']['refresh_token'];

    $res = $auth->refreshTokens($refreshToken);
} catch (Exception $e) {
    //
}
```

### 基础调用

广点通接口格式统一为: `资源/动作`

**接口示例:**

- `funds/get` 获取资金账户信息
- `advertiser/update` 更新广告主信息

资源对应`Client`对象中的属性，动作对应属性中的方法

**调用示例:**

```php
$res = $client->funds->get();
$res = $client->advertiser->update($params);
```

### 请求参数与响应类型

```php

use CloudyCity\TencentMarketingSDK\Client;
use CloudyCity\TencentMarketingSDK\Kernel\Http\Parameters\Params;
use CloudyCity\TencentMarketingSDK\Kernel\Exceptions\Exception;

$advertiserId = '';
$accessToken = '';

// 可以传入第三个参数来指定响应类型
// 支持的响应类型: array (default) / object / collection / raw (json string)
$client = new Client($advertiserId, $accessToken);

// 使用`Params`类来构建参数
$params = Params::make()->setDateRange('2020-01-01', '2020-01-07')
    ->set('level', 'REPORT_LEVEL_ADGROUP')
    ->groupBy('adgroup_id', 'date')
    ->orderBy('cost', 'desc');

$filter = $params->getFilter()
    ->eq('adgroup_id', 'xxx');

$params->setFilter($filter);

// 或使用数组构建参数
$params = [
    'date_range' => [
        'start_date' => '2020-01-01',
        'end_date' => '2020-01-07',
    ],
    'level' => 'REPORT_LEVEL_ADGROUP',
    'group_by' => [
        'adgroup_id',
        'date'
    ],
    'order_by' => [
        'sort_field' => 'cost',
        'sort_type' => 'DESCENDING'
    ],
    'filtering' => [
        [
            'adgroup_id',
            'EQUALS',
            'xxx'
        ]
    ]
];

try {
    $res = $client->daily_reports->get($params);
} catch (Exception $e) {
    //
}
```

### 自动翻页

`BaseClient::getAllPages()`通过[Generator](https://www.php.net/manual/zh/language.generators.overview.php)实现翻页逻辑.

```php

use CloudyCity\TencentMarketingSDK\Client;
use CloudyCity\TencentMarketingSDK\Kernel\Exceptions\Exception;

$advertiserId = '';
$accessToken = '';
$client = new Client($advertiserId, $accessToken);

try {
    foreach ($client->campaigns->getAllPages() as $page) {
        foreach ($page as $record) {
            var_dump($record);
        }
    }
} catch (Exception $e) {
    //
}
```

### 工厂

如果API更新出现了新的资源名称，但是SDK版本未更新，`Client`对象将找不到对应的成员属性。
此时你可以通过工厂类获取一个`BaseClient`实例，建议同时提交新Issue让我给`Client`添加新的成员属性。

```php

use CloudyCity\TencentMarketingSDK\Factory;

$advertiserId = '';
$accessToken = '';

$resourceClient = Factory::getClient('new_resource', $advertiserId, $accessToken);
```

## 维护者

- @CloudyCity

## 如何贡献

非常欢迎你的加入！[提一个 Issue](https://github.com/CloudyCity/tencent-marketing-sdk/issues/new) 或者提交一个 Pull Request。

标准 Readme 遵循 [Contributor Covenant](http://contributor-covenant.org/version/1/3/0/) 行为规范。

## 使用许可

[MIT](LICENSE) © CloudyCity

[ico-version]: https://img.shields.io/packagist/v/cloudycity/tencent-marketing-sdk.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/cloudycity/tencent-marketing-sdk/master.svg?style=flat-square
[ico-code-coverage]: https://img.shields.io/scrutinizer/coverage/g/cloudycity/tencent-marketing-sdk.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/244580741/shield?branch=master
[ico-code-quality]: https://img.shields.io/scrutinizer/g/cloudycity/tencent-marketing-sdk.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/cloudycity/tencent-marketing-sdk.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/cloudycity/tencent-marketing-sdk
[link-travis]: https://travis-ci.org/cloudycity/tencent-marketing-sdk
[link-code-coverage]: https://scrutinizer-ci.com/g/cloudycity/tencent-marketing-sdk/code-structure
[link-styleci]: https://styleci.io/repos/244580741
[link-code-quality]: https://scrutinizer-ci.com/g/cloudycity/tencent-marketing-sdk
[link-downloads]: https://packagist.org/cloudycity/tencent-marketing-sdk
[link-author]: https://github.com/cloudycity
