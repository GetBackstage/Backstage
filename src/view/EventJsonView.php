<?php

/*
 * Based on PXL example
 */

namespace view;

class EventJsonView implements View {
    public function show( array $data ) {
        header( 'Content-Type: application/json' );

        if ( isset( $data['event'] ) ) {
            $event = $data['event'];
            echo json_encode( ['id' => $event->getId(), 'datetime' => $event->getDatetime(), 'person_id' => $event->getPerson(), 'type_id' => $event->getType() ] );
        } else {
            echo '{}';
        }
    }
}
