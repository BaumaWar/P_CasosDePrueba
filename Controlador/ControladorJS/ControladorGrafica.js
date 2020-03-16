$(document).ready(function(){
    
    $(document).on("click","#consultaGrafica",function(){
        
        var modulo= $("#moduloGrafica").val();
        var fecha= $("#fechaGrafica").val();
        var dia= fecha.slice(8,10);
        var mes= fecha.slice(5,7);
        var ano= fecha.slice(0,4);
        var url= $("#fechaGrafica").attr("data-url");
        
        if(modulo!="#"){
            
            $.ajax({
                url:url,
                type:"POST"
            });
        }
    });
    
});


