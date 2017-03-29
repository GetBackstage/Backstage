<?php

require_once 'src/autoload.php';

use \model\PDOPersonRepository;
use \model\PDOEventRepository;
use \view\PersonJsonView;
use \view\EventJsonView;
use \controller\PersonController;
use \controller\EventController;

$user = 'root';
$password = '';
$database = 'backstage';
$pdo = null;

try {
    $pdo = new PDO( "mysql:host=localhost;dbname=$database", $user, $password );
    $pdo->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    $id = isset( $_GET['id'] ) ? $_GET['id'] : null;

    $personPDORepository = new PDOPersonRepository( $pdo );
    $personJsonView = new PersonJsonView();
    $personController = new PersonController( $personPDORepository, $personJsonView );
    $personController->handleFindPersonById( $id );

    $eventPDORepository = new PDOEventRepository( $pdo );
    $eventJsonView = new EventJsonView();
    $eventController = new EventController( $eventPDORepository, $eventJsonView );
    $eventController->handleFindEventById( $id );

} catch ( Exception $e ) {
    echo 'Cannot connect to database';
}