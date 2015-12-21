<?php

/**
 * Verzorgt MySQL-verbindingen.
 *
 * @author omniscimus
 */
class MySQL_Manager {

    private $connection;

    /**
     * Sluit de MySQL verbinding (als die bestaat).
     */
    function closeConnection() {
        if (isset($this->connection)) {
            $this->connection->close();
        }
    }

    /**
     * Verbindt met de MySQL server.
     * 
     * @throws Exception als het verbinden is mislukt
     */
    function connect() {
        $config = include 'config.php';
        $connection = new \mysqli(
                $config["mysql-host"], $config["mysql-user"], $config["mysql-password"], $config["mysql-database"], $config["mysql-port"]);
        $connection->query("CREATE TABLE IF NOT EXISTS inschrijvingen (id SMALLINT UNSIGNED UNIQUE AUTO_INCREMENT NOT NULL, voornaam VARCHAR(32), achternaam VARCHAR(32));");
        if ($connection->connect_error) {
            throw new \Exception("Verbinden met de database is mislukt.");
        } else {
            $this->connection = $connection;
        }
    }

    /**
     * Zet een nieuwe registratie in de database.
     * 
     * @param string $voornaam de voornaam van de persoon die komt
     * @param string $achternaam de achternaam van de persoon die komt
     */
    function insertNewSubscription($voornaam, $achternaam) {
        $statement = $this->connection->prepare("INSERT INTO inschrijvingen (voornaam, achternaam) VALUES (?, ?);");
        $statement->bind_param("ss", $voornaam, $achternaam);
        $statement->execute();
    }

}
