<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/04/16
 * Time: 12:39
 */

namespace Itb\Tests;
use Itb\Model\User;
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
} 