<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1" />
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-clearmin.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/roboto.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/estilo.css" />
    <title>Restaurante</title>
  </head>
  <body class="cm-login" style="background: url('assets/img/restaurante.png');background-repeat: no-repeat;background-size: cover;">
    <div class="col-sm-6 col-md-4 col-lg-3" style="margin: 300px auto; float: none">
      <div>
        <div class="col-xs-12">
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-fw fa-user"></i></div>
              <input type="text" id="usuario" class="form-control" placeholder="Ingrese Usuario" />
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-fw fa-lock"></i></div>
              <input type="password" id="contrasena" class="form-control" placeholder="Ingrese Contraseña" />
            </div>
          </div>
        </div>
        <div class="col-xs-6">
          <button type="submit" class="btn btn-block btn-primary" onclick="logeo();">Iniciar Sesión</button>
        </div>
        <div class="col-xs-12">
          <p id="msjErrorLog"></p>
        </div> 
      </div>
    </div>
      <script src="assets/js/lib/jquery.min.js"></script>
      <script type="text/javascript">
      function mostrar(i){
          if (i == 1) {
            $("#frmLogin").css("display","");
            $("#frmRegistro").css("display","none");
            $("#frmRecContra").css("display","none");
          }else if (i == 2) {
            $("#frmLogin").css("display","none");
            $("#frmRegistro").css("display","");
            $("#frmRecContra").css("display","none");
          }else{
            $("#frmLogin").css("display","none");
            $("#frmRegistro").css("display","none");
            $("#frmRecContra").css("display","");
          }
      }

      function soloNumeros(e){
          var key = window.Event ? e.which : e.keyCode
          return (key >= 48 && key <= 57)
      }

      function validar_email(email) 
      {
        var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email) ? true : false;
      }

      function logeo() {
        $("#msjErrorLog").html("");
        if ($('#usuario').val() != '' && $('#usuario').val().length > 0 ) {
          if ( $('#contrasena').val() != '' && $('#contrasena').val().length > 0 ) {
            $.ajax({
                url:"login.php",
                data : { "usuario" : $('#usuario').val(), "contra" : $('#contrasena').val()  },
                type : 'POST',
                dataType : 'json',  
                success:function(data) {
                    //console.log(data); 
                    if (data == 'legueo') {
                      window.location="panel.php";
                    }else{
                      console.log("NO ENTRO");
                      $("#msjErrorLog").html("La contraseña es incorrecta, vuelva a intentarlo.");
                    }
                },
                error : function(xhr, status) {
                  console.log("Ocurrio un problema");
                  console.log(xhr);
                  console.log(status);
                  console.log($('#usuario').val()+" - "+ $('#contrasena').val());
                }
            });
          }else{
            $("#msjErrorLog").html("Por favor ingrese una contraseña");
          }
        }else{
          $("#msjErrorLog").html("Por favor ingrese su Usuario");
        }
      }

      $(window).on('keydown', function(e) {
        if (e.which == 13) {
          logeo();
          return false;
        }
      });
    </script>

  </body>
</html>
