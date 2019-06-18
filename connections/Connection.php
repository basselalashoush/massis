<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Connection
 *
 * @author uInfo
 */
class Connection {

    public static $server = 'localhost';
    public static $db_name = 'massis1';
    public static $user = 'root';
    public static $pwd = '';
    public static $pdo;
    public static $is_connected = NULL;

    public function __construct() {
        try {
            /*$connect = 'mysql:dbname='.self::$db_name.';'.self::$server.';'.'charset=utf8';
            self::$pdo = new PDO($connect, self::$user, self::$pwd,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET lc_time_names = \'fr_FR\''));
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);*/
             $connect = 'mysql:dbname='.self::$db_name.';'.self::$server;
            self::$pdo = new PDO($connect, self::$user, self::$pwd,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         
        } catch (PDOException $ex) {
             echo('Erreur : ' . $ex->getMessage());
        }

    }

    public function _destruct() {
        self::$is_connected = null;
    }

    public static function getPDO() {
        if (self::$is_connected === NULL) {
            new Connection();
            
        }
        return self::$pdo;
    }
   
}
