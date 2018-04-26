<?php
    /*
     *   Créditos a Anderson Salas (contacto@andersonsalas.com.ve) hasta la versión 0.3.1
     *   Repositorio en GitHub: https://github.com/andersonsalas/htdocsMe
     *   
     *   htdocsMe Version 1.0 Copyright (C) 2018 Jorge Armando.
     *   Repositorio en GitHub: https://github.com/MisterGeorge/htdocsMe
     *
     *   This program is free software; you can redistribute it and/or modify
     *   it under the terms of the GNU General Public License as published by
     *   the Free Software Foundation; either version 2 of the License, or
     *   (at your option) any later version.
     *
     *   This program is distributed in the hope that it will be useful,
     *   but WITHOUT ANY WARRANTY; without even the implied warranty of
     *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *   GNU General Public License for more details.
     *
     *   You should have received a copy of the GNU General Public License along
     *   with this program; if not, write to the Free Software Foundation, Inc.,
     *   51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
     */
    
    /**
     * [rglob description]: Funcion para hacer un glob() recursivo.
     * Créditos a: http://stackoverflow.com/a/17161106
     * @param  [type]  $pattern [description]
     * @param  integer $flags   [description]
     * @return [type]           [description]
     */
    function rglob($pattern, $flags = 0)
    {
        $files = glob($pattern, $flags);
        //foreach (glob(dirname($pattern).'/*', GLOB_ONLYDIR|GLOB_NOSORT) as $dir) {
        foreach (glob(dirname($pattern).'/*') as $dir){
            $files = array_merge($files, rglob($dir.'/'.basename($pattern), $flags));
        }
        return $files;
    }

    /**
     * [human_filesize description] : Funcion para obtener tamaño de archivo y convertir el tamaño de los archivos a un numero más amigable.
     * Créditos a http://php.net/manual/es/function.filesize.php#106569
     * @param  [type]  $bytes    [description]
     * @param  integer $decimals [description]
     * @return [type]            [description]
     */
    function human_filesize($bytes, $decimals = 2)
    {
        $sz = 'BKMGTP';
        $factor = (int) floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
    }

    /**
     * [setCookieLongTime description]: define una cookie antes de ser enviada a la cabecera de HTTP.
     * @param [type] $name  [description]
     * @param [type] $value [description]
     */
    function setCookieLongTime($name, $value)
    {
        setcookie ( $name, $value, time () + ( 60 * 60 * 24 * 365 * 10 ) ); // 10 anos
    }

    // Inicio de sesión
    session_start();
    /**
     * [$langAllow description]: Objeto con las imagenes de las banderas
     * @var array
     */
    $langAllow  = array (
        'pt-BR' => 'assets/flags-mini/br.png',
        'pt-PT' => 'assets/flags-mini/pt.png',
        'en'    => 'assets/flags-mini/us.png',
        'es-ES' => 'assets/flags-mini/co.png',
        'ja'    => 'assets/flags-mini/jp.png',
        'cn'    => 'assets/flags-mini/cn.png' 
    );
    /**
     * [$lang description]: Escogemos por default el idioma español
     * @var string
     */
    $lang = 'es-ES';

    if ( isset( $_COOKIE[ 'htdocsMe-lang' ] ) ){
        $lang = $_COOKIE[ 'htdocsMe-lang' ];
    } else {
        $langs = explode ( ',', $_SERVER[ 'HTTP_ACCEPT_LANGUAGE' ] );
        foreach ( $langs as $_lang ) {
            if ( isset( $langAllow[ $_lang ] ) ) {
                $lang = $_lang;
                setCookieLongTime ( 'htdocsMe-lang', $lang );
                break;
            }
        }
    }

    if ( isset( $_GET[ 'lang' ] ) ) {
        $_lang = strip_tags ( $_GET[ 'lang' ] );
        if ( isset( $langAllow[ $_lang ] ) ) {
            $lang = $_lang;
            setCookieLongTime ( 'htdocsMe-lang', $lang );
        }
    }

    switch( $lang ){
        case 'pt-BR':
            $langString = array(
                'lblBuscar'   => 'Pesquisar arquivos ou pastas...',
                'lblNivel'    => '(Subir um nivel)',
                'lblTitulo'   => 'Gerenciar projeto novo',
                'lblNombre'   => 'Nome do projeto',
                'btnNuevo'    => 'Novo proyecto',
                'btnCrear'    => 'Criar proyecto',
                'btnCancelar' => 'Cancelar',
                'lblCarpetas' => 'Pastas',
                'lblArchivos' => 'Arquivos'
            );
            break;
        case 'pt-PT':
            $langString = array(
                'lblBuscar'   => 'Buscar Ficheiros e Diretorios...',
                'lblNivel'    => '(Subir um nivel)',
                'lblTitulo'   => 'Gestionar Proyecto Nuevo',
                'lblRuta'     => 'Guardar en ruta /',
                'lblNombre'   => 'Nombre del proyecto',
                'btnNuevo'    => 'Nuevo proyecto',
                'btnCrear'    => 'Crear proyecto',
                'btnCancelar' => 'Cancelar',
                'lblCarpetas' => 'Pastas',
                'lblArchivos' => 'Arqhivos'
            );
            break;
        case 'en':
            $langString = array(
                'lblBuscar'   => 'Search files or folders...',
                'lblNivel'    => '(Up one level)',
                'lblTitulo'   => 'Manage New Project',
                'lblNombre'   => 'Projects name',
                'btnNuevo'    => 'New project',
                'btnCrear'    => 'Create project',
                'btnCancelar' => 'Cancelar',
                'lblCarpetas' => 'Folders',
                'lblArchivos' => 'Files'
            );
            break;
        case 'ja':
            $langString = array(
                'lblBuscar'   => 'Buscar archivos o carpetas...',
                'lblNivel'    => '(Subir un nivel)',
                'lblTitulo'   => 'Gestionar Proyecto Nuevo',
                'lblNombre'   => 'Nombre del proyecto',
                'btnNuevo'    => 'Nuevo proyecto',
                'btnCrear'    => 'Crear proyecto',
                'btnCancelar' => 'Cancelar',
                'lblCarpetas' => 'Carpetas',
                'lblArchivos' => 'Archivos'
            );
            break;
        case 'cn':
            $langString = array(
                'lblBuscar'   => 'Buscar archivos o carpetas...',
                'lblNivel'    => '(Subir un nivel)',
                'lblTitulo'   => 'Gestionar Proyecto Nuevo',
                'lblNombre'   => 'Nombre del proyecto',
                'btnNuevo'    => 'Nuevo proyecto',
                'btnCrear'    => 'Crear proyecto',
                'btnCancelar' => 'Cancelar',
                'lblCarpetas' => 'Carpetas',
                'lblArchivos' => 'Archivos'
            );
            break;
        default:
            $langString = array(
                'lblBuscar'   => 'Buscar archivos o carpetas...',
                'lblNivel'    => '(Subir un nivel)',
                'lblTitulo'   => 'Gestionar Proyecto Nuevo',
                'lblNombre'   => 'Nombre del proyecto',
                'btnNuevo'    => 'Nuevo proyecto',
                'btnCrear'    => 'Crear proyecto',
                'btnCancelar' => 'Cancelar',
                'lblCarpetas' => 'Carpetas',
                'lblArchivos' => 'Archivos'
            );
    }

    if ( isset( $_GET[ 'url' ] ) ) {
        $url = $i_url = strip_tags($_GET['url']);
        if(substr($url,0,1) != '.'.DIRECTORY_SEPARATOR){
            $url = '.'.DIRECTORY_SEPARATOR.$url;
        }
    } else {
        $url = $i_url = __dir__;
    }

    /*
     * Creamos la variable para los mensajes de las notificaciones
     */
    $msg = null;
    /**
     * Verificamos la variable
     */
    if(isset($_POST["nameFolder"])){
        /*
         * Capturamos el nombre de la carpeta o proyecto
         */
        $nameFolder = trim($_POST["nameFolder"]);
        /*
         * Obtenemos la ruta
         */
        $dir = dirname(__FILE__);
        /*
         * Amoldamos el string de la ruta a la función mkdir
         */
        $explode_ruta = explode("\\", $dir);
        $_dir_ = implode("/", $explode_ruta);
        /*
         *  Indica si el nombre de archivo es un directorio
         */
        if (is_dir($_dir_)) {
            /*
             *  Comprobamos si la carpeta o directorio existe
             */
            if (file_exists($_dir_."/".$nameFolder)) {
                /*
                 *  Notificamos al usuario la comprobación para que escoja otro nombre
                 */
                $msg = "<div class='alert alert-warning' role='alert'>
                            <i class='far fa-frown'></i> 
                            La carpeta <span class='badge badge-warning text-uppercase p-2'>".$nameFolder."</span> ya existe, utiliza otro nombre!
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                              <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";        
            } else {
                /*
                 *  Creamos la carpeta en la ruta con permisos 0777 (también permite directorios anidados)
                 */
                $newProject =   mkdir($_dir_."/".$nameFolder, 0777, true);
                /*
                 * Creamos la carpeta Assets con las carpetas (css,js,fonts,images) internas que conforman a un proyecto
                 */
                mkdir($_dir_."/".$nameFolder."/"."assets"."/"."css", 0777, true);
                mkdir($_dir_."/".$nameFolder."/"."assets"."/"."js", 0777, true);
                mkdir($_dir_."/".$nameFolder."/"."assets"."/"."fonts", 0777, true);
                mkdir($_dir_."/".$nameFolder."/"."assets"."/"."images", 0777, true);
                /*
                 *  Notificamos al usuario el éxito de la operación
                 */
                $msg = "<div class='alert alert-success' role='alert'>
                            <i class='far fa-smile'></i> 
                            El proyecto <span class='badge badge-success text-uppercase p-2'>".$nameFolder."</span> fue creado exitosamente!
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                              <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";           
            }
        } else {
            /*
             *  Notificamos al usuario que hubo un error fatal en la operación y que repita el proceso
             */
            $msg = "<div class='alert alert-danger' role='alert'>
                        <i class='far fa-meh'></i> 
                        Ha ocurrido un error al crear este directorio: <span class='badge badge-danger text-uppercase p-2'>".$nameFolder."</span>!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }
        $nameFolder = '';
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- The above 2 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>htDocs</title>
        <!-- Custom CSS -->
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
    </head>
    <body>
        <div class="main-container bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-lg-8 mb-4">
                        <div class="card search-box">
                            <div class="card-body">
                                <input type="text" class="form-control input-lg" id="busqueda" placeholder="<?php echo $langString['lblBuscar'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-lg-2">
                        <div class="card search-box">
                            <div class="card-body" id="newFolder">
                                <a href="" id="shortcut" data-toggle="modal" data-target="#myModal">
                                    <i class="fas fa-folder text-warning" id="shortcut-icon"></i>
                                    <span id="shortcut-label"><?php echo $langString['btnNuevo'] ?></span>
                                </a>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header text-center">
                                        <div class="jumbotron col">
                                            <h6>
                                                <i class="fa fa-briefcase fa-lg" aria-hidden="true"></i>
                                                <?php echo $langString['lblTitulo'] ?>
                                            </h6>
                                        </div>
                                    </div><!-- /.modal-header -->
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <form role="form" id="frmCrear" action="<?php echo $_SERVER[ 'PHP_SELF' ] ?>" method="post">
                                                    <div class="form-group row mb-3">
                                                        <label for="nombreCarpeta" class="col-sm-5 col-form-label text-right">
                                                            <?php echo $langString['lblNombre'] ?>
                                                        </label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control" id="nombreCarpeta" name="nameFolder" autocomplete="off" required>
                                                        </div>
                                                    </div><!-- /.form-group -->
                                                    <div class="form-group row border-top pt-3">
                                                        <div class="col-sm-8 offset-sm-2">
                                                            <div class="btn-group btn-block" role="group" aria-label="Basic example">
                                                                <button type="submit" class="btn btn-primary">
                                                                    <i class="fa fa-plus-square" aria-hidden="true"></i>
                                                                    <?php echo $langString['btnCrear'] ?>
                                                                </button>
                                                                <button type="text" class="btn btn-secondary btn-block" data-dismiss="modal">
                                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                                    <?php echo $langString['btnCancelar'] ?>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.form-group -->
                                                </form>
                                            </div>
                                        </div>
                                    </div><!-- /.modal-body-->
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>
                    <div class="col-md-2 col-lg-2">
                        <div class="card search-box">
                            <div class="card-body" id="phpadmin">
                                <a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/phpmyadmin/" target="_blank">
                                   <img class="img-fluid" src="assets/imgs/logo.png" alt="phpMyadmin">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 offset-md-3"><?php echo $msg; ?></div>
                </div>
                <div class="row folder-view">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">
                                    <i class="fa fa-database text-warning" aria-hidden="true"></i>
                                    <?php echo $langString['lblCarpetas'] ?>
                                </li>
                                <li class="breadcrumb-item">
                                    <?php echo $url;?>
                                </li>
                            </ol>
                        </nav>
                        <hr />
                    </div>
                    <?php foreach(scandir($url) as $carpeta){
                        if(($url == __dir__) == $_SERVER['DOCUMENT_ROOT']){
                            $link = $e_link = DIRECTORY_SEPARATOR.$carpeta;
                        } else {
                            $link = $i_url.DIRECTORY_SEPARATOR.$carpeta;
                        }
                        if($carpeta == '.' && isset($_GET['url']) && (dirname($link) != DIRECTORY_SEPARATOR)){
                            ?>
                            <div class="col-md-3 col-xs-6">
                                <span class="name-search">..</span>
                                <a href="?url=<?php echo dirname(dirname($link));?>" class="carpeta-href">
                                    <div class="card bg-secondary border border-default mb-3 text-center carpeta">
                                        <div class="card-body">
                                            <div class="icono-carpeta">
                                                <i class="fas fa-chevron-up fa-5x" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                        <div class="card-footer bg-white text-secondary p-2 text-center">
                                            <h6><?php echo $langString['lblNivel'];?></h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                        }
                        if($carpeta == '.' || $carpeta == '..' || !is_dir($url.DIRECTORY_SEPARATOR.$carpeta)){
                            continue;
                        }
                    ?>
                    <div class="col-md-3 col-xs-6">
                        <span class="name-search"><?php echo strtoupper( $carpeta ); ?></span>
                        <a href="?url=<?php echo $link ;?>" class="carpeta-href">
                            <div class="card bg-secondary border border-default mb-3 text-center carpeta">
                                <div class="card-body">
                                    <div class="icono-carpeta">
                                        <i class="fas fa-folder-open fa-5x" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="card-footer bg-white text-secondary p-2 text-center">
                                    <h6><?php echo $carpeta; ?></h6>
                                </div>
                            </div>
                        </a>
                        <a href="http://<?php echo $_SERVER['HTTP_HOST'].$link;?>" target="_blank" class="link text-secondary">
                            <i class="fas fa-external-link-alt fa-lgx" aria-hidden="true"></i>
                        </a>
                    </div>
                <?php } ?>
                </div>
                <div class="row files-view">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h6>
                                        <i class="fa fa-file text-warning" aria-hidden="true"></i>
                                        <?php echo $langString['lblArchivos'];?>
                                    </h6>
                                </li>
                            </ol>
                        </nav>
                        <hr />
                    </div>
                    <?php foreach(scandir($url) as $archivo){ 
                        if($archivo == '.' || $archivo == '..' || !is_file($url.DIRECTORY_SEPARATOR.$archivo)){
                            continue;
                        }

                        if(($url == __dir__) == $_SERVER['DOCUMENT_ROOT']){
                            $link = DIRECTORY_SEPARATOR.$archivo;
                        } else {
                            $link = $url.DIRECTORY_SEPARATOR.$archivo;
                        }
                    ?>
                    <div class="col-xs-6 col-md-4 col-lg-4">
                        <span class="name-search"><?php echo strtoupper( $archivo ); ?></span>
                        <a href="<?php echo $link;?>" class="carpeta-href">
                            <div class="bg-white text-gray-dark border border-default mb-2 archivo">
                                <i class="fa fa-file icono-archivo text-white" aria-hidden="true"></i>
                                <?php echo $archivo; ?>
                            </div>
                        </a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <footer class="footer bg-dark">
            <div class="footer-right">
            <?php
                /**
                 * [$key description]: Listamos las imagenes de las banderas de los idiomas definidos anteriormente
                 * @var [type]
                 */
                foreach ( $langAllow as $key => $_lang ) {
                    if ( $key != $lang )
                        echo '<a href="?url=' . str_replace(__dir__,'',$url) . '&lang=' . $key . '"><img src="' . $_lang . '"/></a>';
                    else
                        echo '<img class="selected" src="' . $_lang . '"/>';
                }
            ?>
            </div>
            <div class="footer-left">
                <p class="footer-link">htdocsMe 1.0</p>
                <p>
                    <a href="https://github.com/MisterGeorge/htdocsMe" class="text-secondary" target="_blank">
                        <i class="fab fa-github"></i> GitHub
                    </a>
                </p>
            </div>
        </footer>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("html").niceScroll({cursorcolor:"#ff9900",cursorwidth:"16px"});
                document.getElementById("frmCrear").reset();
                var busqueda = '';
                $('#busqueda').keyup(function () {
                    busqueda = $('#busqueda').val();
                    if(busqueda != ''){
                        jQuery('.name-search').parent().hide();
                        var pesquisa = '.name-search:contains(\'' + busqueda.toUpperCase() + '\')';
                        jQuery('body').find( pesquisa ).parent().show();
                    } else {
                        jQuery('.name-search').parent().show();
                    }
                })
            });
        </script>
    </body>
</html>