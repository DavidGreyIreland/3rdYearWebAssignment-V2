<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/04/16
 * Time: 11:46
 */

namespace Itb\Tests;

use Itb\Model\ClassTable;


class ClassTableTest extends \PHPUnit_Framework_TestCase
{
    /**
     * testing id
     */
    public function testGetId()
    {
        $att = new ClassTable();
        $att->setId(1);

        $expectedResult = 1;
        $result = $att->getId();

        $this->assertEquals($expectedResult, $result);
    }


    /**
     * testing time
     */
    public function testGetGrade()
    {
        $att = new ClassTable();
        $att->setGrade("white belt");

        $expectedResult = "white belt";
        $result = $att->getGrade();

        $this->assertEquals($expectedResult, $result);
    }


    /**
     * testing day
     */
    public function testGetDay()
    {
        $att = new ClassTable();
        $att->setDay("10:00");

        $expectedResult = "10:00";
        $result = $att->getDay();

        $this->assertEquals($expectedResult, $result);
    }


    /**
     * testing activity
     */
    public function testGetActivity()
    {
        $att = new ClassTable();
        $att->setActivity("gym");

        $expectedResult = "gym";
        $result = $att->getActivity();

        $this->assertEquals($expectedResult, $result);
    }

    
    /**
     * testing time
     */
    public function testGetTime()
    {
        $att = new ClassTable();
        $att->setTime("10:00");

        $expectedResult = "10:00";
        $result = $att->getTime();

        $this->assertEquals($expectedResult, $result);
    }
} 