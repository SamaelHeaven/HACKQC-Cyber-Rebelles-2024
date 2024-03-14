<?php

final class DatabaseService
{

    public static function query(string $query): array|null
    {
        $connection = pg_connect(self::_get_connection_string());
        if (!$connection) {
            return null;
        }
        $result = pg_query($connection, $query);
        if (!$result) {
            return null;
        }
        $data = array();
        while ($row = pg_fetch_assoc($result)) {
            $data[] = $row;
        }
        pg_close($connection);
        return $data;
    }

    public static function escape_string($string): string
    {
        $connection = pg_connect(self::_get_connection_string());
        $result = pg_escape_string($connection, $string);
        pg_close($connection);
        return $result;
    }

    private static function _get_connection_string(): string
    {
        $host = getenv("DB_HOSTNAME");
        $port = "5432";
        $database_name = getenv("DB_NAME");
        $username = getenv("DB_USERNAME");
        $password = getenv("DB_PASSWORD");
        return "host=$host port=$port dbname=$database_name user=$username password=$password";
    }
}