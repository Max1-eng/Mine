<?php

/*
Привет моя сарделька :з
Если у тебя есть вопросы по скрипту или ты хочешь себе сайт с нуля на заказ, то ты в любое время можешь написать мне (https://vk.com/debl0w). Дешево!

(если чо, тут в рефке деньги не начисляются и в админке не работают некоторые функции (изменение банка/профита), а также статистика).
    
*/
include_once("connect.php");

$sid = $_COOKIE['sid'];
$query = ("SELECT * FROM `users` WHERE `sid` = '$sid'");
$result = mysqli_query($link,$query);
$userInfo = mysqli_fetch_array($result);

$prava = $userInfo['prava'];

if($prava != 1){
    header("Location: /");
}
// чекаем кол-во юзеров
$query = ("SELECT * FROM `users`");
$result1 = mysqli_query($link,$query);
$staticAllUsers = mysqli_num_rows($result1);
// чекаем кол-во игр в минах
$query = ("SELECT * FROM `mines-game`");
$result2 = mysqli_query($link,$query);
$staticAllMines = mysqli_num_rows($result2);
// чекаем кол-во игр в хайло
$query = ("SELECT * FROM `hilos-games`");
$result3 = mysqli_query($link,$query);
$staticAllHilo = mysqli_num_rows($result3);
// чекаем кол-во игр в x50
$query = ("SELECT * FROM `wheel-games`");
$result4 = mysqli_query($link,$query);
$staticAllx50 = mysqli_num_rows($result4);
$today = date("d.m.y");

// чекаем профит за сегодня в x50
$query = ("SELECT * FROM `profit-x50` WHERE `data`='$today'");
$result6 = mysqli_query($link,$query);
$profitTodayX50 = mysqli_fetch_array($result6);
$profitTodayX50 = $profitTodayX50['profit'];
// чекаем профит за сегодня в минах
$query = ("SELECT * FROM `profit-mines` WHERE `data`='$today'");
$result7 = mysqli_query($link,$query);
$profitTodayMines = mysqli_fetch_array($result7);
$profitTodayMines = $profitTodayMines['profit'];
// чекаем профит за сегодня в хайло
$query = ("SELECT * FROM `profit-hilo` WHERE `data`='$today'");
$result8 = mysqli_query($link,$query);
$profitTodayHilo = mysqli_fetch_array($result8);
$profitTodayHilo = $profitTodayHilo['profit'];

// чекаем профит за все время в x50
$query = ("SELECT SUM(`profit`) FROM `profit-x50`");
$result9 = mysqli_query($link,$query);
$profitTodayX501 = mysqli_fetch_array($result9);
$profitTodayX501 = $profitTodayX501['profit'];
// чекаем профит за за все время в минах
$query = ("SELECT SUM(`profit`) FROM `profit-mines`");
$result9 = mysqli_query($link,$query);
$profitTodayMines1 = mysqli_fetch_array($result9);
$profitTodayMines1 = $profitTodayMines1['profit'];
// чекаем профит за за все время в хайло
$query = ("SELECT SUM(`profit`) FROM `profit-hilo`");
$result10 = mysqli_query($link,$query);
$profitTodayHilo1 = mysqli_fetch_array($result10);
$profitTodayHilo1 = $profitTodayHilo1['profit'];



?>
<title>Админ-панель</title>
<script src="js/jQueryv3.3.1.js"></script>
<link rel="stylesheet" href="/css/bootstrap.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
.element{
    border: 1px solid #959595;
    text-align: center;
    border-radius: 10px;
}
.element1{
    text-align: center;
    border-radius: 10px;
}
.element:hover{
    cursor: pointer;
    background: #e3e3e3;
}
</style>

<script>
var path = "/engine.php"; //Для удобства

