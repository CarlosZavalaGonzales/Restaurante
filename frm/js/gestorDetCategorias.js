var arraySubCategorias = [];
var array_OrdenPedido = [];


function Listar_SubCategorias(){

	var array ={"tipoConsulta":"listarParametro", "codClase":'4000',"codPar":sessionStorage.getItem('codCategoria')};
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

			arraySubCategorias = objGe;
            Imprimir_SubCategorias_View();
		},
		timeout: 4000,
		error: function () {
			console.log("error");
		}
	});
}

function Imprimir_SubCategorias_View(){
    var cont = '';

	for (var i in arraySubCategorias){
		cont += "<div class='col-sm-3'><img src='assets/img/"+arraySubCategorias[i]['descripcion']+"' width='150' style='    width: 100%;'/> <br/><button type='button' class='btn btn-info btn-sm' style='    width: 100%;' onclick='AgregarSubCategoria("+arraySubCategorias[i]['codParametro']+",\""+arraySubCategorias[i]['nombre']+"\")' ><i class='fa fa-fw fa-plus'></i> "+arraySubCategorias[i]['nombre']+"</button></div>"; 
	}

	$("#contSubCatePedidos").html(cont);
}

function AgregarSubCategoria(nCodSubCategoria){
    var mensaje;
    var opcion = confirm("Desea Agregar este Insumo a su Orden:");
    if (opcion == true) {
        //alert(nCodSubCategoria);
        if(sessionStorage.getItem("arrePedido") != "null" && sessionStorage.getItem("arrePedido") != undefined){
            array_OrdenPedido = JSON.parse(sessionStorage.getItem("arrePedido"));
        }
        
        array_OrdenPedido.push({
            nMesa: sessionStorage.getItem("codMesa"),
            nSubCategoria: nCodSubCategoria
        });
        console.log(array_OrdenPedido);
        sessionStorage.setItem("arrePedido", JSON.stringify(array_OrdenPedido));
        //alert("ok");
	} 
}

function finalizarPedido(){
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
}

$(document).ready(function () {
    //alert("sfsdf");
    $("#Titulo_Det_Categoria").text("Detalle de:  " + sessionStorage.getItem('nomCategoria'));
    $("#Titulo_Categorias").text("Usted se encuentra en la " + sessionStorage.getItem('nomMesa'));
	Listar_SubCategorias();
})
