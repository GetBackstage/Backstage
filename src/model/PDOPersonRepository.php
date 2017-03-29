<?php

namespace model;

class PDOPersonRepository implements PersonRepository
{
    private $connection = null;

    public function __construct( \PDO $connection )
    {
        $this->connection = $connection;
    }

    public function findPersonById( $id )
    {
        try {
            $statement = $this->connection->prepare( 'SELECT * FROM persons WHERE id=?' );
            $statement->bindParam( 1, $id, \PDO::PARAM_INT );
            $statement->execute();
            $results = $statement->fetchAll( \PDO::FETCH_ASSOC );

            if ( count( $results ) > 0 ) {
                return new Person( $results[0]['id'], $results[0]['first_name'], $results[0]['last_name'], $results[0]['organization'] );
            } else {
                return null;
            }
        } catch ( \Exception $exception ) {
            return null;
        }
    }
}