$( document ).ready(function() {
$(".page").click(
    function(){
    
    var page = $(this).attr("data-page");
    if(page == "static"){
    $(".static").show();
    $(".promocode").hide();
    $(".users").hide();
    $(".deposit").hide();
    $(".vivod").hide();
    $(".settings").hide();
    }
    if(page == "promocode"){
    $(".static").hide();
    $(".promocode").show();
    $(".users").hide();
    $(".deposit").hide();
    $(".vivod").hide();
    $(".settings").hide();
    }
    if(page == "users"){
    $(".static").hide();
    $(".promocode").hide();
    $(".users").show();
    $(".deposit").hide();
    $(".vivod").hide();
    $(".settings").hide();
    }
    if(page == "deposit"){
    $(".static").hide();
    $(".promocode").hide();
    $(".users").hide();
    $(".deposit").show();
    $(".vivod").hide();
    $(".settings").hide();
    }
    if(page == "vivod"){
    $(".static").hide();
    $(".promocode").hide();
    $(".users").hide();
    $(".deposit").hide();
    $(".vivod").show();
    $(".settings").hide();
    }
    if(page == "settings"){
    $(".static").hide();
    $(".promocode").hide();
    $(".users").hide();
    $(".deposit").hide();
    $(".vivod").hide();
    $(".settings").show();
    }
    console.log(page);
    
}
);
});
function searchUsers(){
    var usersId = $("#users_id").val();
   $.ajax({
   url: "/loadUsInfo.php",
   type: "POST",
   dataType: "html",
   data: {
     id: usersId,
   },
   success: function(data){
    obj = $.parseJSON(data);
    $(".resultUsers").html(obj.result);
   }
})
}
function ControlMoneyUsers(num){
   if(num == 1){ // прибавление монет
    num1 = "Вы успешно прибавили игроку монеты";
    var ControlMoneyUsers = $("#addMoneyUsers").val();
   }else{ // отнимаем монеты
    num1 = "Вы успешно отняли у игрока монеты";
    var ControlMoneyUsers = $("#delMoneyUsers").val();
   }
   var users_id = $("#users_id").val();
   $.ajax({
   url: "/adminFunc.php",
   type: "POST",
   dataType: "html",
   data: {
     moneyRedact: ControlMoneyUsers,
     num: num,
     users_id: users_id,
   },
   success: function(response){
    obj = $.parseJSON(response);
    if(obj.good != null){
    alert(num1);
    $("#inputMoneyUsers").val(obj.money);
    }
   }
});
}
function updatepromo(){
    var amountActPromo = $("#amountActPromo").val();
    var summPromo = $("#summPromo").val();
    $("#getPromo").text("Создать промокод ("+amountActPromo*summPromo+")");
}
function createPromo(){
    var namePromo = $("#namePromo").val();
    var amountActPromo = $("#amountActPromo").val();
    var summPromo = $("#summPromo").val();
   $.ajax({
   url: "/adminFunc.php",
   type: "POST",
   dataType: "html",
   data: {
     namePromo: namePromo,
     amountActPromo: amountActPromo,
     summPromo: summPromo,
     create_Promo: "createPromo",
   },
   success: function(response){
    obj = $.parseJSON(response);
    if(obj.qqq == "qqq"){
    alert(obj.mess);
    }
   }
});
}
function delPromo(id){
    $.ajax({
   url: "/adminFunc.php",
   type: "POST",
   dataType: "html",
   data: {
     delpromo: id,

   },
   success: function(response){
    obj = $.parseJSON(response);
    if(obj.qqq == "qqq"){
    alert(obj.mess);
    }
}});
}
function setpay(num,idpay){
//удалить 1
//отправить 2
//отменить 3
//отменить все 4
  $.ajax({
   url: "/adminFunc.php",
   type: "POST",
   dataType: "html",
   data: {
     setpay: num,
     idpay: idpay,
   },
   success: function(response){
    obj = $.parseJSON(response);
    if(obj.setpay == 1){
    $("td[data-pay="+idpay+"]").html("<span style='color: red'>Удалено</span>");
    }
    if(obj.setpay == 2){
    $("td[data-pay="+idpay+"]").html("<span style='color: green'>Отправлено</span>");
    }
    if(obj.setpay == 3){
    $("td[data-pay="+idpay+"]").html("<span style='color: blue'>Отменено</span>");
    }
    if(obj.setpay == 4){
    $("td[data-pay="+idpay+"]").html("<span style='color: blue'>Отменены все выплаты</span>");
    }
  }});
  }
  function setadmin(num){
    if(num == 1){
    var red = $("#group_vk").val();
    }
    if(num == 2){
      var red = $("#bonus_reg").val();
    }
    if(num == 3){
      var red = $("#group_vk").val();
    }
    if(num == 4){
      var red = $("#chat").val();
    }
    $.ajax({
      url: "/adminFunc.php",
      type: "POST",
      dataType: "html",
      data: {
     redAdmin: red,
     num: num,
      },
      success: function(response){
     obj = $.parseJSON(response);
     if(obj.mess != null){
     alert(obj.mess);
     }
    }

    });
  }
