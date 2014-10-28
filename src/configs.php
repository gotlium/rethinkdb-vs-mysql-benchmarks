<?php
date_default_timezone_set('Europe/Moscow');
ini_set('mysqli.default_socket', '/tmp/mysql.sock');

define('MYSQL_HOST', 'localhost');
define('MYSQL_USER', 'root');
define('MYSQL_PASSWORD', '');
define('MYSQL_DB', 'tests');

define('RETHINK_HOST', 'localhost');
define('RETHINK_USER', 'root');
define('RETHINK_PASSWORD', '');
define('RETHINK_DB', 'tests');

define('DB_ROWS', 2000000);
define('DB_STEP', 150);


if (strnatcmp(phpversion(), '5.4.30') < 0) {
    die('PHP version must be > 5.4.30');
}
