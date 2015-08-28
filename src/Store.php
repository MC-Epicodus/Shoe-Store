<?php
//require_once "Element.php";
class Store extends Element {


       function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stores (name) VALUES ('{$this->getName()}');");
            $this->id=$GLOBALS['DB']->lastInsertId();
        }

       function delete()
       {

       }

       static function getAll()
       {
       		$ret_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
       		$stores = array();
       		foreach ($ret_stores as $store) {
       			$name = $store['name'];
       			$id = $store['name'];
       			$new_store  = new Store($name,$id);
       			array_push($stores, $new_store);
       		}
       		return $stores;
       }

       static function deleteAll()
       {

       		$GLOBALS['DB']->exec("DELETE FROM stores;");
       }

}


 ?>
