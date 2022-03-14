<?php

use \PDO;

class Message {
    public string $author;
    public string $message;
    public string $title;

    function __constructor(string $author, string $title, string $message = "") {
        $this->$author = $author;
        $this->title = $title;
        $this->berichttekst = $message;
    }

    function save(object $con) {
        $sql = "insert into message (author, title, message) values (:author, :title, :message)";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":author", $this->author, PDO::PARAM_STR);
        $stmt->bindParam(":title", $this->title, PDO::PARAM_STR);
        $stmt->bindParam(":message", $this->message, PDO::PARAM_STR);
        return $stmt->execute();
    }

    function update(object $con, $id) {
        $sql = "update message set author=:author, title=:title, message=:message where idmessage=:id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":author", $this->author, PDO::PARAM_STR);
        $stmt->bindParam(":title", $this->title, PDO::PARAM_STR);
        $stmt->bindParam(":message", $this->message, PDO::PARAM_STR);
        $stmt->bindParam(":idmessage", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function show(object $con, $id) {
        $sql = "select idmessage, author, title, message from message where idmessage=$id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":idmessage", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function showAll(object $con) {
        $sql = "select idmessage, author, title, message from message";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
