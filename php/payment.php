
<!DOCTYPE html>
<html>
  <head>

    <title>Pago</title>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/footerStyle1.css">
  <link rel="stylesheet" href="../css/estilo5.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
     
  
  </head>
  
    <body {background-color: coral;}>    
      <!-- Logo -->        
        <div class="logobg" >
            <div class="contenido-hero">
              <img src="../img/LogoV1Escalado.png">
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
                <li><a href="">The Witcher</a></li>
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
              <li><a href="Login.html">Registrarse</a></li>
          </ul>
        </nav>     
        
        <br>
        <br>
        <h1 style="text-align: center; color:darkred"> Seleccione su método de pago:</h1>
    
        <center>
          <br>
          <br> 
          <div style=" margin: 0 auto; position:static;">
    <!-- Replace "test" with your own sandbox Business account app client ID -->
    <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script>
    <!-- Set up a container element for the button -->
    <div id="paypal-button-container"></div>
    <div >
      <script>
      paypal.Buttons({
        // Sets up the transaction when a payment button is clicked
        createOrder: (data, actions) => {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: '77.44' // Can also reference a variable or function
              }
            }]
          });
        },
        // Finalize the transaction after payer approval
        onApprove: (data, actions) => {
          return actions.order.capture().then(function(orderData) {
            // Successful capture! For dev/demo purposes:
            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
            const transaction = orderData.purchase_units[0].payments.captures[0];
            alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
            // When ready to go live, remove the alert and show a success message within this page. For example:
            // const element = document.getElementById('paypal-button-container');
            // element.innerHTML = '<h3>Thank you for your payment!</h3>';
            // Or go to another URL:  actions.redirect('thank_you.html');
          });
        }
      }).render('#paypal-button-container');
      </script>
    </div>
  </div>
  </center>
  <br>
  <br>

<center> <form action="../php/convertirPDF.php">

<input type="submit" name="boton" class="submitBtn" value="Generar PDF" action="convertirPDF.php"> 
</form></center>

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
