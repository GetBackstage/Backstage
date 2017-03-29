<?php

use \model\Person;
use \controller\PersonController;

class PersonControllerTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->mockPersonRepository = $this->getMockBuilder('model\PersonRepository')
            ->getMock();
        $this->mockView = $this->getMockBuilder('view\View')
            ->getMock();
    }

    public function tearDown()
    {
        $this->mockPersonRepository = null;
        $this->mockView = null;
    }

    public function testHandleFindPersonById_personFound_stringWithIdName()
    {
        $person = new Person(1, 'testperson');
        $this->mockPersonRepository->expects($this->atLeastOnce())
            ->method('findPersonById')
            ->will($this->returnValue($person));

        $this->mockView->expects($this->atLeastOnce())
            ->method('show')
            ->will($this->returnCallback(function ($object) {
                $person = $object['person'];
                printf("%d %s", $person->getId(), $person->getName());
            }));

        $personController = new PersonController($this->mockPersonRepository, $this->mockView);
        $personController->handleFindPersonById($person->getId());
        $this->expectOutputString(sprintf("%d %s", $person->getId(), $person->getName()));
    }

    public function test_handleFindPersonById_personFound_returnStringEmpty()
    {
        $this->mockPersonRepository->expects($this->atLeastOnce())
            ->method('findPersonById')
            ->will($this->returnValue(null));

        $this->mockView->expects($this->atLeastOnce())
            ->method('show')
            ->will($this->returnCallback(function ($object) {
                echo '';
            }));

        $personController = new PersonController($this->mockPersonRepository, $this->mockView);
        $personController->handleFindPersonById(1);
        $this->expectOutputString('');
    }
}
