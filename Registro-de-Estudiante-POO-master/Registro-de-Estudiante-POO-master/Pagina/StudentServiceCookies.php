<?php

use function PHPSTORM_META\elementType;

class StudentServiceCookie implements IServiceBase{

    private $variables;
    private $cookieName;

    public function __construct()
    {
        $this->variables = new Variables();
        $this->cookieName = 'students';
    }

    public function getList(){

        $ListadoStudents = array();
        
        if (isset($_COOKIE[$this->cookieName])) {
            
            $ListadoStudentsDecode = json_decode($_COOKIE[$this->cookieName],false);
            foreach($ListadoStudentsDecode as $elementDecode){
                $element = new Student();
                $element->set($elementDecode,$element);
                array_push($ListadoStudents,$element);
            }

        } else{
            setcookie($this->cookieName,json_encode($ListadoStudents), $this->variables->getCookieTime(),"/");
        }
        return $ListadoStudents;
    }

    public function getById($id){
        $ListadoStudents = $this->getList();
        $student = $this->variables->searchProperty($ListadoStudents, 'id',$id)[0];
        return $student;
    }

    public function add($entity){

        $ListadoStudents = $this->getList();
        $studentId = 1;

        if (!empty($ListadoStudents)) {
            $lastStudent = $this->variables->getLastElement($ListadoStudents);
            $studentId = $lastStudent->id + 1;
        }

        $entity->id = $studentId;
        $entity->profilePhoto = "";

        if (isset($_FILES['profilePhoto'])) {
            $photoFile = $_FILES['profilePhoto'];

            if($_FILES['error'] == 4){
                $entity->profilePhoto =  "";
            } else{
            
                $typeReplace = str_replace("image/","",$_FILES['profilePhoto']['type']);
                $type = $photoFile['type'];
                $size = $photoFile['size'];
                $name = $studentId . '.' . $typeReplace;
                $tmpname = $photoFile['tmp_name'];
    
                $success = $this->variables->uploadImage('img/students/',$name,$tmpname,$type,$size);
                
                if ($success) {
                    $entity->profilePhoto = $name;
                }
            
            }
        
        }

        array_push($ListadoStudents,$entity);

        setcookie(setcookie($this->cookieName,json_encode($ListadoStudents), $this->variables->getCookieTime(),"/"));
    }

    public function update($id, $entity){
        $element = $this->getById($id);
        $ListadoStudents = $this->getList();

        $elementIndex = $this->variables->getIndexElement($ListadoStudents,'id',$id);
        if (isset($_FILES['profilePhoto'])) {
            
            $photoFile = $_FILES['profilePhoto'];

            if($_FILES['error'] == 4){
                $entity->profilePhoto =  $element->profilePhoto;
            } else{
                $typeReplace = str_replace("image/","",$_FILES['profilePhoto']['type']);
                $type = $photoFile['type'];
                $size = $photoFile['size'];
                $name = $id . '.' . $typeReplace;
                $tmpname = $photoFile['tmp_name'];

                $success = $this->variables->uploadImage('img/students/',$name,$tmpname,$type,$size);
                
                if ($success) {
                    $entity->profilePhoto = "";
                }
            }


            
        
        }
        $ListadoStudents[$elementIndex] =$entity;
        setcookie(setcookie($this->cookieName,json_encode($ListadoStudents), $this->variables->getCookieTime(),"/"));
    }

    public function delete($id){
        $ListadoStudents = $this->getList();
        $elementIndex = $this->variables->getIndexElement($ListadoStudents,'id',$id);
        unset($ListadoStudents[$elementIndex]);
        $ListadoStudents = array_values($ListadoStudents);
        setcookie(setcookie($this->cookieName,json_encode($ListadoStudents), $this->variables->getCookieTime(),"/"));
    }

}

?>