<?php

require_once 'variables.php';
require_once 'Student.php';
require_once 'service/IServiceBase.php';
require_once 'StudentServiceCookies.php';

$service = new StudentServiceCookie();
$variables = new Variables();



if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['area'])) {

  $newStudent = new Student();

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




  $newStudent->inicializeData(0, $_POST['nombre'], $_POST['apellido'], $_POST['area'], true, $materias, $_POST['profilePhoto']);

  $service->add($newStudent);

  header('Location: index.php');
 
  exit();
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
      <h5 class="card-header" style="text-align: center;">Crear estudiante</h5>
      <div class="card-body">
        <form enctype="multipart/form-data" action="crear.php" method="POST">
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" placeholder="Escriba nombre" name="nombre" required>
          </div>
          <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" class="form-control" id="apellido" placeholder="Escriba apellido" name="apellido" required>
          </div>
          <div class="form-group">
            <label for="area">Area</label>
            <select class="form-control" id="area" name="area">
              <?php foreach ($variables->area as $id => $text) : ?>
                <option value="<?php echo $id; ?>"> <?php echo $text; ?> </option>
              <?php endforeach; ?>
            </select>
          </div>
          <h3>Materias favorias:</h3>
          <div class="form-group form-check">
          
          <input type="checkbox" class="form-check-input" id="l" name="lenguaje">
          <label class="form-check-label" for="l">Lenguaje</label>
          <br>
          <input type="checkbox" class="form-check-input" id="c" name="calculo">
          <label class="form-check-label" for="c">Calculo</label>
          <br>
          <input type="checkbox" class="form-check-input" id="h" name="historia">
          <label class="form-check-label" for="h">Historia</label>
          <br>
          <input type="checkbox" class="form-check-input" id="b" name="biologia">
          <label class="form-check-label" for="b">Biologia</label>
          <br>
          <input type="checkbox" class="form-check-input" id="p" name="programacion">
          <label class="form-check-label" for="p">Programacion</label>
          </div>
          <div class="form-group">
            <label for="photo">Foto de perfil</label>
            <input type="file" class="form-control" id="photo" placeholder="Escriba apellido" name="profilePhoto">
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