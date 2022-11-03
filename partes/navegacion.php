<head>
  <meta charset="UTF-8">  
  <link rel="stylesheet" href="../partes/navegacion.css">
</head>
<div class="logobg" >
          <div class="contenido-hero">
            <img src="../img/LogoV1.png">
          </div>
      </div>           
    <!-- Nav bar -->   
    <nav>
        <ul class="menu" position >
          <li><a href="">Inicio</a></li>
          <li><a href="">Géneros</a>
            <ul>
              <li><a href="">FPS</a></li>
              <li><a href="">RPG</a></li>
              <li><a href="">Exploración</a></li>
              <li><a href="">Hack n' Slash</a></li>
              <li><a href="">Automatización</a></li>
            </ul></li>
          <li><a href="">Sagas</a>
            <ul>
              <li><a href="">The Withcer</a></li>
              <li><a href="">Halo</a></li>
              <li><a href="">Resident Evil</a></li>
              <li><a href="">Legend of Zelda</a></li>
              <li><a href="">Crash Bandicoot</a></li>
            </ul></li>
          <li><a href="">Plataformas</a>
            <ul>
              <li><a href="">PlayStation</a></li>
              <li><a href="">XBox</a></li>
              <li><a href="">Nintendo</a></li>
              <li><a href="">PC</a></li>
            </ul></li>
            <li><a href=""><?php 
            if(empty($user)){
              echo "Sesión";
            ?></a>
            <ul>
              <li><a href="../html/SignUp.html">Registrarse</a></li>
              <li><a href="../php/login.php">Iniciar Sesión</a></li>
            </ul><?php }           
            else{echo $user['usuario'];
            ?></a>
            <ul>
              <li><a href="../php/logout.php">Cerrar Sesión</a></li>
            </ul><?php } ?>
          </li>
        </ul>
      </nav>      