<?php

use \model\Event;
use \model\PDOEventRepository;

class PDORepositoryTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->mockPDO = $this->getMockBuilder('PDO')->disableOriginalConstructor()->getMock();

        $this->mockPDOStatement = $this->getMockBuilder('PDOStatement')->disableOriginalConstructor()->getMock();
    }

    public function tearDown()
    {
        $this->mockPDO = null;
        $this->mockPDOStatement = null;
    }

    public function testFindEventById_idExists_EventObject()
    {
        $event = new Event(1, '2017-05-01 14:30:00', 1, 'testEvent1', 'Beschrijving.');
        $this->mockPDOStatement->expects($this->atLeastOnce())->method('fetchAll')->will($this->returnValue([['id' => $event->getId(), 'title' => $event->getTitle(), 'description' => $event->getDescription(), 'datetime' => $event->getDatetime(), 'person' => $event->getPerson()]]));
        $this->mockPDO->expects($this->atLeastOnce())->method('prepare')->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvent = $pdoRepository->findEventById($event->getId());
        $this->assertEquals($event, $actualEvent);
    }

    public function testFindEventById_idDoesNotExist_Null()
    {
        $this->mockPDOStatement->expects($this->atLeastOnce())->method('fetchAll')->will($this->returnValue([]));
        $this->mockPDO->expects($this->atLeastOnce())->method('prepare')->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvent = $pdoRepository->findEventById(1);
        $this->assertNull($actualEvent);
    }

    public function testFindEventById_exeptionThrownFromPDO_Null()
    {
        $this->mockPDO->expects($this->atLeastOnce())->method('prepare')->will($this->throwException(new Exception()));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvent = $pdoRepository->findEventById(1);
        $this->assertNull($actualEvent);
    }

    public function testFindEvents_EventsInResultSet_ArrayEventObjects()
    {
        $event1 = new Event(1, '2017-05-01 14:30:00', 1, 'testEvent1', 'Beschrijving.');
        $event2 = new Event(2, '2017-05-01 14:30:00', 1, 'testEvent2', 'Beschrijving.');
        $this->mockPDOStatement->expects($this->atLeastOnce())->method('execute');
        $this->mockPDOStatement->expects($this->atLeastOnce())->method('fetchAll')->will($this->returnValue([['id' => $event1->getId(), 'title' => $event1->getTitle(), 'description' => $event1->getDescription(), 'datetime' => $event1->getDatetime(), 'person' => $event1->getPerson()], ['id' => $event2->getId(), 'title' => $event2->getTitle(), 'description' => $event2->getDescription(), 'datetime' => $event2->getDatetime(), 'person' => $event2->getPerson()]]));
        $this->mockPDO->expects($this->atLeastOnce())->method('prepare')->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvents = $pdoRepository->findEvents();
        $this->assertEquals([$event1, $event2], $actualEvents);
    }

    public function testFindEvents_noData_EmptyArray()
    {
        $this->mockPDOStatement->expects($this->atLeastOnce())->method('fetchAll')->will($this->returnValue([]));
        $this->mockPDO->expects($this->atLeastOnce())->method('prepare')->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvents = $pdoRepository->findEvents();
        $this->assertEmpty($actualEvents);
    }

    public function testFindEvents_exeptionThrownFromPDO_EmptyArray()
    {
        $this->mockPDO->expects($this->atLeastOnce())->method('prepare')->will($this->throwException(new Exception()));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvents = $pdoRepository->findEvents(1);
        $this->assertEmpty($actualEvents);
    }

    public function testFindEventsByPerson_EventsInResultSet_ArrayEventObjects()
    {
        $event1 = new Event(1, '2017-05-01 14:30:00', 1, 'testEvent1', 'Beschrijving.');
        $event2 = new Event(2, '2017-05-01 14:30:00', 1, 'testEvent2', 'Beschrijving.');
        $this->mockPDOStatement->expects($this->atLeastOnce())->method('execute');
        $this->mockPDOStatement->expects($this->atLeastOnce())->method('fetchAll')->will($this->returnValue([['id' => $event1->getId(), 'title' => $event1->getTitle(), 'description' => $event1->getDescription(), 'datetime' => $event1->getDatetime(), 'person' => $event1->getPerson()], ['id' => $event2->getId(), 'title' => $event2->getTitle(), 'description' => $event2->getDescription(), 'datetime' => $event2->getDatetime(), 'person' => $event2->getPerson()]]));
        $this->mockPDO->expects($this->atLeastOnce())->method('prepare')->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvents = $pdoRepository->findEventsByPerson(1);
        $this->assertEquals([$event1, $event2], $actualEvents);
    }

    public function testFindEventsByPerson_noData_EmptyArray()
    {
        $this->mockPDOStatement->expects($this->atLeastOnce())->method('fetchAll')->will($this->returnValue([]));
        $this->mockPDO->expects($this->atLeastOnce())->method('prepare')->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvents = $pdoRepository->findEventsByPerson();
        $this->assertEmpty($actualEvents);
    }

    public function testFindEventsByPerson_exeptionThrownFromPDO_EmptyArray()
    {
        $this->mockPDO->expects($this->atLeastOnce())->method('prepare')->will($this->throwException(new Exception()));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvents = $pdoRepository->findEventsByPerson(1);
        $this->assertEmpty($actualEvents);
    }

    public function testFindEventsByDate_EventsInResultSet_ArrayEventObjects()
    {
        $event1 = new Event(1, '2017-05-01 14:30:00', 1, 'testEvent1', 'Beschrijving.');
        $event2 = new Event(2, '2017-05-01 14:30:00', 1, 'testEvent2', 'Beschrijving.');
        $this->mockPDOStatement->expects($this->atLeastOnce())->method('execute');
        $this->mockPDOStatement->expects($this->atLeastOnce())->method('fetchAll')->will($this->returnValue([['id' => $event1->getId(), 'title' => $event1->getTitle(), 'description' => $event1->getDescription(), 'datetime' => $event1->getDatetime(), 'person' => $event1->getPerson()], ['id' => $event2->getId(), 'title' => $event2->getTitle(), 'description' => $event2->getDescription(), 'datetime' => $event2->getDatetime(), 'person' => $event2->getPerson()]]));
        $this->mockPDO->expects($this->atLeastOnce())->method('prepare')->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvents = $pdoRepository->findEventsByDate($event1->getDatetime(), $event1->getDatetime());
        $this->assertEquals([$event1, $event2], $actualEvents);
    }

    public function testFindEventsByDate_noData_EmptyArray()
    {
        $this->mockPDOStatement->expects($this->atLeastOnce())->method('fetchAll')->will($this->returnValue([]));
        $this->mockPDO->expects($this->atLeastOnce())->method('prepare')->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvents = $pdoRepository->findEventsByDate();
        $this->assertEmpty($actualEvents);
    }

    public function testFindEventsByDate_exeptionThrownFromPDO_EmptyArray()
    {
        $this->mockPDO->expects($this->atLeastOnce())->method('prepare')->will($this->throwException(new Exception()));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvents = $pdoRepository->findEventsByDate($event1->getDatetime(), $event1->getDatetime());
        $this->assertEmpty($actualEvents);
    }

    public function testFindEventsByPersonDate_EventsInResultSet_ArrayEventObjects()
    {
        $event1 = new Event(1, '2017-05-01 14:30:00', 1, 'testEvent1', 'Beschrijving.');
        $event2 = new Event(2, '2017-05-01 14:30:00', 1, 'testEvent2', 'Beschrijving.');
        $this->mockPDOStatement->expects($this->atLeastOnce())->method('execute');
        $this->mockPDOStatement->expects($this->atLeastOnce())->method('fetchAll')->will($this->returnValue([['id' => $event1->getId(), 'title' => $event1->getTitle(), 'description' => $event1->getDescription(), 'datetime' => $event1->getDatetime(), 'person' => $event1->getPerson()], ['id' => $event2->getId(), 'title' => $event2->getTitle(), 'description' => $event2->getDescription(), 'datetime' => $event2->getDatetime(), 'person' => $event2->getPerson()]]));
        $this->mockPDO->expects($this->atLeastOnce())->method('prepare')->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvents = $pdoRepository->findEventsByPersonDate(1, $event1->getDatetime(), $event1->getDatetime());
        $this->assertEquals([$event1, $event2], $actualEvents);
    }

    public function testFindEventsByPersonDate_noData_EmptyArray()
    {
        $this->mockPDOStatement->expects($this->atLeastOnce())->method('fetchAll')->will($this->returnValue([]));
        $this->mockPDO->expects($this->atLeastOnce())->method('prepare')->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvents = $pdoRepository->findEventsByPersonDate();
        $this->assertEmpty($actualEvents);
    }

    public function testFindEventsByPersonDate_exeptionThrownFromPDO_EmptyArray()
    {
        $this->mockPDO->expects($this->atLeastOnce())->method('prepare')->will($this->throwException(new Exception()));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvents = $pdoRepository->findEventsByPersonDate(1, $event1->getDatetime(), $event1->getDatetime());
        $this->assertEmpty($actualEvents);
    }
}