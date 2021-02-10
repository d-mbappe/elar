<?php
return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        'api/<controller:\w+>/<action:(\w|-)+>' => '<controller>/<action>',
        'api/<controller:\w+>/' => '<controller>/index',
        'rbac/<controller:\w+>/<action:(\w|-)+>' => 'rbac/<controller>/<action>',
        'rbac/<controller:\w+>' => 'rbac/<controller>/index',
        'site/<action:(\w|-)+>' => 'site/<action>',
        '<a>' => 'site/index',
        '<a>/<b>' => 'site/index',
        '<a>/<b>/<c>' => 'site/index',
    ],
];
