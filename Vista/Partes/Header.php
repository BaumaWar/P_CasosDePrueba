<nav class="navbar navbar-expand-lg navbar-light bg-sombra border-bottom blanco" >
    <?php
        
        if(!empty($_SESSION['usu_nombre'] && !empty($_SESSION['id_usu']))){
            echo"<a class='navbar-brand PS' href='index.php?modulo=Inicio&controlador=Inicio&funcion=Inicio'>Pruebas de software</a>";
        }else{
            echo"<a class='navbar-brand PS' href='../index.php'>Pruebas de software</a>";
        }
    ?>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        
        <ul class="navbar-nav mr-auto">
            <!--<li class="active nav-link dropdowns mano">
                <a class="dropboton" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class='ncnsz' src='../Lib/open-iconic-master/svg/list-rich.svg'> Casos de prueba
                </a>
                <div class="dropdown-contents border bg-sombra" style="top:46px;">
                    <a class="dropdown-item" href="index.php?modulo=Caso&controlador=Caso&funcion=caso"><img class='ncnsz' src='../Lib/open-iconic-master/svg/browser.svg'> Registar</a>
                    <a class="dropdown-item" href="index.php?modulo=Caso&controlador=Caso&funcion=listarCaso"><img class='ncnsz' src='../Lib/open-iconic-master/svg/list.svg'> Listado</a>
                </div>
            </li>-->
            
            <li class="active nav-link dropdowns mano">
                <a class="active dropboton" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class='ncnsz' src='../Lib/open-iconic-master/svg/clipboard.svg'> Proceso de pruebas 
                </a>
                <!--<div class="dropdown-contents border bg-sombra" style="top:46px;">
                    <a class="dropdown-item" href="index.php?modulo=Prueba&controlador=Prueba&funcion=crear"><img class='ncnsz' src='../Lib/open-iconic-master/svg/layers.svg'> Prueba</a>
                    <a class="dropdown-item" href="index.php?modulo=Prueba&controlador=Prueba&funcion=listar"><img class='ncnsz' src='../Lib/open-iconic-master/svg/list.svg'> Listado</a>
                </div>-->
                <div class="dropdown-contents border bg-sombra" style="top:46px;">
                    
                    <ul class="dropdown-item dropdownssSubMenu"><img class='ncnsz' src='../Lib/open-iconic-master/svg/list-rich.svg'> Casos de prueba <img class='ncnszSubMenu' src='../Lib/open-iconic-master/svg/caret-bottom.svg'>
                        <li class="active nav-link dropdownssSubMenu mano">
                            <div class="dropdown-contentsSubMenu border bg-sombra" style="left:39.9px; top:-5px;">
                                <a class="dropdown-item" href="index.php?modulo=Caso&controlador=Caso&funcion=caso"><img class='ncnsz' src='../Lib/open-iconic-master/svg/browser.svg'> Registar</a>
                                <a class="dropdown-item" href="index.php?modulo=Caso&controlador=Caso&funcion=listarCaso"><img class='ncnsz' src='../Lib/open-iconic-master/svg/list.svg'> Listado</a>
                            </div>    
                        </li>
                    </ul>
                    
                    <a class="dropdown-item" href="index.php?modulo=Prueba&controlador=Prueba&funcion=crear"><img class='ncnsz' src='../Lib/open-iconic-master/svg/layers.svg'> Prueba</a>
                    <a class="dropdown-item" href="index.php?modulo=Prueba&controlador=Prueba&funcion=listar"><img class='ncnsz' src='../Lib/open-iconic-master/svg/list.svg'> Listado</a>
                    
                    <!--<a class="dropdown-item" href="index.php?modulo=Notificacion&controlador=Notificacion&funcion=listar" title="En Construcion"><img class='ncnsz' src='../Lib/open-iconic-master/svg/list.svg'> Listado</a>-->
                </div>
            </li>
            
            <li class="active nav-link dropdowns mano">
                <a class="active dropboton" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class='ncnsz' src='../Lib/open-iconic-master/svg/envelope-closed.svg'> Notificacion
                </a>
                
                <div class="dropdown-contents border bg-sombra" style="top:46px;">
                   <!-- <a class="dropdown-item" href="index.php?modulo=Notificacion&controlador=Notificacion&funcion=crear" ><img class='ncnsz' src='../Lib/open-iconic-master/svg/bullhorn.svg'> Notificar</a>
                    
                    <ul class="dropdown-item dropdownssSubMenu"><img class='ncnsz' src='../Lib/open-iconic-master/svg/bullhorn.svg'> Notificar
                        <li class="active nav-link dropdownssSubMenu mano">
                            <div class="dropdown-contentsSubMenu border bg-sombra" style="left:58.9px; top:-5px;">-->
                                <a class="dropdown-item" href="index.php?modulo=Notificacion&controlador=Notificacion&funcion=crear" ><img class='ncnsz' src='../Lib/open-iconic-master/svg/bullhorn.svg'> Notificar</a>
                                <!--<a class="dropdown-item" href="index.php?modulo=Notificacion&controlador=Notificacion&funcion=crear" ><img class='ncnsz' src='../Lib/open-iconic-master/svg/bullhorn.svg'> Listado</a>
                            </div>    
                        </li>
                    </ul>
                    
                    <!--<a class="dropdown-item" href="index.php?modulo=Notificacion&controlador=Notificacion&funcion=listar" title="En Construcion"><img class='ncnsz' src='../Lib/open-iconic-master/svg/list.svg'> Listado</a>-->
                </div>
                
            </li>
            <li class="active nav-link dropdowns mano">
                <a class="dropboton" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class='ncnsz' src='../Lib/open-iconic-master/svg/vertical-align-bottom.svg'> Estado
                </a>
                <div class="dropdown-contents border bg-sombra" style="top:46px;">
                    <a class="dropdown-item" href="index.php?modulo=Grafica&controlador=Grafica&funcion=grafica"><img class='ncnsz' src='../Lib/open-iconic-master/svg/pie-chart.svg'> Graficar</a>
                    <!--<a class="dropdown-item" href="index.php?modulo=Grafica&controlador=Grafica&funcion=estado"><img class='ncnsz' src='../Lib/open-iconic-master/svg/pulse.svg'> Estado</a>-->
                </div>
            </li>
        </ul>
        
        <input style="display: none;" id="idUsuarioNotificado" value="<?php echo $idUser= $_SESSION['id_usu']; ?>" data-url="<?php echo setUrl("Notificacion", "Notificacion", "consultaNotificacion","ajax"); ?>" />
        <input style="display: none;" id="idNotificadoPorTiempo" value="<?php echo $idUser= $_SESSION['id_usu']; ?>" data-url="<?php echo setUrl("Notificacion", "Notificacion", "notificacionPorTiempo","ajax"); ?>" />
        <input style="display: none;" id="idLeidoUrl" data-url="<?php echo setUrl("Notificacion", "Notificacion", "notificacionLeida","ajax"); ?>"/>
        <input style="display: none;" id="idVisto" value="<?php echo $idUser= $_SESSION['id_usu']; ?>" data-url="<?php echo setUrl("Notificacion", "Notificacion", "notificacionesVistas","ajax"); ?>"/>
        <input style="display: none;" id="idNoVerMas" data-url="<?php echo setUrl("Notificacion", "Notificacion", "noVerMasNotificaciones","ajax"); ?>"/>
        
        <div class="nav-link dropdowns" id="navbarSupportedContent" style="right: 15px;">  
            
            <a style="padding-bottom: 13px;" href="#" class="alarmaNotificacion" data-placement="bottom" data-toggle="popover" title="Notificaciones" data-content='
               <div class="list-group notiPrueba" >
               </div>'>
               <span class="badge" style="color: tomato;">
                   <img class='ncnsz mano'  src='../Lib/open-iconic-master/svg/bell.svg'>
                   <span id="numberNotificacion">
                       
                   </span>
                       
               </span>
            </a>
            
            <!--<div class="dropdown-contents border bg-sombra" style="top:46px; right:  20px"  aria-labelledby="dropdownMenuLink">
                <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p> esta dentor del
            </div>-->
        </div>
        
        <div class="nav-link dropdowns mano" id="navbarSupportedContent" style="right: 5px ;">
            <a class="active dropboton" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php 
                    error_reporting(E_ALL ^ E_NOTICE);
                    echo"".$nombre=$_SESSION['usu_nombre']." <img class='ncnsz' src='../Lib/open-iconic-master/svg/person.svg'>";
                ?>
            </a>
            <div class="dropdown-contents border bg-sombra" style="top:46px; left: 35px; " aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="index.php?modulo=Usuario&controlador=Usuario&funcion=infUsuario"><img src="../Lib/open-iconic-master/svg/cog.svg" class="ncnsz" alt="icon name"> Mi cuenta</a>
                <a class="dropdown-item" href="loginout.php"><img src="../Lib/open-iconic-master/svg/power-standby.svg" class="ncnsz" alt="icon name"> Cerrar sesion</a>
            </div>
        </div>
        
    </div>
</nav>