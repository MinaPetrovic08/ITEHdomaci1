<?php
class Evaluation{
    public $id;   
    public $student;   
    public $subject;   
    public $points;   
    public $note;
    
    public function __construct($id=null, $student=null, $subject=null, $points=null, $note=null)
    {
        $this->id = $id;
        $this->student = $student;
        $this->subject = $subject;
        $this->points = $points;
        $this->note = $note;
    }

    #funkcija prikazi sve getAll

    public static function getAll(mysqli $conn)
    {
        $query = 'select g.id, g.student_id, g.subject_id,g.points, g.note, s.name as student, ss.name as subject, ss.points as max_points
                from grades g 
                inner join students s on g.student_id = s.id 
                inner join subjects ss on g.subject_id = ss.id';
        return $conn->query($query);
    }

    #funkcija getById

    public static function getById($id, mysqli $conn){
        
    }

    #deleteById

    public function deleteById(mysqli $conn)
    {
      
    }

    #update
    public function update($id, mysqli $conn)
    {
       
    }

    #insert add
    public static function add(Evaluation $evaluation, mysqli $conn)
    {
        
    }
}

?>