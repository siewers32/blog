<?php

class Message {
    public array $fillable = [
        'author',
        'messagetext',
        'title',
    ];

    private array $guarded = [];

    private string $table = 'message';
    private string $pk = 'message_id';
    private string $fk = 'author';

    public int $author;
    public string $messagetext;
    public string $title;

    public function __construct() {

    }

    public function save(object $con) {
        $fields = implode(", ", $this->fillable);
        $placeholders = ":".implode(", :", $this->fillable);
        $sql = "insert into $this->table ($fields) values ($placeholders)";
        $stmt = $con->prepare($sql);
        foreach($this->fillable as $field) {
            $value = $_POST[$field];
            echo $value." - ".$field;
            $stmt->bindParam(":".$field, $value);
        }
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
        $sql = "select message_id, author, fname, prefix, lname, title, messagetext from message join user on message.author = user.user_id";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function toString() {
        echo "Auteur: $this->author, Title: $this->title, Message: $this->messagetext";
    }
}
