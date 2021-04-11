<?php

require_once 'variables.php';
require_once 'Student.php';
require_once 'service/IServiceBase.php';
require_once 'StudentServiceCookies.php';

$service = new StudentServiceCookie();
$variables = new Variables();

if (isset($_GET['id'])) {

  $studentid = $_GET['id'];
  $element = $service->getById($studentid);


  if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['area'])) {


    $materias = [];
  if ($_POST['lenguaje'] == true) {
    array_push($materias,['Lenguaje']);
  }
  if ($_POST['calculo'] == true) {
    array_push($materias,['Calculo']);
  }
  if ($_POST['historia'] == true) {
    array_push($materias,['Historia']);
  }
  if ($_POST['biologia'] == true) {
    array_push($materias,['Biologia']);
  }
  if ($_POST['programacion'] == true) {
    array_push($materias,['Programacion']);
  }

    $updateStudent = new Student();

    $updateStudent->inicializeData($id, $_POST['nombre'], $_POST['apellido'], $_POST['area'], $_POST['activo'],$materias,$_POST['profilePhoto']);


    
    $service->update($studentid, $updateStudent);
    header('Location: index.php');
    exit();
  }
} else {
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear estudiante</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>

<body>
  <div class="container-fluid" style="background-color: lightblue;">
    <h1 style="text-align: center;">Registro Estudiante</h1>
  </div>
  <br>

  <div class="container-fluid col-md-6">
    <div class="card ">
      <h5 class="card-header" style="text-align: center;">Editando al estudiante <?php echo $element->nombre ?></h5>
      <div class="card-body">
        <form enctype ="multipart/form-data" action="editar.php?id=<?php echo $element->id?>" method="POST">
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" placeholder="Escriba nombre" name="nombre" required value="<?php echo $element->nombre ?>">
          </div>
          <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" class="form-control" id="apellido" placeholder="Escriba apellido" name="apellido" required value="<?php echo $element->apellido ?>">
          </div>
          <div class="form-group">
            <label for="area">Area</label>
            <select class="form-control" id="area" name="area">

              <?php foreach ($variables->area as $id => $text) : ?>
                <?php if ($id == $element->areaId) : ?>
                  <option selected value="<?php echo $id; ?>"> <?php echo $text; ?></option>
                <?php else : ?>
                  <option value="<?php echo $id; ?>"> <?php echo $text; ?></option>
                <?php endif; ?>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group form-check">

            <?php if ($element->activo == true) : ?>
              <input type="checkbox" class="form-check-input" id="exampleCheck1" checked name="activo">
            <?php else : ?>
              <input type="checkbox" class="form-check-input" id="exampleCheck1" name="activo">
            <?php endif ?>
            <label class="form-check-label" for="exampleCheck1">Activo</label>
          </div>
          <h3>Materias favorias:</h3>
          <div class="form-group form-check">
          <?php if (in_array("Lenguaje", $element->materiasFav)): ?>
             <input type="checkbox" class="form-check-input" id="l" name="lenguaje" checked>
          <?php else:?>
            <input type="checkbox" class="form-check-input" id="l" name="lenguaje" >
            <?php endif ?>
            <label class="form-check-label" for="l">Lenguaje</label>
            <br>
            <?php if (in_array("Calculo", $element->materiasFav)): ?>
             <input type="checkbox" class="form-check-input" id="l" name="calculo" checked>
          <?php else:?>
            <input type="checkbox" class="form-check-input" id="l" name="calculo">
            <?php endif ?>
          <label class="form-check-label" for="c">Calculo</label>
          <br>
          <?php if (in_array("Historia", $element->materiasFav)): ?>
             <input type="checkbox" class="form-check-input" id="h" name="historia" checked>
          <?php else:?>
            <input type="checkbox" class="form-check-input" id="h" name="historia">
            <?php endif ?>
          <label class="form-check-label" for="c">Historia</label>
          <br>
          <?php if (in_array("Biologia", $element->materiasFav)): ?>
             <input type="checkbox" class="form-check-input" id="b" name="biologia" checked>
          <?php else:?>
            <input type="checkbox" class="form-check-input" id="b" name="biologia">
            <?php endif ?>
          <label class="form-check-label" for="h">Biologia</label>
          <br>
          <?php if (in_array("Programacion", $element->materiasFav)): ?>
             <input type="checkbox" class="form-check-input" id="p" name="programacion" checked>
          <?php else:?>
            <input type="checkbox" class="form-check-input" id="p" name="programacion">
            <?php endif ?>
          <label class="form-check-label" for="b">Programacion</label>
         
          </div>
          <?php if($element->profilePhoto == "" || $element->profilePhoto == null):?>
        <img src="img/default.png" class="bd-placeholder-img card-img-top" width="100%" height="225">
  
      <?php else:?>
        <img src="<?php echo "img/students/" . $element->profilePhoto;?>" class="bd-placeholder-img card-img-top" width="100%" height="225">
  
      <?php endif;?>
          <div class="form-group">
    <label for="photo">Foto de perfil</label>
    <input type="file" class="form-control" id="photo" name="profilePhoto">
  </div>
          <button type="submit" class="btn btn-success">Guardar</button>
        </form>
      </div>
    </div>
  </div>
  <br>
  <div class="container-fluid col-md-2">
    <a class="btn btn-primary" href="index.php" role="button">Volver a atras</a>
  </div>
</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</html>