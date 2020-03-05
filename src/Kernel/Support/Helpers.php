<?php

namespace CloudyCity\TencentMarketingSDK\Kernel\Support;

/**
 * Generate a nonce.
 *
 * @return string
 */
function generate_nonce()
{
    return md5(uniqid(mt_rand(), true));
}
