<script type="text/javascript" src="frm/js/detallePedido.js"></script>
<div class="container-fluid">
    <div class="panel panel-default">
        <div id='nombreDetPedi' class="panel-heading"></div>
        <div class="panel-body">
            <div class="col-md-12">
              	<div class="form-group" style="margin-bottom: 0">
                	<div class="col-sm-12 text-left">
                  	<button type="button" class="btn btn-info btn-md" onclick="FinalizarPedido()" ><i class="fa fa-fw fa-plus"></i>Finalizar Pedido Mesa</button>
                	</div>
              	</div>
              	<hr />
                <div style="padding-top: 20px;">
                	<table class="table table-bordered table-hover" id="tabla_list_cliente" >
  	                <thead>
  	                  	<tr>
  		                    <th style="text-align: center">Categoria</th>
  		                    <th style="text-align: center">Pedido</th>
  	                  	</tr>
  	                </thead>
  	                <tbody id="tabListaPri">
  	                </tbody>
                	</table>
                </div>

            </div>
        </div>
    </div>
</div>
