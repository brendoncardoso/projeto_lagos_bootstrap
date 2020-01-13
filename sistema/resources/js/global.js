/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


var paginacao = function(pagina,action){
    var pg = "";
    if(pagina=="first")
        $("#pagina").val(1);
    else if(pagina=="last")
        $("#pagina").val(parseFloat($("#lastpage").html()));
    else if(pagina=="prev"){
        pg = parseFloat($("#pagina").val());
        $("#pagina").val(pg-1);
    }
    else if(pagina=="next"){
        pg = parseFloat($("#pagina").val());
        $("#pagina").val(pg+1);
    }   
    else
        $("#pagina").val(pagina);
    
    if(action == "pessoas"){
        $('#busca').trigger("click");
    }else{
        $("form:first").submit();
    }
}

var paginacaoGo = function(action){
    
    if(!parseFloat($("#go").val())){
        alert('Favor digite um número válido');
    }else{
        var ir = parseFloat($("#go").val());
        var last = parseFloat($("#lastpage").html());
        
        if(ir > last){
            $("#pagina").val(last);
        }else{
            $("#pagina").val(ir);
        }
        
        if(action == "pessoas"){
            $('#busca').trigger("click");
        }else{
            $("form:first").submit();
        }
    }
    
}