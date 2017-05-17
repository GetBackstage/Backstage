<?php

require_once 'src/autoload.php';
use \model\PDOEventRepository;
use \view\EventJsonView;
use \controller\EventController;

$user = 'root';
$password = '';
$database = 'backstage';
$pdo = null;

$url = parse_url(trim($_SERVER['REQUEST_URI']));
$pathSegments = array_values(array_filter(explode('/', $url['path'])));
$method = $_SERVER['REQUEST_METHOD'];
$requestBody = file_get_contents('php://input');

try {
    $pdo = new PDO("mysql:host=localhost;dbname=$database", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $eventPDORepository = new PDOEventRepository($pdo);
    $eventJsonView = new EventJsonView();
    $eventController = new EventController($eventPDORepository, $eventJsonView);

    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $person = isset($_GET['person']) ? $_GET['person'] : false;
    $from = isset($_GET['from']) ? $_GET['from'] : null;
    $until = isset($_GET['until']) ? $_GET['until'] : false;

    if ($method == 'GET') {
        if ($person == false) {
            if ($id == null) {
                if ($from == null) {
                    $eventController->handleFindEvents();
                } else {
                    $eventController->handleFindEventsByDate($from, $until);
                }
            } else {
                $eventController->handleFindEventById($id);
            }
        } else {
            if ($from == null) {
                $eventController->handleFindEventsByPerson($id);
            } else {
                $eventController->handleFindEventsByPersonDate($id, $from, $until);
            }
        }
    } elseif ($method == 'POST') {
        $event = json_decode($requestBody);

        $datetime = $event->datetime;
        $person = $event->person;
        $title = $event->title;
        $description = $event->description;

        $eventController->handlePostEvent($id, $datetime, $person, $title, $description);

        http_response_code(201);
        header('Content-Type: application/json');
        echo json_encode($person);
    } elseif ($method == 'PUT') {
        $event = json_decode($requestBody);

        $datetime = $event->datetime;
        $person = $event->person;
        $title = $event->title;
        $description = $event->description;

        $eventController->handlePutEvent($id, $datetime, $person, $title, $description);

        http_response_code(201);
        header('Content-Type: application/json');
        echo json_encode($person);
    } elseif ($method == 'DELETE') {
        $eventController->handleDeleteEvent($id);

        http_response_code(201);
    }

} catch (Exception $e) {
    echo 'cannot connect to database';
}
