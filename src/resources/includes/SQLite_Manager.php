<?php

/**
 * Verzorgt SQLite-verbindingen.
 *
 * @author omniscimus
 */
class MySQL_Manager {

    private $database;

    /**
     * Sluit de SQLite verbinding (als die bestaat).
     */
    function closeConnection() {
        if (isset($this->database)) {
            $this->database->close();
        }
    }

    /**
     * Opent de SQLite database.
     */
    function connect() {
        $this->database = new SQLite3('config/inschrijvingen.db');
        $this->database->exec("CREATE TABLE IF NOT EXISTS inschrijvingen (id SMALLINT UNSIGNED UNIQUE
AUTO_INCREMENT NOT NULL, voornaam VARCHAR(32), achternaam VARCHAR(32), email
VARCHAR(48), examenjaar SMALLINT UNSIGNED, beroep VARCHAR(32), vrijdag
TINYINT(1), zaterdag TINYINT(1), les TINYINT(1));");
    }

    /**
     * Zet een nieuwe registratie in de database.
     *
     * @param string $voornaam de voornaam van de persoon die komt
     * @param string $achternaam de achternaam van de persoon die komt
     * @param int $examenjaar het jaar waarin de persoon examen heeft gedaan
     * @param string $beroep het beroep van de persoon die komt
     * @param bool $vrijdag of de persoon vrijdag komt
     * @param bool $zaterdag of de persoon zaterdag komt
     */
    function insertNewSubscription($voornaam, $achternaam, $email, $examenjaar,
                                   $beroep, $vrijdag, $zaterdag, $les) {
        $statement = $this->database->prepare("INSERT INTO inschrijvingen (voornaam, achternaam, email, examenjaar, beroep,
          vrijdag, zaterdag, les) VALUES (:voornaam, :achternaam, :email, :examenjaar, :beroep, :vrijdag, :zaterdag, :les);");
        $statement->bindValue(":voornaam", $voornaam);
        $statement->bindValue(":achternaam", $achternaam);
        $statement->bindValue(":email", $email);
        $statement->bindValue(":examenjaar", $examenjaar);
        $statement->bindValue(":beroep", $beroep);
        $statement->bindValue(":vrijdag", $vrijdag);
        $statement->bindValue(":zaterdag", $zaterdag);
        $statement->bindValue(":les", $les);
        $statement->execute();
    }

    /**
     * Geeft de resultaten van alle inschrijvingen.
     *
     * @return SQLite3Result de gegevens van de ingeschreven personen
     */
    function getResults() {
        return $this->database->query("SELECT voornaam, achternaam,
        email, examenjaar, beroep, vrijdag, zaterdag, les FROM inschrijvingen;");
    }

}