function updateDate(users_id,num){
if(num == 1){
var pole = $("#inputlogin").val();
}
if(num == 2){
var pole = $("#inputidvk").val();
}
if(num == 3){
var pole = $("#inputsid").val();
}
if(num == 4){
var pole = $("#inputMoneyUsers").val();
}
if(num == 5){
var pole = $("#inputdeposit").val();
}
if(num == 6){
var pole = $("#inputvivod").val();
}
if(num == 7){
var pole = $("#inputphoto").val();
}
if(num == 8){
var pole = $("#inputprava").val();
}
if(num == 9){
var pole = $("#inputban").val();
}
if(num == 10){
var pole = $("#inputreferalov").val();
}
if(num == 11){
var pole = $("#inputchatban").val();
}
if(num == 12){
var pole = $("#inputreferalmoney").val();
}
    $.ajax({
   url: "/adminFunc.php",
   type: "POST",
   dataType: "html",
   data: {
     updateus: num,
     pole: pole,
     users: users_id,
   },
   success: function(response){
    obj = $.parseJSON(response);
    
    alert(obj.mess);
    searchUsers();

}});
}
function promo(length) {
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
$("#namePromo").val(result);
}
</script>

<div class="container" style="margin-top: 20px;">
<div class="row">
    <div class="col-sm element page" data-page="static">
      Cтатистика
    </div>
    <div class="col-sm element page" data-page="promocode">
      Промокоды
    </div>
    <div class="col-sm element page" data-page="users">
      Игроки
    </div>
    <div class="col-sm element page" data-page="deposit">
      Пополнения
    </div>
    <div class="col-sm element page" data-page="vivod">
      Выводы
    </div>
    <div class="col-sm element page" data-page="settings">
      Настройки
    </div>
  </div>
  </div>
<div class="col-sm element page"
<center>
<a href="/">Выйти </a>
</center>
</div>
  <div class="container" style="margin-top: 20px;border: 1px solid #B1B1B1;border-radius: 5px;">
  <div class="static">
     <div class="container">
      <p style="text-align: center;font-weight: 600;padding-top: 10px">Статистика проекта</p>
      </div>
     
      <div class="row">
          <div class="col-sm element1">
          Сыграно всего игр: <span style="font-weight: 600"><?echo $staticAllMines+$staticAllHilo+$staticAllx50;?></span>
           </div>
              <div class="col-sm element1">
                Сыграно всего игр в минах: <span style="font-weight: 600"><?echo $staticAllMines;?></span>
                 </div>
                  <div class="col-sm element1">
                     Сыграно всего игр в хайло: <span style="font-weight: 600"><?echo $staticAllHilo;?></span>
                      </div>
             <div class="col-sm element1">
              Сыграно всего игр в x50: <span style="font-weight: 600"><?echo $staticAllx50;?></span>
        </div>
  </div>
  </br>
  <div class="row">
  <div class="col-sm element1">
Всего пользователей: <span style="font-weight: 600"><?echo $staticAllUsers;?></span>
</div>
<div class="col-sm element1">
          Пополнений за сегодня: <span style="font-weight: 600">100</span>
           </div>
           <div class="col-sm element1">
           Сумма выплат за сегодня: <span style="font-weight: 600">100</span>
           </div>
           <div class="col-sm element1">
           Профит за сегодня: <span style="font-weight: 600">100</span>
           </div>
  </div>
  </br>

  <div class="row">
      <div class="col-sm element1">
<? 

$query = ("SELECT * FROM `admin`");
$result10 = mysqli_query($link,$query);
$admin = mysqli_fetch_array($result10);

$bank = $admin['bank'];
$profit = $admin['zarabotok'];

?>
      Общий Банк: <span style="font-weight: 600"><?echo $bank;?></span>
      <input type="number" class="form-control" id="bank">
  <button class="btn btn-primary" style="width: 100%">Изменить</button>

       </div>
           <div class="col-sm element1">
           Профит cайта: <span style="font-weight: 600"><?echo $profit;?></span>
      <input type="number" class="form-control">
<button class="btn btn-primary" style="width: 100%">Изменить</button>


           </div>
       </div>
       </br>
