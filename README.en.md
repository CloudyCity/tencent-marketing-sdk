# Tencent Marketing SDK

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]
[![standard-readme compliant](https://img.shields.io/badge/readme%20style-standard-brightgreen.svg?style=flat-square)](https://github.com/RichardLitt/standard-readme)

English | [简体中文](./README.md)

## 内容列表

- [Introduction](#Introduction)
- [Installation](#Installation)
- [Usage](#Usage)
	- [Authorization](#authorization)
	- [Basic](#basic)
	- [Request params & Response types](#request-params--response-types)
	- [Paginator](#paginator)
	- [Factory](#factory)
- [Contributors](#contributors)
- [Contributing](#contributing)
- [License](#license)

## Introduction

> Now support v1.1

This repo forked from `MrSuperLi/tencent-marketing-api-php-sdk`.

Modified the following：
1. Integrate authorization.
2. Pass `advertiser_id` when instantiate the client.
3. Use member properties as client to request the API.
4. Request param support array.
5. Support multiple response types.
6. Follow PSR-2.

## Installation

`composer install cloudycity/tencent-marketing-sdk`

## Usage

- `Auth`: the client which to get or refresh token.

- `Client`: the main invoker which to get resource client.

- `BaseClient`: resource client which to request api.

- `Factory`: get resource client in special case.

### Authorization

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

### Basic

API standard path: `resource/action`

**demo:**

- `funds/get` get fund info
- `advertiser/update` update advertiser

Resources correspond to attributes in the `Client` object.
Actions correspond to functions in the attribute of `Client` object.

**demo:**

```php
$res = $client->funds->get();
$res = $client->advertiser->update($params);
```

### Request params & Response types

```php

use CloudyCity\TencentMarketingSDK\Client;
use CloudyCity\TencentMarketingSDK\Kernel\Http\Parameters\Params;
use CloudyCity\TencentMarketingSDK\Kernel\Exceptions\Exception;

$advertiserId = '';
$accessToken = '';

// You can passing third param to set response type.
// Support types: array (default) / object / collection / raw (json string)
$client = new Client($advertiserId, $accessToken);

// Use `Params` to build params.
$params = Params::make()->setDateRange('2020-01-01', '2020-01-07')
    ->set('level', 'REPORT_LEVEL_ADGROUP')
    ->groupBy('adgroup_id', 'date')
    ->orderBy('cost', 'desc');

$filter = $params->getFilter()
    ->eq('adgroup_id', 'xxx');

$params->setFilter($filter);

// Or use array
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

### Paginator

`BaseClient::getAllPages()` implement page turning logic by `Generator`.

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

### Factory

If the SDK update lags behind the API update, new resources which do not exist in the member properties of `Client` class may appear.
You can use `Factory` class to obtain the `BaseClient` instance, but i recommend you open a issue let me create a new member properties for `Client`.

```php

use CloudyCity\TencentMarketingSDK\Factory;

$advertiserId = '';
$accessToken = '';

$resourceClient = Factory::getClient('new_resource', $advertiserId, $accessToken);
```

## Maintainers

- @CloudyCity

## Contributing

Feel free to dive in! [Open an issue](https://github.com/CloudyCity/tencent-marketing-sdk/issues/new) or submit PRs.

Standard Readme follows the [Contributor Covenant](http://contributor-covenant.org/version/1/3/0/) Code of Conduct.

## License

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
