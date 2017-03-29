<?php

namespace view;

class PersonJsonView implements View {
    public function show( array $data ) {
        header( 'Content-Type: application/json' );

        if ( isset( $data['person'] ) ) {
            $person = $data['person'];
            echo json_encode( ['id' => $person->getId(), 'first_name' => $person->getFirstName(), 'last_name' => $person->getLastName(), 'organization' => $person->getOrganization() ] );
        } else {
            echo '{}';
        }
    }
}
