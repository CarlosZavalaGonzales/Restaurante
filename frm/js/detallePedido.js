var arr_list_final=[];
function Listar_Pedido(){
    //sessionStorage.getItem("codMesa")
    var array_OrdenPedido_Fin = JSON.parse(sessionStorage.getItem("arrePedido"));
    var cont = ''; 
    if(sessionStorage.getItem("arrePedido") != "null" && array_OrdenPedido_Fin.length > 0){
        for(var i =0; i< array_OrdenPedido_Fin.length;i++){
            if(sessionStorage.getItem("codMesa") == array_OrdenPedido_Fin[i]["nMesa"]){
                //console.log( array_OrdenPedido_Fin[i]["nSubCategoria"]);
                var array ={"tipoConsulta":"listarParametroEspecifico", "codClase":'4000',"codPar": array_OrdenPedido_Fin[i]["nSubCategoria"]};
                $.ajax({
                    //async:true,
                    type:"POST",
                    dataType:"html",
                    contentType:"application/x-www-form-urlencoded",
                    url:"BL/BL_parametro.php",
                    data: array,
                    beforeSend: function() {
                        //console.log("procesara");
                    },
                    success: function (response) {
                        //console.log(response);
                        var objGe = JSON.parse(response);
                        //console.log(objGe);
                        for (var j in objGe){
                            //console.log(objGe[i]);
                            cont +="<tr>";
                            cont += "<td>"+objGe[j]['nomCategoria']+"</td>";
                            cont += "<td>"+objGe[j]['nombre']+"</td>";
                            cont += "<td> <a class='btn btn-danger btn-xs' onclick=\"EliminarPedidoUnitario("+sessionStorage.getItem("codMesa")+","+objGe[j]['codParametro']+")\" ><span class='glyphicon glyphicon-remove'></span></a> "; 
                            cont +="</tr>"
                            $("#tabListaPri").html(cont);
                            //$('#tabla_list_cliente').DataTable();
                        }
                        
                        
                        //arr_list_final.push(JSON.parse(response));
                        //Imprimir_SubCategorias_View();
                    },
                    timeout: 4000,
                    error: function () {
                        console.log("error");
                    }
                });
            }
        }
    }else{
        alert("La mesa seleccionada no cuenta con productos agregados...");
        menus("gestorMenu");
    }
   

}

function EliminarPedidoUnitario(nCodMesa,nCodSubCategoria){
    var array_OrdenPedido_Fin = JSON.parse(sessionStorage.getItem("arrePedido"));
    var pos = -1;
    for(var i =0;i<array_OrdenPedido_Fin.length;i++){
        if(array_OrdenPedido_Fin[i]["nMesa"] == nCodMesa &&
        array_OrdenPedido_Fin[i]["nSubCategoria"] == nCodSubCategoria){
            pos = i;
        }
    }
    if(pos > -1){
        array_OrdenPedido_Fin.splice(pos,1);
        sessionStorage.setItem("arrePedido", JSON.stringify(array_OrdenPedido_Fin));
        alert("Pedido Eliminado...");
        menus("gestorMenu");
    }else{
        alert("Ocurrio un Error...");
    }

    
}

function FinalizarPedido(){
    var array_OrdenPedido_Fin = JSON.parse(sessionStorage.getItem("arrePedido"));
    for(var i =0; i< array_OrdenPedido_Fin.length;i++){
        if(sessionStorage.getItem("codMesa") == array_OrdenPedido_Fin[i]["nMesa"]){
            var array ={"tipoConsulta":"registrarOrden", "nMesa":array_OrdenPedido_Fin[i]["nMesa"],
                                    "nSubCategoria": array_OrdenPedido_Fin[i]["nSubCategoria"]};
            $.ajax({
                //async:true,
                type:"POST",
                dataType:"html",
                contentType:"application/x-www-form-urlencoded",
                url:"BL/BL_parametro.php",
                data: array,
                beforeSend: function() {
                    //console.log("procesara");
                },
                success: function (response) {
                    //console.log(response);
                    var objGe = JSON.parse(response);
                    //ELIMINANDO ATRIBUTO
                   /*var array_OrdenPedido_Fin_Dup = JSON.parse(sessionStorage.getItem("arrePedido"));
                    array_OrdenPedido_Fin_Dup.splice(i,1);
                    sessionStorage.setItem("arrePedido", JSON.stringify(array_OrdenPedido_Fin_Dup));*/
                },
                timeout: 4000,
                error: function () {
                    console.log("error");
                }
            });
        }
        
    }
    Eliminar_Pedidos();
}

function Eliminar_Pedidos(){
    var arre_final_ped=[];
    var array_OrdenPedido_Fin = JSON.parse(sessionStorage.getItem("arrePedido"));
    sessionStorage.setItem("arrePedido", null);

    //var array_OrdenPedido_Fin_Copia = JSON.parse(sessionStorage.getItem("arrePedido"));
    for(var i =0; i< array_OrdenPedido_Fin.length;i++){
        if(sessionStorage.getItem("codMesa") != array_OrdenPedido_Fin[i]["nMesa"]){
            arre_final_ped.push({
                nMesa: array_OrdenPedido_Fin[i]["nMesa"],
                nSubCategoria: array_OrdenPedido_Fin[i]["nSubCategoria"]
            });
        }
        
    }
    sessionStorage.setItem("arrePedido", JSON.stringify(arre_final_ped));
   
    alert("Pedido Registrado, tiempo aproximado de atenci??n 20 minutos");
    menus('registrarPedido');
}
/*function Imprimir_Detalle_Orden(){
    var cont = '';

	for (var i in arr_list_final){
		cont +="<tr>";
		cont += "<td>"+arr_list_final[i]['nomCategoria']+"</td>";
        cont += "<td>"+arr_list_final[i]['nombre']+"</td>";
		//cont += "<td> <a class='btn btn-info btn-xs' onclick=\"Enotria_nuevoCliente('"+arrayEnoClientes[i]['cPerCodigo']+"')\" ><span class='glyphicon glyphicon-edit'></span></a> "; 
		cont +="</tr>"
	}
    console.log(cont);
	$("#tabListaPri").html(cont);
	$('#tabla_list_cliente').DataTable();
}*/

$(document).ready(function () {
    //alert("sfsdf");
    $("#nombreDetPedi").text("Detalle de Pedido " + sessionStorage.getItem('nomMesa'))
	Listar_Pedido();
})
