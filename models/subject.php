<?php
class Subject{
    public $id;   
    public $name;   
    public $teacher;   
    public $department;   
    public $points;
    
    public function __construct($id=null, $name=null, $teacher=null, $department=null, $points=null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->teacher = $teacher;
        $this->department = $department;
        $this->points = $points;
    }

    #funkcija prikazi sve getAll

    public static function getAll(mysqli $conn)
    {
        $query = 'select * from subjects';
        return $conn->query($query);
    }

    #funkcija getById

    public static function getById($id, mysqli $conn){
        $query = "SELECT FROM subjects WHERE id=$id";
        
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
        $query = "DELETE FROM subjects WHERE id=$this->id";
        return $conn->query($query);
    }

    #update
    public function update($id, mysqli $conn)
    {
        $query = "UPDATE subjects set name = $this->name, teacher = $this->teacher,department = $this->department,points = $this->points WHERE id=$id";
        return $conn->query($query);
    }

    #insert add
    public static function add(Subject $subject, mysqli $conn)
    {
        $query = "INSERT INTO subjects(name, teacher, department, points) VALUES('$subject->name','$subject->teacher','$subject->department','$subject->points')";
        return $conn->query($query);
    }
}

?>