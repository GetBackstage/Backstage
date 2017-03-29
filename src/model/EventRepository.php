<?php

namespace model;

interface EventRepository
{
    public function findEventById( $id );
    /*
    public function findEvents();
    public function add(Event $event);
    public function remove($id);
    */
}
