
<?php
  

   /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Element.php";
    require_once "src/Store.php";

        $server = 'mysql:host=localhost;dbname=shoes_test';
        $username = 'root';
        $password = 'root';
        $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Store::deleteAll();
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

      }

      ?>
