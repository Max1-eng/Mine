<?
/*
Привет моя сарделька :з
Если у тебя есть вопросы по скрипту или ты хочешь себе сайт с нуля на заказ, то ты в любое время можешь написать мне (https://vk.com/debl0w). Дешево!

(если чо, тут в рефке деньги не начисляются и в админке не работают некоторые функции (изменение банка/профита), а также статистика).
    
*/
include_once("connect.php");

$id = $_POST['id'];
$query = ("SELECT * FROM `users` WHERE `id`= '$id' or `vk_id`='$id'");
$result = mysqli_query($link,$query);
$userInfo = mysqli_fetch_array($result);
if($userInfo != null){
$id = $userInfo['id'];
$sid = $userInfo['sid'];
$vk_id = $userInfo['vk_id'];
$login = $userInfo['login'];
$money = $userInfo['money'];
$prava = $userInfo['prava'];
$photo = $userInfo['photo_vk'];
$hilo = $userInfo['hilo'];
$ban = $userInfo['ban'];
$deposit = $userInfo['deposit'];
$vivod = $userInfo['vivod'];
$referalov = $userInfo['referalov'];
$chat_ban = $userInfo['chat_ban'];
$dataReg = $userInfo['data'];
$ref_money = $userInfo['ref_money'];
$ip = $userInfo['ip'];

$query = ("SELECT * FROM `hilos-games` WHERE `id_users` = '$id'");
$result1 = mysqli_query($link,$query);
$allgames1 = mysqli_num_rows($result1);

$query = ("SELECT * FROM `mines-game` WHERE `id_users` = '$id'");
$result2 = mysqli_query($link,$query);
$allgames2 = mysqli_num_rows($result2);

$query = ("SELECT * FROM `wheel-games` WHERE `id_users` = '$id'");
$result3 = mysqli_query($link,$query);
$allgames3 = mysqli_num_rows($result3);

// проверка на мультиаккаунты
$query = ("SELECT * FROM `users` WHERE `ip` = '$ip'");
$result4 = mysqli_query($link,$query);
$myltiakk = mysqli_num_rows($result4);

$allgames = $allgames1 + $allgames2 + $allgames3;
$perem = "$('.resultUsers').html('')";
$func = "onclick='ControlMoneyUsers(1);'";
$func1 = "onclick='ControlMoneyUsers(0);'";
$save = "onclick='saveUsers();'";

$updateDate1 = "onclick='updateDate(".$id.",1);'";
$updateDate2 = "onclick='updateDate(".$id.",2);'";
$updateDate3 = "onclick='updateDate(".$id.",3);'";
$updateDate4 = "onclick='updateDate(".$id.",4);'";
$updateDate5 = "onclick='updateDate(".$id.",5);'";
$updateDate6 = "onclick='updateDate(".$id.",6);'";
$updateDate7 = "onclick='updateDate(".$id.",7);'";
$updateDate8 = "onclick='updateDate(".$id.",8);'";
$updateDate9 = "onclick='updateDate(".$id.",9);'";
$updateDate10 = "onclick='updateDate(".$id.",10);'";
$updateDate11= "onclick='updateDate(".$id.",11);'";
$updateDate12 = "onclick='updateDate(".$id.",12);'";


$best = "<form>
<div class='form-row'>
  <div class='form-group col-md-6'>
    <label for='inputEmail4'>Логин</label>
    <input type='text' class='form-control' id='inputlogin' value=".$login.">
    <button type='button' class='btn btn-primary' style='width: 100%;margin-top: 3px;' $updateDate1>Изменить</button>
  </div>
  <div class='form-group col-md-6'>
    <label for='inputPassword4'>Айди вконтакте</label>
    <input type='password' class='form-control' id='inputidvk' placeholder=".$vk_id." disabled='disabled'>
    <button type='button' class='btn btn-primary'style='width: 100%;margin-top: 3px;'$updateDate2>Изменить</button>

  </div>
</div>
<div class='form-row'>
<div class='form-group col-md-6'>
  <label for='inputAddress'>Сид пользователя (куки)</label>
  <input type='text' class='form-control' id='inputsid' placeholder=".$sid." disabled='disabled'>
  <button type='button' class='btn btn-primary'style='width: 100%;margin-top: 3px;'$updateDate3>Изменить</button>

</div>
<div class='form-group col-md-6'>
  <label for='inputAddress2'>Количество монет</label>
  <input type='text' class='form-control' id='inputMoneyUsers' value=".$money." >
  <button type='button' class='btn btn-primary'style='width: 100%;margin-top: 3px;'$updateDate4>Изменить</button>
</div>
</div>
<div class='form-row'>
<div class='form-group col-md-6'>
  <label for='inputAddress'>Сумма депозитов</label>
  <input type='text' class='form-control' id='inputdeposit' placeholder=".$deposit.">
  <button type='button' class='btn btn-primary'style='width: 100%;margin-top: 3px;'$updateDate5>Изменить</button>
</div>
<div class='form-group col-md-6'>
  <label for='inputAddress2'>Сумма выводов</label>
  <input type='text' class='form-control' id='inputvivod' placeholder=".$vivod." >
  <button type='button' class='btn btn-primary'style='width: 100%;margin-top: 3px;'$updateDate6>Изменить</button>
</div>
</div>
<div class='form-row'>
  <div class='form-group col-md-6'>
    <label for='inputCity'>Ссылка на фото</label>
    <input type='text' class='form-control' id='inputphoto' value=".$photo.">
    <button type='button' class='btn btn-primary'style='width: 100%;margin-top: 3px;'$updateDate7>Изменить</button>

  </div>
  <div class='form-group col-md-6'>
  <label for='inputZip'>Дата регистрации</label>
  <input type='text' class='form-control' id='inputZip' placeholder=".$dataReg." disabled='disabled'>
  </div>
  <div class='form-group col-md-4'>
    <label for='inputState'>Права (0-юзер,1-админ,2-модер,3-ютубер)</label>
    <input type='text' class='form-control' id='inputprava' value=".$prava.">
    <button type='button' class='btn btn-primary'style='width: 100%;margin-top: 3px;'$updateDate8>Изменить</button>
  </div>
  <div class='form-group col-md-2'>
    <label for='inputZip'>В бане? (0-нет,1-да)</label>
    <input type='text' class='form-control' id='inputban' value=".$ban.">
    <button type='button' class='btn btn-primary'style='width: 100%;margin-top: 3px;'$updateDate9>Изменить</button>
  </div>
  <div class='form-group col-md-3'>
  <label for='inputZip'>Количество рефералов</label>
  <input type='text' class='form-control' id='inputreferalov' placeholder=".$referalov.">
  <button type='button' class='btn btn-primary'style='width: 100%;margin-top: 3px;'$updateDate10>Изменить</button>
  </div>
  <div class='form-group col-md-3'>
  <label for='inputZip'>Количество игр</label>
  <input type='text' class='form-control' id='inputZip' placeholder=".$allgames." disabled='disabled'>
  </div>
  <div class='form-group col-md-3'>
  <label for='inputZip'>Выдать монеты:</label>
  <input type='text' class='form-control' id='addMoneyUsers'  placeholder='Сколько монет?'>
  <button type='button' class='btn btn-primary' $func style='width: 100%;margin-top: 3px;'>Выдать</button>
  </div>
  <div class='form-group col-md-3'>
  <label for='inputZip'>Отнять монеты:</label>
  <input type='text' class='form-control' id='delMoneyUsers'  placeholder='Сколько отнимаем?'>
  <button type='button' class='btn btn-primary' $func1 style='width: 100%;margin-top: 3px;'>Отнять</button>
  </div>
  <div class='form-group col-md-3'>
  <label for='inputZip'>Количество игр в минах</label>
  <input type='text' class='form-control' id='inputZip' placeholder=".$allgames2." disabled='disabled'>
  </div>
  <div class='form-group col-md-3'>
  <label for='inputZip'>Количество игр в хайло</label>
  <input type='text' class='form-control' id='inputZip' placeholder=".$allgames1." disabled='disabled'>
  </div>
  <div class='form-group col-md-3'>
  <label for='inputZip'>Количество игр в колесе</label>
  <input type='text' class='form-control' id='inputZip' placeholder=".$allgames3." disabled='disabled'>
  </div>
  <div class='form-group col-md-3'>
  <label for='inputZip'>Чат-бан (0-нет, 1-да)</label>
  <input type='text' class='form-control' id='inputchatban' placeholder=".$chat_ban.">
  <button type='button' class='btn btn-primary'style='width: 100%;margin-top: 3px;'$updateDate11>Изменить</button>
  </div>
  <div class='form-group col-md-3'>
  <label for='inputZip'>Заработок с рефералов</label>
  <input type='text' class='form-control' id='inputreferalmoney' placeholder=".$ref_money.">
  <button type='button' class='btn btn-primary'style='width: 100%;margin-top: 3px;'$updateDate12>Изменить</button>
  </div>
  <div class='form-group col-md-3'>
  <label for='inputZip'>ip игрока</label>
  <input type='text' class='form-control' id='inputZip' placeholder=".$ip." disabled='disabled'>
  </div>
  <div class='form-group col-md-3'>
  <label for='inputZip'>Мультиаккаунтов</label>
  <input type='text' class='form-control' id='inputZip' placeholder=".$myltiakk." disabled='disabled'>
  </div>
  </div>
  
<div class='row'>
<button type='button' onclick=".$perem." style='margin-left: 5px;' class='btn btn-danger'>Закрыть</button>
</div>
</form>";

$obj = array("result"=>"$best");
}else{
    $obj = array("result"=>"Игрок не найден");
}

echo json_encode($obj);
?>