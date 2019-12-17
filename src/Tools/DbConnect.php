<?php
namespace App\Tools;
require __DIR__ . './../../vendor/autoload.php';

use Dotenv\Dotenv;
use PDO;

class DbConnect
{
   private $dbHost;
   private $dbName;
   private $dbUser;
   private $dbPassword;

   public function setDbHost()
   {
      $dotenv = Dotenv::createImmutable(dirname(dirname(__DIR__)));
      $dotenv->load();

      $this->dbHost = getenv('DB_HOST');
      $this->dbName = getenv('DB_NAME');
      $this->dbUser = getenv('DB_USER');
      $this->dbPassword = getenv('DB_PASSWORD');

      return $db = new PDO("mysql:host={$this->dbHost}; dbname={$this->dbName}", $this->dbUser, $this->dbPassword);
   }
}