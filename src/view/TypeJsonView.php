<?php

namespace view;

class TypeJsonView implements View {
    public function show( array $data ) {
        header( 'Content-Type: application/json' );

        if ( isset( $data['type'] ) ) {
            $type = $data['type'];
            echo json_encode( ['id' => $type->getId(), 'title' => $type->getTitle(), 'description' => $type->getDescription() ] );
        } else {
            echo '{}';
        }
    }
}
