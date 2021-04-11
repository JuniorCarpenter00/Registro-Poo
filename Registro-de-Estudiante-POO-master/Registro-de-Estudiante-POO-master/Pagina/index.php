<?php
  require_once 'variables.php';
  require_once 'Student.php';
  require_once 'service/IServiceBase.php';
  require_once 'StudentServiceCookies.php';

  $service = new StudentServiceCookie;
  $variables = new Variables();
  $listadoStudents = $service->getList();
  

$listadoStudents = $service->getList();

  if (!empty($listadoStudents)) {
    if (isset($_GET['areaId'])) {
      
      $listadoStudents = $variables->searchProperty($listadoStudents,'areaId',$_GET['areaId']);

    }
  }


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>

<body>
  <div class="container-fluid" style="background-color: lightblue;">
    <h1 style="text-align: center;">Registro Estudiante</h1>
  </div>
  <ul class="nav nav-pills">
    <li class="nav-item">
      <a class="nav-link active" href="crear.php">Crear nuevo</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index.php">Todos</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index.php?areaId=1">Redes</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index.php?areaId=2">Software</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index.php?areaId=3">Multimedia</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index.php?areaId=4">Mecatronica</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index.php?areaId=5">Seguridad Informatica</a>
    </li>
  </ul>
  <br>

  <div class="container">
    <div class="row">

      <?php if (empty($listadoStudents)) : ?>
        <div class="container-fluid">
        <br>
        <h2 style="text-align: center;">No hay Estudiantes registrados</h2></div>
        

    </div>
  <?php else : ?>

    <?php foreach($listadoStudents as $student): ?>
    <div class="col-md-4" height="225" width = "100%">
    <div class="card">
      
      <?php if($student->activo == true):?>
        <div class="card-header" style="background-color: lightgreen;">
        <b>Activo</b>
      </div>
      <?php else : ?>
        <div class="card-header" style="background-color: lightcoral;">
        <b>No activo</b>
      </div>
      <?php endif ?>

      <?php if($student->profilePhoto == "" || $student->profilePhoto == null):?>
        <img src="img/default.png" class="bd-placeholder-img card-img-top" >
  
      <?php else:?>
        <img src="<?php echo "img/students/" . $student->profilePhoto;?>" class="bd-placeholder-img card-img-top" width="100%" height="225">
  
      <?php endif;?>

      <div class="card-body">
        <h5 class="card-title"><?php echo $student->nombre ?></h5>
        <p class="card-text"><?php echo $student->apellido ?></p>
        <p class="card-text"><?php echo $student->getAreaName()?></p>
        <p><b>Materias favoritas:</b></p>
        <?php foreach($student->materiasFav as $mate):?>
        <p><?php echo $mate[0]?></p>
        <?php endforeach?>
        <a href="editar.php?id=<?php echo $student->id?>" class="btn btn-primary">Editar</a>
        <a href="borrar.php?id=<?php echo $student->id?>" class="btn btn-primary">Borrar</a>
      </div>
    </div>
    </div>
    <?php endforeach ?>

  <?php endif ?>

  </div>
  </div>
  
</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</html>