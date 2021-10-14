<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="./public/assets/web/image/iconworld.png">
    <title>democode</title>
    <link rel="stylesheet" href="public/assets/web/main.css">
    <link rel="stylesheet" type="text/css" href="public/assets/web/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="public/assets/web/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="public/assets/web/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="public/assets/web/slick/slick-theme.css"/>

</head>

<body>
<div class="main">
    <div id="header">

        <?php require_once("view/web/component/header.php") ?>
    </div>

    <div id="home">

        <?php

        if (isset($_GET["view"])) {
            $view = $_GET["view"];
            require_once("view/web/page/" . $view . ".php");
        } else {
            require_once("view/web/page/home.php");
        }
        ?>

    </div>

    <div id="footer">
        <?php require_once("view/web/component/footer.php") ?>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>

<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="public/assets/web/slick/slick.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.slider').slick({
            autoplay: true,
            autoplaySpeed: 2000,
            centerMode: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true,
            infinite: true,
            cssEase: 'linear',
            mobileFirst: true, //optional, to be used only if your page is mobile first
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    centerMode: false,
                }
            }]
        });

    });
</script>
<script>
    function myFunction() {
        var x = document.getElementById("myLinks");
        if (x.style.display === "block") {
            x.style.display = "none";
        } else {
            x.style.display = "block";
        }
    }


    function login() {
        sweetAlert({
            title: "!",
            text: "まだログインしないので、ログインしてください!",
            type: 'warning'
        }, function (isConfirm) {
            window.location = "http://localhost/democode/?view=login";
        });
    }
</script>
</body>

</html>