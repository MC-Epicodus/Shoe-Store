<?php


class Brand extends Element {


	 function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO brands (name) VALUES ('{$this->getName()}');");
            $this->id=$GLOBALS['DB']->lastInsertId();
        }



     function addStore($store)
      	{
      			$GLOBALS['DB']->exec("INSERT INTO brands_stores (brand_id, store_id) VALUES ({$this->getId()}, {$store->getId()});");
      	}

	function getStores()
		{
		$returned_stores = $GLOBALS['DB']->query("SELECT stores.* FROM brands
													JOIN brands_stores ON (brands.id = brands_stores.brand_id)
													JOIN stores ON (brands_stores.store_id = stores.id)
													WHERE brands.id = {$this->getId()};");

		$stores = array();
		foreach($returned_stores as $store) {
			$store_name = $store['name'];
			$store_id = $store['id'];
			$new_store = new Store($store_name, $store_id);
			array_push($stores, $new_store);
			}
		return $stores;
		}

	function update($new_name)
	{
		$GLOBALS['DB']->exec("UPDATE brands SET name = '{$new_name}' WHERE id = {$this->getId()}; ");
		$this->setName($new_name);
	}
	
	function delete()
	{
		$GLOBALS['DB']->exec("DELETE FROM brands WHERE id = {$this->getId()};");
		$GLOBALS['DB']->exec("DELETE FROM brands_stores WHERE brand_id = {$this->getId()};");
	}

	
//Static Functions
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
			$GLOBALS['DB']->exec("DELETE FROM brands_stores;");
		}

	static function find($search_id)
		{
		$found_brand = null;
		$brands = Brand::getAll();
			foreach($brands as $brand) {
			$brand_id = $brand->getId();
			if($brand_id == $search_id) {
			$found_brand = $brand;
			}
		}
		return $found_brand;


		}





}


 ?>
