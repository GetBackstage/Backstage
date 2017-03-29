<?php

namespace view;

class TypeJsonView implements View {
    public function show( array $data ) {
        header( 'Content-Type: application/json' );

        if ( isset( $data['type'] ) ) {
            $type = $data['type'];
            echo json_encode( ['id' => $event->getId(), 'title' => $event->getTitle(), 'description' => $event->getDescription() ] );
        } else {
            echo '{}';
        }
    }
}
