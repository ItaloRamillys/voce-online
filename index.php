<?php
/*session_start();
if($_SESSION){
    header("Location: painel");
}

require_once('painel/functions.php');
require_once('proj_esc_func\connection.php');
$conn = new Connection();
$conn = $conn->connect();
//SETANDO AS CONFIGURAÇÕES DA PAGINA INICIAL
$query = "select * from config";
$stmt  = $conn->query($query);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$titulo = $row['title_site'];*/

define("BASE", 'http://localhost/voce-aqui');
define("THEME", 'http://localhost/voce-aqui');
define("THEME_PATH", __DIR__);
define("THEME_LINK", BASE);

$configBase = BASE;
$configSiteName = "Você Aqui";
$configThemePath = THEME_PATH;
$configThemeLink = THEME_LINK;

$configUrl = explode("/", strip_tags(filter_input(INPUT_GET, "url", FILTER_DEFAULT)));

$configUrl[0] = (!empty($configUrl[0]) ? $configUrl[0] : "home");
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?=$configSiteName?></title>

        <meta name="viewport" charset="utf-8" content="width=device-width, initial-scale=1.0">

        <!-- LINKS -->
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="<?=$configBase?>/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="<?=$configBase?>/css/header-main.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.7.0/mapbox-gl.css' rel='stylesheet'/>      
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- SCRIPTS -->
        <script src='<?=$configBase?>/js/jquery.js'></script>
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.7.0/mapbox-gl.js'></script>

        <link rel="shortcut icon" href="<?=$configBase?>/img/favicon.ico">
    </head>
   
    <body>
        <style type="text/css">
        .animate{
        opacity: 0 !important;
        }
        .animate__animated{
        transition: 0.4s;
        animation-duration: 1.5s;
        opacity: 1 !important;
        }
        </style>

        <?php include 'nav.php'; ?>

        <div class="main">
            <?php 
            //QUERY STRING
            
            if (file_exists("{$configThemePath}/{$configUrl[0]}.php") && !is_dir("{$configThemePath}/{$configUrl[0]}.php")) {
                //theme root
                require "{$configThemePath}/{$configUrl[0]}.php";
            }elseif (!empty($configUrl[1]) && file_exists("{$configThemePath}/{$configUrl[0]}/{$configUrl[1]}.php") && !is_dir("{$configThemePath}/{$configUrl[0]}/{$configUrl[1]}.php")) {
                //theme folder
                require "{$configThemePath}/{$configUrl[0]}/{$configUrl[1]}.php";
            } else {
                //theme 404
                if (file_exists("{$configThemePath}/404.php") && !is_dir("{$configThemePath}/404.php")) {
                    require "{$configThemePath}/404.php";
                } else {
                    echo "<div class='container'><div class='trigger trigger-error icon-error radius'>Desculpe, mas a página não existe!</div></div>";
                }
            }
          ?>
        </div>

        <?php include 'footer.php' ?>

    </body>

    <script>
          $(window).bind('scroll', function () {
            if ($(window).scrollTop() > 100) {
                $('.navbar').removeClass('navbar-transparent');
                  $('.nav-item').addClass('nav-item-2');
            } else {
                $('.navbar').addClass('navbar-transparent');
                 $('.nav-item').removeClass('nav-item-2');
            }
          });

         $(document).ready(function(e){
            var url = document.URL;
            var url_split = url.split('/');
            var page = url_split[url_split.length - 1];

            $("#navbarSupportedContent > ul > li > a").each(function(e){
                url_page = $(this).attr('href');
                console.log(url_page);
                if(page == ""){
                    page = "home";
                }
                if(url_page == page){
                
                    $('.active-item-menu').removeClass('active-item-menu');
                    $(this).addClass('active-item-menu');
                
                }
            }); 
         });
    </script>   
    <script src="<?=$configBase?>/js/animate.js" type="text/javascript"></script>
</html>
