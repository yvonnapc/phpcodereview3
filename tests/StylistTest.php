<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";

    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {

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
    }

 ?>
