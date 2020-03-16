//Domento que contiene parte del Jquery
$(document).ready(function(){
    
    //Funcion que perimiter tener el filtro y buscador en las tablas de datos.
    $('#example').DataTable();
              
    //Funcion que pone los alert,pasa datos y vacia los campos una vez se registre un caso de prueba.
    $(document).on("click","#regCas",function(){

        var url= $(this).attr('data-url');
        var nomCaso= $('#nomCaso').val();
        var descripcion= $('#descripcion').val();
        var valEnt= $('#valEnt').val();
        var preCon= $('#preCon').val();
        var resEsp= $('#resEsp').val();
        var posCon= $('#posCon').val();
        var resCas= $('#resCas').val();
        var modulo= $('.casoModulo').val();
        
        var optEnd;
        
        if((nomCaso)&&(descripcion)&&(valEnt)&&(preCon)&&(resEsp)&&(posCon)&&(modulo!="#")){
            
            if($("#formCreCasPru input[id='cajNeg']:radio").is(':checked')){
                optEnd= 2;
            } 
            if($("#formCreCasPru input[id='cajBla']:radio").is(':checked')){
                optEnd= 1;
            }
            if(optEnd){
                
                    var patt = new RegExp(/^[\S][A-Za-z0-9.,;:ñÑáéíóúÁÉÍÓÚ"'+-_$()\s]+$/g);
                    var patt1 = new RegExp(/^[\S][A-Za-z0-9.,;ñÑáéíóúÁÉÍÓÚ%#*¿:"'+-_$()\s]+$/g);
                    var patt2 = new RegExp(/^[\S][A-Za-z0-9.,;ñÑáéíóúÁÉÍÓÚ%#*¿:"'+-_$()\s]+$/g);
                    var patt3 = new RegExp(/^[\S][A-Za-z0-9.,;ñÑáéíóúÁÉÍÓÚ%#*¿:"'+-_$()\s]+$/g);
                    var patt4 = new RegExp(/^[\S][A-Za-z0-9.,;ñÑáéíóúÁÉÍÓÚ%#*¿:"'+-_$()\s]+$/g);
                    var patt5 = new RegExp(/^[\S][A-Za-z0-9.,;ñÑáéíóúÁÉÍÓÚ%#*¿:"'+-_$()\s]+$/g);
                    var patt6 = new RegExp(/^[\S][A-Za-z0-9.,;ñÑáéíóúÁÉÍÓÚ%#*¿:"'+-_$()\s]+$/g);
                    
                    var nombreCaso = patt.test(nomCaso);
                    var descripcionCaso= patt1.test(descripcion);                    
                    var preCondiciones= patt2.test(preCon);
                    var valEntrada= patt3.test(valEnt);
                    var resEsperados= patt4.test(resEsp);
                    var posCondiciones= patt5.test(posCon);
                    var resCaso= patt6.test(resCas);
                    
                if( (nombreCaso)&&(descripcionCaso)&&(preCondiciones)&&(valEntrada)&&(resEsperados)&&(posCondiciones)&&(resCaso) ){
                    $.ajax({
                        url:url,
                        data:"nomCaso="+nomCaso+"&descripcion="+descripcion+"&option="+optEnd+"&valEnt="+valEnt+"&preCon="+preCon+"&resEsp="+resEsp+"&posCon="+posCon+"&modulo="+modulo+"&resultadoCaso="+resCas,         
                        type:"POST",
                        success: function(){

                            $('#setAlert').html('<div class="alert alert-success alert-dismissible fade show text-center" role="alert">\n\
                                                    Registro Exitoso\n\
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                                        <span aria-hidden="true">&times;\n\
                                                        </span>\n\
                                                    </button>\n\
                                                </div>');
                            $('#nomCaso').val("");
                            $('#descripcion').val("");
                            $('#valEnt').val("");
                            $('#preCon').val("");
                            $('#resEsp').val("");
                            $('#posCon').val("");
                            $("#resCas").val("");
                            $("#nombreCaso").removeClass("rojoNoValido");
                            $("#descripcionCaso").removeClass("rojoNoValido");
                            $("#valorEntrada").removeClass("rojoNoValido");
                            $("#resultadoDelCaso").removeClass("rojoNoValido");
                            $("#precodicionesEjecucion").removeClass("rojoNoValido");
                            $("#resultadosEsperados").removeClass("rojoNoValido");
                            $("#poscondiciones").removeClass("rojoNoValido");
                            $("#modulo").removeClass("rojoNoValido");
                            
                       }
                    });
                }else{
                    
                    $('#setAlert').html('<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">\n\
                                            Los datos ingresados no corresponden al formato que es solicitado.\n\
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                                <span aria-hidden="true">&times;\n\
                                                </span>\n\
                                            </button>\n\
                                        </div>');
                    
                    if(nombreCaso){
                        $("#nombreCaso").removeClass("rojoNoValido");
                    }else{
                        $("#nombreCaso").addClass("rojoNoValido");
                    }
                    
                    if(descripcionCaso){
                        $("#descripcionCaso").removeClass("rojoNoValido");
                    }else{
                        $("#descripcionCaso").addClass("rojoNoValido");
                    }
                    
                    if(valEntrada){
                        $("#valorEntrada").removeClass("rojoNoValido");
                    }else{
                        $("#valorEntrada").addClass("rojoNoValido");
                    }
                    
                    if(preCondiciones){
                        $("#precodicionesEjecucion").removeClass("rojoNoValido");
                    }else{
                        $("#precodicionesEjecucion").addClass("rojoNoValido");
                    }
                    
                    if(resEsperados){
                        $("#resultadosEsperados").removeClass("rojoNoValido");
                    }else{
                        $("#resultadosEsperados").addClass("rojoNoValido");
                    }
                    
                    if(posCondiciones){
                        $("#poscondiciones").removeClass("rojoNoValido");
                    }else{
                        $("#poscondiciones").addClass("rojoNoValido");
                    }
                    
                    if(resCas){
                        $("#resultadoDelCaso").removeClass("rojoNoValido");
                    }else{
                        $("#resultadoDelCaso").addClass("rojoNoValido");
                    }
                    
                }
            }else{
                $('#setAlert').html('<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">\n\
                                        Elija un tipo de prueba\n\
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                            <span aria-hidden="true">&times;\n\
                                            </span>\n\
                                        </button>\n\
                                    </div>');
                            $("#nombreCaso").removeClass("rojoNoValido");
                            $("#descripcionCaso").removeClass("rojoNoValido");
                            $("#valorEntrada").removeClass("rojoNoValido");
                            $("#resultadoDelCaso").removeClass("rojoNoValido");
                            $("#precodicionesEjecucion").removeClass("rojoNoValido");
                            $("#resultadosEsperados").removeClass("rojoNoValido");
                            $("#poscondiciones").removeClass("rojoNoValido");
                            $("#modulo").removeClass("rojoNoValido");
            }

        }else{
            $('#setAlert').html('<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">\n\
                                    Todos los campos con * son obligatorios\n\
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                        <span aria-hidden="true">&times;\n\
                                        </span>\n\
                                    </button>\n\
                                </div>');
             
                    if(nomCaso){
                        $("#nombreCaso").removeClass("rojoNoValido");
                    }else{
                        $("#nombreCaso").addClass("rojoNoValido");
                    }
                    
                    if(descripcion){
                        $("#descripcionCaso").removeClass("rojoNoValido");
                    }else{
                        $("#descripcionCaso").addClass("rojoNoValido");
                    }
                    
                    if(valEnt){
                        $("#valorEntrada").removeClass("rojoNoValido");
                    }else{
                        $("#valorEntrada").addClass("rojoNoValido");
                    }
                    if(resCas){
                        $("#resultadoDelCaso").removeClass("rojoNoValido");
                    }else{
                        $("#resultadoDelCaso").addClass("rojoNoValido");
                    }
                    if(preCon){
                        $("#precodicionesEjecucion").removeClass("rojoNoValido");
                    }else{
                        $("#precodicionesEjecucion").addClass("rojoNoValido");
                    }
                    
                    if(resEsp){
                        $("#resultadosEsperados").removeClass("rojoNoValido");
                    }else{
                        $("#resultadosEsperados").addClass("rojoNoValido");
                    }
                    
                    if(posCon){
                        $("#poscondiciones").removeClass("rojoNoValido");
                    }else{
                        $("#poscondiciones").addClass("rojoNoValido");
                    }
                    
                    if(modulo!=="#"){
                        $("#modulo").removeClass("rojoNoValido");
                    }else{
                        $("#modulo").addClass("rojoNoValido");
                    }
                    
        }

    });
    // Funcion que proporciona la informacion de la descripcion del caso de prueba en el modal 
    $(document).on("click","#modInfCas",function(){
        var codigo= $(this).attr('data-codigo');
        var url= $(this).attr('data-url');
        //alert(""+codigo);
        if(codigo){
            $.ajax({
                url:url,
                data:"codigo="+codigo,
                type:"POST",
                success: function(inf_det){
                    
                    var datos_det=JSON.parse(inf_det);
                    
                    $('#modText1').text(datos_det['det_descripcion']);
                    $('#fecCre').text(datos_det['fecha_creacion']);
                    $('#fecMod').text(datos_det['fecha_modificacion']);
                    $('#modText2').text(datos_det['valores_entrada']);
                    $('#modText3').text(datos_det['precondiciones_ejecucion']);
                    $('#modText4').text(datos_det['resultados_esperados']);
                    $('#modText5').text(datos_det['post_condiciones']);
                    $('#modText6').text(datos_det['mod_descripcion']);
                    $('#modText7').text(datos_det['resultado_caso']);
                    
                }
            });
        }
    });
    //Funcion que optiene el dato id del caso de prueba a eliminar y se lo proporciona a la variable global dato
    var dato;
    $(document).on("click","#eliCas",function(){
        
        dato= $(this).attr('data-codigo');
        
    });
    //Funcion que optiene la url y los datos para la eliminacion de los casos de prueba y detalle caso de pruebas.
    $(document).on("click","#eliCasPru",function(){
        
        var codigo= dato;
        var url= $('#eliCas').attr('data-url');
            
            //Se pasan los datos.
            $.ajax({
                url:url,
                data:"codigo="+codigo,
                type:"POST",
                success: function(){
                    window.location.href="index.php?modulo=Caso&controlador=Caso&funcion=listarCaso";
                }
            });
        
    });
    // Funcion que pone los alert en la edicion de caso de prueba, pasa los datos.
    $(document).on("click","#ediCasPru",function(){
        
        var codigo= $('#fk_caso').val();
        var nomCaso= $('#nomCaso').val();
        var descripcion= $('#descripcion').val();
        var valEnt= $('#valEnt').val();
        var preCon= $('#preCon').val();
        var resEsp= $('#resEsp').val();
        var posCon= $('#posCon').val();
        var resCas= $('#resCas').val();
        var url= $('#ediCasPru').attr('data-url');
        var modulo= $(".casoModulo").val();
        
        var optEnd= null;
        
        if((nomCaso)&&(descripcion)&&(valEnt)&&(preCon)&&(resEsp)&&(posCon)&&(modulo!="#")&&(resCas)){
            
            if($("#formEdiCasPru input[id='cajNeg']:radio").is(':checked')){
                optEnd= 2;
            }
            if($("#formEdiCasPru input[id='cajBla']:radio").is(':checked')){
                optEnd= 1;
            }
                if(optEnd){
                    
                    var patt = new RegExp(/^[\S][A-Za-z0-9.,;:ñÑáéíóúÁÉÍÓÚ"'+-_$()\s]+$/g);
                    var patt1 = new RegExp(/^[\S][A-Za-z0-9.,;ñÑáéíóúÁÉÍÓÚ%#*¿:"'+-_$()\s]+$/g);
                    var patt2 = new RegExp(/^[\S][A-Za-z0-9.,;ñÑáéíóúÁÉÍÓÚ%#*¿:"'+-_$()\s]+$/g);
                    var patt3 = new RegExp(/^[\S][A-Za-z0-9.,;ñÑáéíóúÁÉÍÓÚ%#*¿:"'+-_$()\s]+$/g);
                    var patt4 = new RegExp(/^[\S][A-Za-z0-9.,;ñÑáéíóúÁÉÍÓÚ%#*¿:"'+-_$()\s]+$/g);
                    var patt5 = new RegExp(/^[\S][A-Za-z0-9.,;ñÑáéíóúÁÉÍÓÚ%#*¿:"'+-_$()\s]+$/g);
                    var patt6 = new RegExp(/^[\S][A-Za-z0-9.,;ñÑáéíóúÁÉÍÓÚ%#*¿:"'+-_$()\s]+$/g);
                    
                    var nombreCaso = patt.test(nomCaso);
                    var descripcionCaso= patt1.test(descripcion);                    
                    var preCondiciones= patt2.test(preCon);
                    var valEntrada= patt3.test(valEnt);
                    var resEsperados= patt4.test(resEsp);
                    var posCondiciones= patt5.test(posCon);
                    var resultadoCaso= patt6.test(resCas);
                    
                    if( (nombreCaso)&&(descripcionCaso)&&(preCondiciones)&&(valEntrada)&&(resEsperados)&&(posCondiciones)&&(resultadoCaso) ){
                        
                        $.ajax({
                            url:url,
                            data:"codigo="+codigo+"&nomCaso="+nomCaso+"&descripcion="+descripcion+"&option="+optEnd+"&valEnt="+valEnt+"&preCon="+preCon+"&resEsp="+resEsp+"&posCon="+posCon+"&modulo="+modulo+"&resultadoCaso="+resCas,
                            type:"POST",
                            success: function(){
                                //alert("REgistro"+codigo+" "+descripcion+" "+optEnd);

                                //window.location.href="index.php?modulo=Archivo&controlador=Archivo&funcion=listarCaso"
                                $('#setAlert').html('<div class="alert alert-success alert-dismissible fade show text-center" role="alert">\n\
                                                        Edicion exitosa\n\
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                                            <span aria-hidden="true">&times;\n\
                                                            </span>\n\
                                                        </button>\n\
                                                    </div>');
                                
                                        $(".nombreCaso").removeClass("rojoNoValido");
                                        $(".descripcionCaso").removeClass("rojoNoValido");
                                        $(".valorEntrada").removeClass("rojoNoValido");
                                        $(".precondicionesEjecucion").removeClass("rojoNoValido");
                                        $(".resultadosEsperados").removeClass("rojoNoValido");
                                        $(".poscondiciones").removeClass("rojoNoValido");
                                        $(".moduloCaso").removeClass("rojoNoValido");
                                        $("#resultadoDelCaso").removeClass("rojoNoValido");
                                        
                            }
                        });
                        
                    }else{
                        
                        $('#setAlert').html('<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">\n\
                                            Los datos ingresados no corresponden al formato que es solicitado.\n\
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                                <span aria-hidden="true">&times;\n\
                                                </span>\n\
                                            </button>\n\
                                        </div>');
                                        
                        if(nombreCaso){
                            $(".nombreCaso").removeClass("rojoNoValido");
                        }else{
                            $(".nombreCaso").addClass("rojoNoValido");
                        }

                        if(descripcionCaso){
                            $(".descripcionCaso").removeClass("rojoNoValido");
                        }else{
                            $(".descripcionCaso").addClass("rojoNoValido");
                        }
                        
                        if(resultadoCaso){
                            $("#resultadoDelCaso").removeClass("rojoNoValido");
                        }else{
                            $("#resultadoDelCaso").addClass("rojoNoValido");
                        }
                        
                        if(valEntrada){
                            $(".valorEntrada").removeClass("rojoNoValido");
                        }else{
                            $(".valorEntrada").addClass("rojoNoValido");
                        }

                        if(preCondiciones){
                            $(".precondicionesEjecucion").removeClass("rojoNoValido");
                        }else{
                            $(".precondicionesEjecucion").addClass("rojoNoValido");
                        }

                        if(resEsperados){
                            $(".resultadosEsperados").removeClass("rojoNoValido");
                        }else{
                            $(".resultadosEsperados").addClass("rojoNoValido");
                        }

                        if(posCondiciones){
                            $(".poscondiciones").removeClass("rojoNoValido");
                        }else{
                            $(".poscondiciones").addClass("rojoNoValido");
                        }
                        
                    }
                    
                }else{
                    $('#setAlert').html('<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">\n\
                                            Selecione un tipo de prueba\n\
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                                <span aria-hidden="true">&times;\n\
                                                </span>\n\
                                            </button>\n\
                                        </div>');
                
                            $(".nombreCaso").removeClass("rojoNoValido");
                            $(".descripcionCaso").removeClass("rojoNoValido");
                            $(".valorEntrada").removeClass("rojoNoValido");
                            $(".precondicionesEjecucion").removeClass("rojoNoValido");
                            $(".resultadosEsperados").removeClass("rojoNoValido");
                            $(".poscondiciones").removeClass("rojoNoValido");
                            $(".moduloCaso").removeClass("rojoNoValido");
                            $("#resultadoDelCaso").removeClass("rojoNoValido");
                }
            
        }else{
            $('#setAlert').html('<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">\n\
                                    Todos los campos con * son obligatorios\n\
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                        <span aria-hidden="true">&times;\n\
                                        </span>\n\
                                    </button>\n\
                                </div>');
            
                    if(nomCaso){
                        $(".nombreCaso").removeClass("rojoNoValido");
                    }else{
                        $(".nombreCaso").addClass("rojoNoValido");
                    }
                    
                    if(descripcion){
                        $(".descripcionCaso").removeClass("rojoNoValido");
                    }else{
                        $(".descripcionCaso").addClass("rojoNoValido");
                    }
                    
                    if(valEnt){
                        $(".valorEntrada").removeClass("rojoNoValido");
                    }else{
                        $(".valorEntrada").addClass("rojoNoValido");
                    }
                    
                    if(resCas){
                        $("#resultadoDelCaso").removeClass("rojoNoValido");
                    }else{
                        $("#resultadoDelCaso").addClass("rojoNoValido");
                    }
                    
                    if(preCon){
                        $(".precondicionesEjecucion").removeClass("rojoNoValido");
                    }else{
                        $(".precondicionesEjecucion").addClass("rojoNoValido");
                    }
                    
                    if(resEsp){
                        $(".resultadosEsperados").removeClass("rojoNoValido");
                    }else{
                        $(".resultadosEsperados").addClass("rojoNoValido");
                    }
                    
                    if(posCon){
                        $(".poscondiciones").removeClass("rojoNoValido");
                    }else{
                        $(".poscondiciones").addClass("rojoNoValido");
                    }
                    
                    if(modulo!=="#"){
                        $(".moduloCaso").removeClass("rojoNoValido");
                    }else{
                        $(".moduloCaso").addClass("rojoNoValido");
                    }
                    
        }
        
    });
    //Confirmacion de la contraseña
    //variables
    var pass1 = $('#password1');
    var pass2 = $('#password2');

    var div = $('#alert');
    div.hide();
    //función que comprueba las dos contraseñas
    function coincidePassword(){

        var valor1 = pass1.val();
        var valor2 = pass2.val();
        
        //muestro el div
        div.show();
        
        //condiciones dentro de la función
        if(valor1.length>0 || valor2==""){

            div.text('Confirme la contraseña');
            $('#correcto1').removeClass('correcto');
            $('#correcto2').removeClass('correcto');
            $('#correcto1').addClass('incorrecto');
            $('#correcto2').addClass('incorrecto');
            $('#regUsu,#ediDatAcc').prop('disabled', true);
            
        }
        if(valor1 != valor2){

            div.text('No coinciden las contraseñas');
            $('#correcto1').removeClass('correcto');
            $('#correcto2').removeClass('correcto');
            $('#correcto1').addClass('incorrecto');
            $('#correcto2').addClass('incorrecto');
            $('#regUsu,#ediDatAcc').prop('disabled', true);
            
        }
        if(valor1.length<7){
            
            div.text('La contraseña tiene que se mayor a 6 caracteres');
            $('#correcto1').removeClass('correcto');
            $('#correcto2').removeClass('correcto');
            $('#correcto1').addClass('incorrecto');
            $('#correcto2').addClass('incorrecto');
            $('#regUsu,#ediDatAcc').prop('disabled', true);
            
            
        }else{
            if(valor1.length!=0 && valor1==valor2){
                
                div.hide();
                $('#correcto1').removeClass('incorrecto');
                $('#correcto1').addClass('correcto');
                $('#correcto2').removeClass('incorrecto');
                $('#correcto2').addClass('correcto');
                $('#regUsu,#ediDatAcc').prop('disabled', false);
                
            }
        }

    }
    //ejecuto la función al soltar la tecla
    $("#password2, #password1").keyup(function(){

        coincidePassword();

    });
    //Fin confirmacion de la contraseña
    //Funcion que pasa los datos para el registro de usuario
    $(document).on("click","#regUsu",function(){
        
                var nombre= $('#nombre').val();
                var apellido= $('#apellido').val();
                var tipDoc= $('#tipDoc').val();
                var telefono= $('#telefono').val();
                var correo= $('#correo').val();
                var password= $('#password2').val();
                var password1= $('#password1').val();
                var documento= $('#documento').val();
                var url= $('#regUsu').attr('data-url');
        
            if((nombre)&&(apellido)&&(tipDoc!=="#")&&(telefono)&&(correo)&&(password)&&(documento)){
                
                    var patt = new RegExp(/^[\S][A-Za-z0-9ñÑ\s]{5,50}$/g);
                    var patt1 = new RegExp(/^[\S][A-Za-z0-9ñÑ\s]{5,50}$/g);
                    var patt2 = new RegExp(/^[\S][0-9/\s]{6,50}$/g);
                    var patt3 = new RegExp(/^[\S][0-9/\s]{8,15}$/g);
                    var patt4 = new RegExp(/^[\S][a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/);
                    
                    var nombreUsu = patt.test(nombre);
                    var apellidoUsu= patt1.test(apellido);                    
                    var telefonoUsu= patt2.test(telefono);
                    var documentoUsu= patt3.test(documento);
                    var correoUsu= patt4.test(correo);
                
                if( (nombreUsu)&&(apellidoUsu)&&(telefonoUsu)&&(documentoUsu)&&(correoUsu) ){

                    $.ajax({

                        url:url,
                        data:"nombre="+nombre+"&apellido="+apellido+"&tipDoc="+tipDoc+"&telefono="+telefono+"&correo="+correo+"&password="+password+"&documento="+documento,
                        type:"POST",
                        success: function(inf_usu_existe){
                            
                            var existe= JSON.parse(inf_usu_existe);
                            var existe2= existe['total'];
                            
                            //alert(" "+existe['total']);
                            if(existe2==0){
                                $('#alertLogin').html('<div class="alert alert-success alert-dismissible fade show text-center" role="alert">\n\
                                                Registro exitoso\n\
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                                    <span aria-hidden="true">&times;\n\
                                                    </span>\n\
                                                </button>\n\
                                            </div>');
                                setTimeout(function(){ 
                                    window.location.href="index.php?modulo=Usuario&controlador=Login&funcion=login";
                                },1000);
                            }else{
                                $('#alertLogin').html('<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">\n\
                                                Los datos ingresados ya estan registrados.\n\
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                                    <span aria-hidden="true">&times;\n\
                                                    </span>\n\
                                                </button>\n\
                                            </div>');
                                /*setTimeout(function(){ 
                                    window.location.href="index.php?modulo=Usuario&controlador=Login&funcion=crear";
                                },4000);*/
                                $("#nombreCrearUsuario").removeClass("rojoNoValido");
                                $("#apellidoCrearUsuario").removeClass("rojoNoValido");
                                $("#tipoDocumentoUsuario").removeClass("rojoNoValido");
                                $("#telefonoCrearUsuario").removeClass("rojoNoValido");
                                $("#contrasenaCrearUsuario").removeClass("rojoNoValido");
                                $("#confirmeContrasenaUsuario").removeClass("rojoNoValido");
                                
                                if(existe2==3){
                                    $("#numeroDocumentoUsuario").addClass("rojoNoValido");
                                    $("#emailCrearUsuario").addClass("rojoNoValido");
                                }else if(existe2==1){
                                    $("#numeroDocumentoUsuario").removeClass("rojoNoValido");
                                    $("#emailCrearUsuario").addClass("rojoNoValido");
                                }else if(existe2==2){
                                    $("#numeroDocumentoUsuario").addClass("rojoNoValido");
                                    $("#emailCrearUsuario").removeClass("rojoNoValido");
                                }
                                
                            }
                            
                        }
                        
                    });

                }else{

                    $('#alertLogin').html('<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">\n\
                                        Los datos ingresados no corresponden al formato que es solicitado.\n\
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                            <span aria-hidden="true">&times;\n\
                                            </span>\n\
                                        </button>\n\
                                    </div>');
                    /*setTimeout(function(){
                        location.reload();
                    },4000);*/
                
                    if(nombreUsu){
                        $("#nombreCrearUsuario").removeClass("rojoNoValido");
                    }else{
                        $("#nombreCrearUsuario").addClass("rojoNoValido");
                    }
                    if(apellidoUsu){
                        $("#apellidoCrearUsuario").removeClass("rojoNoValido");
                    }else{
                        $("#apellidoCrearUsuario").addClass("rojoNoValido");
                    }
                    if(tipDoc!=="#"){
                        $("#tipoDocumentoUsuario").removeClass("rojoNoValido");
                    }else{
                        $("#tipoDocumentoUsuario").addClass("rojoNoValido");
                    }
                    if(telefonoUsu){
                        $("#telefonoCrearUsuario").removeClass("rojoNoValido");
                    }else{
                        $("#telefonoCrearUsuario").addClass("rojoNoValido");
                    }
                    if(correoUsu){
                        $("#emailCrearUsuario").removeClass("rojoNoValido");
                    }else{
                        $("#emailCrearUsuario").addClass("rojoNoValido");
                    }
                    if(documentoUsu){
                        $("#numeroDocumentoUsuario").removeClass("rojoNoValido");
                    }else{
                        $("#numeroDocumentoUsuario").addClass("rojoNoValido");
                    }
                    
                    if(password){
                        $("#contrasenaCrearUsuario").removeClass("rojoNoValido");
                    }else{
                        $("#contrasenaCrearUsuario").addClass("rojoNoValido");
                    }
                    if(password1){
                        $("#confirmeContrasenaUsuario").removeClass("rojoNoValido");
                    }else{
                        $("#confirmeContrasenaUsuario").addClass("rojoNoValido");
                    }
                    
                }
                
            }else{
       
                $('#alertLogin').html('<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">\n\
                                        Todos los campos con * son obligatorios\n\
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                            <span aria-hidden="true">&times;\n\
                                            </span>\n\
                                        </button>\n\
                                    </div>');
            
                    if(nombre){
                        $("#nombreCrearUsuario").removeClass("rojoNoValido");
                    }else{
                        $("#nombreCrearUsuario").addClass("rojoNoValido");
                    }
                    if(apellido){
                        $("#apellidoCrearUsuario").removeClass("rojoNoValido");
                    }else{
                        $("#apellidoCrearUsuario").addClass("rojoNoValido");
                    }
                    if(tipDoc!=="#"){
                        $("#tipoDocumentoUsuario").removeClass("rojoNoValido");
                    }else{
                        $("#tipoDocumentoUsuario").addClass("rojoNoValido");
                    }
                    if(telefono){
                        $("#telefonoCrearUsuario").removeClass("rojoNoValido");
                    }else{
                        $("#telefonoCrearUsuario").addClass("rojoNoValido");
                    }
                    if(correo){
                        $("#emailCrearUsuario").removeClass("rojoNoValido");
                    }else{
                        $("#emailCrearUsuario").addClass("rojoNoValido");
                    }
                    if(documento){
                        $("#numeroDocumentoUsuario").removeClass("rojoNoValido");
                    }else{
                        $("#numeroDocumentoUsuario").addClass("rojoNoValido");
                    }
                    if(password){
                        $("#contrasenaCrearUsuario").removeClass("rojoNoValido");
                    }else{
                        $("#contrasenaCrearUsuario").addClass("rojoNoValido");
                    }
                    if(password1){
                        $("#confirmeContrasenaUsuario").removeClass("rojoNoValido");
                    }else{
                        $("#confirmeContrasenaUsuario").addClass("rojoNoValido");
                    }
                    
            }
        
    });
    //Funcion que pasa los datos para la edicion de los datos de usuario
    $(document).on("click","#ediUsuInf",function(){
        
        var nombre= $('#nombre').val();
        var apellido= $('#apellido').val();
        var tipDoc= $('#tipDoc').val();
        var numDoc= $('#documento').val();
        var telefono= $('#telefono').val();
        
        var url= $('#ediUsuInf').attr('data-url');
        
        if((nombre)&&(apellido)&&(tipDoc)&&(numDoc)&&(telefono)&&(url)){
            
                    var patt = new RegExp(/^[\S][A-Za-zñÑáéíóúÁÉÍÓÚ\s]{5,50}$/g);
                    var patt1 = new RegExp(/^[\S][A-Za-zñÑáéíóúÁÉÍÓÚ\s]{5,50}$/g);
                    var patt2 = new RegExp(/^[\S][0-9/\s]{8,50}$/g);
                    var patt3 = new RegExp(/^[\S][0-9/\s]{8,15}$/g);

                    var nombreUsu = patt.test(nombre);
                    var apellidoUsu= patt1.test(apellido);                    
                    var telefonoUsu= patt2.test(telefono);
                    var documentoUsu= patt3.test(numDoc);
                    
            if( (nombreUsu)&&(apellidoUsu)&&(documentoUsu)&&(telefonoUsu) ){
                
                $.ajax({

                    url:url,
                    data:"nombre="+nombre+"&apellido="+apellido+"&tipDoc="+tipDoc+"&numDoc="+numDoc+"&telefono="+telefono,
                    type:"POST",
                    success: function(){
                        
                        $('#setAlertDatos').html('<div class="alert alert-success alert-dismissible fade show text-center" role="alert">\n\
                                    Edicion exitosa.\n\
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                        <span aria-hidden="true">&times;\n\
                                        </span>\n\
                                    </button>\n\
                                </div>');
                        setTimeout(function(){ 
                                window.location.href="index.php?modulo=Usuario&controlador=Usuario&funcion=infUsuario";
                        },3000);
                        
                        $("#nombreUsuario").removeClass("rojoNoValido");
                        $("#apellidoUsuario").removeClass("rojoNoValido");
                        $("#numeroDocumento").removeClass("rojoNoValido");
                        $("#telefonoCelular").removeClass("rojoNoValido");
                        
                    }
                });
                
            }else{
                $('#setAlertDatos').html('<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">\n\
                                    Los datos ingresados no corresponden al formato que es solicitado.\n\
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                        <span aria-hidden="true">&times;\n\
                                        </span>\n\
                                    </button>\n\
                                </div>');
                
                    if(nombreUsu){
                        $("#nombreUsuario").removeClass("rojoNoValido");
                    }else{
                        $("#nombreUsuario").addClass("rojoNoValido");
                    }
                    if(apellidoUsu){
                        $("#apellidoUsuario").removeClass("rojoNoValido");
                    }else{
                        $("#apellidoUsuario").addClass("rojoNoValido");
                    }
                    if(documentoUsu){
                        $("#numeroDocumento").removeClass("rojoNoValido");
                    }else{
                        $("#numeroDocumento").addClass("rojoNoValido");
                    }
                    if(telefonoUsu){
                        $("#telefonoCelular").removeClass("rojoNoValido");
                    }else{
                        $("#telefonoCelular").addClass("rojoNoValido");
                    }
                    
            }
        }else{
            $('#setAlertDatos').html('<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">\n\
                                    Todos los campos con * son obligatorios\n\
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                        <span aria-hidden="true">&times;\n\
                                        </span>\n\
                                    </button>\n\
                                </div>');
                    if(nombre){
                        $("#nombreUsuario").removeClass("rojoNoValido");
                    }else{
                        $("#nombreUsuario").addClass("rojoNoValido");
                    }
                    if(apellido){
                        $("#apellidoUsuario").removeClass("rojoNoValido");
                    }else{
                        $("#apellidoUsuario").addClass("rojoNoValido");
                    }
                    if(tipDoc){
                        $("#tipoDocumento").removeClass("rojoNoValido");
                    }else{
                        $("#tipoDocumento").addClass("rojoNoValido");
                    }
                    if(numDoc){
                        $("#numeroDocumento").removeClass("rojoNoValido");
                    }else{
                        $("#numeroDocumento").addClass("rojoNoValido");
                    }
                    if(telefono){
                        $("#telefonoCelular").removeClass("rojoNoValido");
                    }else{
                        $("#telefonoCelular").addClass("rojoNoValido");
                    }
        }
        
    });
    //Funcion que edita los datos de acceso del usuario
    $(document).on("click","#ediDatAcc",function(){
        
        var correo= $('#correo').val();
        var password1= $('#password1').val();
        var password2= $('#password2').val();
        var url= $('#ediDatAcc').attr('data-url');
                
        if((password1)&&(password2)&&(correo)&&(url)){
            
            var patt4 = new RegExp(/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/);

            var correoUsu= patt4.test(correo);
            
            if(correoUsu){
            
                $.ajax({
                    url:url,
                    data:"email="+correo+"&password="+password2,
                    type:"POST",
                    success: function(int_correo_existe){
                        
                        var corExiste= JSON.parse(int_correo_existe);
                        var corExis= corExiste.total;
                        
                        $("#confirmeContrasena").removeClass("rojoNoValido");
                        $("#nuevaContrasena").removeClass("rojoNoValido");
                        $("#emailUsuario").removeClass("rojoNoValido");
                        
                        if(corExis==0){
                            $('#setAlertDatos').html('<div class="alert alert-success alert-dismissible fade show text-center" role="alert">\n\
                                        Edicion exitosa.\n\
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                            <span aria-hidden="true">&times;\n\
                                            </span>\n\
                                        </button>\n\
                                    </div>');
                            setTimeout(function(){ 
                                    window.location.href="index.php?modulo=Usuario&controlador=Usuario&funcion=infUsuario";
                            },3000);
                            
                            
                            
                        }else{
                            $('#setAlertDatos').html('<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">\n\
                                        El correo ya esta registrado.\n\
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                            <span aria-hidden="true">&times;\n\
                                            </span>\n\
                                        </button>\n\
                                    </div>');
                            if(corExis==0){
                                $("#emailUsuario").removeClass("rojoNoValido");
                            }else{
                                $("#emailUsuario").addClass("rojoNoValido");
                            }
                            
                        }
                        
                    }
                    
                });
                
           }else{
               $('#setAlertDatos').html('<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">\n\
                                    Los datos ingresados no corresponden al formato que es solicitado.\n\
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                        <span aria-hidden="true">&times;\n\
                                        </span>\n\
                                    </button>\n\
                                </div>');
                    
                    if(correoUsu){
                        $("#emailUsuario").removeClass("rojoNoValido");
                    }else{
                        $("#emailUsuario").addClass("rojoNoValido");
                    }
                    $("#nuevaContrasena").removeClass("rojoNoValido");
                    $("#confirmeContrasena").removeClass("rojoNoValido");
                    
            }    
        }else{
            $('#setAlertDatos').html('<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">\n\
                                    Todos los campos con * son obligatorios\n\
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                        <span aria-hidden="true">&times;\n\
                                        </span>\n\
                                    </button>\n\
                                </div>');
                    
                    if(correo){
                        $("#emailUsuario").removeClass("rojoNoValido");
                    }else{
                        $("#emailUsuario").addClass("rojoNoValido");
                    }
                    if(password1){
                        $("#nuevaContrasena").removeClass("rojoNoValido");
                    }else{
                        $("#nuevaContrasena").addClass("rojoNoValido");
                    }
                    if(password2){
                        $("#confirmeContrasena").removeClass("rojoNoValido");
                    }else{
                        $("#confirmeContrasena").addClass("rojoNoValido");
                    }
        }
        
    });
    
    $(document).on("click","#recuperar_cuenta",function(){
        
        var correo= $("#correo_recuperacion").val();
        var url= $("#rutaRecuperacion").attr('data-url');
        if(correo){
            $.ajax({
                url:url,
                data:"codigo="+correo,
                type:"POST",
                success: function(inf_NoExiste){
                    
                    var NoExiste= JSON.parse(inf_NoExiste);
                    var Existe= NoExiste.existe;
                    alert("llego");
                    if(Existe!=0){
                        $('#alertLogin').html('<div class="alert alert-success alert-dismissible fade show text-center" role="alert">\n\
                                                        Cuenta recuperada. Comuniquese a soporte para mayor informacion.\n\
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                                            <span aria-hidden="true">&times;\n\
                                                            </span>\n\
                                                        </button>\n\
                                                    </div>');
                    }else{
                         $('#alertLogin').html('<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">\n\
                                                        Las datos son incorrectos o no corresponden a una cuenta existente.\n\
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                                            <span aria-hidden="true">&times;\n\
                                                            </span>\n\
                                                        </button>\n\
                                                    </div>');
                        
                    }
                
                }
            });
        }
    });
    
});