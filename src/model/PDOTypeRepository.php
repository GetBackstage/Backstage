<?php

/*
 * Based on PXL example
 */

namespace model;

class PDOTypeRepository implements TypeRepository
{
    private $connection = null;

    public function __construct( \PDO $connection ) {
        $this->connection = $connection;
    }

    public function findTypeById( $id ) {
        try {
            $statement = $this->connection->prepare( 'SELECT * FROM types WHERE id=?' );
            $statement->bindParam( 1, $id, \PDO::PARAM_INT );
            $statement->execute();
            $results = $statement->fetchAll( \PDO::FETCH_ASSOC );

            if ( count( $results ) > 0 ) {
                return new Type( $results[0]['id'], $results[0]['title'], $results[0]['description'] );
            } else {
                return null;
            }
        } catch ( \Exception $exception ) {
            return null;
        }
    }
}
