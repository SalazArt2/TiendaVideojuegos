<?php
  require 'database.php';
  require '../php/funciones.php';
  $auth=estaAutenticado();
  if($auth){         
    $records=$connect->prepare("SELECT usuario,correo,contrasena FROM usuarios WHERE usuario=:usuario");
    $records->bindParam(":usuario",$_SESSION['user']);
    $records->execute();
    $results=$records->fetch(PDO::FETCH_ASSOC);
    $user=null;
    if(is_countable($results)>0)
      $user=$results;
  }
?><!DOCTYPE html>

<html>
<head>
  <title>GameParadise</title>
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
    <div class="contenedor">
            
      <div class="slideshow-container">        
      <?php
        $records=$connect->prepare("SELECT tituloTr,portada FROM juegos order By fechaIng asc limit 3");        
        $records->execute();
        $data = $records->fetchAll();
        foreach ($data as $valores):
          ?>
        <div class="mySlides fade">      
          <img src="../img/<?php echo $valores['portada'];?>" style="width:100%">
          <div class="text"><?php echo $valores['tituloTr']?></div>
        </div>     
        <?php
        endforeach;
        ?>
        <a class="prev" onclick="plusSlides(-1)">❮</a>
        <a class="next" onclick="plusSlides(1)">❯</a>        
      </div>
      <br>        
      <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span> 
        <span class="dot" onclick="currentSlide(2)"></span> 
        <span class="dot" onclick="currentSlide(3)"></span> 
      </div>
      
      <script>
        let slideIndex = 1;
        showSlides(slideIndex);
      
        function plusSlides(n) {
          showSlides(slideIndex += n);
        }
      
        function currentSlide(n) {
          showSlides(slideIndex = n);
        }
      
        function showSlides(n) {
          let i;
          let slides = document.getElementsByClassName("mySlides");
          let dots = document.getElementsByClassName("dot");
          if (n > slides.length) {slideIndex = 1}    
          if (n < 1) {slideIndex = slides.length}
          for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
          }
          for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
          }
          slides[slideIndex-1].style.display = "block";  
          dots[slideIndex-1].className += " active";
        }
      </script>
  </div>

<!-- Catálogo -->
  <br>
  <div class="cont-cajas contenedor">      
    <?php 
      $records=$connect->prepare("SELECT id,tituloTr,caratula,precio,descripcion FROM juegos order By YearL desc limit 12 ");        
      $records->execute();
      $data = $records->fetchAll();
      foreach ($data as $valores):
    ?>
      <section class="cajas contenedor-campos">           
        <img src="../img/<?php echo $valores['caratula'];?>" style="width:100%" class="imagen">
        <h2><?php echo $valores['tituloTr'];?> <br>$<?php echo $valores['precio'];?> MXN</h2>
        <p><?php echo $valores['descripcion']; ?></p><br>
        <a class="comprar" href="<?php 
        if($auth){
        ?>
          ../php/product.php?id=<?php echo $valores['id'];        
        }else
        ?>
          ../php/login.php">comprar</a>
      </section>
      <?php
        endforeach; 
      ?>   
  </div>

  <?php require '../partes/AcercaDe.php' ?>

</body>


</html> 