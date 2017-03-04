<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

use Service\HeadersInjector\HeaderProviders as Header;

return [
    'default' => 'cors',


    'providers' => [
        Header\AccessControlAllowOrigin::class,
        Header\AccessControlAllowMethods::class,
        Header\AccessControlAllowHeaders::class,
    ],


    'rules' => [
        'cors' => [
            'Access-Control-Allow-Origin'  => Header\AccessControlAllowOrigin::ORIGIN_ECHO,
            'Access-Control-Allow-Headers' => Header\AccessControlAllowHeaders::all(),
            'Access-Control-Allow-Methods' => Header\AccessControlAllowMethods::all(),
        ],
    ],
];