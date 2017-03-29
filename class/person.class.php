<?php
class Person {
    private $id;
	private $first_name;
	private $last_name;
	private $organization;

    function __construct( $id ) {
        global $sql;
        
        $result = $sql->query( 'SELECT * FROM persons WHERE id = '.$id );
        $type = $result->fetch_assoc();
        
        $this->setId( $type['id'] );
        $this->setFirstName( $type['datetime'] );
        $this->setLastName( $type['customer'] );
        $this->setOrganization( $type['oragization'] );
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
?>