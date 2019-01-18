<?php

return [
            // HTTP 请求的超时时间（秒）
            'timeout' => 5.0,
            // 默认发送配置
            'default' => [
                // 网关调用策略，默认：顺序调用
                'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,
                // 默认可用的发送网关
                'gateways' => ['submail','aliyun'],
            ],
            // 可用的网关配置
            'gateways' => [
                'errorlog' => [
                    'file' => '/storage/logs/easy-sms.log',
                ],
                'aliyun' => [
                    'access_key_id' => env('ALIYUN_ACCESS_KEY_ID'),
                    'access_key_secret' => env('ALIYUN_ACCESS_KEY_SECRET'),
                    'sign_name' => env('ALIYUN_SIGN_NAME'),
                ],
                'submail' => [
                    'app_id' => env('SUBMAIL_APP_ID'),
                    'app_key' => env('SUBMAIL_KEY'),
                    'project' => env('SUBMAIL_PROJECT'), 
                ],
            ],
        ];