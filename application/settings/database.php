<?php
// ** MySQL settings ** //
defined('_ENGINE') or die('Access Denied');
return array(
    'webhost'  => 'autotestdrive.vha.worldserver.su',
    'database' => array(
        'adapter' => 'mysqli',
        'params'  => array(		
            'host'     => 'localhost', // Имя хоста
            'username' => 'total', // Имя пользователя MySQL
            'password' => 'zHotVB3O', // ...и пароль
            'dbname'   => 'total', // Имя базы данных
            'charset' => 'UTF8' // Кодировка базы данных, в большинстве случаев не требует изменений // DB_COLLATE - 
                                // Проверка базы данных, чаще всего значение не требует изменений и остается пустым.
        ),
        'tablePrefix' => 'total_',
    )
);