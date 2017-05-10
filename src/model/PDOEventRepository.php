<?php

namespace model;

class PDOEventRepository implements EventRepository
{
    private $connection = null;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findEventsByPersonDate($id, $from, $until)
    {
        try {
            $statement = $this->connection->prepare('SELECT * FROM events WHERE person =? AND datetime >=? AND datetime <=?');
            $statement->bindParam(1, $id, \PDO::PARAM_INT);
            $statement->bindParam(2, $from, \PDO::PARAM_INT);
            $statement->bindParam(3, $until, \PDO::PARAM_INT);
            $statement->execute();
            $events = [];
            $statement->setFetchMode(\PDO::FETCH_ASSOC);
            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($results as $event) {
                $events[] = new Event($event['id'], $event['datetime'], $event['person'], $event['type']);
            }
            return $events;
        } catch (\Exception $exception) {
            return null;
        }
    }

    public function findEventsByDate($from, $until)
    {
        try {
            $statement = $this->connection->prepare('SELECT * FROM events WHERE datetime >=? AND datetime <=?');
            $statement->bindParam(1, $from, \PDO::PARAM_INT);
            $statement->bindParam(2, $until, \PDO::PARAM_INT);
            $statement->execute();
            $events = [];
            $statement->setFetchMode(\PDO::FETCH_ASSOC);
            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($results as $event) {
                $events[] = new Event($event['id'], $event['datetime'], $event['person'], $event['type']);
            }
            return $events;
        } catch (\Exception $exception) {
            return null;
        }
    }

    public function findEventsByPerson($id)
    {
        try {
            $statement = $this->connection->prepare('SELECT * FROM events WHERE person=?');
            $statement->bindParam(1, $id, \PDO::PARAM_INT);
            $statement->execute();
            $events = [];
            $statement->setFetchMode(\PDO::FETCH_ASSOC);
            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($results as $event) {
                $events[] = new Event($event['id'], $event['datetime'], $event['person'], $event['type']);
            }
            return $events;
        } catch (\Exception $exception) {
            return null;
        }
    }

    public function findEventById($id)
    {
        try {
            $statement = $this->connection->prepare('SELECT * FROM events WHERE id=?');
            $statement->bindParam(1, $id, \PDO::PARAM_INT);
            $statement->execute();
            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);

            if (count($results) > 0) {
                return new Event($results[0]['id'], $results[0]['datetime'], $results[0]['person'], $results[0]['type']);
            } else {
                return null;
            }
        } catch (\Exception $exception) {
            return null;
        }
    }

    public function findEvents()
    {
        try {
            $statement = $this->connection->prepare('SELECT * FROM events');
            $statement->execute();
            $events = [];
            $statement->setFetchMode(\PDO::FETCH_ASSOC);
            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($results as $event) {
                $events[] = new Event($event['id'], $event['datetime'], $event['person'], $event['type']);
            }
            return $events;
        } catch (\Exception $exception) {
            return null;
        }
    }
}
