<?php
/*
 * htdocsMe (versión 0.3.2)
 *
 * Desarrollado por Anderson Salas (contacto@andersonsalas.com.ve)
 * Repositorio en GitHub: https://github.com/andersonsalas/htdocsMe
 *
 * -------------------------------------------------------------------------------------
 *
 *   htdocsMe
 *   Copyright (C) 2015 Anderson Salas
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

    function rglob($pattern, $flags = 0)
    {
        // Funcion para hacer un glob() recursivo. Tomado de:
        // http://stackoverflow.com/a/17161106

        $files = glob($pattern, $flags);
        //foreach (glob(dirname($pattern).'/*', GLOB_ONLYDIR|GLOB_NOSORT) as $dir) {
        foreach (glob(dirname($pattern).'/*') as $dir){
            $files = array_merge($files, rglob($dir.'/'.basename($pattern), $flags));
        }
        return $files;
    }

    function human_filesize($bytes, $decimals = 2)
    {
        // Funcion para convertir el tamaño de los archivos a un numero más amigable
        // http://php.net/manual/es/function.filesize.php#106569

        $sz = 'BKMGTP';
        $factor = (int) floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
    }

    function setCookieLongTime($name, $value)
    {
        setcookie ( $name, $value, time () + ( 60 * 60 * 24 * 365 * 10 ) ); // 10 anos
    }

    session_start();

    $langAllow = array (
        'pt-BR' => 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEASABIAAD/2wCEAAYEBAQFBAYFBQYJBgUGCQsIBgYICwwKCgsKCgwQDAwMDAwMEAwODxAPDgwTExQUExMcGxsbHCAgICAgICAgICABBwcHDQwNGBAQGBoVERUaICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIP/AABEIAB4AMgMBEQACEQEDEQH/xACRAAACAwEBAAAAAAAAAAAAAAAABAUGBwEDEAABAwIEAggEBwAAAAAAAAABAgMEAAUGERIhEzEHFCIyQWFxgUJRgpEVIyRDUlSxAQACAwEBAAAAAAAAAAAAAAAABQMEBgEHEQABAwEFBQcDBQAAAAAAAAABAAIDBAUREiExBiJBUaEyYYGRseHwExQjM1JiwdH/2gAMAwEAAhEDEQA/AKbSVYxFCFM2XCl2uo4qECPD8Zb3ZR9I2KqoVVoRw5dp/IaprQWPNUZgYWfuP9c0/d8B3CKlT1vcTcY6e/wsuKn6Rsfaq9Na7HZSAxu79FcrtnpYt6P8jevlxVYIIJB5g5EfI/I03WeRQhFCE7abNPu0rq0JAUvLNSlKCUpHzPj9qr1NUyFuJ+it0dFJUPwx6+i0OxYAtcDS9M/XShuNQyaSfJHj6msrWW1JJkzdb181tqDZ6GHN++/oPBZtjjEOCMSXR1mdfryzEjFTYiRoiDFb0HSrUj4+0OZr02xLK+ziGFrS9wvLj2jf6KCqqHSO/iOChrHhqTFm9bwBidmfcG1E/hpSq3S1JTuM47x4b2x3G3kaZ1bY52YKhl7T49dQq7Jiw3jJbG1ZYGKbHDuNxhLt10fZSp8BJbdad+NCgoDPJWeyhXkc88lBUPhacTGu48uHRN57NgrGB7hc4jUa+6pOIcJXKy/mOlL0RR0okJ23PIKQdwfSn1FaUdRkMncljLSseWlzNzmc/wDQoSmCUrra1tuJcbUUOI3QtJIUD5EVwgEXHRda4tN4yIVysfSPMY0s3VHWWv7CNnR6jkr/AGkNZYTHZx7p5cPZamg2le3dm3hzGvv8yVTxh0cSru5IumEuFc4UhZeTGC+HIjOrVrXpCskqSoqJ0qy39q1Fk7SshaIqu+N7RdfduuA08U0+k2f8kBDmnzCQs/RbimZPE29RE2qOyoKXIluIKEgfwbSpZJ581Der1XtTRxtuid9V50DQepXBRP1dutHErR7n0hRocZEK0a5i2UJa69JKlZ6Bpz37Th25msK2ypJ5DLObi433D5kqtXtHHG3BTjFdxOnv6d6pE+4TbhI6xNeU+74KVyHkkcgKfQwsjGFguCydRUyTOxSHEfmiXqVQLlCEUIXvEmy4b4kRXVMPD9xByPv4H3qOSJrxc4XhSwzvidiYS13cmLrfbpdVhU58ugd1vutj0QNvvUVPSRw9gXKerr5aj9Q393DySO9WVTRQhFCF/9k=',
        'pt-PT' => 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEASABIAAD/2wCEAAYEBAQFBAYFBQYJBgUGCQsIBgYICwwKCgsKCgwQDAwMDAwMEAwODxAPDgwTExQUExMcGxsbHCAgICAgICAgICABBwcHDQwNGBAQGBoVERUaICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIP/AABEIAB4AMgMBEQACEQEDEQH/xACNAAEAAwADAAAAAAAAAAAAAAAABQYHAQIDEAAABAQEBQMFAAAAAAAAAAAAAQIDBAUREgYTFCEHMUFCYRUjcTIzNIHCAQEAAgMBAQAAAAAAAAAAAAAABAUBBgcIAhEAAQMCAgYHCQEAAAAAAAAAAAECAwQREjEFIVFhcYEHEyIyQZHBBhQzQlJiobHR8P/aAAwDAQACEQMRAD8Ayca2agAMk5L5XMlQanChH8ut+Zku2W2862iFLK3Fmnmh2HozckaTI/VdW2vqvnlc6GRkdDGTrZwBkAAAIgTDyCaHwlw7K4t+Mm8ybzkQFEQbSt0alSDWlSy6kVCp5OvQVNfUOSRkTfmXXw2GwaEo2vdidtRP96GpJw5ZJNcmZvFGm36icNcWXnZX4l9Pop3/ALFquiIvduus34f0JxvtN0gq4YqlYms7K9i+tVz7+Hb9vIzviRI4dlTE2h2Ew2rUaH20GRoNxKCVmJIuV293kqikp5rSvi8G5cNn8N/9m65zkWFzsWFLoq52vay8PAoosDawAAAhxMPIJZsEYohpNFraj2jel0Tablu62nEEZIeSnkqhLMlJ6l8CBW0z32fGtpG5b9ylpo2u6l2vL9L4KalC46gnpeqDObwXoSWtJoiP3dJZ9u6hKpXtsr5psPl+k5kh6rDJfl5Yr5b87HR9E2rVWSNirOiouNFvrVb3VNVl58ilY+xe1P49KYRnTwEPs0W5GtVCSbik9NkkSfHyIdBSOju563e7P+HRNBaJWlj7a3kdnu3fm67yqCxL8AAAIcTDyCABJwClaZW/f/IjS5nY+i3uz8W+p6j4OtgAAAAH/9k=',
        'en'    => 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEASABIAAD/2wCEAAYEBAQFBAYFBQYJBgUGCQsIBgYICwwKCgsKCgwQDAwMDAwMEAwODxAPDgwTExQUExMcGxsbHCAgICAgICAgICABBwcHDQwNGBAQGBoVERUaICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIP/AABEIAB4AMgMBEQACEQEDEQH/xACZAAACAwEBAAAAAAAAAAAAAAAGBwQFCAIDEAACAQIFAQYCBwkAAAAAAAABAgMEBQAGBxESIQgTFDFBYSJRIzJCUnFylBUWN1dkgZGz0gEAAwEBAQEAAAAAAAAAAAAAAwQFBgIBBxEAAQIDAwgJAwUAAAAAAAAAAQACAwQRBRIhBhYxQVFTcaETFBUiYWORwfAzQ7E0QlLR4f/aAAwDAQACEQMRAD8AbWQNbcjZ+pltNcqUF2qV4S2at4sk3T4hA7AJMPbbl8wMPTElEhY6Rt+aENkQOQXqT2WqCrElxyO60VT9ZrNOx8M253PcyfE0Psp3T0HHzw1LWqRhExG3WhxIAKDMjWC9WHTbUy3XijloK5Dby0E68W25EBhturKduhUkYBbsVr2tLcRT3VrJhtJxg8fZdWKGWfR3UWCFDJNL4BI41BZmZpQAABuSSfIDE6xTSMD4q7lj9vgfypGm3Zhvl3aO45vZ7RbTs60CEeNlHyfzWAf5f8pxoJm1AMGYnl8+YrCw5fWU77lftMNI8vx0f0Nth4k01upx3lXUsvm3HrJI33nc/icSmsizDq6fwmCQ1Keftf1vfSdxlSMwcj3RkrmV+O/TkFp3UHbz2Yj3xRFjj+XL/UHrIQ8t50aQ7ppuFI6giukHUeXriGbaj7Stxmb5g9EdW7tGUdvooqOny7UmCEcY++rjO+w9DJKHc/3OFXTldS6zRO8HoVV5410jzNlevsgsb0jVqqniTOr8eLhvIKCfLA3zF4UonrOyc6vHbEvg3dVFRaYanJklbkrWxrh49onG0gj4d0CPUHfzxxCi3E7bFj9cu967drqR0e03GQR+7kvX+pX/AJwXrXgouaJ3g9CgW5Zs0rulZLW3PIMldWTnlNUVFymlkY+7OSenoPTDTbXitwGC4zO8wehUX9raL/y1T9bJjvtuPtK9zO8wehUnLObci5nui2yx6Uy1tY23JUrjxjB+1K+3GNfdiN/TfD0WxIcMVc4c1BblJOHQ88k7bfoxp/JRxPcMt0tNVsN5YIZ5pkU/ISHu+X48RiWZeHqRu353eFBGfsraSR5SzK+Waana8WNYfES07yOIXmk2CluRTlsDuPT1xzMStxl6lKqlY1szMaaYx7yWk4oZ0ls2Qai0Zhu2cqeN6C2yUqiolMnGITnjueB8uRG59MClYHSGlKlVMpLRjS9zo3Xa1qnBTaP6T1dKlTR2emqIJV5wzRyyMjA+RDK5BGDmWYNSzPb85vDySp1AOVci1G140u7ygYkQ3Smr3elbr0DOVXu2P3X29t8Py9lQouhwrs1obsop0fvPJB51X0mHQ6an9fhrN5u0c0POib3hWn4LblXT7KVQ1st4pbXbommlhpwDK/AdWZnILufmzYRLnRX4nEqdoWWNSe0Pm7N6NR24tZLFKPhp6dyKiZCehnnXiRuPNE2HzLDGglbNZDxPeckoswdAXvpT/CTUgDoA1v2A6AdfQYm5Q6Bw91fyW/Vw+Psp1oJGi+pJHnxof9gxMsT644q9lj9vgUDZA1Uzhkes3s9VyoXfea1T7vSv19E3+iY/fTb35Y1sxJsijHTtXz6HHIWuNNdQLTqVlWWsa3GBQxpbhRVHCWIuPrhT9tPzKPwxmpmAYL6VVBrrwVVN2b9H5ZnlNldDIxbhHV1caDc77KiyhVA9ABsMFFpR9vIf0ueiav/Z',
        'es-ES' => 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEASABIAAD/2wCEAAYEBAQFBAYFBQYJBgUGCQsIBgYICwwKCgsKCgwQDAwMDAwMEAwODxAPDgwTExQUExMcGxsbHCAgICAgICAgICABBwcHDQwNGBAQGBoVERUaICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIP/AABEIAB4AMgMBEQACEQEDEQH/xACLAAEAAgIDAAAAAAAAAAAAAAAAAQQDBQYHCBAAAQMCAwQJBQAAAAAAAAAAAQIDBAAFBxESBhcxkRMUFiFBU1SU0hUiQmGCAQEAAwEAAwAAAAAAAAAAAAAAAgMGAQQHCBEAAQIDBAkEAwAAAAAAAAAAAAECBREWAwYxUxIVIUFhYpGhoiIzQ5JysdH/2gAMAwEAAhEDEQA/AO3K9CyNeRSQFJAUkCaSApIEUkDzRvuxE9ez7VPzr6EoaF5Xkpj9c2oON+IYBJns5AZk9VT4f3ShoXleShIzanJt4+2doejp2tu3U3i+kS7RGiNKmCG4wXG5Ta9bjRBXknTxrxqNhj/bsp8dJZTnhuLtZ2qYqV2cXb3MZaai34xZ4jSHHky4TZbflBYEaNG0FJzdSTmpZyBFdW5MObjY7NmDlw3qpFsVtV39jWXTFnFW03B+3XKQ1GnRVaJDCozRKFZBWRKXFJ4KB7jVzLlQlyTSz2fkv8Ivi1s1SpvuxE9ez7VPzqVDQvK8lI66tRvuxE9ez7VPzpQ0LyvJRrq1NH2cZ81XIVbUfJ3NdQ7MxeiFm22tFvuEacjo5C4yw4mPKbDjCyPB1HdqT+qi+8GkktDHiSbcliL7i/VDHKswkyHX3HiC6tS9CR9qdRz0pBzySngkeAo28MklodzjrktX5F6GIbPNDg8rkKlUfJ3OUQzNXohduUP6g1CbdDTaoLPVw8y3pcfGefSSVEnpHM/yqtkf0Z+jHj+ib7lMX5PEpdnGfNVyFWVHydyFDszF+qDs4z5quQpUfJ3FDszF6IbesybsUAoBQCgFAKA//9k=' );
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
                'Carpetas' => 'Pastas',
                'Archivos' => 'Arquivos'
            );
            break;
        case 'pt-PT':
            $langString = array(
                'buscar'   => 'Buscar Ficheiros e Diretorios...',
                'subir'    => '(Subir um nível)',
                'Carpetas' => 'Diretorios',
                'Archivos' => 'Ficheiros'
            );
            break;
        case 'en':
            $langString = array(
                'buscar'   => 'Find files or folders ...',
                'subir'    => '(Up one level)',
                'Carpetas' => 'Folders',
                'Archivos' => 'Files'
            );
            break;
        default:
            $langString = array(
                'buscar'   => 'Buscar archivos o carpetas...',
                'subir'    => '(Subir un nivel)',
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


?><!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>htdocsMe!</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <link href="http://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet" type="text/css">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <style>
            body {
                font-family : "Droid Sans"
            }

            .main-container {
                padding-top    : 30px;
                padding-bottom : 30px;
                background     : #FAFAFA;
            }

            .search-box, .search-box *, .carpeta, .archivo {
                border-radius : 0;
            }

            .search-box {
                margin-bottom : 50px;
            }

            .carpeta > div, .archivo > div {
                padding : 0;
            }

            .carpeta:hover, .archivo:hover {
                box-shadow : 0 0 15px 0 rgba(0, 0, 0, 0.3);
                transition : all 0.2s;
            }

            .carpeta:hover .icono-carpeta, .archivo:hover .icono-archivo {
                background : #5E9EE8;
                transition : all 0.2s;
            }

            .carpeta .glyphicon {
                font-size : 60px;
            }

            .carpeta-href:hover, .carpeta-href:focus {
                text-decoration : none !important;
            }

            .carpeta p, .archivo p {
                margin : 0;
                color  : #363636;
            }

            .carpeta p {
                padding : 8px 0;
            }

            .icono-archivo {
                background   : #FAFAFA;
                padding      : 20px;
                top          : 0;
                margin-right : 5px;
                font-size    : 15px transition : all 0.5 s;
            }

            .archivo:hover .icono-archivo {
                color : white;
            }

            .icono-carpeta {
                width      : 100%;
                display    : block;
                padding    : 40px;
                background : #E2E2E2;
                color      : white;
                transition : all 0.5s;
            }

            .search-box input {
                border-top          : none;
                border-left         : none;
                border-right        : none;
                border-bottom-width : 2px;
                padding-left        : 0;
                padding-right       : 0;
                box-shadow          : none !important;
            }

            .name-search {
                display : none;
            }

            .footer {
                padding : 20px 0;
            }

            .footer p {
                margin : 0;
            }

            .footer .lang-list {
                text-align : right;
            }

            .footer .lang-list img {
                padding-left : 6px;

            }
            .footer .lang-list img.selected {
                opacity: 0.3;
            }

            .boton-abrir-externo {
                width         : 35px;
                height        : 35px;
                color         : #424242;
                background    : none;
                position      : absolute;
                border-radius : 50%;
                right         : 25px;
                top           : 10px;
                opacity       : 0.2;
            }

            .boton-abrir-externo .glyphicon {
                font-size : 14px;
                padding   : 8px 12px;
            }

            .boton-abrir-externo:hover {
                opacity    : 1;
                background : #363636;
                color      : white;
            }
            /*Link CSS*/
            #phpadmin{
                height: 76px;
                padding: 10px;
            }
            #phpadmin img{            
                height: 60px;
                margin-left: 20px;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid main-container">
            <div class="container">
                <div class="row">
                    <div class="col-md-10">
                        <div class="search-box panel panel-default">
                            <div class="panel-body">
                                <input type="text" class="form-control input-lg input-busqueda"
                                       placeholder="<?php echo $langString[ 'buscar' ] ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="search-box panel panel-default">
                            <div id="phpadmin" class="panel-body">
                                <a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/phpmyadmin/" target="_blank">
                                   <img class="img-responsive" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAKwAAABkCAMAAAAsVCszAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAALuUExURenp7fbr2/OmMvvBavbt4f2pKuytTvu8XNDKw+vbw9fDpfGpPv+ZAMzMzPnRlNnBnPajJvu5VsLC1Pbp1P6mJPjaq/6iGeuuUuW0bPyuOt29jJKStdHS3r290fXx6Z2dvfnTnG1tnu7u8MnJ2aSkwffiwfjWouO2cv6hFfSkLN/Wyuzl3POsQu3QpfffunV1o3t7ptXFrI2NsvfPlNbW4eTk6tHKvvu9YeqxXNPHs/jctPnPjq2tx8/Lx/6mIf6kHdy+kfrHevXn0fmhHv+aBPXy7bKyyra2zf+cCP6aBvrLhffkyf2bBvrIfeC7hffmzfO9bP2uN/y0SPrFdfy2TdLIu/u/ZOro5fuxQf2wPeTczt3d5fDw8t67hvXz8PXYrPumJmZmmfrJgeHh6ISErH5+qLm5zuG5fOLf2/+dC/Xy7PW1Vf2qLefn7PfXpfueEqCgvvbu5P6jG+TGmdjY4/mfGO3AfJWVuf6gEueyY/yzRfnNiv6fEN3Jq/Dew/ycCv2bCfrEcoCAqvycDffjxP6eDv6eDPDEgaqqxc7O3IqKsN3MsoODrfLw79ra5P2rMM3N2/iiIpqau/6cB6+vyPXx7H+Brfjcs/jbsPTCdv2sM/ukIWtrnPqfF/T09OLi4uDg4OHh4fPz8+Xl5ePj4/Ly8s/Pz+bm5t/f3/Hx8e/v7+fn5+rq6vDw8Ojo6OTk5O3t7dDQ0NLS0tHR0e7u7vX19dnZ2dXV1ezs7Ovr69ra2t7e3tTU1N3d3enp6fX08vX089bW1tPT09zc3Nvb29fX19jY2P2oKI+PtPPz9PX08XBwn/rDcPbw6PLy8/ehH/jet/fkx/y0R/jYqObl4+3k2OPg3PudDr/C2fmgGvy4UtnW0viqNZmbwevr7+LCkurIlOrKmPuqL9fV04mJr9zb2u7t7PLu6vHw8O/ZuOrq6Py0Q/GnOfPEfPHs5NnEpPC9cN/e3fPy8ffLiPTRnqiow+3r5/y1TPm/aPX19TQVb1gAAAD6dFJOU////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////wDeYEUjAAARrElEQVR42mL4OaBg9QJSVAMEEMOAunXRgm3zSFAOEEAD69gNK7btI0E5QAANrGMXH1m8eCXxygECaEAdO+/w7n2rFhOvHiCA6OHYeStXLgIzlq5ciiKxdvvedT8XbyDaIIAAor1j5y3evmzZnvXzfq5dsXnjsm07kMuCQ3t3/Fy7hOg8BhBAtHfsykMH16/fxrtrzaFlK5YvPLQXSWr3pt3AYF2+hlijAAKI9o7dunYrKBB5ebdvARVWSAlh0Z7te4FiS+cvJdIogACiWwbbd2QtutAW3oMrVoE8QmweAwiggSwN1vNuAzt27VEiiy+AABpIx+4COhbkzK3bdhOnASCABtCxKzfzHl4IDtMlvFuI0gEQQHRz7LxVG1ZC6VXQVMzLu3fBUkji3bWVGDMAAojmjl0Frg+2LgcWthsPr/25evvGjcuO7QSJ7eXl3b0QXMbO28NLVPEFEEA0duy8DQvA4bh0z8Hl+xZu3LSN99jyNUv2HNkKEuLlXbEAUiHs5d2+iAjTAAKIxo5duWQFJNLXgly1ag/vYlB8LwIliJ28oJCFNmh4edcTYRpAANHYsftWrEAullYiZaQFvLzLFsyHsHfw8m5aS9g0gACisWN3Q7MQlnb3dqBjV0Adu2gTMJQJmwYQQLR17KI9sFSJAYCBybtxIazu2gZ0OeHWF0AA0daxa4BZCIcUMBXwbp4PS6krgLxtBIsvgACirWNX8M5fiKOYAKYC3k3zYSG7HMjjXUfIOIAAYqBtKuCdvwR3KuA9tGQ1lAsqGnj3EGp9AQQQTR27k3fZ+iW4UwHvwfkwx67aDOIvJGAeQADR1LELeDcuWY8rzIHg2HxYxbXoEIi/cRV+8wACiJaOBabLQ+sX48h5ILBrISxkfx4FCxzGbyBAANHSscB0uX3+cuzlL8SxK9bDCrbDYAHenXgNBAggBpqmAt5j8CyEApZuAjtt7/zlO5DTMC/vUbydR4AAoqFjQXXUsYVYR1xWQ5y2d8GGJdAGzBKICO9yfCYCBBADTVMBMFXuwN5HAIMVC5cuX4zifN5N+Ho4AAHEQNNUwHsEq2NXLYO4bOHCpauOLYW1xCEA37AiQADRzrHzjoJTJbYOy3yowxYCWzlH5yNqBXDxhaeHAxBAtHPsBlDw7cbmWHBVCwJLFi79uXDTUhTH8u7CbSRAANHOsfMhqXItrkIWCNavWARM2eB6a8tGuGtxD4ICBBDNHDvvICRVYnEstEzlXbZ4wVZg3bVxLby+BQPcPRyAAGKgaSrgnb8Cs3GyFhaIG5cDHfvzCDhPITkWdw8HIIAYaJoKeBcvWIQze/FuXrwQXMIu24Lq2M24ejgAAcRA01TAuwSzowBpw4DL1MVLIFlrL6pjcfZwAAKIgaapYNlizFbfOribDq2eD00VG1Adu2wHdkMBAoiBpqlg4/qFuGovUGMbXH2BauUjqI7F1cMBCCAaOXYrJBVsXr4Ee5BDWi2Quhbk+h0rURzLi7X58xMggBhomQp4N2E6djdS+K1fDuss7tqC6ljsPRyAAGKgZSrg3b4Yve29FslRhxeDu4jrwWXcJhTH8s7HZipAANHGsfOOQiN68XJc5Rao4QBp7ILbMEf3ojoWaw8HIIBo49gt0IS5C73tDelrwdoxkC7YBggHLWix9XAAAoiBlqmA98gStLGA5ShRvWQnokY7uALVsdgGQQECiCaOnXcMFtHz12CrKuCNLvCI0VJIaK/Yg+pYLD0cgACiiWNhjWve3Qs34KgQwHUxpJWzCOKDPehBi9kvBgggmjh2PTxVojoWlu9g/a0FYMduhcbD7oOojt2EUXwBBBAtHLt1G7yPMn8V6ggNmmNXItdphxagBe0KdIMBAoiBlqkAmCpXYfUEBKxbCAk7WKm19xiq/DL0XgZAANHCsYuRstBK3AG7cR20sQur1DYvQSu+0Hs4AAHEQMtUwLt8IVK627oL1Smb9y1chDzAAQzaDYfQwh7VZIAAooFjVyG6U8tXLMIZsLybdkIbu0vgQhvWomYytB4OQAAx0DIVbFyH3PZGC1jeQ2tWoFfB234uPYyiBrUdBBBANHAsIhVsXrdgK+rwMUqwbViA0V7Y93Prko28uHo4AAHEQMtUsGk1ovE0bxu6Yw+uWYhWLAOrLWC87ziIq4cDEEAMNEwFvJvWzcccLEDE+b4lqONcsFb3ooUbsfdwAAKIgYapgHf76vUYzQUEOLIOi2P3gLPUDoQhyKvUAAKI6o5di5TkjiEcuxrDrby70UcQkQYNtq4+iKWHAxBAVHcsciNwF7ztvWg7pmNXrF6OxbGwFsGi5QcxejgAAcRAw1QA7LesxkzIiObs+uXY2mLw/vCidbuWoc7hAAQQAw1TAe/u9dAqaOkhLI5dv3gfNp8gl1Y7FuxBbiIABBADDVMB78Il+36iVqgo3e31+zD7ZeiNrUVrFmzfC8tjAAFEbcceRu23QDoKWzZic+w+WDdiPv7G1iL4KjWAAKKyY1HHKtZDh5IPY3Mr75r5O7A6FqOvuGgJNI8BBBCVHbsard+yCnt9AJnzWgDtRixBk8AY6toJzYkAAcRAw1QAbCGuxezMwJ20E9pR+Ine+cJox85bA2l9AQQQAw1TAdCxK3EUW6BcvwG2ImU3hhyOyXyAAKKuY1FLzGXrQGtOVm7C7thNO3dDkyLaYAzvxk1o80tbl67dsG7JgtUAAcRAw1SwcR2oK7ACu1t592yBjYrDGrrLNm/ftXv+8jWrFsEalvOWrlqzeMWRbccOHt21YvVKgACiqmOXogbipjXAtveOZTgcu2nDbphjl+05tnfB4n1blsIbLYtW7Vy9ZMWug8BktfHg3sU7Vi4CSQEEEAPtUgHIsbARDJTEumn79mPbjizZAutGrF0L773MW7tj3foFR45ugpbMy3YtX4todgEEEGmODfYAAUk5KJcdzI2Iw54KeGs1fDwmC/Ae2nPw6LYjhxcsWL943b4dW1Z9BunZD4pjpPy+dsO+xQsOHz202UzAx8dHHdrEXII6FQIQQKQ5NogHBMSEITzVTDCXHV4WoGUlHZCsR91KSBzCgTmSnnkrt+xcPX/vse2bYKnFsAEoHQvuoy1GH5IBCCCSHCuXA3Ydjyo0YCE8X6ypYOOm+xBpPjRD4iKAgl4rt+xYPX/3NoQjYUAKpIcLtEANc34cIIAwHduRkiKPw7H+GhD71cA87zZkHnS8YNnmQwePrFiyes2Gd1CfhaEU70vXahcBBYsP4cp36p6enjdDefdgW/YJEEAYjl2ZmpgojcOxFyDW8ySBeWEQjof3z5+nXIFg3pIly8O/PZ8KTcLVUMX9IP68RSs3rFu/4untTbxcnjw8PoZAZ9miAJhjLfn5+bl4j7xwhYA4ZPsBAgjDsbmnExOn4HAsH9R+cIpzqoFwilh+/hQE5plGoBhLDpABCWlhYAB6RALl2+oWL9x7bM/GZRzp3BObfXxAepxDecEZCQHqz3NLgR3L3dzcLL5i3gUPCKjIMb8Atx8ggDAcK5OYmKiMw7HMUMdGHAByzsA4cT9PzQLS1tCU4QlO0Vt/gKR0QU7zgwQZlwAPHDABM5InDzqQAKoKdQYyPvz8aY0kDktnPwECCOhYJXcbMBAyBQnIAh1bMMVmirISaAwgDSIlC5b6WQWK1VYeHtZCYMiB0q8GJJhBoehiBVQwAyR2FRjfu2pBzuTnuAkkLcBu5b+OZD0bL68Dhlt56i2BXqqHuI4ZSXwWzLEAAQR0rEkiFJwWAuUvGC81+ufP5DlQjqI7UOrscaDOMyI8PDX+ENOqQNHs9fOnHjCUaoTnrVlfBgk1IHgDZHHz8jLBBMzA4dp8/g0TyDXAclQCSHmWlpaCPFVfWtoMkpaCFAYeF3/+BBUZNfb29h4gGuZYgAACOlY5EQ5kfs4rh3MKIGkCCoBJw78CGIAKgUDtF34KA1OsCx8ow+f9/KkApFhdgZWtOCTUIHb68PPyWoBcCAwwsNt42IAsDlA8O/DyskGU2gpA4p8fWryC1BUVQsJFAZpNKmCOBQggoGPdgAEnr1JgAHSR/M+VPYmJTSoq0kCOESRNyKuoAAuIxPKfP6eDfKkqCDYmGEgG6QH9nQkMBhAnBDS7oQlNeRwCUFdLQQPMVhMWxFw8kMIAFOaVwMyfD1FgCAxwTy6IHyJdf3oDw8JDD+i+PCBfBOZYgAACOlYeGOVAlqk+0JngwsDt58+TKYmJJ37+LEhM1D8JLCGArp0WA/alWCEoYyUVggrLGaJAwv7sz5+3gHTwz59HzJyhtY86yI3XgZEMcgrITVyggPNbtnEZ2PnnQ3lDz0OU8oNSgyEkCeeHQvxgDgkXDUagqxxBqQ3mWIAAAjo2BVqwPgE5GloYKDWBgvnnCWD4nvsJpoGOBSXTHHA+NfcCEoEHGkHBcOpnXA6koloPyh0NwOCxLEXJONyPjzwAV7wbVm3ZORPI0llxpBuYzF2AStNBBZkZxHtMtpDCIAlSSM8ClbGgcGCGORYggBh+5gJDtAOU8w1AMQ+K+D5gzlIEBTBDKjjl/lwJ9E/PuZ+vwbENDk47cFqIgFRQTmLA0AGWhqtAwTMXaLM4ai4HBhHIh2Isi4BAEKLnMkgg6vB2UKJ+w8sLS+3vMyG5ABQugkCbT+VAC0UwAAgghp8mQHfJAlkgWuXn18REA2Bod4IDOBqYJkDFQDRQ6u7PqXZgX8Jq2RzXqSKQwuACMJTEQHEGLQy4fNDKJN3F7UCyNWr+/PkZd4Cs9sXL3wIpyayfP79DyzYmSGp/CKQyW37+jIS2ORhByU0U5liAAGL4KQQJy3mTgHTnT2DO6gJGvDuQE/1zAlgInHQTb4ALA6AvzxZBXGANaXVd/gkO6zY1FhYWQUjwcIMCONahWFdUND4ApHTmzi8gyhzoIRZ7UNBtWJMNpLKXLNZmBfl31XKtiaA0vXtDEiQXnBWBFgZ6LsA87QRzLEAAMYALgzRl2S6gg56cBEU4qBmjAgzgez/TEhPnuCvLGgGlmpTAbgJG0SlJsFtFCn+qgYKrBVIV8LhUVFS4gIMHXAJIHNnwc9G+hQs5XcBpRxjkUVDBKQYKOuGfB0BB57hqDSeoWtFd+bMF6O+Gl5CGnGQcuDDIBNWEICtEYM3nnwABxPBzErwo1Y/+aQpOqz/nAd1ndBIcotBKwQRSA7YBTRAEO7YaklPtzkLjCgYceEHFlvPVn0vXL1i8ZSsLKIzsWOCVM9SfjHaQigrUNGrj3AkOCDFgvTgLUhiAubDC4BK8ugcIIAZQIQUBTSXwlgGDATiAu2BSBjLQRjPIBF+QhfYskNo3EmSIggfcIW3d4GKretH6hfsWwdvrF37GmSMcGwRstwN1uLRAynw7YMiBoj/w2/IoMUguABU2/SDdIciFwU+AAGJgABYGBtInpFWEQI1dmRMnpIHtgNzyEyeEft4zAEudKJC9B5Q6YC5yXCQE2B0RPX78uAgwYOO+AwUgLW/V4JAIVlZQchRx0pk4cXaQ9op10N6BlwhQNagBbsV8qf84CNgB9egBtUYCI6UaSJsDzXQUOT47YP66ukcJCQnxwPAACoNacT9viRy3U4A7FiCAGECFgBD2RlYfUCoNwd2//8B+MOPAAQgDLgABrrfAyTPu2av9G+Yjmvn7D3zq7YX2CA8cgOuFUAegdNzyj1dWgoUPHJiHZDKqFQABxCAEbhJgBRPwtBaRgDBzGAiYgzI2jzFkgxe4lbgTNLCyct38+QsXzp+/E58ROxYsIWYbI0AAMdgAM1Yydjlg+aUYTdgINaS8I3ltwRpI/K9dt2Dhhp8rgblsw9KfW5fuwOnYeavWoc304wQAAcRQcPp0F47tASqnT/esImxEEsKtkSw/185fsHzfvsULFy4Hal2+ex2eTWlr1q9evXjJgoXLtxDZYQUIIIZ7ubn3cMgBpYjp/AIzx/GEBGDOCVEA95jWrlm3buda0Ngfgchdu2bNmh1blm4luncNEEDUnwfbumgesH+4as36BUu2UNlogACivmOXLgY2AZbMX7xzKdWNBggwABJLGoNUAH5MAAAAAElFTkSuQmCC" alt="phpMyadmin">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row folder-view">
                    <div class="col-md-12">
                        <h4>
                            <span class="glyphicon glyphicon-th-large"></span>
                            <?php echo $langString[ 'Carpetas' ] ?>: <span class="pull-right text-muted"><?php echo $url;?></span>
                        </h4>
                        <hr />
                    </div>
                    <?php foreach(scandir($url) as $carpeta){

                            if(($url == __dir__) == $_SERVER['DOCUMENT_ROOT'])
                            {
                                $link = $e_link = DIRECTORY_SEPARATOR.$carpeta;
                            }
                            else
                            {
                                $link = $i_url.DIRECTORY_SEPARATOR.$carpeta;

                            }

                            if($carpeta == '.' && isset($_GET['url']) && (dirname($link) != DIRECTORY_SEPARATOR)){
                                ?>
                                    <div class="col-md-3 col-xs-6">
                                        <span class="name-search">..</span>
                                        <a href="?url=<?php echo dirname(dirname($link));?>" class="carpeta-href">
                                            <div class="panel panel-default carpeta">
                                                <div class="panel-body text-center">
                                                    <div class="icono-carpeta" style="background: #BFBFBF">
                                                        <span class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>
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
                                            <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
                                        </div>
                                        <p><?php echo $carpeta; ?></p>
                                    </div>
                                </div>
                            </a>
                            <a href="http://<?php echo $_SERVER['HTTP_HOST'].$link;?>" target="_blank" class="boton-abrir-externo"><span class="glyphicon glyphicon-share" aria-hidden="true"></span></a>
                        </div>
                    <?php } ?>
                </div>
                <div class="row files-view">
                    <div class="col-md-12">
                        <h4><?php echo $langString['Archivos'];?>:</h4>
                        <hr />
                    </div>
                    <?php foreach(scandir($url) as $archivo){ ?>

                        <?php
                            if($archivo == '.' || $archivo == '..' || !is_file($url.DIRECTORY_SEPARATOR.$archivo))
                            {
                                continue;
                            }
                            if(($url == __dir__) == $_SERVER['DOCUMENT_ROOT'])
                            {
                                $link = DIRECTORY_SEPARATOR.$archivo;
                            }
                            else
                            {
                                $link = $url.DIRECTORY_SEPARATOR.$archivo;
                            }
                        ?>

                        <div class="col-xs-6 col-sm-4">
                            <span class="name-search"><?php echo strtoupper( $archivo ); ?></span>
                            <a href="<?php echo $link;?>" class="carpeta-href">
                                <div class="panel panel-default archivo">
                                    <div class="panel-body">
                                        <p>
                                            <span class="glyphicon glyphicon-file icono-archivo" aria-hidden="true"></span>
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
                            <p class="text-muted">htdocsMe! 0.3.2 - <a href="https://github.com/andersonsalas/htdocsMe">GitHub</a></p>
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
        <script type="text/javascript">
            $(document).ready(function(){
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
