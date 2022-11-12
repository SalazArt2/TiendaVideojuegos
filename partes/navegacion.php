<head>
  <meta charset="UTF-8">  
  <link rel="stylesheet" href="../partes/navegacion1.css">
</head>
<div class="logobg" >
          <div class="contenido-hero">
            <img src="../img/LogoV1.png">
          </div>
      </div>           
    <!-- Nav bar -->   
    <nav>
        <ul class="menu" position >
          <li><a href="../php/index.php">Inicio</a></li>
          <li><a href="">Géneros</a>
            <ul>
            <?php
                $records=$connect->prepare("SELECT * FROM generos ORDER BY rand() limit 5");        
                $records->execute();
                $data = $records->fetchAll();
                foreach ($data as $valores):
                ?>
                  <li><a href="../php/catalogo.php?gene=<?php echo $valores['idGen'];?>"><?php echo $valores['genero']; ?></a></li>
              <?php
                endforeach;
              ?>
            </ul></li>
          <li><a href="">Sagas</a>
            <ul>
              <li><a href="../php/catalogo.php?saga=The Witcher">The Witcher</a></li>
              <li><a href="../php/catalogo.php?saga=Halo">Halo</a></li>
              <li><a href="../php/catalogo.php?saga=Resident Evil">Resident Evil</a></li>
              <li><a href="../php/catalogo.php?saga=Legend of Zelda">Legend of Zelda</a></li>
              <li><a href="../php/catalogo.php?saga=Crash Bandicoot">Crash Bandicoot</a></li>
            </ul></li>
          <li><a href="">Compania</a>
            <ul>
              <?php
                $records=$connect->prepare("SELECT * FROM compania ORDER BY rand() limit 5");        
                $records->execute();
                $data = $records->fetchAll();
                foreach ($data as $valores):
                ?>
                  <li><a href="../php/catalogo.php?compania=<?php echo $valores['idCompania'];?>"><?php echo $valores['Compania']; ?></a></li>
              <?php
                endforeach;
              ?>
            </ul>
          </li>
          <li><a href=""><?php 
            if(empty($user)){
              echo "Sesión";
            ?></a>
            <ul>
              <li><a href="../php/signup.php">Registrarse</a></li>
              <li><a href="../php/login.php">Iniciar Sesión</a></li>
            </ul><?php }           
            else{echo $user['usuario'];
            ?></a>
            <ul>
              <li><a href="../php/carrito.php">Carrito</a></li>
              <li><a href="../php/logout.php">Cerrar Sesión</a></li>
            </ul><?php } ?>
          </li>
        </ul>
      </nav>      