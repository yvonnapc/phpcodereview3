<?php

  /**
  * @backupGlobals disabled
  * @backupStaticAttributes disabled
  */

  require_once "src/Stylist.php";
  require_once "src/Client.php";

  $server = 'mysql:host=localhost;dbname=hair_salon_test';
  $username = 'root';
  $password = 'root';
  $DB = new PDO($server, $username, $password);

  class ClientTest extends PHPUnit_Framework_TestCase
  {

    function test_getName()
    {
      //Arrange
      $name = "Mulder";
      $test_client = new Client($name);
      //Act
      $result = $test_client->getName();
      //Assert
      $this->assertEquals($name, $result);
    }
  }

 ?>
