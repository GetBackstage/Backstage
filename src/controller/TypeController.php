<?php

namespace controller;

use model\TypeRepository;
use view\View;

class TypeController {
    private $typeRepository;
    private $view;

    public function __construct( TypeRepository $typeRepository, View $view ) {
        $this->typeRepository = $typeRepository;
        $this->view = $view;
    }

    public function handleFindTypeById( $id = null ) {
        $type = $this->typeRepository->findTypeById( $id );
        $this->view->show( ['type' => $type] );
    }
}