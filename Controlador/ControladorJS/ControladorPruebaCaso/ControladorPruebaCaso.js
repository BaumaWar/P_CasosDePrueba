$(document).ready(function(){
    
    
    $(document).on("click","#savePruebaCaso",function(){
        
    });
    /*Start JQuery adminstra el select de la Configuracion del la prueba. Dependiendo de la opcion quita y pone el cuadro para seleccionar al usuario responsable de la prueba*/
    $('.selectpicker').on("changed.bs.select",function(e, clickedIndex, isSelected, previousValue){
        var configuracionDeLaPrueba= $('#configuracionDeLaPruebaPruebaCaso').val();
        
        switch (configuracionDeLaPrueba){
            case "ElActualUsuarioPrueba":
                $('#usuarioResponsableDIV').addClass('displayNone');
                break;
            case "OtroUsuarioPrueba":
                $('#usuarioResponsableDIV').removeClass('displayNone');
            default :
                console.log("Ha seleccionad la casilla incorrecta en Prueba De Casos");
        }
        
    });
    /*End JQuery*/
});


