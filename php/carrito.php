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
  }
  ?>
<!DOCTYPE html>
<html>

  <head>
    <title>Carrito</title>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../css/footerStyle1.css">
  <link rel="stylesheet" href="../css/estilo5.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" 
  integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqkI2xXr2" crossorigin="anonymous">




  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="../css/cssKart/bootstrap.min.css">
  <link rel="stylesheet" href="../css/cssKart/magnific-popup.css">
  <link rel="stylesheet" href="../css/cssKart/jquery-ui.css">
  <link rel="stylesheet" href="../css/cssKart/owl.carousel.min.css">
  <link rel="stylesheet" href="../css/cssKart/owl.theme.default.min.css">


  <link rel="stylesheet" href="../css/cssKart/aos.css">

  <link rel="stylesheet" href="../css/cssKart/style.css">
  
  </head>
  
  <body>

    <!-- Logo -->        
   <?php
   require '../partes/navegacion.php';
   ?>

  <!-- Carrito -->    

  <div class="site-wrap">
  
      <div class="site-section">
        <div class="container">
          <div class="row mb-5">
            <form class="col-md-12" method="post">
              <div class="site-blocks-table">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="product-thumbnail">Caratula</th>
                      <th class="product-name">Título</th>
                      <th class="product-price">Precio</th>
                      <th class="product-quantity">Cantidad</th>
                      <th class="product-total">Total</th>
                      <th class="product-remove">Eliminar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                     
                     //SELECT juegos.tituloTr,juegos.caratula,juegos.precio,carro.cant from carro 
                     //LEFT JOIN juegos on juegos.id in (SELECT carro.juego from carro where carro.user="molahs") GROUP BY juegos.tituloTr;
                     $records=$connect->prepare("SELECT juegos.tituloTr,juegos.caratula,juegos.precio,carro.cant,juegos.id from carro 
                     LEFT JOIN juegos on juegos.id in (SELECT carro.juego from carro where carro.user=:user)
                      GROUP BY juegos.tituloTr;");   
                     $records->bindParam(":user",$_SESSION['user']);      
                     $records->execute();
                     $data = $records->fetchAll();
                     foreach ($data as $valores):
                    ?>
                    <tr>
                      <td class="product-thumbnail">
                        <img src="../img/<?php echo $valores['caratula'];?>" alt="Image" class="img-fluid">
                      </td>
                      <td class="product-name">
                        <h2 class="h5 text-black"><?php echo $valores['tituloTr'];?></h2>
                      </td>
                      <td>$<?php echo number_format($valores['precio'], 2, '.', ',');?></td>
                      <td><?php echo $valores['cant'];?></td>
                      <td>$<?php echo number_format($valores['precio']*$valores['cant'], 2, '.', ',');?></td>
                      <td><a href="../php/quitarC.php?id=<?php echo $valores['id'];?>" class="btn btn-primary btn-sm">X</a></td>
                    </tr>                    
                    <?php
                        endforeach;
                    ?>
                  </tbody>
                </table>
              </div>
            </form>
          </div>
  
          <div class="row">
            <div class="col-md-6">
              <div class="row mb-5">
                <div class="col-md-6 mb-3 mb-md-0">
                  <button class="btn btn-primary btn-sm btn-block" onclick="recargar()">Actualizar carro</button>
                </div>
                <div class="col-md-6">
                  <button class="btn btn-outline-primary btn-sm btn-block" onclick="seguir()">Seguir comprando</button>
                  <script>
                    function seguir(){
                      window.location.href = "../php/index.php";
                    }
                    function recargar(){
                      location.reload();
                    }
                  </script>
                </div>
              </div>
              
            </div>
            <div class="col-md-6 pl-5">
              <div class="row justify-content-end">
                <div class="col-md-7">
                  <div class="row">
                    <div class="col-md-12 text-right border-bottom mb-5">
                      <h3 class="text-black h4 text-uppercase">Totales:</h3>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <span class="text-black">Subtotal</span>
                    </div>
                    <div class="col-md-6 text-right">
                        <?php
                            $subtotal=0;
                            foreach ($data as $valores):
                                $subtotal+=$valores['precio']*$valores['cant'];
                            endforeach;
                        ?>
                      <strong class="text-black">$<?php echo number_format($subtotal, 2, '.', ',');?></strong>
                    </div>
                  </div>
                  <div class="row mb-5">
                    <div class="col-md-6">
                      <span class="text-black">Total</span>
                    </div>
                    <div class="col-md-6 text-right">
                        <?php
                            $total=$subtotal*1.16;
                        ?>
                      <strong class="text-black">$<?php echo number_format($total, 2, '.', ',');?></strong>
                    </div>
                  </div>
  
                  <div class="row">
                    <div class="col-md-12">
                      <button class="btn btn-primary btn-lg py-3 btn-block" 
                      onclick="window.location='payment.php?total=<?php echo $total; ?>'">Proceder al pago</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  
      
    </div>
  
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/aos.js"></script>
  
    <script src="js/main.js"></script>



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