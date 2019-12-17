<?php
namespace App\Storage;

use App\Storage\Contracts\StorageInterface;

class FileStorage implements StorageInterface
{
   protected $key;
   protected $value;
   protected $itemsPath = './../storage/items/';

   /**
    * @return string
    */
   public function getItemsPath()
   {
      return $this->itemsPath;
   }

   public function set($key, $value)
   {
      file_put_contents($this->getItemsPath() . $key, serialize($value));
   }

   public function get($key)
   {
      if (!file_exists($this->getItemsPath() . $key))
         return null;
      return unserialize(file_get_contents($this->getItemsPath() . $key));
   }

   public function delete($key)
   {
      if (!file_exists($this->getItemsPath() . $key))
         return null;
      unlink($this->getItemsPath() . $key);
   }

   public function destroy()
   {
      $scanned_directory = array_diff(scandir($this->getItemsPath()), array('..', '.'));
      foreach ($scanned_directory as $file)
      {
         unlink($this->getItemsPath() . $file);
      }
   }

   public function all()
   {
      $array = [];
      $scanned_directory = array_diff(scandir($this->getItemsPath()), array('..', '.'));

      foreach ($scanned_directory as $file)
      {
         $array[$file] = unserialize(file_get_contents($this->getItemsPath() . $file));
      }
      return $array;
   }
}
