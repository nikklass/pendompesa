<?php

return [

    'role_structure' => [
        
        'superadministrator' => [
            
            'user' => 'c,r,u,d',
            'acl' => 'c,r,u,d',
            'profile' => 'r,u',
            'sms' => 'c,r,u,d',
            'scheduled-sms' => 'c,r,u,d',
            'group' => 'c,r,u,d',
            'prayer-request' => 'c,r,u,d',
            'paybill' => 'c,r,u,d',
            'loan' => 'c,r,u,d',
            'account' => 'c,r,u,d',
            'deposit_account' => 'c,r,u,d',
            'loan_account' => 'c,r,u,d',
            'loan_repayment' => 'c,r,u,d',
            'loan_application' => 'c,r,u,d',
            'account' => 'c,r,u,d'

        ],  

        'administrator' => [
            
            /*'user' => 'c,r,u,d',
            'profile' => 'r,u',
            'sms' => 'c,r,u,d',
            'scheduled_sms' => 'c,r,u,d',
            'group' => 'c,r,u,d',
            'company' => 'c,r,u,d',
            'paybill' => 'r',
            'loan' => 'r,u',
            'loan_repayment' => 'c,r,u,d',
            'loan_application' => 'c,r,u,d',
            'account' => 'c,r,u,d'*/

        ],

        'companyadministrator' => [
            
            /*'user' => 'c,r,u,d',
            'profile' => 'r,u',
            'sms' => 'c,r',
            'scheduled_sms' => 'c,r,u,d',
            'group' => 'c,r,u,d',
            'company' => 'r,u',
            'paybill' => 'r',
            'loan' => 'r,u'*/

        ],

        'companymanager' => [

            /*'profile' => 'r,u',
            'paybill' => 'r',
            'sms' => 'c,r',
            'scheduled_sms' => 'c,r,u,d',
            'group' => 'c,r,u,d',*/

        ]

    ],

    'permission_structure' => [
        
        /*'cru_user' => [
            'profile' => 'c,r,u'
        ],*/

    ],

    'permissions_map' => [

        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'

    ]

];
