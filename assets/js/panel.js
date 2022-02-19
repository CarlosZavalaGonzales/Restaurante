function soloNumeros(e){
  var key = window.Event ? e.which : e.keyCode
  return (key >= 48 && key <= 57)
}

function soloNumerosFloat(e){
  var key = window.Event ? e.which : e.keyCode
  return (key >= 48 && key <= 57 || key == 46)
}


function m_alerta_ok(titulo,contenido){
    $.alert({
      theme: 'modern',
      type: 'green',
      closeAnimation: 'scaleX',
      icon: 'fa fa-check',
      title: titulo,
        content: contenido,
        draggable: false
  });
}

function m_alerta_mal(titulo,contenido){
    $.alert({
      theme: 'modern',
      type: 'red',
      closeAnimation: 'scaleX',
      icon: 'fa fa-times',
      title: titulo,
        content: contenido,
        draggable: false
  });
}

function m_alert_simple(titulo,contenido) {
    $.alert({
        theme: 'modern',
        type: 'red',
        title: titulo,
        content: contenido,
        columnClass: 'small'
    });
}

function zeroFill( number, width ){
    width -= number.toString().length;
    if ( width > 0 ){ return new Array( width + (/\./.test( number ) ? 2 : 1) ).join( '0' ) + number; }
    return number + "";
}

var emailValidador = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
function validar_email(email) 
{
  var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email) ? true : false;
}

function menus(nomMenu) {
  var array ={menu: nomMenu };
  $.ajax({
    async:true,
    type:"POST",
    dataType:"html",
    contentType:"application/x-www-form-urlencoded",
    url:'frm/'+nomMenu+".php",
    data: array,
    beforeSend: function () {
      $("#global").html('<div class="img_loading"><img src="assets/img/loading.gif" alt="Cargando"><span>Cargando</span></div>');
    },
    success: function (response) {
      $("#global").html(response);
      //init_sidebar();
    },
    timeout: 4000,
    error: function () {
      $("#global").text("");
    }
  });
}

function cambiarPerfil(num){
  if (sessionStorage.getItem('pPerfil') != num) {
    if (num == 1) {
      $("#icoCli").removeClass("fa-check pull-right");
      $("#icoTra").addClass("fa-check pull-right");
      sessionStorage.setItem('pPerfil',1);
      generarMenuP();

    }else{
      if ($('#pCli').length) {
        $("#icoTra").removeClass("fa-check pull-right");
        $("#icoCli").addClass("fa-check pull-right");
        sessionStorage.setItem('pPerfil',2);
        generarMenuP();
      }
    }
  }
}

function generarMenuP() {
  if (sessionStorage.getItem('pPerfil') > 0) {
    $.ajax({
        type : 'POST',
        url:"BL/BL_usuario.php",
        data : { "tipoConsulta":"actMenus","perfil":sessionStorage.getItem('pPerfil') },
        contentType:"application/x-www-form-urlencoded",
        dataType : 'html',  
        success:function(data) {
            // $('#cont_menu_p').html(data);
            location.reload();
            //console.log(data);
        },
        error : function(xhr, status) {
          console.log("Ocurrio un problema");
          console.log(xhr);
        }
    });
  }
}



function init_DataTables() {
    console.log('run_datatables');
    // if( typeof ($.fn.DataTable) === 'undefined'){ return; }

    var handleDataTableButtons = function() {
      if ($("#datatable-buttons").length) {
      $("#datatable-buttons").DataTable({
        dom: "Blfrtip",
        buttons: [
        {
          extend: "copy",
          className: "btn-sm"
        },
        {
          extend: "csv",
          className: "btn-sm"
        },
        {
          extend: "excel",
          className: "btn-sm"
        },
        {
          extend: "pdfHtml5",
          className: "btn-sm"
        },
        {
          extend: "print",
          className: "btn-sm"
        },
        ],
        responsive: true
      });
      }
    };

    TableManageButtons = function() {
      "use strict";
      return {
      init: function() {
        handleDataTableButtons();
      }
      };
    }();

    $('#datatable').dataTable();

    $('#datatable-keytable').DataTable({
      keys: true
    });

    $('#datatable-responsive').DataTable();

    $('#datatable-scroller').DataTable({
      ajax: "js/datatables/json/scroller-demo.json",
      deferRender: true,
      scrollY: 380,
      scrollCollapse: true,
      scroller: true
    });

    $('#datatable-fixed-header').DataTable({
      fixedHeader: true
    });

    var $datatable = $('#datatable-checkbox');

    $datatable.dataTable({
      'order': [[ 1, 'asc' ]],
      'columnDefs': [
      { orderable: false, targets: [0] }
      ]
    });
    $datatable.on('draw.dt', function() {
      $('checkbox input').iCheck({
      checkboxClass: 'icheckbox_flat-green'
      });
    });

    TableManageButtons.init();
    
  };



  $(document).ready(function() {
    //init_DataTables();
  }); 
  