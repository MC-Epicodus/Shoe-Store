<?php
//require_once "Element.php";
class Store extends Element {


    function save()
	        {
	            $GLOBALS['DB']->exec("INSERT INTO stores (name) VALUES ('{$this->getName()}');");
	            $this->id=$GLOBALS['DB']->lastInsertId();
	        }

    function update($new_name)
	       {
	        $GLOBALS['DB']->exec("UPDATE stores SET name = '{$new_name}' WHERE id = {$this->getId()};");
	        $this->setName($new_name);

	       }

    function addBrand($brand)
	      {

	      	 $GLOBALS['DB']->exec("INSERT INTO stores_brands (brand_id, store_id) VALUES ({$brand->getId()}, {$this->getId()});");


	      }

    function getBrands()
	      {
	      	 $returned_brands = $GLOBALS['DB']->query("SELECT brands.* FROM stores
                                    JOIN stores_brands ON (stores.id = stores_brands.store_id)
                                    JOIN brands ON (stores_brands.brand_id = brands.id)
                                    WHERE stores.id = {$this->getId()};");
            
           	//var_dump($returned_brands);
            $brands = array();
            foreach($returned_brands as $brand) {
                $brand_name = $brand['name'];
                $id = $brand['id'];
                $new_brand = new Brand($brand_name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
	      }

    function delete()
       {
       		$GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
       		$GLOBALS['DB']->exec("DELETE FROM stores_brands WHERE store_id = {$this->getId()};");
       }

   	static function getAll()
       {
       		$ret_stores = $GLOBALS['DB']->query("SELECT * FROM stores ORDER BY id DESC;");
       		$stores = array();
       		foreach ($ret_stores as $store) {
       			$name = $store['name'];
       			$id = $store['id'];
       			$new_store  = new Store($name,$id);
       			array_push($stores, $new_store);
       		}
       		return $stores;
       }

   	static function deleteAll()
       {
       		$GLOBALS['DB']->exec("DELETE FROM stores;");
       		$GLOBALS['DB']->exec("DELETE FROM stores_brands;");
       }

       static function find($search_id)
       {
       	 $found_store = null;
            $stores = Store::getAll();
            foreach($stores as $store) {
                $store_id = $store->getId();
                if($store_id == $search_id) {
                    $found_store = $store;
                }
            }
            return $found_store;
       }

}


 ?>
