<?php
  session_start();
  require 'database.php';
  if(isset($_SESSION['user'])){         
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
<link rel="stylesheet" href="../css/estilo1.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
   

</head>
  <body {background-color: coral;}>    
    <!-- Parte superior -->        
     
    <?php require '../partes/navegacion.php' ?>  
    <!-- Slider -->
    <div class="contenedor">
      <div class="slideshow-container">        
        <div class="mySlides fade">      
          <img src="../img/sm.jpg" style="width:100%">
          <div class="text">Opcion 1</div>
        </div>        
        <div class="mySlides fade">      
          <img src="../img/sm.jpg" style="width:100%">
          <div class="text">Opcion 2</div>
        </div>        
        <div class="mySlides fade">      
          <img src="../img/fifa23.jpg" style="width:100%">
          <div class="text">Opcion 3</div>
        </div>        
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
      <section class="cajas contenedor-campos">           
        <img src="../img/fifa23P.png" style="width:100%" class="imagen">
        <h2>EA SPORTS™ FIFA 23 <br> Mex$ 1,599.00 </h2>
        <p>FIFA 23 es un videojuego de simulación de fútbol publicado por Electronic Arts. Es la trigésima y última 
          entrega de la serie FIFA desarrollada por EA Sports y lanzada en todo el mundo el 30 de septiembre de 2022 
          para PC, Nintendo Switch, PlayStation 4, PlayStation 5, Xbox One, Xbox Series X/S y Google Stadia.​ </p>
      </section>
      <section class="cajas contenedor-campos">           
        <img src="../img/Portada_God_of_War_Ragnarok.webp" style="width:100%" class="imagen">
        <h2>¡REALIZA TU PRECOMPRA AQUI!</h2>
        <p>God of War: Ragnarök es un próximo juego de acción y aventuras en desarrollo por Santa Monica Studio 
          y que será publicado por Sony Interactive Entertainment. Su lanzamiento está programado para el 9 de noviembre
           del 2022 para PlayStation 4 y PlayStation 5.​ Será la 9.ª entrega de la saga de God of War.</p>
      </section>        
      <section class="cajas contenedor-campos">           
        <img src="../img/spiel-spidermanps4-2.png" style="width:100%" class="imagen">
        <h2>Marvel’s Spider-Man Remastered <br> Mex$ 999.00</h2>
        <p>Marvel's Spider-Man es un videojuego de acción y aventura basado en el popular superhéroe hómonimo de la editorial Marvel Comics.​ Fue desarrollado por Insomniac Games y publicado por Sony Interactive Entertainment.</p>
      </section>
      <section class="cajas contenedor-campos">            
        <img src="../img/pokemon-escudo_1zdf.png" style="width:100%" class="imagen">
        <h2>Pokémon Escudo<br> Mex$ 1,599.00</h2>
        <p>Pokémon Espada y Escudo, conocidos en Japón como Pocket Monsters Sword & Shield, son dos videojuegos de rol desarrollados por Game Freak y publicados por Nintendo y The Pokémon Company para Nintendo Switch. Son los primeros títulos de la octava generación de la serie principal de Pokémon. </p>
      </section>
      <section class="cajas contenedor-campos">            
        <img src="../img/pokemon-espada-y-escudo-201972612334165_18.jpg" style="width:100%" class="imagen">
        <h2>Pokémon Espada<br> Mex$ 1,599.00</h2>
        <p>Pokémon Espada y Escudo, conocidos en Japón como Pocket Monsters Sword & Shield, son dos videojuegos de rol desarrollados por Game Freak y publicados por Nintendo y The Pokémon Company para Nintendo Switch. Son los primeros títulos de la octava generación de la serie principal de Pokémon. </p>
      </section>      
  </div>

  
 

  <?php require '../partes/AcercaDe.php' ?>




</body>


</html> 