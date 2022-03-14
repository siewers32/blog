<?php
    include("Message.php");
    include("Container.php");
    include("Db.php");
    $db = new Db("mysql:host=localhost;port=3307;dbname=testdb", "root", "root");
    $c = new Container();
    $c->add("db", $db->getConnection());

    $bericht = new Bericht("Jan", "de titel", "Dit is het bericht");
    $bericht->berichtOpslaan($c->getObject('db'));