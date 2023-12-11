<?php
class UserManager
{
    private PDO $db;
    private string $table = 'user';

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create(User $user){
        $req = $this->db->prepare("INSERT INTO $this->table(email, password, firstName, lastName, address, postalCode, city, admin) 
        VALUES (:email, :password, :firstName, :lastName, :address, :postalCode, :city, :admin)");

        $req->bindValue(':email', $user->getEmail());
        $req->bindValue(':password', password_hash($user->getPassword(), PASSWORD_DEFAULT));
        $req->bindValue(':firstName', $user->getFirstName());
        $req->bindValue(':lastName', $user->getLastName());
        $req->bindValue(':address', $user->getAddress());
        $req->bindValue(':postalCode', $user->getPostalCode());
        $req->bindValue(':city', $user->getCity());
        $req->bindValue(':admin', 0);  
        $req->execute();
    }

    public function login($email, $password) {
        $req = $this->db->prepare("SELECT * FROM $this->table WHERE email = :email");
        $req->bindValue(':email', $email);
        $req->execute();
        $user = $req->fetch(PDO::FETCH_ASSOC);
        if ($user !== false && isset($user['password']) && password_verify($password, $user['password'])) {
            return $user;
        } else {
            return false;
        }
    }

    function update($user){
        $req = $this->db->prepare("UPDATE $this->table SET email = :email, password = :password, firstName = :firstName, lastName = :lastName,
        adress = :address, postalCode = :postalCode, city = :city WHERE id = :id");
        $req->bindValue(':email', $user->getEmail());
        $req->bindValue(':password', hash("sha256", $user->getPassword()));
        $req->bindValue(':firstName', $user->getFirstName());
        $req->bindValue(':lastName', $user->getLastName());
        $req->bindValue(':adress', $user->getAddress());
        $req->bindValue(':postalCode', $user->getPostalCode());
        $req->bindValue(':city', $user->getCity());
        $req->bindValue(':id', $user->getId());
        $req->execute();
    }

    function delete($user){
        $req = $this->db->prepare("DELETE FROM $this->table WHERE id = :id");
        $req->bindValue(':id', $user->getId());
        $req->execute();
    }

    function findOne($id){
        $req = $this->db->prepare("SELECT * FROM $this->table WHERE id = :id");
        $req->bindValue(':id', $id);
        $req->execute();
        $user = $req->fetch(PDO::FETCH_ASSOC);
        return new User($user);
    }

    public function findAll(): array
    {
        $req = $this->db->prepare("SELECT * FROM $this->table");
        $req->execute();
        $users = $req->fetchAll(PDO::FETCH_ASSOC);
        $usersArray = [];
        foreach ($users as $user) {
            $usersArray[] = new User($user);
        }
        return $usersArray;
    }

    public function findByEmail($email){
        $req = $this->db->prepare("SELECT * FROM $this->table WHERE email = :email");
        $req->bindValue(':email', $email);
        $req->execute();
        $user = $req->fetch(PDO::FETCH_ASSOC);
        if ($user == false) {
            return false;
        } else {
            return new User($user);
        }
    }
    
    public function verify_ID_PASSWORD() {
        $req = $this->db->prepare("SELECT * FROM $this->table WHERE email = :email");
        $req->bindValue(':email', $_POST['email']);
        $req->execute();
        $user = $req->fetch(PDO::FETCH_ASSOC);
        if (password_verify($_POST['password'], $user['password'])) {
            return $user;
        } else {
            return false;
        }
    }
}