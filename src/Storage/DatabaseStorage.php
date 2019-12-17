<?php
namespace App\Storage;

use App\Tools\DbConnect;
use PDO;
use App\Storage\Contracts\StorageInterface;

class DatabaseStorage implements StorageInterface
{
   public function set($key, $value)
   {
      $db = (new DbConnect())->setDbHost();

      if ($this->get($key))
         $query = $db->prepare('UPDATE storage SET key_storage = :key, value = :value WHERE key_storage = :key');
      else
         $query = $db->prepare('INSERT INTO storage (key_storage, value) VALUES (:key, :value)');
      $query->execute([
         "key" => $key,
         "value" => serialize($value)
      ]);
   }

   public function get($key)
   {
      $db = (new DbConnect())->setDbHost();
      $query = $db->prepare('SELECT value FROM storage WHERE key_storage = ?');
      $query->execute([$key]);
      $result = $query->fetch(PDO::FETCH_ASSOC);

      return unserialize($result['value']);
   }

   public function delete($key)
   {
      $db = (new DbConnect())->setDbHost();
      $query = $db->prepare('DELETE FROM storage WHERE key_storage = ?');
      $query->execute([$key]);
   }

   public function destroy()
   {
      $db = (new DbConnect())->setDbHost();
      $db->query('DELETE FROM storage');
   }

   public function all()
   {
      $array = [];
      $db = (new DbConnect())->setDbHost();
      $query = $db->query('SELECT * FROM storage');
      $result =  $query->fetchAll(PDO::FETCH_ASSOC);

      if ($result) {
         foreach ($result as $items => $value)
         {
            $value['value'] = unserialize($value['value']);
            $array[] = $value;
         }
      }

      return $array;
   }
}