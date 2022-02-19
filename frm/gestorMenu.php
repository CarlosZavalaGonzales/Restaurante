<script type="text/javascript" src="frm/js/gestorCategorias.js"></script>
<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">Categorias de Pedidos</div>
        <h3 id="Titulo_Categorias" style="text-align: center;font-weight: bold;"></h3>
        <hr>
        <div class="panel-body">
            <div class="col-md-12" id="vis_listado">
              	<div class="form-group" style="margin-bottom: 0">
                	<div class="col-sm-12 text-left" id="contCatePedidos">
                  	    
                	</div>
              	</div>
              	<hr />
            </div>
            <br>
            <br>
            <div class="col-md-12" style="text-align: center;padding: 50px;">
                <div class="form-group" style="margin-bottom: 0">
                    <div class="col-sm-12">
                  	    <button type="button" class="btn btn-danger btn-sm" onclick="menus('registrarPedido');" ><i class="fa fa-fw fa-plus"></i> Regresas a Mesas</button>
                          <button type="button" class="btn btn-warning btn-sm" onclick="finalizarPedido();" ><i class="fa fa-fw fa-plus"></i> Finalizar Pedido</button>
                	</div>
              	</div>
            </div>
        </div>
    </div>
</div>
