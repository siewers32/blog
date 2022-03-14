<?php

class Message {
    public int $author;
    public string $messagetext;
    public string $title;

    public function __construct() {

    }

    public function save(object $con) {
        $sql = "insert into message (author, title, messagetext) values (:author, :title, :messagetext)";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":author", $this->author, PDO::PARAM_INT);
        $stmt->bindParam(":title", $this->title, PDO::PARAM_STR);
        $stmt->bindParam(":messagetext", $this->messagetext, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function update(object $con, int $id) {
        $sql = "update message set author=:author, title=:title, messagetext=:messagetext where idmessage=:id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":author", $this->author, PDO::PARAM_STR);
        $stmt->bindParam(":title", $this->title, PDO::PARAM_STR);
        $stmt->bindParam(":messagetext", $this->messagetext, PDO::PARAM_STR);
        $stmt->bindParam(":idmessage", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function fetch(object $con, int $id) {
        $sql = "select message_id, author, title, messagetext from message where message_id=:message_id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":message_id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchAll(object $con) {
        $sql = "select message_id, author, title, messagetext from message";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function toString() {
        echo "Auteur: $this->author, Title: $this->title, Message: $this->messagetext";
    }
}
