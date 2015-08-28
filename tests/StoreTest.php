
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

    class StoreTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
           Store::deleteAll();
           Brand::deleteAll();
        }

        function testGetNameForElement()
        {
            $test_store = new Store("A Store Name");

            $result = $test_store->getName();
            $this->assertEquals("A Store Name", $result);
        }

        function testSetNameForElement()
        {
            $name1 = "A Store Name";
            $test_store = new Store($name1);

            $name2 = "Bobs big Store name";
            $test_store->setName($name2);
            $result = $test_store->getName();
            $this->assertEquals($name2, $result);
        }

        
        function testDeleteAll()
        {
             
            $name1 = "A Store Name";
            $test_store = new Store($name1);
            $test_store->save();

            $name2 = "ballsack";
            $test_store = new Store($name2);
            $test_store->save();

            Store::deleteAll();

            $this->assertEquals([],Store::getAll());


        }

        function testUpdate()
        {
            $name1 = "A Store Name";
            $test_store = new Store($name1);
            $test_store->save();

            $new_name = "A New Store Name";
            $test_store->update($new_name);

            $result = Store::getAll();
            $this->assertEquals($result[0]->getName(), $new_name);

        }

        function testFind()
        {
            $name1 = "A Store Name";
            $test_store = new Store($name1);
            $test_store->save();

            $name2 = "ballsack";
            $test_store = new Store($name2);
            $test_store->save();

            $result = Store::find($test_store->getId());

            $this->assertEquals($result, $test_store);

        }

        function testAddBrand()
        {
            $name1 = "KippersOnKrakkers";
            $test_store = new Store($name1);
            $test_store->save();

            $brand_name = "Adeedus";
            $test_brand = new Brand($brand_name);
            $test_brand->save();

            $brand_name2 = "bujeezus";
            $test_brand2 = new Brand($brand_name2);
            $test_brand2->save();

            $test_store->addBrand($test_brand);
            $test_store->addBrand($test_brand2);
           
            $result = $test_store->getBrands();

        $this->assertEquals([$test_brand,$test_brand2],$result);
        }

      }

      ?>
