<?php

class MySQL
{
    private static $connection;
    private static $host = "127.0.0.1";
    private static $userName = "root";
    private static $password = "password";
    private static $dbName = "team_effi_sync_db";
    private static $port = "3306";

    private static function setUpConnection()
    {
        if (!isset(MySQL::$connection)) {
            MySQL::$connection = new mysqli(MySQL::$host, MySQL::$userName, MySQL::$password, MySQL::$dbName, MySQL::$port);
        }
    }

    public static function search($query)
    {
        MySQL::setUpConnection();
        return MySQL::$connection->query($query);
    }

    public static function iud($query)
    {
        MySQL::setUpConnection();
        MySQL::$connection->query($query);
    }
}