<?php 

interface IServiceBase{

    public function getById($id);
    public function getList();
    public function add($entity);
    public function update($id, $entity);
    public function delete($id);
}

?>