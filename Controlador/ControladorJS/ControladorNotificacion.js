$(document).ready(function(){
    //Funcion para activar el complemento de los tooltip
    $(function () {
        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'hover'
        });
    });
    //Funcion para activar el complemento de los popovers
    $(function () {
        $('[data-toggle="popover"]').popover({
            container: 'body',
            html:true,
            
        });
    });
    //funcion que pone el nombre,fechaCreacion,responsable en las casillas correspondiente del formulario de notificaciones
    $(document).on("sp-change","#pruebaDesarollada",function(){
        
        var pruebaID= $(this).val();
        var url= $(this).attr('data-url');
        
        $.ajax({
            url:url,
            data:"codigo="+pruebaID,
            type:"POST",
            success: function(inf_prueba){
                
                var prueba= JSON.parse(inf_prueba);
                
                $("#nombrePrueba").val(prueba[0]);
                $("#moduloPrueba").val(prueba[1]);
                $("#fechaPrueba").val(prueba[2]);
                
            }
        });
        
    });
    //Funcion que pone los usarios en el modulo de notificacion
    $(document).on("sp-change","#usuarioNotificado",function(){
        
        var codigo= $(this).val();
        var url= $(this).attr('data-url');
        var existeUsuario;
        if($("#"+codigo).length > 0){
            existeUsuario=0; 
        }else{
            existeUsuario=1; 
        }
        if((existeUsuario!=0)&&((codigo!=="#"))){
            $.ajax({
                url:url,
                data:"codigo="+codigo,
                type:"POST",
                success: function(inf_UsarioNotificado){

                    var usuario= JSON.parse(inf_UsarioNotificado);

                        var fila=  '<tr>\n\
                                        <td>'+usuario[1]+'</td>\n\
                                        <td>'+usuario[2]+'</td>\n\
                                        <td align="center">\n\
                                            <button class="btn btn-rojo eli_usuNotificado" title="Eliminar" style="font-weight:bold; color:red;"><img class="ncnszRemove" src="../Lib/open-iconic-master/svg/circle-x.svg"></button>\n\
                                            <input type="hidden" name="correo" value="'+usuario[2]+'" id="'+usuario[0]+'">\n\
                                            <input name="usuarioNotificado[]" value="'+usuario[0]+'" type="hidden">\n\
                                        </td>\n\
                                    </tr>';
                        $("#notificacionUsuario").append(fila);
                        
                    }

            });
        }
    });
    //Funcion que consulta las notificaciones cada 10s
    function notificacionesPorTiempo(){
                
        var codigo=$("#idNotificadoPorTiempo").val();
        var url=$("#idNotificadoPorTiempo").attr('data-url');
        
        $.ajax({
            url:url,
            data:"codigo3="+codigo,
            type:"POST",
            success: function(inf_noti_tiempo){
                var notiTiempo= JSON.parse(inf_noti_tiempo);
                var total=notiTiempo.total;
                if(total!=0){
                    $('#numberNotificacion').text(notiTiempo.total);
                }else{
                    $('#numberNotificacion').text("");
                }
            }
        });
       setTimeout(function(){notificacionesPorTiempo();}, 10000); 
    }
    notificacionesPorTiempo();
    
    //Funcion que remueve los usuarios
    $(document).on("click",".eli_usuNotificado",function(){
       
        $(this).parent().parent().remove();
        
    });
    
    //Funcion que cambiara el color si se encuentrarn notificaciones
    
    function changeColor(contadorColor){
       
        contadorColor++;
        if(contadorColor===1){
            $(".alarmaNotificacion").css('background-color','#FDFFC4');
            
        }
        if(contadorColor===2){
            $(".alarmaNotificacion").css('background-color','#E5FFC4');
            contadorColor+1;
        }
        if(contadorColor===3){
            $(".alarmaNotificacion").css('background-color','#C4FAFF');
            contadorColor+1;
        }
        if(contadorColor===4){
            $(".alarmaNotificacion").css('background-color','#E7C4FF');
            contadorColor+1;
        }
        if(contadorColor===5){
            $(".alarmaNotificacion").css('background-color','#C4DBFF');
            contadorColor=0;
        }
        setTimeout(function(){changeColor(contadorColor)}, 2000);
    }
    //changeColor(0);
     
    //Funcion que organiza las notificaziones
    
    function notificacionesDePruebas(){
        
        var codigo=$("#idUsuarioNotificado").val();
        var url=$("#idUsuarioNotificado").attr('data-url');
        
        $.ajax({
            url:url,
            data:"codigo2="+codigo,
            type:"POST",
            success: function(inf_notif){
                
                var datosNoti= JSON.parse(inf_notif);
                
                $.each(datosNoti, function (i,element) {
                    for (i in element) {
                        //alert("Company Name: " + member[i].descripcion_pru_pro);
                        
                        var yaleido=element[i].fecha_leido;
                        
                        if(yaleido==="No leido"){
                            
                            var fila = '<div id="mantequilla'+element[i].id_notificacion+'" class="list-group-item list-group-item-action flex-column align-items-start">\n\
                                            <div class="d-flex w-100 justify-content-between">\n\
                                                <a target="_blank" href="../Controlador/ControladorPrueba/PruebaReporte/ReportePruebaDeSoftwarepdf.html.php?codigo='+element[i].fk_pru_pro+'" ><h6 class="mb-1 labelHead">'+element[i].descripcion_pru_pro+'</h6></a>\n\
                                            </div>\n\
                                            <small class="text-muted">Creada por: '+element[i].nomEmisor+'</small><br>\n\
                                            <small class="text-muted">Fecha: '+element[i].fecha_creacion+'</small>\n\
                                            <a href="#"><span class="badge badge-info MarcarLeido" id="leido'+element[i].id_notificacion+'" data-codigo="'+element[i].id_notificacion+'" title="Marcar como leido">■</span></a>\n\
                                            <a href="#"><span class="badge badge-danger NoVerMas" data-codigo="'+element[i].id_notificacion+'" title="No ver mas">■</span></a>\n\
                                        </div>';

                                $(".notiPrueba").prepend(fila);
                                
                        }else{
                            
                            var fila = '<div id="mantequilla'+element[i].id_notificacion+'" class="list-group-item list-group-item-action flex-column align-items-start">\n\
                                            <div class="d-flex w-100 justify-content-between">\n\
                                                <a target="_blank" href="../Controlador/ControladorPrueba/PruebaReporte/ReportePruebaDeSoftwarepdf.html.php?codigo='+element[i].fk_pru_pro+'" ><h6 class="mb-1 labelHead">'+element[i].descripcion_pru_pro+'</h6></a>\n\
                                            </div>\n\
                                            <small class="text-muted">Creada por: '+element[i].nomEmisor+'</small><br>\n\
                                            <small class="text-muted">Fecha: '+element[i].fecha_creacion+'</small>\n\
                                            <a href="#"><span class="badge badge-secondary MarcarLeido" id="leido'+element[i].id_notificacion+'" data-codigo="'+element[i].id_notificacion+'" title="Marcado como leido">■</span></a>\n\
                                            <a href="#"><span class="badge badge-danger NoVerMas" data-codigo="'+element[i].id_notificacion+'" title="No ver mas">■</span></a>\n\
                                        </div>';

                                $(".notiPrueba").prepend(fila);
                            
                        }
                        
                    }
                    
                 });
                 
            }
        });
        //setTimeout(function(){notificacionesDePruebas();}, 15000);
    }
    //Funcion que pone las notificaciones
    $(document).on("click",".alarmaNotificacion",function(){
        notificacionesDePruebas();
        
        var url= $("#idVisto").attr('data-url');
        var codigo= $("#idVisto").val();
        
        $.ajax({
            url:url,
            data:"codigo5="+codigo,
            type:"POST",
        });
        
    });
    //Funcion que marca las notificaciones como leidas
    $(document).on("click",".MarcarLeido",function(){
        
        var codigo= $(this).attr('data-codigo');
        var idLeidoo= $(this).attr('id');
        var url= $("#idLeidoUrl").attr('data-url');
        
        $.ajax({
            url:url,
            data:"codigo4="+codigo,
            type:"POST",
            success: function(){
                
                $("#"+idLeidoo).replaceWith('<span class="badge badge-secondary MarcarLeido" title="Marcado como leido">■</span>');
                
            }
        });
        
    });
    //Funcion que cambia el estado de las notifcaciones al dar click en no ver mas
    $(document).on("click",".NoVerMas",function(){
        var codigo= $(this).attr('data-codigo');
        var url= $("#idNoVerMas").attr('data-url');
        $(this).parent().parent().remove();
        $.ajax({
            url:url,
            data:"codigo6="+codigo,
            type:"POST",
            success: function(){
                
            }
        });
    });
    
});
