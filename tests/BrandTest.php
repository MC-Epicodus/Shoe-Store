
<?php

   /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Element.php";
    require_once "src/Store.php";
    require_once "src/Brand.php";

        $server = 'mysql:host=localhost;dbname=shoes_test';
        $username = 'root';
        $password = 'root';
        $DB = new PDO($server, $username, $password);

    class BrandTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
       {
           Brand::deleteAll();
           Store::deleteAll();
        }

        function testGetNameForElement()
        {
            $test_brand = new Brand("A Brand Name");

            $result = $test_brand->getName();
            $this->assertEquals("A Brand Name", $result);
        }

        function testSetNameForElement()
        {
            $name1 = "A Brand Name";
            $test_brand = new Brand($name1);

            $name2 = "Bobs big brand name";
            $test_brand->setName($name2);
            $result = $test_brand->getName();
            $this->assertEquals($name2, $result);
        }

             function testSave()
        {
            $name1 = "A Brand Name";
            $test_brand = new Brand($name1);
            $test_brand->save();

            $result = Brand::getAll();
            $this->assertEquals([$test_brand], $result);
        }

        function testGetStores()
        {
            $name1 = "A Brand Name";
            $test_brand = new Brand($name1);
            $test_brand->save();

            $store_name1 = "KippersOnKrakkers";
            $test_store1 = new Store($store_name1);
            $test_store1->save();

            $test_store1->addBrand($test_brand);

            $this->assertEquals($test_store1->getBrands()[0],$test_brand);
        }

        function testUpdate()
        {
            $name1 = "A Brand Name";
            $test_brand = new Brand($name1);
            $test_brand->save();

            $new_name = "A Brand new Brand Name";
            $test_brand->update($new_name);

            $result = Brand::find($test_brand->getId());
            $this->assertEquals($result->getName(),$new_name);
        }

        function testDeleteAll()
        {
            $name1 = "A Brand Name";
            $test_brand = new Brand($name1);
            $test_brand->save();

            $name2 = "A new Brand Name";
            $test_brand2 = new Brand($name2);
            $test_brand2->save();

            Brand::deleteAll();

            $this->assertEquals([],Brand::getAll());
        }

        function testDeleteOne()
        {
            $name1 = "A Brand Name";
            $test_brand = new Brand($name1);
            $test_brand->save();

            $name2 = "A new Brand Name";
            $test_brand2 = new Brand($name2);
            $test_brand2->save();

            $test_brand2->delete();

            $this->assertEquals([$test_brand],Brand::getAll());


        }



      }

      ?>
