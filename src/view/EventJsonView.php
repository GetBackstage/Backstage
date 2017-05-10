<?php

namespace view;

class EventJsonView implements View
{
    public function show(array $data)
    {
        header('Content-Type: application/json');

        if (isset($data['events'])) {
            $events = $data['events'];
            echo json_encode($events);
        } else {
            echo '{}';
        }
    }
}
