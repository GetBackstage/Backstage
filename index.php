<?php

include 'common.php';

include 'class/type.class.php';
include 'class/person.class.php';
include 'class/event.class.php';

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
<?php
$event = new Event( 1 );

echo $event->getType( true )->getTitle();
?>
    </body>
</html>