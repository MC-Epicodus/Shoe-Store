<?php

class Brand extends Element {


 function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO brands (name) VALUES ('{$this->getName()}');");
            $this->id=$GLOBALS['DB']->lastInsertId();
        }

 static function getAll()
       {
       		$ret_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
       		$brands = array();
       		foreach ($ret_brands as $brand) {
       			$name = $brand['name'];
       			$id = $brand['id'];
       			$new_brand  = new brand($name,$id);
       			array_push($brands, $new_brand);
       		}
       		return $brands;
       }

       static function deleteAll()
       {

       		$GLOBALS['DB']->exec("DELETE FROM brands;");
       		$GLOBALS['DB']->exec("DELETE FROM stores_brands;");
       }

}


 ?>
