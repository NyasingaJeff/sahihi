<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log','user-managment'],
    'modules' => [
        #addirtion of the wbimark Rbac module
        'user-management' => [
            'class' => 'webvimark\modules\UserManagement\UserManagementModule',
            'auth_rule_table'=>'authRules',
            'auth_item_table'=>'authItems',
            'auth_assignment_table'=>'authAssignments',
            'auth_item_child_table'=>'authItemChildren',
            'on beforeAction' => function(yii\base\ActionEvent $event) {
                if (Yii::$app->user->isGuest && !in_array($event->action->uniqueId, [
                    'user-management/auth/login',
                    'user-management/auth/logout',
                    'user-management/auth/confirm-registration',
                    'user-management/auth/password-recovery',
                    'user-management/auth/password-recovery-receive'
                ])) {
                    Yii::$app->user->loginRequired();
                }
            },
        ],
    ],
    'components' => [
        #to handle the user management.
        'user' => [
            'class' => 'webvimark\modules\UserManagement\components\UserConfig',
            'on afterLogin' => function($event) {
                \webvimark\modules\UserManagement\models\UserVisitLog::newVisitor($event->identity->id);
            },
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
    
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'login' => 'user-management/auth/login',
                'logout' => 'user-management/auth/logout',
                'registration' => 'user-management/auth/registration',
                'password-recovery' => 'user-management/auth/password-recovery',
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
