<?php

namespace model;

class Event implements \JsonSerializable
{
    private $id;
	private $datetime;
	private $person;
	private $type;

    function __construct( $id, $datetime, $person, $type ) {
        $this->setId( $id);
        $this->setDatetime( $datetime);
        $this->setPerson( $person);
        $this->setType( $type);
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

    public function setType( $type ) {
        $this->type = $type;
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

    public function getType() {
		return $this->type;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'datetime' => $this->datetime,
            'person' => $this->person,
            'type' => $this->type
        ];
    }

}
