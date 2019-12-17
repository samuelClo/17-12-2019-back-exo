<?php
namespace App\Storage;

use App\Storage\Contracts\StorageInterface;

class SessionStorage implements StorageInterface
{
   public function set($key, $value)
   {
      if ($key && $value)
         $_SESSION['items'][$key] = serialize($value);
   }

   public function get($key)
   {
      if (isset($_SESSION['items'][$key]))
         return unserialize($_SESSION['items'][$key]);
   }

   public function delete($key)
   {
      if (isset($_SESSION['items'][$key]))
         unset($_SESSION['items'][$key]);
   }

   public function destroy()
   {
      if (isset($_SESSION['items']))
         unset($_SESSION['items']);
   }

   public function all()
   {
      $array = [];
      if (isset($_SESSION['items']))
      {
         foreach ($_SESSION['items'] as $items => $value)
         {
            $array[$items] = unserialize($value);
         }
      }
      return $array;
   }
}