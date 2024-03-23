<?php

class Database
{
  private $DB;
  private $config;

  public function __construct()
  {
    $this->config = __DIR__ . '/../config.php';
    require_once $this->config;

    try {
      $dsn = "mysql:host=" . DATABASE_HOST . ";dbname=" . DATABASE_NAME;
      $this->DB = new PDO($dsn, DATABASE_USER, DATABASE_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (PDOException $error) {
      die('Erreur : ' . $error->getMessage());
    }
  }

  
  public function getDB(): PDO
  {
    return $this->DB;
  }
}