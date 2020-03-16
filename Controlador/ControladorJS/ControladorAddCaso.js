$(document).ready(function(){
    // Funcion que pone el PICKER y le añade el buscador
    $('.ex-events').picker({
        search : true
    });
    // Funcion que pone los caso de prueba que se califican en el formulario de pruebas
    $('#ex-events').on("sp-change",function(){
        
        var codigo= $('#ex-events').val();
        var codigoPrueba= $("#pruebaProcesoIDRegistrada").val();
        
        var existeCaso;
        if($("#"+codigo).length > 0){
            existeCaso=0; 
        }else{
            existeCaso=1; 
        }
        
        if((codigo!=="#")&&(existeCaso!=0)){
            
            var url= $('#ex-events').attr('data-url');
            
            $.ajax({
                url:url,
                data:"codigo="+codigo+"&codigoPrueba="+codigoPrueba,
                type:"POST",
                success: function(inf_operacion){
                    
                    var urlInformacion="ajax.php?modulo=Prueba&controlador=Prueba&funcion=casoPruebaInformacion";
                    var operacion= JSON.parse(inf_operacion);
                    
                    if(operacion['operacion']==2){
                        
                        $.ajax({
                            url:urlInformacion,
                            data:"codigo="+codigo,
                            type:"POST",
                            success: function(inf_casoPrueba){
                                
                                var caso= JSON.parse(inf_casoPrueba);
                     
                                var fila=  '<tr class="agrCasPru comun ocultate'+caso[0]+'" id="'+caso[0]+'">\n\
                                                <td class="text-justify">\n\
                                                    <div id="nombreCaso'+caso[0]+'" type="text" class="form-control comun" style="margin-bottom:5px;" >'+caso[1]+'</div>\n\
                                                </td>\n\
                                                <td align="center" style="width: 15px">\n\
                                                    <label for="si'+caso[0]+'1" class="caramelo" ><img class="ncnszBig mano" id="aprobadosi'+caso[0]+'1" src="./media-record.svg"></label>\n\
                                                    <input class="boxcheckk" style="display:none;" id="si'+caso[0]+'1" type="checkbox" name="" value="1" />\n\
                                                </td>\n\
                                                <td align="center" style="width: 15px">\n\
                                                    <label for="si'+caso[0]+'0" class="caramelo" ><img class="ncnszBig mano" id="noAprobadosi'+caso[0]+'0" src="./media-record.svg"></label>\n\
                                                    <input class="boxcheckk" style="display:none;" id="si'+caso[0]+'0" type="checkbox" name="" value="2" />\n\
                                                </td>\n\
                                                <td align="center" >\n\
                                                    <button type="button" class="btn btn-rojo eli_casPru" id="eliCaso'+caso[0]+'Pru" title="Eliminar" style="font-weight:bold; color:red; height:30px; width:30px; border-radius:50%;"></button>\n\
                                                    <input type="hidden" class="exitenCasoParaEvaluar" name="prueba[]" value="'+caso[0]+'">\n\
                                                    <input type="hidden" id="updateORInsert'+caso[0]+'" name="queHacer" value="2">\n\
                                                </td>\n\
                                            </tr>\n\
                                            <tr class="ocultate'+caso[0]+'" id="globalId'+caso[0]+'">\n\
                                                <td style="border-top:hidden;">\n\
                                                    <div style="position:relative; top:-17px" class="oculto" id="addNote'+caso[0]+'90"><img style="width: 30px;" class="mano agregarNotaAlCaso" data-codigo="1" id="addNoteCaja'+caso[0]+'900" src="../Lib/open-iconic-master/svg/icon-icons.com.svg" > \n\
                                                            Agregar una anotacion.  \n\
                                                            <img data-toggle="modal" data-toggle="tooltip" title="Ver descripcion" data-target="#modDetCas" style="width: 32px; position:relative; left:565px;" data-codigo="'+caso[0]+'" class="ncnszRemove mano OjoDescripcion" src="../Lib/open-iconic-master/svg/zenmap.svg">\n\
                                                    </div>\n\
                                                    <div style="position:relative; top:-17px;" class="comun oculto" id="argussi'+caso[0]+'80"><img style="width: 30px;" class="ncnszRemove" src="../Lib/open-iconic-master/svg/senalTransito.svg"> ¿Por que el caso de prueba no fue aprobado?* <img data-toggle="modal" data-toggle="tooltip" title="Ver descripcion" data-target="#modDetCas" style="width: 32px; position:relative; left:442px;" data-codigo="'+caso[0]+'" class="ncnszRemove mano OjoDescripcion" src="../Lib/open-iconic-master/svg/zenmap.svg"></div>\n\
                                                    <div><img data-toggle="modal" data-toggle="tooltip" title="Ver descripcion" data-target="#modDetCas" style="width: 32px; position:relative; left:723px; top:-17px;" id="ocultaOJO'+caso[0]+'" data-codigo="'+caso[0]+'" class="ncnszRemove mano OjoDescripcion" src="../Lib/open-iconic-master/svg/zenmap.svg"></div>\n\
                                                    <textarea class="form-control comun oculto" id="addNotaCaja'+caso[0]+'85" name="comentario" ></textarea>\n\
                                                    <textarea class="form-control comun oculto" id="argumentosi'+caso[0]+'85" name="argumento" ></textarea>\n\
                                                </td>\n\
                                                <td colspan="3" align="center" >\n\
                                                    <input type="button" data-codigo="'+caso[0]+'" id="yaGuardoCasoPruebaBloquea'+caso[0]+'" class="btn btn-azul btn-block labelCP guardarCasoIndependiente" value="Guardar caso de prueba">\n\
                                                </td>\n\
                                            </tr>';
                        
                                $('.bodyCasPrueba').append(fila);
                                
                                $('#setAlertPrueb').html('<div class="alert alert-primary alert-dismissible fade show text-center" role="alert">\n\
                                            El caso de prueba no esta aprobado. #'+caso[0]+'\n\
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                                <span aria-hidden="true">&times;\n\
                                                </span>\n\
                                            </button>\n\
                                        </div>');
                                
                            }
                        });
                        
                        
                    }else if(operacion['operacion']==3){
                        
                        $('#setAlertPrueb').html('<div class="alert alert-primary alert-dismissible fade show text-center" role="alert">\n\
                                            El caso de prueba ya fue evaluado como aprobado.\n\
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                                <span aria-hidden="true">&times;\n\
                                                </span>\n\
                                            </button>\n\
                                        </div>');
                        
                    }else if(operacion['operacion']==4){
                        
                        $.ajax({
                            url:urlInformacion,
                            data:"codigo="+codigo,
                            type:"POST",
                            success: function(inf_casoPrueba){
                                
                                var caso= JSON.parse(inf_casoPrueba);
                                
                                var fila=  '<tr class="agrCasPru comun ocultate'+caso[0]+'" id="'+caso[0]+'">\n\
                                                <td class="text-justify">\n\
                                                    <div id="nombreCaso'+caso[0]+'" type="text" class="form-control comun" style="margin-bottom:5px;" >'+caso[1]+'</div>\n\
                                                </td>\n\
                                                <td align="center" style="width: 15px">\n\
                                                    <label for="si'+caso[0]+'1" class="caramelo" ><img class="ncnszBig mano" id="aprobadosi'+caso[0]+'1" src="./media-record.svg"></label>\n\
                                                    <input class="boxcheckk" style="display:none;" id="si'+caso[0]+'1" type="checkbox" name="" value="1" />\n\
                                                </td>\n\
                                                <td align="center" style="width: 15px">\n\
                                                    <label for="si'+caso[0]+'0" class="caramelo" ><img class="ncnszBig mano" id="noAprobadosi'+caso[0]+'0" src="./media-record.svg"></label>\n\
                                                    <input class="boxcheckk" style="display:none;" id="si'+caso[0]+'0" type="checkbox" name="" value="2" />\n\
                                                </td>\n\
                                                <td align="center" >\n\
                                                    <button type="button" class="btn btn-rojo eli_casPru" id="eliCaso'+caso[0]+'Pru" title="Eliminar" style="font-weight:bold; color:red; height:30px; width:30px; border-radius:50%;"></button>\n\
                                                    <input type="hidden" class="exitenCasoParaEvaluar" name="prueba[]" value="'+caso[0]+'">\n\
                                                    <input type="hidden" id="updateORInsert'+caso[0]+'" name="queHacer" value="4">\n\
                                                </td>\n\
                                            </tr>\n\
                                            <tr class="ocultate'+caso[0]+'" id="globalId'+caso[0]+'">\n\
                                                <td style="border-top:hidden;">\n\
                                                    <div style="position:relative; top:-17px" class="oculto" id="addNote'+caso[0]+'90"><img style="width: 30px;" class="mano agregarNotaAlCaso" data-codigo="1" id="addNoteCaja'+caso[0]+'900" src="../Lib/open-iconic-master/svg/icon-icons.com.svg" > \n\
                                                            Agregar una anotacion.  \n\
                                                            <img data-toggle="modal" data-toggle="tooltip" title="Ver descripcion" data-target="#modDetCas" style="width: 32px; position:relative; left:565px;" data-codigo="'+caso[0]+'" class="ncnszRemove mano OjoDescripcion" src="../Lib/open-iconic-master/svg/zenmap.svg">\n\
                                                    </div>\n\
                                                    <div style="position:relative; top:-17px;" class="comun oculto" id="argussi'+caso[0]+'80"><img style="width: 30px;" class="ncnszRemove" src="../Lib/open-iconic-master/svg/senalTransito.svg"> ¿Por que el caso de prueba no fue aprobado?* <img data-toggle="modal" data-toggle="tooltip" title="Ver descripcion" data-target="#modDetCas" style="width: 32px; position:relative; left:442px;" data-codigo="'+caso[0]+'" class="ncnszRemove mano OjoDescripcion" src="../Lib/open-iconic-master/svg/zenmap.svg"></div>\n\
                                                    <div><img data-toggle="modal" data-toggle="tooltip" title="Ver descripcion" data-target="#modDetCas" style="width: 32px; position:relative; left:723px; top:-17px;" id="ocultaOJO'+caso[0]+'" data-codigo="'+caso[0]+'" class="ncnszRemove mano OjoDescripcion" src="../Lib/open-iconic-master/svg/zenmap.svg"></div>\n\
                                                    <textarea class="form-control comun oculto" id="addNotaCaja'+caso[0]+'85" name="comentario" ></textarea>\n\
                                                    <textarea class="form-control comun oculto" id="argumentosi'+caso[0]+'85" name="argumento" ></textarea>\n\
                                                </td>\n\
                                                <td colspan="3" align="center" >\n\
                                                    <input type="button" data-codigo="'+caso[0]+'" id="yaGuardoCasoPruebaBloquea'+caso[0]+'" class="btn btn-azul btn-block labelCP guardarCasoIndependiente" value="Guardar caso de prueba">\n\
                                                </td>\n\
                                            </tr>';
                        
                                $('.bodyCasPrueba').append(fila);
                            
                            }
                        });
                        
                    }
                    
                }
            });
        }
    });
    // Funcion que remueve los casos de prueba que se califican en el formulario de pruebas
    $(document).on("click",".eli_casPru",function(){
        
        var idCasoEli= $(this).attr('id');
        var idCaso= idCasoEli.slice(7,-3);
        var idEnd= "globalId"+idCaso;
        
        var codigoLlave= $("#probarCasosAsociadosAProbar").attr('data-codigo');
        var urlEliminar= $("#urlParaAsociarCasoAPruebaEliminar").attr('data-url');
        var codigoPrueba= $("#pruebaProcesoIDRegistrada").val();
        
        alert(codigoPrueba,urlEliminar);
        if(codigoLlave==1){
            
            $.ajax({
                url:urlEliminar,
                data:"codigoCaso="+idCaso+"&codigoPrueba="+codigoPrueba,
                type:"POST",
                success: function(){
                    console.log("El caso se elimino de la base de datos");
                }
            });
            
        }else if(codigoLlave==3){
            
            $.ajax({
                url:urlEliminar,
                data:"codigoCaso="+idCaso+"&codigoPrueba="+codigoPrueba+"&codigoQueHacer="+codigoLlave,
                type:"POST",
                success: function(){
                    console.log("El caso se elimino de la base de datos");
                }
            });
            
        }else{
            
            console.log("El caso se elimina de la tabla no de la base de datos");
            
        }
        
        $("#"+idEnd).remove();
        $(this).parent().parent().remove();
        
    });
    //Variable que permite hacer visible la notas
    var agregarNota;
    //varible que permitira poner la caja de argumentacion
    var argumento;
    //Variables globales de las cajas de text
    var idBox1;
    var idBox0;
    // Funcion que permite que se selcione solo un Checkbox
    $(document).on("click",".boxcheckk",function(){
        
        var num= $(this).attr("id");
        
        //le paso el numero a argumento
        argumento=num;
        
        var num2= num.slice(0, -1);
       
        idBox1=  num2 + "1";
        idBox0=  num2 + "0";
        
        //le paso el numero a agregarNota
        agregarNota= num.slice(2, -1);
        
        $(document).on('click',"#"+idBox0,function(){
            
            $("#"+idBox1).prop('checked', false);
            
            $("#"+idBox0).prop('checked', true);
           
        });
        
        $(document).on('click',"#"+idBox1,function(){
            
            $("#"+idBox1).prop('checked', true);
            
            $("#"+idBox0).prop('checked', false);

        });
       
    });
    //JQuery que se encarga de poner y retirar la clase (oculta) de la caja de argumento. JQuery que se encarga de otras cosas que pondre.
    $(document).on("click",".caramelo",function(){
        
            setTimeout(function(){

                var numeroX= argumento.slice(0,-1);
                var numeroJ= argumento.slice(0,-1);
                
                var numeroY=  numeroX + "1";
                var numeroL=  numeroX + "0";
                var numero85= "argumento"+numeroJ + "85";
                var numero80= "argus"+numeroJ + "80";
                //alert(numero85);
                if($("#"+numeroY).is(':checked')){
                    
                    $("#"+numero85).addClass('oculto');
                    $("#"+numero80).addClass('oculto');
                    $("#addNote"+agregarNota+"90").removeClass('oculto');
                    $("#ocultaOJO"+agregarNota).addClass('oculto');
                    //Remplazo de la imagenes en la evaluacion de las calificaciones
                    
                }else{
                    
                    $("#"+numero85).removeClass('oculto');
                    $("#"+numero80).removeClass('oculto');
                    $("#addNote"+agregarNota+"90").addClass('oculto');
                    var agregarComentario='<div style="position:relative; top:-17px" class="oculto" id="addNote'+agregarNota+'90"><img style="width: 30px;" class="agregarNotaAlCaso mano" data-codigo="1" id="addNoteCaja'+agregarNota+'900" src="../Lib/open-iconic-master/svg/icon-icons.com.svg" > \n\
                                                    Agregar una anotacion.  \n\
                                                    <img data-toggle="modal" data-toggle="tooltip" title="Ver descripcion" data-target="#modDetCas" style="width: 32px; position:relative; left:565px;" data-codigo="'+agregarNota+'" class="ncnszRemove mano OjoDescripcion" src="../Lib/open-iconic-master/svg/zenmap.svg">\n\
                                            </div>';
                    $("#addNote"+agregarNota+"90").replaceWith(agregarComentario);
                    $("#addNotaCaja"+agregarNota+"85").addClass('oculto');
                    $("#ocultaOJO"+agregarNota).addClass('oculto');
                    //Remplazo de la imagenes en la evaluacion de las calificaciones
                    
                }
                
                $("#noAprobado"+idBox0).replaceWith('<img class="ncnszBig mano" id="aprobado'+idBox0+'" src="./media-record.svg">');
                $("#aprobado"+idBox1).replaceWith('<img class="mano" style="width:22px;" id="noAprobado'+idBox1+'" src="./checkmark.svg">');
                
                if($("#"+numeroL).is(':checked')){
                    
                    $("#noAprobado"+idBox1).replaceWith('<img class="ncnszBig mano" id="aprobado'+idBox1+'" src="./media-record.svg">');
                    $("#aprobado"+idBox0).replaceWith('<img class="mano" style="width:22px;" id="noAprobado'+idBox0+'" src="./letterx.svg">');
                    
                }

            },10);
        
    });
    
    //JQuery que se encarga de tomar el dato id de la prueba que se eliminara y lo almacena en la variable global(idProPru).
    var idProPru;
    $(document).on("click","#eliProPru",function(){
        idProPru= $(this).attr('data-codigo');
    });
    
    //JQuery que se encarga de eliminar la prueba junto con sus casos de prueba y notificaciones.
    $(document).on("click","#eliProPruConfirm",function(){
        
        var codigo= idProPru;
        var url= $('#eliProPru').attr('data-url');
        
        $.ajax({
           url:url,
           data:"codigo="+codigo,
           type:"POST",
           success: function(){
               window.location.href="index.php?modulo=Prueba&controlador=Prueba&funcion=listar";
           }
        });
        
    });
    
    //JQuery que se encarga de traer todos los casos de prueba segun el modulo seleccionado.
    $(document).on("click",".casosPorModulo",function(){
        
        var modulo= $(".modulo").val();
        var url= $("#urlCasoModulo").attr('data-url');
        
        var codigoLlave= $("#probarCasosAsociadosAProbar").attr('data-codigo');
        var codigoPrueba= $("#pruebaProcesoIDRegistrada").val();
        var urlAddAllCaseTest= $("#urlParaAsociarCasoAPruebaTodos").attr('data-url');
        
        var codigoMaestro= $(".casosPorModulo").attr('data-codigo');
        
        if(modulo!="#"){
            
            $("#tituloModulo").removeClass("rojoNoValido");
            
            if(codigoMaestro==0){
                
                $.ajax({
                    url:url,
                    data:"codigo7="+modulo,
                    type:"POST",
                    success: function(inf_casoModulo){

                        var casoModulo= JSON.parse(inf_casoModulo);

                        $.each(casoModulo, function (i,element) {

                            for (i in element) {

                                var existeCaso;
                                if($("#"+element[i].id_cas_pru).length > 0){
                                    existeCaso=0; 
                                }else{
                                    existeCaso=1; 
                                }
                                if(existeCaso!=0){

                                    var fila=  '<tr class="agrCasPru comun ocultate'+element[i].id_cas_pru+'" id="'+element[i].id_cas_pru+'">\n\
                                                <td class="text-justify">\n\
                                                    <div id="nombreCaso'+element[i].id_cas_pru+'" type="text" class="form-control comun" style="margin-bottom:5px;" >'+element[i].nombre_caso+'</div>\n\
                                                </td>\n\
                                                <td align="center" style="width: 15px">\n\
                                                    <label for="si'+element[i].id_cas_pru+'1" class="caramelo" ><img class="ncnszBig mano" id="aprobadosi'+element[i].id_cas_pru+'1" src="./media-record.svg"></label>\n\
                                                    <input class="boxcheckk" style="display:none;" id="si'+element[i].id_cas_pru+'1" type="checkbox" name="" value="1" />\n\
                                                </td>\n\
                                                <td align="center" style="width: 15px">\n\
                                                    <label for="si'+element[i].id_cas_pru+'0" class="caramelo" ><img class="ncnszBig mano" id="noAprobadosi'+element[i].id_cas_pru+'0" src="./media-record.svg"></label>\n\
                                                    <input class="boxcheckk" style="display:none;" id="si'+element[i].id_cas_pru+'0" type="checkbox" name="" value="2" />\n\
                                                </td>\n\
                                                <td align="center" >\n\
                                                    <button type="button" class="btn btn-rojo eli_casPru" id="eliCaso'+element[i].id_cas_pru+'Pru" title="Eliminar" style="font-weight:bold; color:red; height:30px; width:30px; border-radius:50%;"></button>\n\
                                                    <input type="hidden" class="exitenCasoParaEvaluar" name="prueba[]" value="'+element[i].id_cas_pru+'">\n\
                                                    <input type="hidden" id="updateORInsert'+element[i].id_cas_pru+'" name="queHacer" value="4">\n\
                                                </td>\n\
                                            </tr>\n\
                                            <tr class="ocultate'+element[i].id_cas_pru+'" id="globalId'+element[i].id_cas_pru+'">\n\
                                                <td style="border-top:hidden;">\n\
                                                    <div style="position:relative; top:-17px" class="oculto" id="addNote'+element[i].id_cas_pru+'90"><img style="width: 30px;" class="mano agregarNotaAlCaso" data-codigo="1" id="addNoteCaja'+element[i].id_cas_pru+'900" src="../Lib/open-iconic-master/svg/icon-icons.com.svg" > \n\
                                                            Agregar una anotacion.  \n\
                                                            <img data-toggle="modal" data-toggle="tooltip" title="Ver descripcion" data-target="#modDetCas" style="width: 32px; position:relative; left:565px;" data-codigo="'+element[i].id_cas_pru+'" class="ncnszRemove mano OjoDescripcion" src="../Lib/open-iconic-master/svg/zenmap.svg">\n\
                                                    </div>\n\
                                                    <div style="position:relative; top:-17px;" class="comun oculto" id="argussi'+element[i].id_cas_pru+'80"><img style="width: 30px;" class="ncnszRemove" src="../Lib/open-iconic-master/svg/senalTransito.svg"> ¿Por que el caso de prueba no fue aprobado?* <img data-toggle="modal" data-toggle="tooltip" title="Ver descripcion" data-target="#modDetCas" style="width: 32px; position:relative; left:442px;" data-codigo="'+element[i].id_cas_pru+'" class="ncnszRemove mano OjoDescripcion" src="../Lib/open-iconic-master/svg/zenmap.svg"></div>\n\
                                                    <div><img data-toggle="modal" data-toggle="tooltip" title="Ver descripcion" data-target="#modDetCas" style="width: 32px; position:relative; left:723px; top:-17px;" id="ocultaOJO'+element[i].id_cas_pru+'" data-codigo="'+element[i].id_cas_pru+'" class="ncnszRemove mano OjoDescripcion" src="../Lib/open-iconic-master/svg/zenmap.svg"></div>\n\
                                                    <textarea class="form-control comun oculto" id="addNotaCaja'+element[i].id_cas_pru+'85" name="comentario" ></textarea>\n\
                                                    <textarea class="form-control comun oculto" id="argumentosi'+element[i].id_cas_pru+'85" name="argumento" ></textarea>\n\
                                                </td>\n\
                                                <td colspan="3" align="center" >\n\
                                                    <input type="button" data-codigo="'+element[i].id_cas_pru+'" id="yaGuardoCasoPruebaBloquea'+element[i].id_cas_pru+'" class="btn btn-azul btn-block labelCP guardarCasoIndependiente" value="Guardar caso de prueba">\n\
                                                </td>\n\
                                            </tr>';

                                    $('.bodyCasPrueba').append(fila);
                                    
                                }
                            }
                            
                        });

                    }

                });
                
                console.log("CodigoMaestro=0; Trayendo todos los casos asociados al modulo");
                
            }else{
                
                var urlAsociado= $("#traeTodosLosCasosDePruebaYaAsociados").attr('data-url');
                
                $.ajax({
                    url:urlAsociado,
                    data:"codigoPrueba="+codigoPrueba,
                    type:"POST",
                    success: function(informacion_casoAsociado){

                        var casoAsociado= JSON.parse(informacion_casoAsociado);

                        $.each(casoAsociado, function (i,element) {

                            for (i in element) {

                                var existeCaso;
                                if($("#"+element[i].fk_cas_pru).length > 0){
                                    existeCaso=0; 
                                }else{
                                    existeCaso=1; 
                                }
                                if(existeCaso!=0){

                                    var fila=  '<tr class="agrCasPru comun ocultate'+element[i].fk_cas_pru+'" id="'+element[i].fk_cas_pru+'">\n\
                                                <td class="text-justify">\n\
                                                    <div id="nombreCaso'+element[i].fk_cas_pru+'" type="text" class="form-control comun" style="margin-bottom:5px;" >'+element[i].nombre_caso+'</div>\n\
                                                </td>\n\
                                                <td align="center" style="width: 15px">\n\
                                                    <label for="si'+element[i].fk_cas_pru+'1" class="caramelo" ><img class="ncnszBig mano" id="aprobadosi'+element[i].fk_cas_pru+'1" src="./media-record.svg"></label>\n\
                                                    <input class="boxcheckk" style="display:none;" id="si'+element[i].fk_cas_pru+'1" type="checkbox" name="" value="1" />\n\
                                                </td>\n\
                                                <td align="center" style="width: 15px">\n\
                                                    <label for="si'+element[i].fk_cas_pru+'0" class="caramelo" ><img class="ncnszBig mano" id="noAprobadosi'+element[i].fk_cas_pru+'0" src="./media-record.svg"></label>\n\
                                                    <input class="boxcheckk" style="display:none;" id="si'+element[i].fk_cas_pru+'0" type="checkbox" name="" value="2" />\n\
                                                </td>\n\
                                                <td align="center" >\n\
                                                    <button type="button" class="btn btn-rojo eli_casPru" id="eliCaso'+element[i].fk_cas_pru+'Pru" title="Eliminar" style="font-weight:bold; color:red; height:30px; width:30px; border-radius:50%;"></button>\n\
                                                    <input type="hidden" class="exitenCasoParaEvaluar" name="prueba[]" value="'+element[i].fk_cas_pru+'">\n\
                                                    <input type="hidden" id="updateORInsert'+element[i].fk_cas_pru+'" name="queHacer" value="2">\n\
                                                </td>\n\
                                            </tr>\n\
                                            <tr class="ocultate'+element[i].fk_cas_pru+'" id="globalId'+element[i].fk_cas_pru+'">\n\
                                                <td style="border-top:hidden;">\n\
                                                    <div style="position:relative; top:-17px" class="oculto" id="addNote'+element[i].fk_cas_pru+'90"><img style="width: 30px;" class="mano agregarNotaAlCaso" data-codigo="1" id="addNoteCaja'+element[i].fk_cas_pru+'900" src="../Lib/open-iconic-master/svg/icon-icons.com.svg" > \n\
                                                            Agregar una anotacion.  \n\
                                                            <img data-toggle="modal" data-toggle="tooltip" title="Ver descripcion" data-target="#modDetCas" style="width: 32px; position:relative; left:565px;" data-codigo="'+element[i].fk_cas_pru+'" class="ncnszRemove mano OjoDescripcion" src="../Lib/open-iconic-master/svg/zenmap.svg">\n\
                                                    </div>\n\
                                                    <div style="position:relative; top:-17px;" class="comun oculto" id="argussi'+element[i].fk_cas_pru+'80"><img style="width: 30px;" class="ncnszRemove" src="../Lib/open-iconic-master/svg/senalTransito.svg"> ¿Por que el caso de prueba no fue aprobado?* <img data-toggle="modal" data-toggle="tooltip" title="Ver descripcion" data-target="#modDetCas" style="width: 32px; position:relative; left:442px;" data-codigo="'+element[i].fk_cas_pru+'" class="ncnszRemove mano OjoDescripcion" src="../Lib/open-iconic-master/svg/zenmap.svg"></div>\n\
                                                    <div><img data-toggle="modal" data-toggle="tooltip" title="Ver descripcion" data-target="#modDetCas" style="width: 32px; position:relative; left:723px; top:-17px;" id="ocultaOJO'+element[i].fk_cas_pru+'" data-codigo="'+element[i].fk_cas_pru+'" class="ncnszRemove mano OjoDescripcion" src="../Lib/open-iconic-master/svg/zenmap.svg"></div>\n\
                                                    <textarea class="form-control comun oculto" id="addNotaCaja'+element[i].fk_cas_pru+'85" name="comentario" ></textarea>\n\
                                                    <textarea class="form-control comun oculto" id="argumentosi'+element[i].fk_cas_pru+'85" name="argumento" ></textarea>\n\
                                                </td>\n\
                                                <td colspan="3" align="center" >\n\
                                                    <input type="button" data-codigo="'+element[i].fk_cas_pru+'" id="yaGuardoCasoPruebaBloquea'+element[i].fk_cas_pru+'" class="btn btn-azul btn-block labelCP guardarCasoIndependiente" value="Guardar caso de prueba">\n\
                                                </td>\n\
                                            </tr>';

                                    $('.bodyCasPrueba').append(fila);

                                }
                            
                            }

                        });

                    }

                });
                
                console.log("CodigoMaestro=1; Trayendo todos los casos asociados al modulo anteriolmente");
                
            }
            
            if(codigoLlave==1){
            
                $.ajax({
                    url:urlAddAllCaseTest,
                    data:"modulo="+modulo+"&codigoPrueba="+codigoPrueba,
                    type:"POST",
                    success: function(){
                        
                        console.log("Todos los casos fueron agregados a la prueba");

                    }

                });
            
            }
            
        }else{
            
            $('#setAlertPrueb').html('<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">\n\
                                            Seleccione el modulo.\n\
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                                <span aria-hidden="true">&times;\n\
                                                </span>\n\
                                            </button>\n\
                                        </div>');
            
            if(modulo!=="#"){
                $("#tituloModulo").removeClass("rojoNoValido");
            }else{
                $("#tituloModulo").addClass("rojoNoValido");
            }
            
        }
        
    });
    /////////////////////////////////////////////////
    //JQuery que se encarga de guardar la de prueba.
    $(document).on("click","#idPruebaProceso",function(){
        
        var url= $(this).attr("data-url");
        var nombrePrueba= $("#nomPru").val();
        var modulo= $(".modulo").val();
        var asociarOpropia= $(".asociarOpropia").attr('data-codigoAP');
        
        var patt = new RegExp(/^[\S][A-Za-z0-9.,;:ñÑáéíóúÁÉÍÓÚ"'+-_$()\s]{5,200}[\S]$/g);
        var nombrePruebaAceptable = patt.test(nombrePrueba);
        
        if((nombrePrueba)&&(modulo!=="#")){
            
            if(nombrePruebaAceptable){

                $.ajax({
                    url:url,
                    data:"modulo="+modulo+"&nombrePrueba="+nombrePrueba+"&asociarOpropia="+asociarOpropia,
                    type:"POST",
                    success: function(inf_prueba){

                            $("#nombrePrueba").removeClass("rojoNoValido");
                            $("#tituloModulo").removeClass("rojoNoValido");

                            var dato= JSON.parse(inf_prueba);
                            var datoOn= dato['Dato'];

                            if(datoOn==525){

                                $('#setAlertPrueb').html('<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">\n\
                                        El nombre que asigno a la prueba ya esta registrado. Remplaze el nombre para obtener un registro exitoso.\n\
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                            <span aria-hidden="true">&times;\n\
                                            </span>\n\
                                        </button>\n\
                                    </div>');

                                $("#nombrePrueba").addClass("rojoNoValido");

                            }else{

                                $("#pruebaProcesoIDRegistrada").val(datoOn);
                                $("#idPruebaProceso").slideUp('slow');

                                $('#setAlertPrueb').html('<div class="alert alert-success alert-dismissible fade show text-center" role="alert">\n\
                                        Prueba registrada. Continue con la evaluacion o asociacion de los casos de prueba.\n\
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                            <span aria-hidden="true">&times;\n\
                                            </span>\n\
                                        </button>\n\
                                    </div>');

                                $("#nombrePrueba").removeClass("rojoNoValido");
                                $("#tituloModulo").removeClass("rojoNoValido");

                            }

                    }

                });

            }else{

                $('#setAlertPrueb').html('<div class="alert alert-info alert-dismissible fade show text-center" role="alert">\n\
                                            Revise que el nombre no tenga espacios en blanco al inicio o al final.\n\
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                                <span aria-hidden="true">&times;\n\
                                                </span>\n\
                                            </button>\n\
                                        </div>');
                
                if(nombrePruebaAceptable){
                    $("#nombrePrueba").removeClass("rojoNoValido");
                }else{
                    $("#nombrePrueba").addClass("rojoNoValido");
                }
                
                if(modulo!=="#"){
                    $("#tituloModulo").removeClass("rojoNoValido");
                }else{
                    $("#tituloModulo").addClass("rojoNoValido");
                }
                
            }

        }else{

            $('#setAlertPrueb').html('<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">\n\
                                    Todos los campos con * son obligatorios\n\
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                        <span aria-hidden="true">&times;\n\
                                        </span>\n\
                                    </button>\n\
                                </div>');

            if(nombrePrueba){
                $("#nombrePrueba").removeClass("rojoNoValido");
            }else{
                $("#nombrePrueba").addClass("rojoNoValido");
            }
            if(modulo!=="#"){
                $("#tituloModulo").removeClass("rojoNoValido");
            }else{
                $("#tituloModulo").addClass("rojoNoValido");
            }

        }
        
    });
    //JQuery que se encarga de mostrar el textarea para agregar el comentario.
    $(document).on("click",".agregarNotaAlCaso",function(){
        
        var idAddNota= $(this).attr('id');
        var eliminarAgregar= $(this).attr('data-codigo');
        var codigo= idAddNota.slice(11,-3);
        
        if(eliminarAgregar==1){
            $("#addNotaCaja"+codigo+"85").removeClass('oculto');
            var eliminar= '<div style="position:relative; top:-17px" class="" id="addNote'+codigo+'90"><img style="width: 30px;" data-codigo="0" class="mano agregarNotaAlCaso" id="addNoteCaja'+codigo+'900" src="../Lib/open-iconic-master/svg/menos.png" > \n\
                            Eliminar la anotacion.*  \n\
                            <img data-toggle="modal" data-toggle="tooltip" title="Ver descripcion" data-target="#modDetCas" style="width: 32px; position:relative; left:570px;" data-codigo="'+codigo+'" class="ncnszRemove mano OjoDescripcion" src="../Lib/open-iconic-master/svg/zenmap.svg">\n\
                        </div>';
            $("#addNote"+codigo+"90").replaceWith(eliminar);
        }else{
            $("#addNotaCaja"+codigo+"85").addClass('oculto');
            var agregar= '<div style="position:relative; top:-17px" class="" id="addNote'+codigo+'90"><img style="width: 30px;" class="mano agregarNotaAlCaso" data-codigo="1" id="addNoteCaja'+codigo+'900" src="../Lib/open-iconic-master/svg/icon-icons.com.svg" > \n\
                                Agregar una anotacion.  \n\
                                <img data-toggle="modal" data-toggle="tooltip" title="Ver descripcion" data-target="#modDetCas" style="width: 32px; position:relative; left:565px;" data-codigo="'+codigo+'" class="ncnszRemove mano OjoDescripcion" src="../Lib/open-iconic-master/svg/zenmap.svg">\n\
                        </div>';
            $("#addNote"+codigo+"90").replaceWith(agregar);
        }
        
    });
    //JQuery que se encarga de guardar los casos de prueba.
    $(document).on("click",".guardarCasoIndependiente",function(){
        
        var idPrueba= $("#pruebaProcesoIDRegistrada").val();
        var codigoCaso= $(this).attr('data-codigo');
        var url= $("#pruebaProcesoIDRegistrada").attr('data-url');
        var configuracion=$("#probarCasosAsociadosAProbar").attr('data-codigo');
        var insertOrUpdate= "updateORInsert"+codigoCaso;
        var decision= $("#"+insertOrUpdate).val();
        
        if(!configuracion){
            if(idPrueba){

                //Se crean los ID para la asociacion de los casos de prueba.
                var comentario= "addNotaCaja"+codigoCaso+"85";
                var argumento= "argumentosi"+codigoCaso+"85";
                var respondaArgumento= "argussi"+codigoCaso+"80";
                var respondaCometario= "addNote"+codigoCaso+"90";
                var anotacionGo= "addNoteCaja"+codigoCaso+"900";
                var yaGuardoCaso="yaGuardoCasoPruebaBloquea"+codigoCaso;
                var eliminarCasoBloqueo="eliCaso"+codigoCaso+"Pru";
                var aprobado= "si"+codigoCaso+"1";
                var rechazado= "si"+codigoCaso+"0";
                var nombreCaso= "nombreCaso"+codigoCaso;
                
                var comentarioDato= $("#"+comentario).val();    
                var argumentoDato= $("#"+argumento).val();

                var patt = new RegExp(/^\S/);
                var argumentoVacio = patt.test(argumentoDato);

                var calificacion=null;
                //se confirma si al esta calificado el caso
                if($("#"+aprobado).is(':checked')){
                    calificacion=1;
                }else if($("#"+rechazado).is(':checked')){
                    calificacion=2;
                }else{

                    calificacion=0;
                }

                if(calificacion===2){

                    if((argumentoDato)&&(argumentoVacio)){

                        $("#"+respondaArgumento).removeClass('rojoNoValido');

                        $.ajax({
                            url:url,
                            data:"idPrueba="+idPrueba+"&codigoCaso="+codigoCaso+"&calificacion="+calificacion+"&argumentoComentario="+argumentoDato+"&decision="+decision,
                            type:"POST",
                            success: function(){

                                $('#setAlertPrueb').html('<div class="alert alert-success alert-dismissible fade show text-center" role="alert">\n\
                                            Caso de prueba registrado de forma exitosa. #'+codigoCaso+'\n\
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                                <span aria-hidden="true">&times;\n\
                                                </span>\n\
                                            </button>\n\
                                        </div>');

                                $("#"+yaGuardoCaso).slideUp('low');
                                $("#"+yaGuardoCaso).replaceWith('<input type="button" class="btn btn-verde btn-block labelCP disabled" value="Registro exitoso #'+codigoCaso+'">');
                                $("#"+eliminarCasoBloqueo).replaceWith('<button type="button" class="btn btn-rojo disabled" title="Eliminar" style="font-weight:bold; color:red; height:30px; width:30px; border-radius:50%;"></button>');
                                
                            }

                        });

                    }else{

                        $('#setAlertPrueb').html('<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">\n\
                                            Todos los campos con * son obligatorios.\n\
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                                <span aria-hidden="true">&times;\n\
                                                </span>\n\
                                            </button>\n\
                                        </div>');

                        $("#"+respondaArgumento).addClass('rojoNoValido');

                    }

                }else if(calificacion===1){

                    var patt1 = new RegExp(/^\S/);
                    var comentarioVacio = patt1.test(comentarioDato);
                    var anotacion= $("#"+anotacionGo).attr('data-codigo');

                    if(anotacion==1){comentarioDato="";}

                    if(anotacion==0){

                        if(comentarioVacio){

                            $.ajax({
                                url:url,
                                data:"idPrueba="+idPrueba+"&codigoCaso="+codigoCaso+"&calificacion="+calificacion+"&argumentoComentario="+comentarioDato+"&decision="+decision,
                                type:"POST",
                                success: function(){

                                    $('#setAlertPrueb').html('<div class="alert alert-success alert-dismissible fade show text-center" role="alert">\n\
                                                Caso de prueba registrado de forma exitosa. #'+codigoCaso+'\n\
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                                    <span aria-hidden="true">&times;\n\
                                                    </span>\n\
                                                </button>\n\
                                            </div>');
                                    $("#"+respondaCometario).removeClass('rojoNoValido');
                                    $("#"+yaGuardoCaso).slideUp('low');
                                    $("#"+yaGuardoCaso).replaceWith('<input type="button" class="btn btn-verde btn-block labelCP disabled" value="Registro exitoso #'+codigoCaso+'">');
                                    $("#"+eliminarCasoBloqueo).replaceWith('<button type="button" class="btn btn-rojo disabled" title="Eliminar" style="font-weight:bold; color:red; height:30px; width:30px; border-radius:50%;"></button>');

                                }

                            });

                        }else{

                            $('#setAlertPrueb').html('<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">\n\
                                            Todos los campos con * son obligatorios.\n\
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                                <span aria-hidden="true">&times;\n\
                                                </span>\n\
                                            </button>\n\
                                        </div>');
                            $("#"+respondaCometario).addClass('rojoNoValido');

                        }

                    }else{
                        
                        $.ajax({
                                url:url,
                                data:"idPrueba="+idPrueba+"&codigoCaso="+codigoCaso+"&calificacion="+calificacion+"&argumentoComentario="+comentarioDato+"&decision="+decision,
                                type:"POST",
                                success: function(){

                                    $('#setAlertPrueb').html('<div class="alert alert-success alert-dismissible fade show text-center" role="alert">\n\
                                                Caso de prueba registrado de forma exitosa. #'+codigoCaso+'\n\
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                                    <span aria-hidden="true">&times;\n\
                                                    </span>\n\
                                                </button>\n\
                                            </div>');

                                    $("#"+yaGuardoCaso).slideUp('low');
                                    $("#"+yaGuardoCaso).replaceWith('<input type="button" class="btn btn-verde btn-block labelCP disabled" value="Registro exitoso #'+codigoCaso+'">');
                                    $("#"+eliminarCasoBloqueo).replaceWith('<button type="button" class="btn btn-rojo disabled" title="Eliminar" style="font-weight:bold; color:red; height:30px; width:30px; border-radius:50%;"></button>');

                                }

                            });

                    }
                    
                }else if(calificacion===0){

                    $('#setAlertPrueb').html('<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">\n\
                                            Califique el caso de prueba.\n\
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                                <span aria-hidden="true">&times;\n\
                                                </span>\n\
                                            </button>\n\
                                        </div>');
                    $("#"+nombreCaso).addClass("rojoNoValido");
                    setTimeout(function(){
                        $("#"+nombreCaso).removeClass("rojoNoValido");
                    },3000);

                }

            }else{

                $('#setAlertPrueb').html('<div class="alert alert-info alert-dismissible fade show text-center" role="alert">\n\
                                        Registre la prueba para guardar el caso de prueba.\n\
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                            <span aria-hidden="true">&times;\n\
                                            </span>\n\
                                        </button>\n\
                                    </div>');

                var nombrePrueba= $("#nomPru").val();
                var modulo= $(".modulo").val();

                if(nombrePrueba){
                    $("#nombrePrueba").removeClass("rojoNoValido");
                }else{
                    $("#nombrePrueba").addClass("rojoNoValido");
                }
                if(modulo!=="#"){
                    $("#tituloModulo").removeClass("rojoNoValido");
                }else{
                    $("#tituloModulo").addClass("rojoNoValido");
                }

                $("#idPruebaProceso").removeClass('btn-azul');
                $("#idPruebaProceso").addClass('btn-rojo');

                setTimeout(function(){
                    $("#idPruebaProceso").removeClass('btn-rojo');
                    $("#idPruebaProceso").addClass('btn-azul');
                },3000);

            }
            
        }else{
            
            $('#setAlertPrueb').html('<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">\n\
                                    Modifique la configuracion a evaluacion de casos de prueba.\n\
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                        <span aria-hidden="true">&times;\n\
                                        </span>\n\
                                    </button>\n\
                                </div>');
        }
        
    });
    
    $(document).on("click",".OjoDescripcion",function(){
        
        var codigo= $(this).attr('data-codigo');
        var url= $("#urlParaElDetalleCasoPrueba").attr('data-url');
       
        $.ajax({
            
            url:url,
            data:"codigo="+codigo,
            type:"POST",
            success: function(inf_Detalle_CasoPrueba){
                
                var datos_det= JSON.parse(inf_Detalle_CasoPrueba);
                
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
        
    });
    /*
    $(document).on("click","#probarCasosAsociados",function(){
        
        var codigo= $(this).attr('data-codigo');
        var confirmaPruReg= $("#pruebaProcesoIDRegistrada").val();
        var existeLlave= $('.exitenCasoParaEvaluar').val();
        var url= "ajax.php?modulo=Prueba&controlador=Prueba&funcion=cambiarModo";
        
        if(confirmaPruReg){
            if(!existeLlave){
                
                if(codigo==0){
                    $('.opcionDeEstadosDeLaPrueba').addClass('oculto');
                    $(this).replaceWith('<label style="position: relative; left:937px;" data-codigo="4" class="mano" id="probarCasosAsociadosAProbar"><img style="width: 30px" class="mano bor-rad" src="../Lib/open-iconic-master/svg/carpetaArchivo.svg" data-placement="top" data-toggle="tooltip" ></label>');
                    
                    $.ajax({
                  
                        url:url,
                        data:"codigo=1&codigoPrueba="+confirmaPruReg,
                        type:"POST",
                        success: function(){

                        }
                        
                    });
                    
                }
                
            }else{
                $('#setAlertPrueb').html('<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">\n\
                                    Elimina los casos de prueba de la tabla de evaluacion para cambiar esta opcion.\n\
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                        <span aria-hidden="true">&times;\n\
                                        </span>\n\
                                    </button>\n\
                                </div>');
            }
        }else{
            
            $('#setAlertPrueb').html('<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">\n\
                                    Registre la prueba.\n\
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                        <span aria-hidden="true">&times;\n\
                                        </span>\n\
                                    </button>\n\
                                </div>');
                
                var nombrePrueba= $("#nomPru").val();
                var modulo= $(".modulo").val();
                
                if(nombrePrueba){
                    $("#nombrePrueba").removeClass("rojoNoValido");
                }else{
                    $("#nombrePrueba").addClass("rojoNoValido");
                }
                if(modulo!=="#"){
                    $("#tituloModulo").removeClass("rojoNoValido");
                }else{
                    $("#tituloModulo").addClass("rojoNoValido");
                }
                
                $("#idPruebaProceso").removeClass('btn-azul');
                $("#idPruebaProceso").addClass('btn-rojo');

                setTimeout(function(){
                    $("#idPruebaProceso").removeClass('btn-rojo');
                    $("#idPruebaProceso").addClass('btn-azul');
                },3000);
                
        }
        
    });
    
    $(document).on("click","#probarCasosAsociadosAProbar",function(){
        
        var codigo= $(this).attr('data-codigo');
        var existeLlave= $('.exitenCasoParaEvaluar').val();
        var codigoPrueba= $("#pruebaProcesoIDRegistrada").val();
        
        var url= "ajax.php?modulo=Prueba&controlador=Prueba&funcion=cambiarModo";
        
        if(!existeLlave){
            
            if(codigo==1){
                $('.opcionDeEstadosDeLaPrueba').removeClass('oculto');
                $(this).replaceWith('<label style="position: relative; left:937px;" data-codigo="0" class="mano asociarOpropia" data-codigoAP="1" id="probarCasosAsociados"><img style="width: 30px" class="mano bor-rad" src="../Lib/open-iconic-master/svg/iconfinder.svg" data-placement="top" data-toggle="tooltip" ></label>');
               
                $.ajax({
                    
                    url:url,
                    data:"codigo=0&codigoPrueba="+codigoPrueba,
                    type:"POST",
                    success: function(){
                   
                    }
                   
                });
               
            }
            
        }else{
            
            $('#setAlertPrueb').html('<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">\n\
                                    Elimina los casos de prueba de la tabla de evaluacion para cambiar esta opcion.\n\
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                        <span aria-hidden="true">&times;\n\
                                        </span>\n\
                                    </button>\n\
                                </div>');
            
        }
        
    });*/
    
    $(document).on("sp-change","#ex-events",function(){
        
        var codigoLlave= $("#probarCasosAsociadosAProbar").attr('data-codigo');
        var codigoCaso= $("#ex-events").val();
        var codigoPrueba= $("#pruebaProcesoIDRegistrada").val();
        var url= $("#urlParaAsociarCasoAPrueba").attr('data-url');
        var existeCaso;
            
        if($("#"+codigoCaso).length > 0){
            existeCaso=0; 
        }else{
            existeCaso=1; 
        }
        setTimeout(function(){
            
            if(codigoLlave==1){

                if((codigoCaso!=="#")&&(existeCaso!=0)){

                    $.ajax({
                        url:url,
                        data:"codigoCaso="+codigoCaso+"&codigoPrueba="+codigoPrueba,
                        type:"POST",
                        success: function(){
                            
                        }

                    });

                }

            }else{
                console.log("Configuracion de asociacion no activadad");
            }
            
        },80);
        
    });
    //JQuery funcion que pone el estado de la prueba
    $(document).on("click",".estadoDeLaPrueba",function(){
        
        var codigoEstado= $(this).attr('data-codigo');
        var codigoPrueba= $("#pruebaProcesoIDRegistrada").val();
        var url= "ajax.php?controlador=Prueba&modulo=Prueba&funcion=cambiarEstadoDePrueba";
        
        if(codigoPrueba){
            
            $.ajax({
                url:url,
                data:"codigoEstado="+codigoEstado+"&codigoPrueba="+codigoPrueba,
                type:"POST",
                success: function(){
                    window.location.href="index.php?controlador=Prueba&modulo=Prueba&funcion=listar";
                }
            });
            
        }else{
            
            $('#setAlertPrueb').html('<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">\n\
                                    Registre la prueba.\n\
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                        <span aria-hidden="true">&times;\n\
                                        </span>\n\
                                    </button>\n\
                                </div>');
            
        }
        
    });
    
    $(document).on("click","#idPruebaProcesoEditarNombre",function(){
        
        var codigoPrueba= $('#pruebaProcesoIDRegistrada').val();
        var url= $(this).attr('data-url');
        var nombrePrueba= $('#nombrePrueba').val();
        
        var patt = new RegExp(/^[\S][A-Za-z0-9.,;:ñÑáéíóúÁÉÍÓÚ"'+-_$()\s]{5,200}[\S]$/g);
        var nombrePruebaAceptable = patt.test(nombrePrueba);
        
        if(nombrePruebaAceptable){
            
            $.ajax({
                url:url,
                data:"codigoPrueba="+codigoPrueba+"&nombrePrueba="+nombrePrueba,
                type:"POST",
                success: function(){

                    $('#setAlertPrueb').html('<div class="alert alert-success alert-dismissible fade show text-center" role="alert">\n\
                                        Edicion exitosa.\n\
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                            <span aria-hidden="true">&times;\n\
                                            </span>\n\
                                        </button>\n\
                                    </div>');
                    $("#nombreIncorrecto").removeClass("rojoNoValido");
                }

            });
        
        }else{
                $('#setAlertPrueb').html('<div class="alert alert-info alert-dismissible fade show text-center" role="alert">\n\
                                            Revise que el nombre no tenga espacios en blanco al inicio o al final.\n\
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                                <span aria-hidden="true">&times;\n\
                                                </span>\n\
                                            </button>\n\
                                        </div>');
                
                if(nombrePruebaAceptable){
                    $("#nombreIncorrecto").removeClass("rojoNoValido");
                }else{
                    $("#nombreIncorrecto").addClass("rojoNoValido");
                }
        }
        
    });
    
    $(document).on("click","",function(){
        
    });
    
});