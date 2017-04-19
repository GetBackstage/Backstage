<?php

/*
 * Based on PXL example
 */

namespace model;

class PDOEventRepository implements EventRepository
{
    private $connection = null;

    public function __construct( \PDO $connection ) {
        $this->connection = $connection;
    }

    public function findEventById( $id ) {
        try {
            $statement = $this->connection->prepare( 'SELECT * FROM events WHERE id=?' );
            $statement->bindParam( 1, $id, \PDO::PARAM_INT );
            $statement->execute();
            $results = $statement->fetchAll( \PDO::FETCH_ASSOC );

            if ( count( $results ) > 0 ) {
                return new Event( $results[0]['id'], $results[0]['datetime'], $results[0]['person'], $results[0]['type'] );
            } else {
                return null;
            }
        } catch ( \Exception $exception ) {
            return null;
        }
    }
}