</div>
<div class="promocode" style="display: none">
<div class="container">
<p style="text-align: center;font-weight: 600;padding-top: 10px">Создать промокод</p>
<div class="row">
<div class='form-group col-md-4'>
    <label for='inputZip'>Название промокода</label> <span onclick="promo(10);" style="cursor: pointer">(Рандом)</span>
    <input type='text' class='form-control' id='namePromo' onkeyup="updatepromo();"  placeholder="Введите название промокода">
  </div>
  <div class='form-group col-md-4'>
    <label for='inputZip'>Количество активаций</label>
    <input type='text' class='form-control' id='amountActPromo' onkeyup="updatepromo();" placeholder="Введите количество активаций">
  </div>
  <div class='form-group col-md-4'>
    <label for='inputZip'>Сумма</label>
    <input type='text' class='form-control' id='summPromo' onkeyup="updatepromo();"  placeholder="Введите сумму промокода">
  </div>
  <button class="btn btn-primary" style="width: 100%" id="getPromo" onclick="createPromo();">Создать промокод</button>
  </div>
  <p style="font-weight: 600;padding-top: 10px">Последние 10 промокода</p>
  <div class="table-responsive">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Промокод</th>
      <th scope="col">Осталось активаций</th>
      <th scope="col">Всего активаций</th>
      <th scope="col">Сумма</th>
      <th scope="col">Удалить промо</th>

    </tr>
  </thead>
  <tbody>
  <?
    $query = ("SELECT * FROM `promocode` ORDER BY `id` DESC LIMIT 10");
    $result5555 = mysqli_query($link,$query);
    while(($promo = mysqli_fetch_array($result5555))){
        $idPromo = $promo['id'];
        $namePromo = $promo['name'];
        $ostPromo = $promo['ost_activ'];
        $activPromo = $promo['activ'];
        $sumPromo = $promo['sum'];
        $ostPromo = $activPromo - $ostPromo;

  $t.="<tr>
      <th scope='row'>$idPromo</th>
      <td>$namePromo</td>
      <td>$ostPromo</td>
      <td>$activPromo</td>
      <td>$sumPromo</td>
      <td onclick='delPromo($idPromo)' style='color: blue;'><a href='#'>Удалить</a></td>
    </tr>";
    }
    echo $t;
    ?>
    </tbody>
</table>
</div>
</div>
</div>
<div class="settings" style="display: none">
<div class="container">
<p style="text-align: center;font-weight: 600;padding-top: 10px">Настройки сайта</p>
<div class="row">
<?php
$query = ("SELECT * FROM `admin`");
$resultad = mysqli_query($link,$query);
$admin = mysqli_fetch_array($resultad);
$bonus_reg = $admin['bonus_reg'];
$referalka = $admin['referalka'];
$group_vk = $admin['group_vk'];
$chat = $admin['chat'];
?>
<div class='form-group col-md-4'>
    <label for='inputZip'>Ccылка на группу вк</label>
    <input type='text' class='form-control' id='group_vk' placeholder="<?echo $group_vk;?>">
    <button type="button" class="btn btn-primary" style="width: 100%"onclick="setadmin(1);">Изменить</button>
  </div>
  <div class='form-group col-md-4'>
    <label for='inputZip'>Бонус при регистрации</label>
    <input type='text' class='form-control' id='bonus_reg' placeholder="<?echo $bonus_reg;?>">
    <button type="button" class="btn btn-primary" style="width: 100%" onclick="setadmin(2);">Изменить</button>  </div>
  <div class='form-group col-md-4'>
    <label for='inputZip'>Рефералка</label>
    <input type='text' class='form-control' id='referalka'  placeholder="<?echo $referalka;?>">
    <button type="button" class="btn btn-primary" style="width: 100%" onclick="setadmin(3);">Изменить</button>  </div>
    <div class='form-group col-md-4'>
    <label for='inputZip'>Чат закрыт (0-нет, 1-да)</label>
    <input type='text' class='form-control' id='chat'  placeholder="<?echo $chat;?>">
    <button type="button" class="btn btn-primary" style="width: 100%" onclick="setadmin(4);">Изменить</button>  </div>

  </div>
</div>
</div>
<div class="users" style="display: none">
<div class="container">
<p style="text-align: center;font-weight: 600;padding-top: 10px">Искать игрока</p>
<div class="form-group">
    <label for="exampleInputEmail1">Поиск игрока</label>
    <input type="number" class="form-control" id="users_id" aria-describedby="emailHelp" placeholder="Введите ид игрока или ид вконтакте">
    <button type="button" class="btn btn-primary" onclick="searchUsers();" style="margin-top: 2px;width: 100%;">Поиск</button>
  </div>
 <div class="resultUsers">
 </div> 
 <div class="container">
<p style="font-weight: 600;padding-top: 10px">Последние 10 игроков</p>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Логин</th>
      <th scope="col">Количество монет</th>
      <th scope="col">Ссылка на стр вк</th>
      <th scope="col">Дата регистрации</th>
      <th scope="col">Пригласил</th>

    </tr>
  </thead>
  <tbody>
  <?
    $query = ("SELECT * FROM `users` ORDER BY `id` DESC LIMIT 10");
    $result555 = mysqli_query($link,$query);
    while(($userstop10 = mysqli_fetch_array($result555))){
    $id = $userstop10['id'];
    $login = $userstop10['login'];
    $data = $userstop10['data'];
    $money = $userstop10['money'];
    $vk_id = $userstop10['vk_id'];
    $invited = $userstop10['invited'];
    $u.="<tr>
      <th scope='row'>".$id."</th>
      <td>".$login."</td>
      <td>".$money."</td>
      <td><a href='https://vk.com/id$vk_id'  target='_blank' >https://vk.com/id$vk_id</a></td>
      <td>".$data."</td>
      <td>$invited</td>
    </tr>";
    }
    echo $u;

