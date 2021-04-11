<?php 

class Student{

    public $id;
    public $nombre;
    public $apellido;
    public $area;
    public $areaId;
    public $activo;
    public $materiasFav;
    public $profilePhoto;
    
    private $variables;

    public function __construct()
    {
        $this->variables = New variables();
    }

    public function inicializeData($id,$nombre,$apellido,$areaId,$activo,$materiasFav,$profilePhoto){

        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->areaId = $areaId;
        $this->activo = $activo;
        $this->materiasFav = $materiasFav;
        $this->profilePhoto = $profilePhoto;
    }
    
    public function set($data){
        foreach($data as $key => $value) $this->{$key} = $value;


        
    }

    function getAreaName(){
        if ($this->areaId != 0 && $this->areaId != null) {
            return $this->variables->area[$this->areaId];
        }
    }
    
    function getMateriaId(){
        if ($this->areaId != 0 && $this->areaId != null) {
            return $this->variables->area[$this->areaId];
        }
    }

}

?>