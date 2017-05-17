<?php

namespace model;

class Event implements \JsonSerializable
{
    private $id;
	private $datetime;
	private $person;
	private $description;
	private $title;

    function __construct( $id, $datetime, $person, $title, $tidescriptiontle ) {
        $this->setId( $id );
        $this->setDatetime( $datetime );
        $this->setPerson( $person );
        $this->setTtile( $title );
        $this->setDescription( $description );
    }

    // Setters
    public function setId( $id ) {
        $this->id = $id;
    }

    public function setDatetime( $datetime ) {
        $this->datetime = $datetime;
    }

    public function setPerson( $person ) {
        $this->person = $person;
    }

    public function setTitle( $title ) {
        $this->title = $title;
    }

    public function setDescription( $description ) {
        $this->description = $description;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getDatetime() {
		return $this->datetime;
    }

    public function getPerson() {
		return $this->person;
    }

    public function getTitle() {
         return $this->title;
    }

    public function getDescription() {
         return $this->description;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'datetime' => $this->datetime,
            'person' => $this->person,
            'title' => $this->title,
            'description' => $this->description
        ];
    }

}
