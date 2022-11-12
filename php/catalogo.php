<?php
  require 'database.php';
  require '../php/funciones.php';
  $auth=estaAutenticado();
  if($auth){         
    $records=$connect->prepare("SELECT usuario,correo FROM usuarios WHERE usuario=:usuario");
    $records->bindParam(":usuario",$_SESSION['user']);
    $records->execute();
    $results=$records->fetch(PDO::FETCH_ASSOC);
    $user=null;
    if(is_countable($results)>0)
    {$user=$results;}
    $busc="";
  }
?><!DOCTYPE html>

<html>
<head>
  <title>Catalogo -<?php
    if(isset($_GET['compania'])){
    $records=$connect->prepare("SELECT compania FROM compania WHERE idCompania=:compania");
    $records->bindParam(":compania",$_GET['compania']);
    $records->execute();
    $results=$records->fetch(PDO::FETCH_ASSOC);
    $busc=$results['compania'];}
    if(isset($_GET['gene'])){
        $records=$connect->prepare("SELECT genero FROM generos WHERE idGen=:gene");
        $records->bindParam(":gene",$_GET['gene']);
        $records->execute();
        $results=$records->fetch(PDO::FETCH_ASSOC);
        $busc=$results['genero'];}
    if(isset($_GET['saga'])){
        $busc=$_GET['saga'];}
    echo $busc;
  ;?>-</title>
  <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/footerStyle1.css">
<link rel="stylesheet" href="../css/estilo5.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
   

</head>
  <body {background-color: coral;}>    
    <!-- Parte superior -->        
     
    <?php require '../partes/navegacion.php' ?>  
    <!-- Slider -->    

<!-- Catálogo -->
  <br>
  <div class="cont-cajas contenedor">      
    <?php 
    if(isset($_GET['compania'])){
        $busc=$_GET['compania'];
      $records=$connect->prepare("SELECT * from juegos,juegoscompania where (juegoscompania.idJuego=juegos.id) and (juegoscompania.idCompania=:compania);
      ");   
      $records->bindParam(":compania",$busc);      
      $records->execute();
      $data = $records->fetchAll();
      foreach ($data as $valores):
    ?>
      <section class="cajas contenedor-campos">           
        <img src="../img/<?php echo $valores['caratula'];?>" style="width:100%" class="imagen">
        <h2><?php echo $valores['tituloTr'];?> <br>$<?php echo $valores['precio'];?> MXN</h2>
        <p><?php echo $valores['descripcion']; ?></p>
        <br>
        <a class="comprar" href="../php/comprar?id=<?php echo $valores['id']?>">comprar</a>
      </section>
      <?php
        endforeach; }
      ?>   
      <?php 
        if(isset($_GET['saga'])){
            $busc=$_GET['saga'];
      $records=$connect->prepare("SELECT * from juegos where saga=:saga;
      ");   
      $records->bindParam(":saga",$busc);      
      $records->execute();
      $data = $records->fetchAll();
      foreach ($data as $valores):
    ?>
      <section class="cajas contenedor-campos">           
        <img src="../img/<?php echo $valores['caratula'];?>" style="width:100%" class="imagen">
        <h2><?php echo $valores['tituloTr'];?> <br>$<?php echo $valores['precio'];?> MXN</h2>
        <p><?php echo $valores['descripcion']; ?></p>
        <br>
        <a class="comprar" href="../php/product.php?id=<?php echo $valores['id']?>">comprar</a>
      </section>
      <?php
        endforeach; }
      ?>   
      <?php 
        if(isset($_GET['gene'])){
            $busc=$_GET['gene'];
            $records=$connect->prepare("SELECT * from juegos,juegosgeneros where (juegosgeneros.idJuego=juegos.id) and (juegosgeneros.idGenero=:gene)");
      $records->bindParam(":gene",$busc);      
      $records->execute();
      $data = $records->fetchAll();
      foreach ($data as $valores):
    ?>
      <section class="cajas contenedor-campos">           
        <img src="../img/<?php echo $valores['caratula'];?>" style="width:100%" class="imagen">
        <h2><?php echo $valores['tituloTr'];?> <br>$<?php echo $valores['precio'];?> MXN</h2>
        <p><?php echo $valores['descripcion']; ?></p>
        <br>
        <a class="comprar" href="../php/product.php?id=<?php echo $valores['id']?>">comprar</a>
      </section>
      <?php
        endforeach; }
      ?>   
  </div>

  <?php require '../partes/AcercaDe.php' ?>

</body>


</html> 