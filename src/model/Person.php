<?php

namespace model;

class Person
{
    private $id;
    private $first_name;
	private $last_name;
	private $organization;

    public function __construct( $id, $first_name, $last_name, $organization ) {
        $this->setId( $id );
        $this->setFirstName( $first_name );
        $this->setLastName( $last_name );
        $this->setOrganization( $organization );
    }

    // Setters
    public function setId( $id ) {
        $this->id = $id;
    }

    public function setFirstName( $first_name ) {
        $this->first_name = $first_name;
    }

    public function setLastName( $last_name ) {
        $this->last_name = $last_name;
    }

    public function setOrganization( $organization ) {
        $this->organization = $organization;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getFirstName() {
        return $this->first_name;
    }

    public function getLastName() {
        return $this->last_name;
    }

    public function getOrganization() {
        return $this->organization;
    }
}
