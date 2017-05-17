<?php

namespace controller;

use model\EventRepository;
use view\View;

class EventController
{
    private $eventRepository;
    private $view;

    public function __construct(EventRepository $eventRepository, View $view)
    {
        $this->eventRepository = $eventRepository;
        $this->view = $view;
    }

    public function handleFindEventsByPersonDate($id = null, $from = null, $until = null)
    {
        $event = $this->eventRepository->findEventsByPersonDate($id, $from, $until);
        $this->view->show(['events' => [$event]]);
    }

    public function handleFindEventsByDate($from = null, $until = null)
    {
        $event = $this->eventRepository->findEventsByDate($from, $until);
        $this->view->show(['events' => [$event]]);
    }

    public function handleFindEventsByPerson($id = null)
    {
        $event = $this->eventRepository->findEventsByPerson($id);
        $this->view->show(['events' => [$event]]);
    }

    public function handleFindEventById($id = null)
    {
        $event = $this->eventRepository->findEventById($id);
        $this->view->show(['events' => [$event]]);
    }

    public function handleFindEvents()
    {
        $events = $this->eventRepository->findEvents();
        $this->view->show(['events' => $events]);
    }

    public function handlePutEvent($id = null, $datetime = null, $person = null, $title = null, $description = null)
    {
        $event = $this->eventRepository->putEventById($id, $datetime, $person, $title, $description);
        $this->view->show(['events' => [$event]]);
    }
}