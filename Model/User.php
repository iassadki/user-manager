<?php
class User {
    private int $id;
    private string $email;
    private string $password;
    private string $firstName;
    private string $lastName;
    private string $address;
    private string $postalCode;
    private string $city;
    private bool $admin;
    
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId(){
        return $this->id;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getFirstName(){
        return $this->firstName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getLastName(){
        return $this->lastName;
    }

    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    public function getAddress(){
        return $this->address;
    }

    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    public function getPostalCode(){
        return $this->postalCode;
    }

    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    public function getCity(){
        return $this->city;
    }

    public function setAdmin($admin)
    {
        $this->admin = $admin;
        return $this;
    }

    public function getAdmin(){
        return $this->admin;
    }

    function __construct(array $data = []){
        $this->hydrate($data);
    } 

   public function hydrate(array $data){
        foreach($data as $key => $value){
            $method = 'set'.ucfirst($key);
            if(method_exists($this,$method)){
                $this->$method($value);
            }
        }
    }  

}