<?php
    /*
     *   Créditos a Anderson Salas (contacto@andersonsalas.com.ve) hasta la versión 0.3.1
     *   Repositorio en GitHub: https://github.com/andersonsalas/htdocsMe
     *   
     *   htdocsMe Version 0.4 Copyright (C) 2017 Jorge Armando.
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
    $langAllow = array (
        'pt-BR' => 'assets/flags-mini/br.png',
        'pt-PT' => 'assets/flags-mini/pt.png',
        'en'    => 'assets/flags-mini/us.png',
        'es-ES' => 'assets/flags-mini/co.png',
        'ja'    => 'assets/flags-mini/jp.png' 
    );
    $lang = 'es-ES';
    if ( isset( $_COOKIE[ 'htdocsMe-lang' ] ) )
        $lang = $_COOKIE[ 'htdocsMe-lang' ];
    else {
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
                'buscar'   => 'Buscar arquivos e pastas...',
                'subir'    => '(Subir um nível)',
                'Nuevo'    => 'Novo projeto',
                'Carpetas' => 'Pastas',
                'Archivos' => 'Arquivos'
            );
            break;
        case 'pt-PT':
            $langString = array(
                'buscar'   => 'Buscar Ficheiros e Diretorios...',
                'subir'    => '(Subir um nível)',
                'Nuevo'    => 'Novo projeto',
                'Carpetas' => 'Diretorios',
                'Archivos' => 'Ficheiros'
            );
            break;
        case 'en':
            $langString = array(
                'buscar'   => 'Find files or folders ...',
                'subir'    => '(Up one level)',
                'Nuevo'    => 'New project',
                'Carpetas' => 'Folders',
                'Archivos' => 'Files'
            );
            break;
        case 'ja':
            $langString = array(
                'buscar'   => 'バスカーゴ・カーペタス ...',
                'subir'    => '(1つ上のレベル)',
                'Nuevo'    => '新しいプロジェクト',
                'Carpetas' => 'カーペタス',
                'Archivos' => '記録'
            );
            break;
        default:
            $langString = array(
                'buscar'   => 'Buscar archivos o carpetas...',
                'subir'    => '(Subir un nivel)',
                'Nuevo'    => 'Nuevo proyecto',
                'Nombre'   => 'Nombre del proyecto',
                'Crear'    => 'Crear',
                'Cancelar' => 'Cancelar',
                'Carpetas' => 'Carpetas',
                'Archivos' => 'Archivos'
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
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>htDocs</title>
        <!-- Custom CSS -->
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container-fluid main-container">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="search-box panel panel-default">
                            <div class="panel-body">
                                <input type="text" class="form-control input-lg input-busqueda" placeholder="<?php echo $langString[ 'buscar' ] ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="search-box panel panel-default">
                            <div id="new-folder" class="panel-body">
                                <a id="shortcut" href=""  data-toggle="modal" data-target="#myModal">
                                    <i id="shortcut-icon" class="fa fa-folder" aria-hidden="true"></i>
                                    <span id="shortcut-label"><?php echo $langString[ 'Nuevo' ] ?></span>
                                </a>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="panel panel-info">
                                            <div class="panel-heading text-center">
                                                <h4>
                                                    <i class="fa fa-folder fa-lg" aria-hidden="true"></i>
                                                    <?php echo $langString[ 'Nuevo' ] ?>
                                                </h4>
                                            </div>
                                        </div>
                                    </div><!-- /.modal-header -->
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon" id="basic-addon1">
                                                        <i class="fa fa-tag" aria-hidden="true"></i>
                                                        <?php echo $langString[ 'Nombre' ] ?> 
                                                    </span>
                                                    <input type="text" class="form-control" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.modal-body-->
                                    <div class="modal-footer">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="btn-group btn-group-justified">
                                                    <a href="" class="btn btn-default" data-dismiss="modal">
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                        <?php echo $langString[ 'Cancelar' ] ?>
                                                    </a>
                                                    <a href="" type="button" class="btn btn-primary">
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                        <?php echo $langString[ 'Crear' ] ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.modal-footer -->
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>
                    <div class="col-md-2">
                        <div class="search-box panel panel-default">
                            <div id="phpadmin" class="panel-body">
                                <a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/phpmyadmin/" target="_blank">
                                   <img class="img-responsive" src="assets/imgs/logo.png" alt="phpMyadmin">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row folder-view">
                    <div class="col-md-12">
                        <h4>
                            <i class="fa fa-database" aria-hidden="true"></i>
                            <?php echo $langString[ 'Carpetas' ] ?>: <span class="pull-right text-muted"><?php echo $url;?></span>
                        </h4>
                        <hr />
                    </div>
                    <?php foreach(scandir($url) as $carpeta){
                        if(($url == __dir__) == $_SERVER['DOCUMENT_ROOT'])
                        {
                            $link = $e_link = DIRECTORY_SEPARATOR.$carpeta;
                        } else {
                            $link = $i_url.DIRECTORY_SEPARATOR.$carpeta;
                        }

                        if($carpeta == '.' && isset($_GET['url']) && (dirname($link) != DIRECTORY_SEPARATOR)){
                            ?>
                            <div class="col-md-3 col-xs-6">
                                <span class="name-search">..</span>
                                <a href="?url=<?php echo dirname(dirname($link));?>" class="carpeta-href">
                                    <div class="panel panel-default carpeta">
                                        <div class="panel-body text-center">
                                            <div class="icono-carpeta" style="background: #eee">
                                                <i class="fa fa-level-up fa-5x" aria-hidden="true"></i>
                                            </div>
                                            <p><?php echo $langString['subir'];?></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                        }

                        if($carpeta == '.' || $carpeta == '..' || !is_dir($url.DIRECTORY_SEPARATOR.$carpeta))
                        {
                            continue;
                        }
                    ?>
                    <div class="col-md-3 col-xs-6">
                        <span class="name-search"><?php echo strtoupper( $carpeta ); ?></span>
                        <a href="?url=<?php echo $link ;?>" class="carpeta-href">
                            <div class="panel panel-default carpeta">
                                <div class="panel-body text-center">
                                    <div class="icono-carpeta">
                                        <i class="fa fa-folder-open fa-5x" aria-hidden="true"></i>
                                    </div>
                                    <p><?php echo $carpeta; ?></p>
                                </div>
                            </div>
                        </a>
                        <a href="http://<?php echo $_SERVER['HTTP_HOST'].$link;?>" target="_blank" class="boton-abrir-externo">
                            <i class="fa fa-external-link fa-lg" aria-hidden="true"></i>
                        </a>
                    </div>
                <?php } ?>
                </div>
                <div class="row files-view">
                    <div class="col-md-12">
                        <h4>
                            <i class="fa fa-file-code-o" aria-hidden="true"></i> <?php echo $langString['Archivos'];?>:
                        </h4>
                        <hr />
                    </div>
                    <?php foreach(scandir($url) as $archivo){ 
                        if($archivo == '.' || $archivo == '..' || !is_file($url.DIRECTORY_SEPARATOR.$archivo))
                        {
                            continue;
                        }
                            if(($url == __dir__) == $_SERVER['DOCUMENT_ROOT'])
                            {
                                $link = DIRECTORY_SEPARATOR.$archivo;
                            } else {
                                $link = $url.DIRECTORY_SEPARATOR.$archivo;
                            }
                    ?>
                    <div class="col-xs-6 col-sm-4">
                        <span class="name-search"><?php echo strtoupper( $archivo ); ?></span>
                        <a href="<?php echo $link;?>" class="carpeta-href">
                            <div class="panel panel-default archivo">
                                <div class="panel-body">
                                    <p>
                                        <i class="fa fa-file icono-archivo" aria-hidden="true"></i>
                                        <?php echo $archivo; ?>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="container-fluid footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-xs-6">
                            <p>htdocsMe 0.4 - <a href="https://github.com/MisterGeorge/htdocsMee">GitHub</a></p>
                        </div>
                        <div class="col-xs-6 lang-list">
                            <?php
                                foreach ( $langAllow as $key => $_lang ) {
                                    if ( $key != $lang )
                                        echo '<a href="?url=' . str_replace(__dir__,'',$url) . '&lang=' . $key . '"><img src="' . $_lang . '"/></a>';
                                    else
                                        echo '<img class="selected" src="' . $_lang . '"/>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Custom JS -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("html").niceScroll({cursorcolor:"#ff9900"});
                var busqueda = '';
                $('.input-busqueda').keyup(function () {
                    busqueda = $('.input-busqueda').val();
                    if(busqueda != ''){
                        jQuery('.name-search').parent().hide();
                        var pesquisa = '.name-search:contains(\'' + busqueda.toUpperCase() + '\')';
                        jQuery('body').find( pesquisa ).parent().show();
                    } else {
                        jQuery('.name-search').parent().show();
                    }
                });
            });
        </script>
    </body>
</html>