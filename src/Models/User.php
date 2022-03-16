<?php
class User {
    public array $fillable = [
        'fname',
        'prefix',
        'lname',
        'email'
    ];

    private array $guarded = [
        'password'
    ];

    private string $table = 'user';
    public string $pk = 'user_id';

    public function create($db) {
        $fields = implode(', ', array_merge($this->fillable, $this->guarded));
        $placeholders = ':'.implode(', :', array_merge($this->fillable, $this->guarded));
        $sql = "insert into $this->table ($fields) values ($placeholders)";
        $stmt = $db->prepare($sql);
        foreach(array_merge($this->fillable, $this->guarded) as $key) {
            if($key == 'password') {
                $password = password_hash($_POST[$key], PASSWORD_DEFAULT);
                $stmt->bindParam(':'.$key, $password);
            } else {
                $stmt->bindParam(':'.$key, $_POST[$key]);
            }
        }
        $stmt->execute();
    }

    public function fetch($db, $id) {
        $fields = implode(', ',$this->fillable);
        $placeholders = ':'.implode(', :', $this->fillable);
        $sql = "select $fields from $this->table where $this->pk = :$this->pk";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':'.$this->pk, $_POST[$this->pk]);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchByEmail($db) {
        $fields = implode(', ', array_merge($this->fillable, $this->guarded, array($this->pk)));
        $sql = "select $fields from $this->table where email = :email";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
