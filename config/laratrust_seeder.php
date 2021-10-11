<?php

return [
    'role_structure' => [
        'superadmin' => [
            'associado' => 'c,r,u,d',
            'dependente' => 'c,r,u,d',
            'marcacao' => 'c,r,u,d',
            'medico' => 'c,r,u,d',
        ],
        'admin' => [
            'associado' => 'c,r,u',
            'dependente' => 'c,r,u',
            'marcacao' => 'c,r,u',
            'medico' => 'c,r,u',
        ],
        'associado' => [
            'associado' => 'r,u',
            'marcacao' => 'c,r,d'
        ],
        'medico' => [
            'medico' => 'r,u',
            'marcacao' => 'r'
        ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
