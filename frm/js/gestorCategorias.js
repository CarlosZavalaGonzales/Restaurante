var arrayCategorias = [];


function Listar_Categorias(){
	var array ={"tipoConsulta":"listarParametro", "codClase":'3000',"codPar":'0'};
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

			arrayCategorias = objGe;
            Imprimir_Categorias_View();
		},
		timeout: 4000,
		error: function () {
			console.log("error");
		}
	});
}

function Imprimir_Categorias_View(){
    var cont = '';

	for (var i in arrayCategorias){
		cont += "<div class='col-sm-2'> <button type='button' class='btn btn-info btn-sm' onclick='Detalle_Categoria("+arrayCategorias[i]['codParametro']+",\""+arrayCategorias[i]['nombre']+"\")' ><i class='fa fa-fw fa-plus'></i> "+arrayCategorias[i]['nombre']+"</button></div>"; 
	}

	$("#contCatePedidos").html(cont);
}

function Detalle_Categoria(nCatCodigo,cNomCategoria){
    sessionStorage.setItem('codCategoria', nCatCodigo);
    sessionStorage.setItem('nomCategoria', cNomCategoria);
    menus("gestorDetalleCat");
}

function finalizarPedido(){
	console.log(sessionStorage.getItem("arrePedido"));
	if(sessionStorage.getItem("arrePedido") != "null" && sessionStorage.getItem("arrePedido") != undefined){
		var array_OrdenPedido_Fin = JSON.parse(sessionStorage.getItem("arrePedido"));
		var bandera = 0;
		for(var i=0;i < array_OrdenPedido_Fin.length;i++){
			if(array_OrdenPedido_Fin[i]["nMesa"] == sessionStorage.getItem("codMesa")){
				bandera = 1;
			}
		}
		if(bandera == 1){
			menus("detallePedido");
		}else{
			alert("La mesa seleccionada no cuenta con productos agregados...");
		}
	}else{
		alert("La mesa seleccionada no cuenta con productos agregados...");
	}
	
}

$(document).ready(function () {
    //alert("sfsdf");
    $("#Titulo_Categorias").text("Usted se encuentra en la " + sessionStorage.getItem('nomMesa'))
	Listar_Categorias();
})
