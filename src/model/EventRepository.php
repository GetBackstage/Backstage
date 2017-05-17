<?php

namespace model;

interface EventRepository
{
    public function findEventsByDate($from, $until);
    public function findEventsByPersonDate($id, $from, $until);
    public function findEventById($id);
    public function findEventsByPerson($id);
    public function findEvents();
    public function postEvent($id, $datetime, $person, $title, $description);
    public function deleteEvent($id);
    public function putEvent($id, $datetime, $person, $title, $description);

    /*
    public function add(Event $event);
    public function remove($id);
    */
}
