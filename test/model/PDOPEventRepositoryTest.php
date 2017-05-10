<?php

use \model\Event;
use \model\PDOEventRepository;

class PDORepositoryTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->mockPDO = $this->getMockBuilder('PDO')
            ->disableOriginalConstructor()
            ->getMock();

        $this->mockPDOStatement = $this->getMockBuilder('PDOStatement')
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function tearDown()
    {
        $this->mockPDO = null;
        $this->mockPDOStatement = null;
    }

    public function testFindEventById_idExists_EventObject()
    {
        $event = new Event(1, 'testEvent');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue([['id' => $event->getId(), 'name' => $event->getName()]]));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvent = $pdoRepository->findEventById($event->getId());
        $this->assertEquals($event, $actualEvent);
    }

    public function testFindEventById_idDoesNotExist_Null()
    {
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue([]));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvent = $pdoRepository->findEventById(1);
        $this->assertNull($actualEvent);
    }


    public function testFindEventById_exeptionThrownFromPDO_Null()
    {
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')->will($this->throwException(new Exception()));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvent = $pdoRepository->findEventById(1);
        $this->assertNull($actualEvent);
    }


    public function testFindEvents_EventsInResultSet_ArrayEventObjects()
    {
        $event1 = new Event(1, 'testEvent1');
        $event2 = new Event(2, 'testEvent2');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue([['id' => $event1->getId(), 'name' => $event1->getName()], ['id' => $event2->getId(), 'name' => $event2->getName()]]));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvents = $pdoRepository->findEvents();
        $this->assertEquals([$event1, $event2], $actualEvents);
    }


    public function testFindEvents_noData_EmptyArray()
    {
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue([]));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvents = $pdoRepository->findEvents();
        $this->assertEmpty($actualEvents);
    }

    public function testFindEvents_exeptionThrownFromPDO_EmptyArray()
    {
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')->will($this->throwException(new Exception()));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvents = $pdoRepository->findEvents(1);
        $this->assertEmpty($actualEvents);
    }

}
