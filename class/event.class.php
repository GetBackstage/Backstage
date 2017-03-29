<?php
class Event {
    private $id;
	private $datetime;
	private $customer;
	private $type;

    function __construct( $id ) {
        global $sql;
        
        $result = $sql->query( 'SELECT * FROM events WHERE id = '.$id );
        $event = $result->fetch_assoc();
        
        $this->setId( $event['id'] );
        $this->setDatetime( $event['datetime'] );
        $this->setPerson( $event['person'] );
        $this->setType( $event['type'] );
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

    public function getDatetime( $format = false ) {
		if ( $format )
			return date( "j F Y", strtotime( $this->datetime ) );
		else
			return $this->datetime;
    }

    public function getPerson( $object = false ) {
		if ( $object )
			return new Person( $this->person );
		else
			return $this->person;
    }

    public function getType( $object = false ) {
		if ( $object )
			return new Type( $this->type );
		else
			return $this->type;
    }
}
?>