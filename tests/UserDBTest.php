<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/04/16
 * Time: 12:39
 */

namespace Itb\Tests;
use Itb\Model\User;
use Mattsmithdev\PdoCrud\DatabaseTable;

class UserDBTest extends \PHPUnit_Extensions_Database_TestCase
{
    public function getConnection()
    {
        $host = DB_HOST;
        $dbName = DB_NAME;
        $dbUser = DB_USER;
        $dbPass = DB_PASS;

        // mysql
        $dsn = 'mysql:host=' . $host . ';dbname=' . $dbName;
        $db = new \PDO($dsn, $dbUser, $dbPass);
        $connection = $this->createDefaultDBConnection($db, $dbName);

        return $connection;
    }

    public function getDataSet()
    {
        $seedFilePath = __DIR__ . '/databaseXml/seed.xml';
        return $this->createXMLDataSet($seedFilePath);
    }

    public function testNumRowsFromSeedData()
    {
        // arrange
        $numRowsAtStart = 4;
        $expectedResult = $numRowsAtStart;

        // act

        // assert
        $this->assertEquals($expectedResult, $this->getConnection()->getRowCount('users'));
    }


    public function testRowCountAfterDeleteOne()
    {

        // arrange
        $numRowsAtStart = 4;
        $this->assertEquals($numRowsAtStart, $this->getConnection()->getRowCount('users'), 'Pre-Condition');
        $expectedResult = 3;

        // act
        User::delete(1);
        $result = $this->getConnection()->getRowCount('users');

        // assert
        $this->assertNotNull($expectedResult, $result);
    }
    

/*    public function testGetAllAsObjectArray()
    {
        // arrange
        $user1 = new User();
        $user1->setId(1);
        $user1->setUsername('david');
        $user1->setPassword(1234);
        $user1->setRole(1);

        //$user1->getPassword();
        //$user2 = password_hash($pass, PASSWORD_DEFAULT);
        //$user1->setPassword($user2);
        //$user1->setRole(1);


        $expectedResult = [];
        $expectedResult[] = $user1;

        // act
        $result = User::getAll();
        //$previsionalName = User1::getOneByUsername("david");
        //$hashedStoredPassword = $previsionalName->getPassword();

        // assert
        $this->assertEquals($expectedResult, $result);
    }*/
} 