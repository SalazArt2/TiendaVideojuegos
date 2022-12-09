
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
    {$user=$results;}
    $busc="";
  }
?><!DOCTYPE html>
<html>
  <head>
    <title>Detalles del producto</title>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/footerStyle1.css">
  <link rel="stylesheet" href="../css/estilo5.css">
  <link rel="stylesheet" href="../css/cssProd/prodStyle4.css">
  <link rel="stylesheet" href="../css/cssProd/bootstrap.min.css"/>
  <link rel="stylesheet" href="../javascript/prodJs/bootstrap.min.js"
  integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
  </head>
  
  <body>

   <?php require '../partes/navegacion.php';?>

  <br>
  <br>
  <h1 style="text-align: center; color:darkred"> Detalles:</h1>
<?php 
    $records=$connect->prepare("SELECT * from juegos where id=:id");
    $records->execute(['id'=>$_GET['id']]);         
    $data=$records->fetch();
?>
<!-- Producto-->  
  <form method="post" action="../php/agregar.php?id=<?php echo$data['id']?>">
    <section class="container sproduct my-5 pt-5">
      <div class="row mt-5">
        <div class="col-lg-5 col-md-12 col-12">
          <img class="img-fluid w-100 pb-1" src="../img/<?php echo $data['caratula'];?>" id="MainImg" alt="">
      
          <div class="small-img-group"> 
            <div class="small-img-col">
                <img src="../img/<?php echo $data['caratula'];?>" width="100%" class="small-img" alt=""> 
            </div> 
            <div class="small-img-col">
                <img src="../img/<?php echo $data['portada'];?>" width="100%" class="small-img" alt="">
            </div> 
        </div> 
    </div>
    
        <div class="col-lg-6 col-md-12 col-12">
          <h3 class="py-4"><?php echo $data['tituloTr'];?></h3> 
          <h2>$<?php echo number_format($data['precio'], 2, '.', ',');?></h2> 
          Cantidad:
          <br>
          <br>
          <div>
          
            <input type="button" class="btn btn-primary btn-sm" id="btnsumar" value="   +    ">
            <input type="number" id="contador" min="1" max="<?php echo $data["disponibles"];?>" value="1">
            <input type="button" class="btn btn-primary btn-sm" id="btnrestar" value="   -    ">

            <script src="../javascript/contador2.js">
            </script>
          </div>
          <input type="submit" class="buy-btn" text="Agregar al carrito">
          <h4 class="mt-5 mb-5">Descripción:</h4>
          <span><?php echo $data['descripcion'];?>
          </span>
          
    
      </div>
    </div>
    </section>
  </form>

<!-- Relacionados -->  

  <section id="featured" class="my-5 pb-5">
      <div class="container text-center mt-5 py-5">
        <h3>Productos relacionados</h3>
        <hr class="mx-auto">
        <p>Otros productos que podrían interesarte...</p> 
      </div> 
    <div class="row mx-auto container-fluid"> 
        <?php
             //SELECT * FROM `juegos` WHERE juegos.id in( SELECT idJuego from juegosgeneros WHERE juegosgeneros.idGenero IN (SELECT idGenero FROM juegosgeneros WHERE idJuego=3));
             $records=$connect->prepare("SELECT * FROM `juegos` WHERE juegos.id in( SELECT idJuego from juegosgeneros WHERE juegosgeneros.idGenero IN (SELECT idGenero FROM juegosgeneros WHERE idJuego=:id) and juegos.id!=:id);");
             $records->execute(['id'=>$_GET['id']]);                      
             $data=$records->fetchAll();
             
            foreach ($data as $valores):
        ?>
      <div class="product text-center col-lg-3 col-md-4 col-12">
        <img class="img-fluid mb-3" src="../img/<?php echo $valores['caratula'];?>" alt=""> 
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i> 
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i> 
        </div> 
        <h5 class="p-name"><?php echo $valores['tituloTr'];?></h5> 
        <h4 class="p-price">$<?php echo number_format($valores['precio'], 2, '.', ',');?></h4>
        <a class="buy-btn2" href="../php/product.php?id=<?php echo $valores['id']?>">Buy Now</a> 
        </div>
        <?php
        endforeach;
        ?>
     </div>  
  </section>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"
  integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG"
  crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
  integrity="sha384-j0CNLUeiqtyaRm1zUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc"
  crossorigin="anonymous"></script>

    <script src="../javascript/prodJs/product.js"></script>

    <footer>
      <div class="content">
        <div class="left box">
          <div class="upper">
            <div class="topic">Sobre nosotros</div>
            <p>GameParadise® es un lugar en el que puedes adquirir cualquier tipo de videojuego para cualquier
              plataforma de generación actual.
            </p>
          </div>
          <div class="lower">
            <div class="topic">Contactanos</div>
            <div class="phone">
              <a href="#"><i class="fas fa-phone-volume"></i>+007 9089 6767</a>
            </div>
            <div class="email">
              <a href="#"><i class="fas fa-envelope"></i>GameParadise@gmail.com</a>
            </div>
          </div>
        </div>
        <div class="middle box">
          <div class="topic">Nuestros Servicios</div>
          <div><a href="#">Venta a domicilio</a></div>
          <div><a href="#">Venta en plataforma digital</a></div>
          <div><a href="#">Venta de accesorios</a></div>
          <div><a href="#">Consolas</a></div>
          <div><a href="#">Figuras coleccionables</a></div>
          <div><a href="#">Articulos exclusivos en tienda</a></div>
        </div>
        <div class="right box">
          <div class="topic">Contactanos</div>
          <form action="#">
            <input type="text" placeholder="e-mail">
            <input type="submit" name="" value="Enviar">
            <div class="media-icons">
              <a href="#"><i class="fab fa-facebook-f"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
              <a href="#"><i class="fab fa-youtube"></i></a>
              <!--<a href="#"><i class="fab fa-linkedin-in"></i></a>-->
            </div>
          </form>
        </div>
      </div>
      <div class="bottom">
        <p>Copyright © 2022 <a href="#">GameParadise®</a> All rights reserved</p>
      </div>
    </footer>

  </body>
</html>
