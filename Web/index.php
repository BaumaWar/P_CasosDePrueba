<html>
<?php
    include_once '../Controlador/Helper.php';
    
    include_once '../Vista/Partes/Head.php';  
?>
    <body class="blanco rebosar">
<?php
    if(!empty($_SESSION['id_usu'])){
        include_once '../Vista/Partes/Header.php';
    }
?>     
        

        
           <?php

                    /*error_reporting(0);*/

                    getUrl();

            ?>
         
    </body>
<?php
    include_once '../Vista/Partes/Script.php';
?>
</html>
