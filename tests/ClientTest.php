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
      protected function tearDown()
      {
        Client::deleteAll();
        Stylist::deleteAll();
      }
      function test_getName()
      {
        //Arrange
        $name = "Mulder";
        $stylist_id = 1;
        $id = 1;
        $test_client = new Client($name, $stylist_id, $id);
        //Act
        $result = $test_client->getName($name, $stylist_id, $id);
        //Assert
        $this->assertEquals($name, $result);
      }
      function test_getId()
      {
        //Arrange
        $name = "Mulder";
        $id = 1;
        $stylist_id = 1;
        $test_client = new Client($name, $stylist_id,$id);
        //Act
        $result = $test_client->getId();
        //Assert
        $this->assertEquals(true, is_numeric($result));
      }
      function test_save()
      {
        //Arrange
        $name = "Yvonna";
        $stylist_id = 1;
        $test_client = new Client($name, $stylist_id);
        $test_client->save();
        //Act
        $result = Client::getAll();
        //Assert
        $this->assertEquals($test_client, $result[0]);
      }
      function test_getAll()
      {
        //Arrange
        $name = "Yvonna";
        $stylist_id = 1;
        $test_client = new Client($name, $stylist_id);
        $test_client->save();

        $name2 = "Alexandra";
        $stylist_id = 2;
        $test_client2 = new Client($name2, $stylist_id);
        $test_client2->save();
        //Act
        $result = Client::getAll();
        //Assert
        $this->assertEquals([$test_client, $test_client2], $result);
      }
      function test_deleteAll()
      {
        //Arrange
        $name = "Yvonna";
        $stylist_id = 1;
        $test_client = new Client($name, $stylist_id);
        $test_client->save();

        $name2 = "Alexandra";
        $test_client2 = new Client($name2, $stylist_id);
        $test_client2->save();
        //Act
        Client::deleteAll();
        $result = Client::getAll();
        //Assert
        $this->assertEquals([], $result);
      }

  }

 ?>
