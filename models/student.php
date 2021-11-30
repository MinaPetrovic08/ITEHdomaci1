<?php
class Student{
    public $id;   
    public $name;   
    public $dob;   
    public $email;   
    public $address;
    public $city;
    
    public function __construct($id=null, $name=null, $dob=null, $email=null, $address=null, $city=null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->dob = $dob;
        $this->email = $email;
        $this->address = $address;
        $this->city = $city;
    }

    #funkcija prikazi sve getAll

    public static function getAll(mysqli $conn)
    {
        $query = 'select * from students';
        return $conn->query($query);
    }

    #funkcija getById

    public static function getById($id, mysqli $conn){
        $query = "SELECT FROM students WHERE id=$id";
        
        $myObj = array();
        if($msqlObj = $conn->query($query)){
            while($red = $msqlObj->fetch_array(1)){
                $myObj[]= $red;
            }
        }
        return $myObj;
    }

    #deleteById

    public function deleteById(mysqli $conn)
    {
        $query = "DELETE FROM students WHERE id=$this->id";
        return $conn->query($query);
    }

    #update
    public function update($id, mysqli $conn)
    {
        $query = "UPDATE students set name = $this->name, dob = $this->dob,email = $this->email,address = $this->address, city=$this->city WHERE id=$id";
        return $conn->query($query);
    }

    #insert add
    public static function add(Student $student, mysqli $conn)
    {
        $query = "INSERT INTO students(name, dob, email, address, city) VALUES('$student->name','$student->dos','$student->email','$student->address','$student->city')";
        return $conn->query($query);
    }
}

?>