
<?php
    require_once "src/Element.php";
    require_once "src/Brand.php";
    class myClassTest extends PHPUnit_Framework_TestCase
    {
        function testGetName()
        {
            $test_brand = new Brand("A Brand Name");

            $result = $test_brand->getName();
            $this->assertEquals("A Brand Name", $result);
        }

        function testSetName()
        {
            $name1 = "A Brand Name";
            $test_brand = new Brand($name1);

            $name2 = "Bobs big brand name";
            $test_brand->setName($name2);
            $result = $test_brand->getName();
            $this->assertEquals($name2, $result);
        }


      }

      ?>
