<?php
require 'database.php';
$total = $_GET["total"];

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
?>
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
        <?php require '../partes/navegacion.php' ?>  
        
        <br>
        <br>
        <h1 style="text-align: center; color:darkred"> Seleccione su método de pago:</h1>
    

    <!-- Paypal -->     
         <center>
           <br>
           <br> 
           
           <div style=" margin: 0 auto; position:static;">
 
     <!-- Replace "test" with your own sandbox Business account app client ID -->
   <script src="https://www.paypal.com/sdk/js?client-id=ATYAoJunoexnVxM9-d0czu2qjlRD_8vrJNcXgaJtA9tNBKaFVQAc1QmLjARbe0JjTrO4o1er-OTu7xAp&currency=MXN
   "></script>
   <!-- Set up a container element for the button -->
   <div id="paypal-button-container"></div>
   <script>
     paypal.Buttons({
           style:{
             color : 'blue',
             shape : 'pill',
             label : 'pay'
           },
 
       // Sets up the transaction when a payment button is clicked
       createOrder: (data, actions) => {
         return actions.order.create({
           purchase_units: [{
             amount: {
               value: <?php echo $total; ?> // Can also reference a variable or function
             }
           }]
         });
       },
       // Finalize the transaction after payer approval
       onApprove: (data, actions) => {
         return actions.order.capture().then(function(orderData) {
          window.open('../php/preparacion.php', '_blank');
          window.location.href="../php/sobrecarga.php";
           // Successful capture! For dev/demo purposes:
           console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
           const transaction = orderData.purchase_units[0].payments.captures[0];
 
           //window.alert(`La transacción ha sido ${transaction.status}: \n\n¡Gracias por su compra!`);
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

    

<?php require '../partes/AcercaDe.php' ?>

  </body>
</html>
