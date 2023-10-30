<?php

return [
    [
        'name' => 'super_admin',
        'core' => true,
        'permissions' => [],
        'revoke_permissions' => []
    ],
    [
        'name' => 'shopper',
        'core' => true,
        'permissions' => [
            'browse_product',
            'view_product'
        ],
        'revoke_permissions' => []
    ],
];
