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
            //$this->connection->close();
            mysql_close($this->connection);
        }
    }

    /**
     * Verbindt met de MySQL server.
     *
     * @throws Exception als het verbinden is mislukt
     */
    function connect() {
        $config = include 'config/config.php';
//        $connection = new \mysqli(
//                $config["mysql-host"], $config["mysql-user"], $config["mysql-password"], $config["mysql-database"], $config["mysql-port"]);
        $connection = mysql_connect($config["mysql-host"], $config["mysql-user"], $config["mysql-password"]) or die(mysql_error());
        mysql_select_db($config["mysql-database"]) or die(mysql_error());
        mysql_query("CREATE TABLE IF NOT EXISTS inschrijvingen (id SMALLINT UNSIGNED UNIQUE
AUTO_INCREMENT NOT NULL, voornaam VARCHAR(32), achternaam VARCHAR(60), email
VARCHAR(48), examenjaar SMALLINT UNSIGNED, beroep VARCHAR(32), vrijdag
TINYINT(1), zaterdag TINYINT(1), les TINYINT(1));");
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
     * @param int $examenjaar het jaar waarin de persoon examen heeft gedaan
     * @param string $beroep het beroep van de persoon die komt
     * @param bool $vrijdag of de persoon vrijdag komt
     * @param bool $zaterdag of de persoon zaterdag komt
     */
    function insertNewSubscription($voornaam, $achternaam, $email, $examenjaar,
                                   $beroep, $vrijdag, $zaterdag, $les) {
        $voornaam = htmlspecialchars($voornaam, ENT_QUOTES);
        $achternaam = htmlspecialchars($achternaam, ENT_QUOTES);
        $email = htmlspecialchars($email, ENT_QUOTES);
        $examenjaar = htmlspecialchars($examenjaar, ENT_QUOTES);
        $beroep = htmlspecialchars($beroep, ENT_QUOTES);
        $vrijdag = htmlspecialchars($vrijdag, ENT_QUOTES);
        $zaterdag = htmlspecialchars($zaterdag, ENT_QUOTES);
        $les = htmlspecialchars($les, ENT_QUOTES);

        $sql = sprintf("INSERT INTO inschrijvingen (voornaam, achternaam, email, examenjaar, beroep,
          vrijdag, zaterdag, les) VALUES ('%s', '%s', '%s', %u, '%s', %u, %u, %u);",
                $voornaam, $achternaam, $email, $examenjaar, $beroep, $vrijdag, $zaterdag, $les);
        mysql_query($sql);
        //$sql = "INSERT INTO inschrijvingen (voornaam, achternaam, email, examenjaar, beroep,
        //  vrijdag, zaterdag, les) VALUES ($voornaam, $achternaam, $email, $examenjaar, $beroep, $vrijdag, $zaterdag, $les);";
//        $statement = $this->connection->prepare("INSERT INTO inschrijvingen (voornaam, achternaam, email, examenjaar, beroep,
//          vrijdag, zaterdag, les) VALUES (?, ?, ?, ?, ?, ?, ?);");
//        $statement->bind_param("sssisiii", $voornaam, $achternaam,
//          $email, $examenjaar, $beroep, $vrijdag, $zaterdag, $les);
//        $statement->execute();
    }

    /**
     * Geeft de resultaten van alle inschrijvingen.
     *
     * @return mysqli_result de gegevens van de ingeschreven personen
     */
    function getResults() {
        return mysql_query("SELECT * FROM inschrijvingen");
//        return $this->connection->query("SELECT voornaam, achternaam,
//        examenjaar, beroep, vrijdag, zaterdag FROM inschrijvingen;");
    }
    function getSubsByDay()
    {
        return mysql_query("SELECT vrijdag, zaterdag, les FROM inschrijvingen");
    }

    /**
     * Geeft een query met de voornaam, achternaam en het examenjaar van de ingeschreven deelnemers
     *
     * @return
     */
    function getSubs() {
        return mysql_query("SELECT voornaam, achternaam, examenjaar FROM inschrijvingen ORDER BY examenjaar");
    }

}
