<?php 
    include_once './Controlador/Helper.php';
?>

<html>
    <head>
        
        <meta charset="UTF-8">
        <title>Pruebas Registel</title>
        
        <link language="css" rel="stylesheet" href="./Web/css/datatables.min.css?<?php echo rand(0, 9999); ?>"/>
        <link language="css" rel="stylesheet" href="./Web/css/bootstrap/css/bootstrap-grid.css?<?php echo rand(0, 9999); ?>">
        <link language="css" rel="stylesheet" href="./Web/css/bootstrap/css/bootstrap-grid.min.css?<?php echo rand(0, 9999); ?>">
        <link language="css" rel="stylesheet" href="./Web/css/bootstrap/css/bootstrap-reboot.css?<?php echo rand(0, 9999); ?>">
        <link language="css" rel="stylesheet" href="./Web/css/bootstrap/css/bootstrap-reboot.min.css?<?php echo rand(0, 9999); ?>">
        <link language="css" rel="stylesheet" href="./Web/css/bootstrap/css/bootstrap.css?<?php echo rand(0, 9999); ?>">
        <link language="css" rel="stylesheet" href="./Web/css/bootstrap/css/bootstrap.min.css?<?php echo rand(0, 9999); ?>">
        <link language="css" rel="stylesheet" href="./Web/css/width_Form.css?<?php echo rand(0, 9999); ?>">
        <link language="css" rel="stylesheet" href="./Web/css/iconos.css?<?php echo rand(0, 9999); ?>">
        <link language="css" rel="stylesheet" href="./Web/css/botones.css?<?php echo rand(0, 9999); ?>">
        <link language="css" rel="stylesheet" href="./Web/css/Font-style.css?<?php echo rand(0, 9999); ?>">
        
    </head>
    <body class="modal-open blanco rebosar" >
        
        
    
            <?php 
                    error_reporting(0);
                    
                    getUrlII();
            ?>
            
        
    </body>
    <footer>
        
        <!-- Libreria de javascript, Jquery-->
        <script language="javascript" src="./Lib/jquery-3.4.1.min.js?<?php echo rand(0, 9999); ?>"></script>
        <!-- Plugin que proporciona el filtro en las tablas -->
        <script language="javascript" src="./Web/js/datatables.min.js?<?php echo rand(0, 9999); ?>"></script>
        <!-- Bootstrap-->
        <script language="javascript" src="./Web/css/bootstrap/js/bootstrap.bundle.js?<?php echo rand(0, 9999); ?>" ></script>
        <script language="javascript" src="./Web/css/bootstrap/js/bootstrap.bundle.min.js?<?php echo rand(0, 9999); ?>" ></script>
        <script language="javascript" src="./Web/css/bootstrap/js/bootstrap.js?<?php echo rand(0, 9999); ?>" ></script>
        <script language="javascript" src="./Web/css/bootstrap/js/bootstrap.min.js?<?php echo rand(0, 9999); ?>" ></script>
        <!--fin bootstrap-->
        <!-- Controlador de Jquery-->
        <script language="javascript" src="./Controlador/ControladorJS/ControladorJquery.js?<?php echo rand(0, 9999); ?>"></script>

    </footer>
</html>