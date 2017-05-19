<?php
/*
 * Modified: prepend directory path of current file, because of this file own different ENV under between Apache and command line.
 * NOTE: please remove this comment.
 */
defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

/**
 * mysql : 3306
 * postgresql : 5432
 * mongodb : 27017
 */

return new \Phalcon\Config([
    'database' => [
        'mysql' => [
            'adapter'    => 'Mysql',
            'host'       => 'localhost',
            'port'       => '8889',
            'username'   => 'root',
            'password'   => 'root',
            'dbname'     => 'test',
            'charset'    => 'utf8',
        ],
        'postgresql' =>[
            'adapter'    => 'Postgresql',
            'host'       => 'localhost',
            'port'       => '5432',
            'username'   => 'root',
            'password'   => 'root',
            'dbname'     => 'test',
            'charset'    => 'utf8',
        ],
        'mongodb' => [
            'host'       => 'localhost',
            'port'       => '27017',
            'username'   => 'root',
            'password'   => 'root',
            'dbname'     => 'test',
        ],
        'awsDynamodb' =>[
        ],
    ],

    'application' => [
        'modelsDir'      => APP_PATH . '/models/',
        'migrationsDir'  => APP_PATH . '/migrations/',
        'viewsDir'       => APP_PATH . '/views/',
        'baseUri'        => '/apibase/',
    ],

    'notification' => [
        // get from firebase
        'firebaseKey' => 'AAAA7ckixgc:APA91bE4_jHKyaCVojtJEfp8bhIev_hOXC4td1y82TB0LWmyUhprIKR15p-VyMbwClZ9CBejdqI_QKFjZs8Cap5LtXezxwvJrNibRhW0-a_qMpZInFGy__W_KihtDgjt_NM84TNDYAcpvqunMa816KQrPtqojH1N6g',
    ],

    /**
     * if true, then we print a new line at the end of each execution
     *
     * If we dont print a new line,
     * then the next command prompt will be placed directly on the left of the output
     * and it is less readable.
     *
     * You can disable this behaviour if the output of your application needs to don't have a new line at end
     */
    'cli_printNewLine' => true,
    'version' => "1.0",
    'display_php_inner_error' => false, // 是否顯示 php 內部錯誤訊息
    'is_show_response_debug_msg' => false // 是否 resonse 顯示 debug message
]);
