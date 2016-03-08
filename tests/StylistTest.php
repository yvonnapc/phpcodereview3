<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";
    require_once "src/Client.php";

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {
      protected function tearDown()
      {
        Client::deleteAll();
        Stylist::deleteAll();
      }
      function test_getName()
      {
        //Arrange
        $name = "Dana";
        $id = null;
        $test_stylist = new Stylist($name, $id);
        //Act
        $result = $test_stylist->getName();
        //Assert
        $this->assertEquals($name, $result);
      }
      function test_getId()
      {
        //Arrange
        $name = "Dana";
        $id = 1;
        $test_stylist = new Stylist($name, $id);
        //Act
        $result =  $test_stylist->getId();
        //Assert
        $this->assertEquals(true, is_numeric($result));
      }
      function test_save()
      {
        //Arrange
        $name = "Dana";
        $test_stylist = new Stylist($name);
        $test_stylist->save();
        //Act
        $result = Stylist::getAll();
        //Assert
        $this->assertEquals($test_stylist, $result[0]);
      }
      function test_getAll()
      {
        //Arrange
        $name = "Dana";
        $id = null;
        $test_stylist = new Stylist($name, $id);
        $test_stylist->save();

        $name2 = "Scully";
        $id = null;
        $test_stylist2 = new Stylist($name2, $id);
        $test_stylist2->save();
        //Act
        $result = Stylist::getAll();
        //Assert
        $this->assertEquals([$test_stylist, $test_stylist2], $result);
      }
      function test_deleteAll()
      {
        //Arrange
        $name = "Dana";
        $id = null;
        $test_stylist = new Stylist($name, $id);
        $test_stylist->save();

        $name2 = "Scully";
        $id = null;
        $test_stylist2 = new Stylist($name2, $id);
        $test_stylist2->save();
        //Act
        Stylist::deleteAll();
        $result = Stylist::getAll();
        //Assert
        $this->assertEquals([], $result);
      }
      function test_find()
      {
        //Arrange
        $name = "Dana";
        $id = null;
        $test_stylist = new Stylist($name, $id);
        $test_stylist->save();

        $name2 = "Scully";
        $id = null;
        $test_stylist2 = new Stylist($name2, $id);
        $test_stylist2->save();
        //Act
        $result = Stylist::find($test_stylist->getId());
        //Assert
        $this->assertEquals($test_stylist, $result);
      }
    }

 ?>
