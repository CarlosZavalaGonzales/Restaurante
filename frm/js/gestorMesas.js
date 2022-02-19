var arrayMesas = [];


function Listar_Mesas(){
	var array ={"tipoConsulta":"listarParametro", "codClase":'2000',"codPar":'0'};
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

			arrayMesas = objGe;
            Imprimir_Mesas_View();
		},
		timeout: 4000,
		error: function () {
			console.log("error");
		}
	});
}

function Imprimir_Mesas_View(){
    var cont = '';

	for (var i in arrayMesas){
		cont += "<div class='col-sm-2'> <button type='button' class='btn btn-info btn-sm' onclick='Categoria_Menu("+arrayMesas[i]['codParametro']+",\""+arrayMesas[i]['nombre']+"\")' ><i class='fa fa-fw fa-plus'></i> "+arrayMesas[i]['nombre']+"</button></div>"; 
	}

	$("#contMesasGen").html(cont);
}

function Categoria_Menu(nMesaCodigo,nombre){
    sessionStorage.setItem('codMesa', nMesaCodigo);
    sessionStorage.setItem('nomMesa', nombre);
    menus("gestorMenu");
}

$(document).ready(function () {
	Listar_Mesas();
})
