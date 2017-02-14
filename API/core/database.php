<?php

class database
{
    protected $database;

    public function __construct(){
        try
        {
            $database = new PDO('mysql:dbname=angularmusic;
                host=localhost;charset=utf8', 'root', 'root');
            $this->database = $database;
        }
        catch (Exception $e)
        {
            die('La connexion à la base de donnée a échoué: ' . $e->getMessage());
        }
    }
}