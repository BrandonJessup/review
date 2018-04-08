<?php

// Put your database connection info in the following lines.
define ("DB_HOST"       , "");
define ("DB_NAME"       , "");
define ("DB_USERNAME"   , "");
define ("DB_PASSWORD"   , "");
define ("DB_CHARSET"    , "utf8");

class DatabaseHelpers {
    public static function getDatabaseConnection() {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        $opt = [
            PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES      => false,
        ];
        $dbh = new PDO($dsn, DB_USERNAME, DB_PASSWORD, $opt);

        return $dbh;
    }
}
