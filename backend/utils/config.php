<?php

class Config {
    public static function DB_NAME() {
        // return Config::get_env("DB_NAME", "university");
        return "billtracker";
    }
    public static function DB_PORT() {
        // return Config::get_env("DB_PORT", 3306);
        return 3306;
    }
    public static function DB_USER() {
        // return Config::get_env("DB_USER", 'root');
        return 'root';
    }
    public static function DB_PASSWORD() {
        // return Config::get_env("DB_PASSWORD", '');
        return 'billtracker123';
    }
    public static function DB_HOST() {
        // return Config::get_env("DB_HOST", '127.0.0.1');
        return '127.0.0.1';
    }
    // public static function JWT_SECRET() {
    //     return Config::get_env("DB_HOST", ',dpPL,Se%fM-UVQBwf/X0T&B!DF6%}');
    // }
    public static function get_env($name, $default){
        return isset($_ENV[$name]) && trim($_ENV[$name]) != "" ? $_ENV[$name] : $default;
    }
}