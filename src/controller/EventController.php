<?php

namespace controller;

use model\EventRepository;
use view\View;

class EventController {
    private $eventRepository;
    private $view;

    public function __construct( EventRepository $eventRepository, View $view ) {
        $this->eventRepository = $eventRepository;
        $this->view = $view;
    }

    public function handleFindEventById( $id = null ) {
        $event = $this->eventRepository->findEventById( $id );
        $this->view->show( ['event' => $event] );
    }
}
