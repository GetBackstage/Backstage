<?php

use \model\Event;
use \controller\EventController;

class EventControllerTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->mockEventRepository = $this->getMockBuilder('model\EventRepository')->getMock();
        $this->mockView = $this->getMockBuilder('view\View')->getMock();
    }

    public function tearDown()
    {
        $this->mockEventRepository = null;
        $this->mockView = null;
    }

    public function testHandleFindEventById_EventFound_stringWithIdName()
    {
        $event = new Event(1, '2017-05-01 14:30:00', 1, 'testEvent1', 'Beschrijving.');
        $this->mockEventRepository->expects($this->atLeastOnce())->method('findEventById')->will($this->returnValue($event));
        $this->mockView->expects($this->atLeastOnce())->method('show')
            ->will($this->returnCallback(function ($object) {
                $event = $object['Events'];
                printf("[{\"id\"=>%d, \"title\"=>%s, \"description\"=>%s, \"datetime\"=>%s, \"person\"=>%d}]", $event[0]->getId(), $event[0]->getTitle(), $event[0]->getDescription(), $event[0]->getDatetime(), $event[0]->getPerson());
            }));
        $eventController = new EventController($this->mockEventRepository, $this->mockView);
        $eventController->handleFindEventById($event->getId());
        $this->expectOutputString(sprintf("[{\"id\"=>%d, \"title\"=>%s, \"description\"=>%s, \"datetime\"=>%s, \"person\"=>%d}]", $event[0]->getId(), $event[0]->getTitle(), $event[0]->getDescription(), $event[0]->getDatetime(), $event[0]->getPerson()));
    }

    public function test_handleFindEventById_EventFound_returnStringEmpty()
    {
        $this->mockEventRepository->expects($this->atLeastOnce())->method('findEventById')->will($this->returnValue(null));

        $this->mockView->expects($this->atLeastOnce())->method('show')
            ->will($this->returnCallback(function ($object) {
                echo '';
            }));
        $eventController = new EventController($this->mockEventRepository, $this->mockView);
        $eventController->handleFindEventById(1);
        $this->expectOutputString('');
    }

    public function testHandleFindEvents_EventsFound_stringWithIdName()
    {
        $event1 = new Event(1, '2017-05-01 14:30:00', 1, 'testEvent1', 'Beschrijving.');
        $event2 = new Event(2, '2017-05-01 14:30:00', 1, 'testEvent2', 'Beschrijving.');
        $events = [$event1, $event2];
        $this->mockEventRepository->expects($this->atLeastOnce())->method('findEvents')->will($this->returnValue([$event1, $event2]));
        $this->mockView->expects($this->atLeastOnce())->method('show')
            ->will($this->returnCallback(function ($object) {
                $events = $object['Events'];
                echo json_encode($events);
            }));
        $eventController = new EventController($this->mockEventRepository, $this->mockView);
        $eventController->handleFindEvents();
        $this->expectOutputString(json_encode($events));
    }

    public function test_handleFindEvents_NoEventFound_returnStringEmpty()
    {
        $this->mockEventRepository->expects($this->atLeastOnce())->method('findEvents')->will($this->returnValue([]));

        $this->mockView->expects($this->atLeastOnce())->method('show')
            ->will($this->returnCallback(function ($object) {
                echo '[]';
            }));
        $eventController = new EventController($this->mockEventRepository, $this->mockView);
        $eventController->handleFindEvents();
        $this->expectOutputString('[]');
    }

    public function testHandleFindEventsByPerson_EventsFound_stringWithIdName()
    {
        $event1 = new Event(1, '2017-05-01 14:30:00', 1, 'testEvent1', 'Beschrijving.');
        $event2 = new Event(2, '2017-05-01 14:30:00', 1, 'testEvent2', 'Beschrijving.');
        $events = [$event1, $event2];
        $this->mockEventRepository->expects($this->atLeastOnce())->method('findEventsByPerson')->will($this->returnValue([$event1, $event2]));
        $this->mockView->expects($this->atLeastOnce())->method('show')
            ->will($this->returnCallback(function ($object) {
                $events = $object['Events'];
                echo json_encode($events);
            }));
        $eventController = new EventController($this->mockEventRepository, $this->mockView);
        $eventController->handleFindEventsByPerson($event->getPerson());
        $this->expectOutputString(json_encode($events));
    }

    public function test_handleFindEventsByPerson_NoEventFound_returnStringEmpty()
    {
        $this->mockEventRepository->expects($this->atLeastOnce())->method('findEventsByPerson')->will($this->returnValue([]));

        $this->mockView->expects($this->atLeastOnce())->method('show')
            ->will($this->returnCallback(function ($object) {
                echo '[]';
            }));
        $eventController = new EventController($this->mockEventRepository, $this->mockView);
        $eventController->handleFindEventsByPerson($event->getPerson());
        $this->expectOutputString('[]');
    }

    public function testHandleFindEventsByDate_EventsFound_stringWithIdName()
    {
        $event1 = new Event(1, '2017-05-01 14:30:00', 1, 'testEvent1', 'Beschrijving.');
        $event2 = new Event(2, '2017-05-01 14:30:00', 1, 'testEvent2', 'Beschrijving.');
        $events = [$event1, $event2];
        $this->mockEventRepository->expects($this->atLeastOnce())->method('findEventsByDate')->will($this->returnValue([$event1, $event2]));
        $this->mockView->expects($this->atLeastOnce())->method('show')
            ->will($this->returnCallback(function ($object) {
                $events = $object['Events'];
                echo json_encode($events);
            }));
        $eventController = new EventController($this->mockEventRepository, $this->mockView);
        $eventController->handleFindEventsByDate($event->getDate(), $event->getDate());
        $this->expectOutputString(json_encode($events));
    }

    public function test_handleFindEventsByDate_NoEventFound_returnStringEmpty()
    {
        $this->mockEventRepository->expects($this->atLeastOnce())->method('findEventsByDate')->will($this->returnValue([]));

        $this->mockView->expects($this->atLeastOnce())->method('show')
            ->will($this->returnCallback(function ($object) {
                echo '[]';
            }));
        $eventController = new EventController($this->mockEventRepository, $this->mockView);
        $eventController->handleFindEventsByDate($event->getDate(), $event->getDate());
        $this->expectOutputString('[]');
    }

    public function testHandleFindEventsByPersonDate_EventsFound_stringWithIdName()
    {
        $event1 = new Event(1, '2017-05-01 14:30:00', 1, 'testEvent1', 'Beschrijving.');
        $event2 = new Event(2, '2017-05-01 14:30:00', 1, 'testEvent2', 'Beschrijving.');
        $events = [$event1, $event2];
        $this->mockEventRepository->expects($this->atLeastOnce())->method('findEventsByPersonDate')->will($this->returnValue([$event1, $event2]));
        $this->mockView->expects($this->atLeastOnce())->method('show')
            ->will($this->returnCallback(function ($object) {
                $events = $object['Events'];
                echo json_encode($events);
            }));
        $eventController = new EventController($this->mockEventRepository, $this->mockView);
        $eventController->handleFindEventsByPersonDate($event->getDate(), $event->getDate());
        $this->expectOutputString(json_encode($events));
    }

    public function test_handleFindEventsByPersonDate_NoEventFound_returnStringEmpty()
    {
        $this->mockEventRepository->expects($this->atLeastOnce())->method('findEventsByPersonDate')->will($this->returnValue([]));

        $this->mockView->expects($this->atLeastOnce())->method('show')
            ->will($this->returnCallback(function ($object) {
                echo '[]';
            }));
        $eventController = new EventController($this->mockEventRepository, $this->mockView);
        $eventController->handleFindEventsByPersonDate($event->getPerson(), $event->getDate(), $event->getDate());
        $this->expectOutputString('[]');
    }
}