?>
  </tbody>
</table>
</div>
</div>
</div>
<div class="deposit" style="display: none">
<div class="container">
<p style="text-align: center;font-weight: 600;padding-top: 10px">Последние 15 пополнений</p>
<table class="table">
  <thead>
  <tr>
      <th scope='col' style='font-size: 15px !important'>Ид</th>
      <th scope='col' style='font-size: 15px !important'>Ид юзера</th>
      <th scope='col' style='font-size: 15px !important'>На сколько пополняет</th>
      <th scope='col' style='font-size: 15px !important'>Номер</th>
      <th scope='col' style='font-size: 15px !important'>Дата</th>


    </tr>
  </thead>
  <tbody>
  <?
    $query = ("SELECT * FROM `deposit` ORDER BY `id` DESC LIMIT 10");
   $result1500 = mysqli_query($link,$query);
    while(($deposit = mysqli_fetch_array($result1500))){
$id = $deposit['id'];

        $user_id = $deposit['user_id'];
        $amount = $deposit['AMOUNT'];
        $data = $deposit['data'];
        $phone = $deposit['P_PHONE'];

       

    $vv.="<tr>
<td>$id</td>
    <td>$user_id</td>
    <td>$amount</td>
    <td>$phone</td>
    <td>$data</td></tr>";
}
 
    echo $vv;

    ?>

  </tbody>
</table>


</div>
</div>
<div class="vivod" style="display: none">
<div class="container">
<p style="text-align: center;font-weight: 600;padding-top: 10px">Выплаты ожидающие подтверждения</p>
<div class="table-responsive">
<table class="table">
  <thead>
  <tr>
      <th scope='col' style='font-size: 15px !important'>Ид</th>
      <th scope='col' style='font-size: 15px !important'>Логин</th>
      <th scope='col' style='font-size: 15px !important'>Монет</th>
      <th scope='col' style='font-size: 15px !important'>Выводит</th>
      <th scope='col' style='font-size: 15px !important'>Номер</th>
      <th scope='col' style='font-size: 15px !important'>Кошелек</th>
      <th scope='col'style='font-size: 15px !important'>Мультиаккаунтов</th>
      <th scope='col'style='font-size: 15px !important'>Редактировать</th>

    </tr>
  </thead>
  <tbody>
  <?
    $query = ("SELECT * FROM `payments` WHERE `result`='Ожидание'");
    $result8 = mysqli_query($link,$query);
    while(($payments = mysqli_fetch_array($result8))){
     
        $id_pay = $payments['id'];
        $users_id_pay = $payments['users_id'];
        $login_pay = $payments['login'];
        $wallet_pay = $payments['wallet'];
        $sum_pay = $payments['sum'];
        $number_wallet_pay = $payments['number_wallet'];


        $query = ("SELECT * FROM `users` WHERE `id`= '$users_id_pay'");
        $result12 = mysqli_query($link,$query);
        $userInfo2 = mysqli_fetch_array($result12);
        $money_pay = $userInfo2['money']; 
        $vk_id = $userInfo2['vk_id'];
        $deposit = $userInfo2['deposit'];
        $vivod = $userInfo2['vivod'];
        $ip = $userInfo2['ip'];

        $query = ("SELECT * FROM `users` WHERE `ip` = '$ip'");
        $result4 = mysqli_query($link,$query);
        $myltiakk = mysqli_num_rows($result4);
        




    $s.="<tr>
    <td>$users_id_pay</td>
    <td><a href='https://vk.com/id$vk_id' target='_blank'>$login_pay</a></td>
    <td>$money_pay монет</td>
    <td>$sum_pay монет</td>
    <td>$number_wallet_pay</td>
    <td>$wallet_pay</td>
    <td>$myltiakk</td>
    <td data-pay='$id_pay'><a href='#' onclick='setpay(1,$id_pay);'>Удалить</a></br><a href='#' onclick='setpay(2,$id_pay);'>Отправить</a></br><a href='#' onclick='setpay(3,$id_pay);'>Отменить</a></br><a href='#' onclick='setpay(4,$users_id_pay);'>Отменить всё</a></td></tr>";
    }
    echo $s;
    ?>

  </tbody>
</table>
</div>
</div>
</div>
</div>