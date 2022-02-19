<?php 
  session_cache_limiter('nocache,private');
  session_name('covigym');
  session_start();

  if (!isset($_SESSION['codUsu'])) {  
    session_destroy();
    session_commit();
    header('Location: index.php');
  }else{
    if (intval($_SESSION['codUsu']) < 0) {
      session_destroy();
      session_commit();
      header('Location: index.php');
    }else{
      $usuarioPri = $_SESSION['codUsu'];
      $nomUsuPri = $_SESSION['nomUsu'];

      
      //Listar Menu
      $file1 = realpath(dirname(__FILE__)."/DA/ClsUsuario.php");
      require_once($file1);
      $objDatos =  new ClsUsuario();
      $resultado1 = $objDatos->Get_listado_permisos_usuario($_SESSION['codUsu']);
      $htmlMenu = "";

      $classMenu = '';

      $jer = 0;
      $pos = 0;
      $array = [];
      $conResumen = 0;
      if (count($resultado1)> 0) {
        foreach ($resultado1 as $key => $value) {
          $contActive = '';
            if($value['nivel'] == 2){ 
              if ($value['nParCodigo'] == 1) { 
                $conResumen = 1;
              }

              $pos = strpos($value['cParDescripcion'], ",");
              if ($pos === false) { 
                $htmlMenu .= "<li class='cm-submenu'><a class='".$value['cParDescripcion']."'>".$value['cParNombre']." <span class='caret'></span></a>
                              <ul>";
                $jer = $value['cParNivPadre'];

                foreach ($resultado1 as $key => $value2) { 
                  if($value2['cParNivPadre'] == $jer && $value2['nivel'] == 5){
                    $htmlMenu .= '<li><a href="javascript:menus(\''.$value2['cParDescripcion'].'\');">'.$value2['cParNombre'].'</a></li>';
                  }
                }
                $htmlMenu .= "</ul></li>";
              } else { 
                $array = explode(",", $value['cParDescripcion']);
                $htmlMenu .='<li '.$contActive.'><a href="javascript:menus(\''.$array[0].'\');" class="'.$array[1].'">'.$value['cParNombre'].'</a></li>';
              }
            }
        }

      }

    
          
    }
  }

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport"content="width=device-width, initial-scale=1.0, maximum-scale=1" />
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-clearmin.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/roboto.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/material-design.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/small-n-flat.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/js/jquery-confirm/jquery-confirm.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/js/jquery-datatable/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="assets/css/estilo.css" />
    <title>Restaurante</title>
  </head>
  <body class="cm-no-transition cm-1-navbar">
    <div id="cm-menu">
      <nav class="cm-navbar cm-navbar-danger">
        <div class="cm-flex"><a href="index.php" class="cm-logo" style="    color: white;font-size: 25px;font-weight: bold;display: flex;justify-content: center; align-items: center;">RESTAURANTE</a></div>
        <div class="btn btn-danger md-menu-white" data-toggle="cm-menu"></div>
      </nav>
      <div id="cm-menu-content">
        <div id="cm-menu-items-wrapper">
          <div id="cm-menu-scroller">
            <ul class="cm-menu-items">
              <?php echo $htmlMenu; ?>
          </div>
        </div>
      </div>
    </div>
    <header id="cm-header">
      <nav class="cm-navbar cm-navbar-danger">
        <div class="btn btn-danger md-menu-white hidden-md hidden-lg" data-toggle="cm-menu"></div>
        <div class="cm-flex">
          <h1 id="nomPagina"></h1>
        </div>
        <div class="dropdown pull-right">
          <button class="btn btn-danger md-account-circle-white" data-toggle="dropdown"></button>
          <ul class="dropdown-menu">
            <input type="hidden" id="codUsuarioP" value="<?php echo $_SESSION['codUsu']; ?>">
            <input type="hidden" id="nomUsuarioP" value="<?php echo $nomUsuPri ?>">
            <li class="disabled text-center"><a style="cursor: default"><strong><?php echo $nomUsuPri; ?></strong></a></li>
            <li class="divider"></li>
            <li><a href="destroy_session.php"><i class="fa fa-fw fa-sign-out"></i> Salir</a></li>
          </ul>
        </div>
      </nav>
    </header>
    <div id="global">

    </div>
    <div>
      <footer class="cm-footer">
        <span class="pull-left">Conectado como <?php echo $nomUsuPri; ?></span>
      </footer>
    </div>
    <div id="m_preload">
        <div>
            <img src="assets/img/pre3.gif" alt=""/>
        </div>
    </div>
    <script src="assets/js/lib/jquery.min.js"></script>
    <script src="assets/js/jquery.mousewheel.min.js"></script>
    <script src="assets/js/jquery.cookie.min.js"></script>
    <script src="assets/js/jquery-confirm/jquery-confirm.min.js"></script>
    <script src="assets/js/jquery-datatable/jquery.dataTables.js"></script>
    <script src="assets/js/jquery_autocomplete/jquery.autocomplete.js"></script>
    <script src="assets/js/fastclick.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/clearmin.min.js"></script>
    <script src="assets/js/demo/home.js"></script>
    <script src="assets/js/panel.js"></script>
  </body>
</html>
