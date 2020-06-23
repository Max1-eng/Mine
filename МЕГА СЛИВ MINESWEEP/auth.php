<?php
/*
Привет моя сарделька :з
Если у тебя есть вопросы по скрипту или ты хочешь себе сайт с нуля на заказ, то ты в любое время можешь написать мне (https://vk.com/debl0w). Дешево!

(если чо, тут в рефке деньги не начисляются и в админке не работают некоторые функции (изменение банка/профита), а также статистика).
    
*/

include_once("connect.php");
$sid = $_COOKIE['sid'];
$query = ("SELECT * FROM `users` WHERE `sid`= '$sid'");
$result = mysqli_query($link,$query);
$token = mysqli_fetch_array($result);
$invited = $_GET['ref'];
setcookie('ref', $invited, time()+36000000*60, '/');
if($sid != null){
    header("Location: /");
}

if($_GET['ref'] != null){
$ref = $_GET['ref'];

setcookie("ref", $ref, time()+36000000000000000000000000000000000, '/');
}

?>
<link rel="stylesheet" href="/css/bootstrap.min.css">

<div class="container">
<div class="col-6">
</div>
</div>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Пример на bootstrap 4: Простой одностраничный шаблон для фотогалереи, портфолио и многого другого. Версия v4.1.3">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Авторизация</title>

  </head>

  <body>



<!-- Yandex.Metrika counter -->  <noscript><div><img src="https://mc.yandex.ru/watch/39705265" style="position:absolute; left:-9999px;" alt="Yandex.Metrika" /></div></noscript> <!-- /Yandex.Metrika counter -->

    <header>
      
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="#" class="navbar-brand d-flex align-items-center">
            <strong>Netron</strong>
          </a>
          
        </div>
      </div>
    </header>

    <main role="main">

      <section class="jumbotron text-center" style="background-color: white;margin-top:20px">
        <div class="container">
          <h1 class="jumbotron-heading">Добро пожаловать!</h1>
          <p class="lead text-muted">Участие в проекте является исключительно добровольным. Проект был создан в развлекательных целях. В его задачи <span style="color: red;font-weight: 600">не</span> входит заработок средств. Вносите только ту сумму, которую вам не жалко будет потерять в случае проигрыша.
            <a class="btn btn-primary my-2" href="https://oauth.vk.com/authorize?client_id=<?echo $client_id;?>&redirect_uri=https://<? echo $domen;?>/vklogin.php&response_type=code">Войти через Вконтакте</a>
            <a href="https://vk.com/netron_fun"" class="btn btn-secondary my-2">Группа ВКонтакте</a>
          </p>
        </div>
      </section>
    </main>

    <footer class="text-muted">
      <div class="container">
        <p>On-line проект под названием <?echo $domen;?> представляет собой систему добровольных пожертвований, принадлежит его организатору и находится в сети Интернет непосредственно по адресу – <?echo $domen;?>. </p>
        <p>Услугами сервиса могут пользоваться исключительно лица, достигшие совершеннолетия (18 лет) и старше. </p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/vendor/holder.min.js"></script>  
<svg xmlns="http://www.w3.org/2000/svg" width="348" height="225" viewBox="0 0 348 225" preserveAspectRatio="none" style="display: none; visibility: hidden; position: absolute; top: -100%; left: -100%;"><defs><style type="text/css"></style></defs><text x="0" y="17" style="font-weight:bold;font-size:17pt;font-family:Arial, Helvetica, Open Sans, sans-serif">Thumbnail</text></svg></body></html>