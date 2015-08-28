<?php


class Brand extends Element {


		 function save()
		        {
		            $GLOBALS['DB']->exec("INSERT INTO brands (name) VALUES ('{$this->getName()}');");
		            $this->id=$GLOBALS['DB']->lastInsertId();
		        }

      function addStore()
      	{
      			$GLOBALS['DB']->exec("INSERT INTO stores_brands (brand_id, store_id) VALUES ({$brand->getId()}, {$this->getId()});");
      	}



      function getStores()
	     {
	      	 $returned_brands = $GLOBALS['DB']->query("SELECT stores.* FROM brand
                                    JOIN stores_brands ON (stores.id = stores_brands.store_id)
                                    JOIN stores ON (stores_brands.brand_id = brands.id)
                                    WHERE brand.id = {$this->getId()};");
            
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
