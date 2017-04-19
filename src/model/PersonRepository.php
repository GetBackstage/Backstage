<?php

/*
 * Based on PXL example
 */

namespace model;

interface PersonRepository
{
    public function findPersonById( $id );
    /*
    public function findPersons();
    public function add( Person $person );
    public function remove( $id );
    */
}
