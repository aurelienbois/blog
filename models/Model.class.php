<?php
abstract class Model
{
    private static $pdo;

    private static function setBdd()
    {
        $host = $_ENV['DB_HOST'];
        $dbname = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $pass = $_ENV['DB_PASS'];        

        self::$pdo = new PDO(
            "mysql:host=$host;dbname=$dbname;charset=utf8",
            $user,
            $pass
        );

        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    protected function getBdd()
    {
        if (self::$pdo === null) { // si vrai, la connexion n'a pas été faite
            self::setBdd(); // ne pas utiliser $this->setBdd() car setBdd est static
        }
        return self::$pdo; // dans tous les cas, on retourne la connexion
    }

}
