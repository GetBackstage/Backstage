<?php
class Type {
    private $id;
	private $title;
	private $description;

    function __construct( $id, $title, $description ) {
        $this->setId( $id );
        $this->setTitle( $title );
        $this->setDescription( $description );
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