<?php
class Type {
    private $id;
	private $title;
	private $description;

    function __construct( $id ) {
        global $sql;
        
        $result = $sql->query( 'SELECT * FROM types WHERE id = '.$id );
        $type = $result->fetch_assoc();
        
        $this->setId( $type['id'] );
        $this->setTitle( $type['datetime'] );
        $this->setDescription( $type['customer'] );
    }

    // Setters
    public function setId( $id ) {
        $this->id = $id;
    }

    public function setTitle( $title ) {
        $this->title = $title;
    }

    public function setdescription( $description ) {
        $this->description = $description;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }
}
?>