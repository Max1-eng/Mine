<?php

/*
Привет моя сарделька :з
Если у тебя есть вопросы по скрипту или ты хочешь себе сайт с нуля на заказ, то ты в любое время можешь написать мне (https://vk.com/debl0w). Дешево!

(если чо, тут в рефке деньги не начисляются и в админке не работают некоторые функции (изменение банка/профита), а также статистика).
    
*/

include_once("connect.php");

$sid = $_COOKIE['sid'];
$komissia = 0.10;

//данные чата
$query = ("SELECT * FROM `chat`");
$result = mysqli_query($link,$query);
$getChat = mysqli_fetch_array($result);
$chatLogin = $getChat['login'];
$chatPhoto = $getChat['photo'];
$mess = $getChat['mess'];

//данные юзера
$query = ("SELECT * FROM `users` WHERE `sid` = '$sid'");
$result = mysqli_query($link,$query);
$userInfo = mysqli_fetch_array($result);

$id = $userInfo['id'];
$vk_id = $userInfo['vk_id'];
$login = $userInfo['login'];
$money = $userInfo['money'];
$prava = $userInfo['prava'];
$photo = $userInfo['photo_vk'];
$hilo = $userInfo['hilo'];
$chat_my_ban = $userInfo['chat_ban'];
$vivod = $userInfo['vivod'];
$deposit = $userInfo['deposit'];
$invited = $userInfo['invited'];
$bilet = $userInfo['bilet'];


$login777 = $login; // для бота

//игровой массив
$query = ("SELECT * FROM `mines-game` WHERE `id_users` = '$id' AND `onOff` = '1' ORDER BY `id` DESC LIMIT 1");
$result = mysqli_query($link,$query);
$minesgame = mysqli_fetch_array($result);

if($minesgame){
$mines = $minesgame['mines'];
$click = $minesgame['click'];
$step = $minesgame['step'];
$num_mines = $minesgame['num_mines'];
$bet = $minesgame['bet'];
$win = $minesgame['win'];
$resultgame = $minesgame['result'];
$onOff = $minesgame['onOff'];
$click = unserialize($click);
}else{
  $click = unserialize($click);
  $click = [];
}
if(isset($_POST['chatGet']) == "ok"){
    if($prava == 0){
      $query = ("SELECT * FROM `chat`");
      $result = mysqli_query($link,$query);
    while(($chat = mysqli_fetch_array($result))){
     $chatLogin = $chat['login'];
     $mess = $chat['mess'];
     $idUsersChat = $chat['id_users'];
     $photo = $chat['photo'];
    $p.='<div class="chat-box-item">
    <div class="chat-avatar" onclick="openProfile('.$idUsersChat.')"><img class="chat-avatar" style="box-shadow: 0 0 0 0.2rem rgba(0,0,0,.2);cursor:pointer" src="'.$photo.'"></div>
    <div class="chat-mess">
     <div class="chat-mess-name" onclick="openProfile('.$idUsersChat.')" >
    <div>'.$chatLogin.'</div>
     </div>
     <div class="chat-mess-mess">
    '.$mess.'
     </div>
    </div>
  </div>';
    }
    }
  if($prava == 1 || $prava == 2){
    $query = ("SELECT * FROM `chat`");
    $result = mysqli_query($link,$query);
    while(($chat = mysqli_fetch_array($result))){
      $chat_id = $chat['id'];
      $vk_id = $chat['vk_id'];
      $chatLogin = $chat['login'];
      $mess = $chat['mess'];
$idUsersChat = $chat['id_users'];
      $photo = $chat['photo'];
     $p.='<div class="chat-box-item">
     <div class="chat-avatar"   onclick="openProfile('.$idUsersChat.')"><img class="chat-avatar" style="box-shadow: 0 0 0 0.2rem rgba(0,0,0,.2);cursor:pointer" src="'.$photo.'"></div>
     <div class="chat-mess">
      <div class="chat-mess-name">
     <div style="cursor: pointer"><span   onclick="openProfile('.$idUsersChat.')">'.$chatLogin.'</span><i class="fas fa-trash" style="cursor:pointer" title="Удалить" onclick="delMess('.$chat_id.');"></i><i class="fas fa-ban" onclick="blockUsers('.$vk_id.');" title="Заблокировать" style="color: red;cursor:pointer"></i><i class="fas fa-recycle" onclick="noblockUsers('.$vk_id.')" style="color:green;cursor:pointer" title="Разблокировать"></i></div>
      </div>
      <div class="chat-mess-mess">
     '.$mess.'
      </div>
     </div>
   </div>';
  }
}

    $obj = array("chat" => "$p");    
}
if(isset($_POST['mess'])){
    $mess = $_POST['mess'];
    if($chat_my_ban != 1){
    $query = ("SELECT * FROM `admin`");
    $resultad = mysqli_query($link,$query);
    $admin = mysqli_fetch_array($resultad);
    $chat = $admin['chat'];

    if($chat == 0){


    $mess = htmlspecialchars($mess);
    $query = ("SELECT * FROM `users` WHERE `sid`= '$sid'");
    $result = mysqli_query($link,$query);
    $token = mysqli_fetch_array($result);
    if($token){
    if($deposit >= 1000 && $deposit <= 2999 || $prava == 3){
      $colorNickname =  'style="color: green;font-weight: 600"';
      }
      if($deposit >= 3000){
        $colorNickname =  'style="color: blue;font-weight: 600"';
    }
    if($prava == "1"){
      $colorNickname =  'style="color: red;font-weight: 600"';
      }
      if($prava == "0"){
        $colorNickname =  '0 0 0 0.2rem rgba(0,0,0,.2)"';
        }
        if($prava == "2"){
        $colorNickname =  'style="color: #007500;font-weight: 600;"';
        }

$login = '<span '.$colorNickname.'>'.  $login . '</span>';
$query = mysqli_query($link,"INSERT INTO `chat` (`login`,`photo`,`mess`,`vk_id`,`id_users`) VALUES ('$login','$photo','$mess','$vk_id','$id')");

if($mess == '/clear'){
if($prava == 1 || $prava == 2){
$query = mysqli_query($link,"TRUNCATE `chat`");
$login = '<span style="color: #0b61bd;font-weight: 600">Система</span>';
$mess = '<span style="font-weight: 700">Чат очищен модератором или администратором проекта.</span>';
$photo = 'https://img.bgxcdn.com/customers_avatars/20170415124347_679.jpg';
$query = mysqli_query($link,"INSERT INTO `chat` (`login`,`photo`,`mess`,`vk_id`,`id_users`) VALUES ('$login','$photo','$mess','77777777','77777777')");
}
}



}else{
  $obj = array("good"=>"false","mess"=>"Авторизируйтесь!");
}
}else{
  $obj = array("good"=>"false","mess"=>"Чат временно недоступен");
}
}else{
  $obj = array("good"=>"false","mess"=>"Вы заблокированы в чате!");
}
}
if(isset($_POST['type'])){
    $type = $_POST['type'];
    $bet = $_POST['bet'];





    $mines = $_POST['mines']; //кол-во мин
    if($mines == 3 || $mines == 5 || $mines == 10 || $mines == 24){
    if($money >= $bet){
    if($bet >= "1"){
    if($type == "mine"){
  
  $addbilet = $bet / 100;

  $query = mysqli_query($link, "UPDATE `users` SET `bilet`= '$bilet' + '$addbilet' WHERE `id`='$id'");
  
      $query = ("SELECT * FROM `mines-game` WHERE `id_users` = '$id' AND `onOff` = '1' ORDER BY `id` DESC LIMIT 1");
      $minesgame = mysqli_query($link,$query);
  
      if(mysqli_num_rows($minesgame) != 0){
      $result = array("info" => "false");
      }else{
        //вычитаем монету
        $query = ("UPDATE `users` SET `money` = '$money' - '$bet' WHERE `id` = '$id'");
        mysqli_query($link,$query);
        $money = $money - $bet;
  
  
        
        if($mines == 3){
          $resultmines = range(1,25);
          shuffle($resultmines);
          $resultmines = array_slice($resultmines,0,3);
        }
        if($mines == 5){
          $resultmines = range(1,25);
          shuffle($resultmines);
          $resultmines = array_slice($resultmines,0,5);
        }
        if($mines == 10){
          $resultmines = range(1,25);
          shuffle($resultmines);
          $resultmines = array_slice($resultmines,0,10);
        }
        if($mines == 24){
          $resultmines = range(1,25);
          shuffle($resultmines);
          $resultmines = array_slice($resultmines,0,24);
        }
        $resultmines = serialize($resultmines);
  
        $sss = []; // для заполнения столбца (click)
        $sss = serialize($sss); // часть функции
  
        $query = ("INSERT INTO `mines-game` (`id_users`, `bet`, `onOff`, `step`,`result`, `win`,`mines`,`click`,`num_mines`,`login`) VALUES ('$id', '$bet', '1', '0', '1', '0','$resultmines','$sss','$mines','$login')");
        mysqli_query($link,$query);
  
        $obj = array("info"=>"true","money"=>"$money");
      }
    }
  }else{
    $obj = array("info" => "warning","warning"=>"Минимальная сумма игры 1 монета!");
  }
  }else{
    $obj = array("info" => "warning","warning"=>"У вас недостаточно средств для этой ставки.");
  }
  }else{
    $obj = array("info" => "warning","warning"=>"Произошла ошибка");
  }
  }
  if(isset($_POST['finish'])){
    $mines = unserialize($mines);
  
      if($step != "0"){
      if($minesgame != null){
      $query = ("UPDATE `users` SET `money` = '$money' + '$win' WHERE `id` = '$id'"); //выдаем баланс игроку за победу.
      mysqli_query($link,$query);
  
      $query = ("UPDATE `mines-game` SET `onOff` = '2' WHERE `id_users` = '$id'"); //отключаем игру.
      mysqli_query($link,$query);
  
     $tamines = json_encode($mines);

  // для работы с антиминусом
   $query = ("SELECT * FROM `admin`");
   $row_admin = mysqli_query($link,$query);
   $admin = mysqli_fetch_array($row_admin);
  
   $bank = $admin['bank'];
   $profit = $admin['zarabotok'];
   $win = $win - $bet;
   $query = mysqli_query($link, "UPDATE `admin` SET `bank`= '$bank'-'$win'");
    
    $win = $win + $bet;
    $money = $money + $win; //для правильного отображения баланса
    $ssa = "<span class='number result-win result'><span class='myBetsBox'>".$win."</span> <i class='fas fa-coins'></i></span>"; 
    $obj = array("info"=>"true","win" => "$win","money"=>"$money","tamines"=>"$tamines","resultHistoryContentBomb"=>"$ssa");
  }else{
    $obj = array("info" => "warning","warning"=>"Игра не существует.");
  }
  }else{
    $obj = array("info" => "warning","warning"=>"Ты не нажал на поле!");
  }
  }
  //игрок нажал на клетку...
if(isset($_POST['mmine'])){

    $mmines = $_POST['mmine'];
    if($mmines >= "1" && $mmines <= "25"){
    
    
    
    
    $mines = unserialize($mines);
    if($minesgame !=  null){
    

    $threebombs = [1.03,1.06,1.12,1.18,1.30,1.45,1.67,2.51,2.9,3.8,6,7.33,9.93,13.24,18.2,26.01,39.01,62.42,109.25,218.5,546.25,2190];
    $fivebombs = [1.18,1.5,1.91,2.48,3.01,3.84,5.89,7.15,8.55,12.8,17.21,25.21,40.72,80.25,150.29,350.58,504.31,700.05,1500];
    $tenbombs = [1.38,2.41,3.8,5.8,8.8,11.61,17.96,25.67,55.77,103,310,1086,4700,28200,31100];
    $twfobombs = [23.8];
    
    // для работы с антиминусом
   $query = ("SELECT * FROM `admin`");
   $row_admin = mysqli_query($link,$query);
   $admin = mysqli_fetch_array($row_admin);
  
   $bank = $admin['bank'];
 

    if(in_array($mmines,$click) == false){
    

    if(in_array($mmines,$mines)){
    
       //тут есть бомба, игра проиграна
    
      
    
      $query = ("UPDATE `mines-game` SET `onOff` = '2',`result` = '$bet',`win` = '0',`loseBombs`='$mmines' WHERE `id_users` = '$id' AND `onOff` = '1'");
      mysqli_query($link,$query);
    
        // для работы с антиминусом
   $query = ("SELECT * FROM `admin`");
   $row_admin = mysqli_query($link,$query);
   $admin = mysqli_fetch_array($row_admin);
  
   $bank = $admin['bank'];
   $profit = $admin['zarabotok'];
   $profit1 = $bet * $komissia;
   $bank1 = $bet * (1-$komissia);
   $query = mysqli_query($link, "UPDATE `admin` SET `bank`= '$bank'+'$bank1',`zarabotok`='$profit'+'$profit1'");
  
      $tamines = json_encode($mines);

      $saad = "<span class='number result-lose result'><span class='myBetsBox'>".$bet."</span> <i class='fas fa-coins'></i></span>";
      $obj = array("info" => "click","bombs"=>"true","pressmine" => "$mmines","tamines"=>"$tamines","resultHistoryContentBomb"=>"$saad");
    
    }else{
      $query = ("SELECT * FROM `admin`");
      $row_admin = mysqli_query($link,$query);
      $admin = mysqli_fetch_array($row_admin);
     
      $bank = $admin['bank'];

        $win = $win - $bet;
        if($win < $bank){

       //тут нет бомбы, все четко...
    
      $query = ("UPDATE `mines-game` SET `step` = '$step' + 1 WHERE `id_users` = '$id' AND `onOff` = '1'");
      mysqli_query($link,$query);
    
      if($num_mines == "3"){
      $win = $bet * $threebombs[$step];
      }
      if($num_mines == "5"){
      $win = $bet * $fivebombs[$step];
      }
      if($num_mines == "10"){
      $win = $bet * $tenbombs[$step];
      }
      if($num_mines == "24"){
      $win = $bet * $twfobombs[$step];
      }

    
     //кол-во криссталов
      $gem_number = 24 - $num_mines - $step;
    
      $query = ("UPDATE `mines-game` SET `win` = '$win' WHERE `id_users` = '$id' AND `onOff` = '1'");
      mysqli_query($link,$query);
    
      $click[] = $mmines;
      $click = serialize($click);
    
      $query = ("UPDATE `mines-game` SET `click` = '$click' WHERE `id_users` = '$id' AND `onOff` = '1'");
      mysqli_query($link,$query);

      if($num_mines == 3){
        $nextCoef = $threebombs[$step+1];
      }
      if($num_mines == 5){
        $nextCoef = $fivebombs[$step+1];
      }
      if($num_mines == 10){
        $nextCoef = $tenbombs[$step+1];
      }
      if($num_mines == 24){
        $nextCoef = $twfobombs[$step+1];
      }
      $rdr = "<span class='number result-win result'><span class='myBetsBox'>".$win."</span> <i class='fas fa-coins'></i></span>";
      $obj = array("info" => "click","bombs"=>"false","pressmine" => "$mmines","win" => "$win","gem"=>"$gem_number","nextX"=>"$nextCoef","resultHistoryContentBomb"=>"$rdr");
    
    }
    else{

    //создаем проигрышный вариант игры

$query = ("SELECT * FROM `mines-game` WHERE `id_users` = '$id' AND `onOff` = '1'");
$result55 = mysqli_query($link,$query);
$minesgame1 = mysqli_fetch_array($result55);

$click = $minesgame1['click'];
$step = $minesgame1['step'];
$num_mines = $minesgame1['num_mines'];
$resultgame = $minesgame1['result'];
$onOff = $minesgame1['onOff'];
$click = unserialize($click);



    //создаем новый массив, нужно учесть значения click

    

      
  $query = ("SELECT * FROM `admin`");
  $row_admin = mysqli_query($link,$query);
  $admin = mysqli_fetch_array($row_admin);
 
  $bank = $admin['bank'];
  $profit = $admin['zarabotok'];
  $bet = $bet * (1-$komissia);
  $profit1 = $bet * $komissia;
  $query = mysqli_query($link, "UPDATE `admin` SET `bank`='$bank'+'$bet',`zarabotok`='$profit'+'$profit1'");

  $mines = [];
  $mines[] = $mmines;      
  while(count($mines) < $num_mines){
    $rand = mt_rand(1,25);
    if(in_array($rand,$click)){
    }else{
        if(in_array($rand,$mines) == false){
           $mines[] = $rand;
        }

    }
}


      $mines = serialize($mines);
      $query = mysqli_query($link, "UPDATE `mines-game` SET `mines` = '$mines',`onOff`= '2',`loseBombs`='$mmines' WHERE `id_users` = '$id' AND `onOff` = '1'"); 
      $mines = unserialize($mines);
      $tamines = json_encode($mines);
      
      $saad = "<span class='number result-lose result'><span class='myBetsBox'>".$bet."</span> <i class='fas fa-coins'></i></span>";
      $obj = array("info" => "click","bombs"=>"true","pressmine" => "$mmines","tamines"=>"$tamines","resultHistoryContentBomb"=>"$saad");
    }
    }
    }else{
      $obj = array("info" => "warning","warning"=>"Вы уже нажимали на это поле.");
    }
    }else{
      $obj = array("info" => "warning","warning"=>"Нажмите начать игру.");
    }
    }else{
      $obj = array("info" => "warning","warning"=>"Произошла ошибка");
    }    
}
if(isset($_POST['live'])){
  $query = ("SELECT * FROM `mines-game` WHERE `onOff`= '2' ORDER BY `id` DESC LIMIT 10");
                        $result = mysqli_query($link,$query);
                        while(($minesHistory = mysqli_fetch_array($result))){                        
                        
                        $idgameHistory = $minesHistory['id'];
                        $idusersHistory = $minesHistory['id_users'];
                        $nameHistory = $minesHistory['login'];
                        $betHistory = $minesHistory['bet'];
                        $bombsHistory = $minesHistory['num_mines'];
                        $resultHistory = $minesHistory['result'];
                        if($minesHistory['win'] != "0"){
                           $resultHistory = $minesHistory['win'];
                        }
                        if($minesHistory['win'] != 0){
						          	$color = "win";
					             	}else{
						           	$color = "lose";
						            }
						
                        $h.="
                        <tr onclick='openMines($idgameHistory)' style='cursor: pointer'>
                        <td ><i class='fas fa-user-circle'  onclick ='openProfile($idusersHistory)' style='cursor: pointer'></i> <span>".$nameHistory."</span></td>
                        <td><span>".$betHistory."</span> <i class='fas fa-coins'></i></td>
                        <td><span>".$bombsHistory."</span> <i class='fas fa-bomb'></i></td>
                        <td class='result-".$color."'><span>".$resultHistory."</span> <i class='fas fa-coins'></i></td>
                        </tr>";                            
                        } 
					 	            $obj = array("live"=>"$h");
                      }
if(isset($_POST['hilos'])){
                        $query = ("SELECT * FROM `hilos-games` ORDER BY `id` DESC LIMIT 10");
                        $result1 = mysqli_query($link,$query);
                        while(($hilosHistory = mysqli_fetch_array($result1))){
                        $hilosidUsersHistory = $hilosHistory['id_users'];
                        $nameHilosHistory = $hilosHistory['login'];
                        $betHilosHistory = $hilosHistory['bet'];
                        $coefHilosHistory = $hilosHistory['coef'];
                        $resultHilosHistory = $hilosHistory['result'];
                        if($resultHilosHistory == "lose"){
                          $resultHilosHistory = $betHilosHistory;
                          $colorHilos = "lose";
                        }else{
                          $colorHilos = "win";
                          $resultHilosHistory = $coefHilosHistory * $betHilosHistory;
                        }
                        $p.="
                        <tr onclick='openProfile($hilosidUsersHistory)'>
				                 <td><i class='fas fa-user-circle'></i> <span>".$nameHilosHistory."</span></td>
			                	<td><span>".$betHilosHistory."</span> <i class='fas fa-coins'></i></td>
			                	<td><span style='font-weight: 600;'>х".$coefHilosHistory."</i></td>
			                	<td class='result-$colorHilos'><span>".$resultHilosHistory."</span> <i class='fas fa-coins'></i></td>
			                  </tr>";                            
                        }      
                        $obj = array("hilo"=>"$p");
}
if(isset($_POST['wheelHis']) == true){ // история wheel
    $query = ("SELECT * FROM `wheel-games` ORDER BY `id` DESC LIMIT 10");
    $result2 = mysqli_query($link,$query);
    while(($wheelHistory = mysqli_fetch_array($result2))){
    $idWheelUsersHistory = $wheelHistory['id_users'];
    $nameWheelHistory = $wheelHistory['login'];
    $betWheelHistory = $wheelHistory['bet'];
    $colorWheelHistory = $wheelHistory['colorWheel'];
    $resultWheelHistory = $wheelHistory['result'];
    if($colorWheelHistory == $resultWheelHistory){
      $w_color = "win";
      $wheelWinHistory = $betWheelHistory * $colorWheelHistory;
    }else{
      $w_color = "lose";
      $wheelWinHistory = $betWheelHistory;
      $resultWheelHistory = $colorWheelHistory;
    }

    $w.="
    <tr onclick='openProfile($idWheelUsersHistory)'>
    <td><i class='fas fa-user-circle'></i> <span>".$nameWheelHistory."</span></td>
    <td><span>".$betWheelHistory."</span> <i class='fas fa-coins'></i></td>
    <td><span style='font-weight: 600;'>х".$resultWheelHistory."</span></td>
    <td class='result-$w_color'><span>".$wheelWinHistory."</span> <i class='fas fa-coins'></i></td>
    </tr>";  
    }                                
  $obj = array("wheel"=>"$w");
}
if(isset($_POST['promo'])){
  $promo = $_POST['promo'];

$token_vk = 'bebd07563bf1d1aebd8b253e324c5d069cb59b5c4ae444b5f46ecc9c4898967142e0631121d8797ded9da';
  

$result777 = json_decode(file_get_contents("https://api.vk.com/method/groups.isMember?group_id=190597876&user_id=".$vk_id."&access_token=".$token_vk."&v=5.103"));
 $result777 = $result777->response;






  if($result777 == 1){
  $query = ("SELECT * FROM `promocode` WHERE `name` = '$promo'");
  $result = mysqli_query($link,$query);
  $promo1 = mysqli_fetch_array($result);
  if($promo1){
    $name = $promo1['name'];
    $total_activ = $promo1['ost_activ']; // кол-активаций
    $activ = $promo1['activ']; // всего активаций
    $users = $promo1['users']; 
    $sum = $promo1['sum'];
    $users = unserialize($users);
    if($activ > $total_activ){ // активация промокода
      if(in_array($id,$users) == false){
      $query = mysqli_query($link, "UPDATE `users` SET `money` = '$money' + '$sum' WHERE `id` = '$id'");
      $users[] = $id;
      $users = serialize($users);
      $query = mysqli_query($link, "UPDATE `promocode` SET `ost_activ`= '$total_activ' + '1',`users`='$users' WHERE `name`='$promo'");
      $money = $money + $sum; //для правильного отображения баланса
      $obj = array("good"=>"true","mess"=>"Промокод на сумму $sum монет успешно активирован","money"=> "$money");
      }else{
        $obj = array("good"=>"false","mess"=>"Вы уже активировали этот промокод!");
      }
    }else{
      $obj = array("good"=>"false","mess"=>"Активации закончились");
    }
 

  }else{
    $obj = array("good"=>"false","mess"=>"Промокод не существует");
  }
  }else{
    $obj = array("good"=>"false","mess"=>"Подпишитесь на нашу группу Вконтакте");
}
} 
if(isset($_POST['range'])){
  $range = $_POST['range'];
  $bet = $_POST['bet'];
  $diceRandom = mt_rand(1,100);




  $less_hilo = 100 / $hilo;  //коэффициент на меньше
  $less_hilo = round($less_hilo,2);
  $more_hilo = (1 / (100 - $hilo)) * 100;
  $more_hilo = round($more_hilo,2); // коэффициент на больше

  
if($bet >= "1"){
  if($bet <= $money){

   $addbilet = $bet / 100;

  $query = mysqli_query($link, "UPDATE `users` SET `bilet`= '$bilet' + '$addbilet' WHERE `id`='$id'");


   if($range == "l"){ //меньше    
    if($hilo > $diceRandom){ // выигрыш 
      $win = ($bet * $less_hilo) - $bet;
      $query = mysqli_query($link,"UPDATE `users` SET `money` = '$money' + '$win' WHERE `id` = '$id'");
      $query = mysqli_query($link,"UPDATE `users` SET `hilo` = '$diceRandom' WHERE `id` = '$id'");
      $win = $bet + $win;
      $query = mysqli_query($link, "INSERT INTO `hilos-games` (`id_users`, `login`, `hilo`, `diceRand`, `bet`, `result`,`click`,`coef`) VALUES ('$id', '$login', '$hilo', '$diceRandom', '$bet', '$win','less','$less_hilo')");
      

       // для работы с антиминусом
   $query = ("SELECT * FROM `admin`");
   $row_admin = mysqli_query($link,$query);
   $admin = mysqli_fetch_array($row_admin);
  
   $bank = $admin['bank'];
   $profit = $admin['zarabotok'];
   $bank1 = $win - $bet;
   $query = mysqli_query($link, "UPDATE `admin` SET `bank`= '$bank'-'$bank1'");

      $win = $bet * $less_hilo;
      $less_hilo = 100 / $diceRandom;  //коэффициент на меньше
      $less_hilo = round($less_hilo,2);
      $more_hilo = (1 / (100 - $diceRandom)) * 100;
      $more_hilo = round($more_hilo,2); // коэффициент на больше
      $money = $money + $win - $bet;
      $ewwe = "<span class='number result-win result'><span class='myBetsBox'>".$win."</span> <i class='fas fa-coins'></i></span>";
      $obj = array("good"=>"good","mess"=>"Выигрыш $win <i class='fas fa-coins'></i>","hilo"=>"$diceRandom","hi"=>"$less_hilo","lo"=>"$more_hilo","money"=>"$money","resultHistoryContentDice"=>"$ewwe");
    }else{




       // для работы с антиминусом
   $query = ("SELECT * FROM `admin`");
   $row_admin = mysqli_query($link,$query);
   $admin = mysqli_fetch_array($row_admin);
  
   $bank = $admin['bank'];
   $profit = $admin['zarabotok'];
   $bank1 = $win - $bet * (1 - $komissia);
   $profit1 = $bet * $komissia;
   $query = mysqli_query($link, "UPDATE `admin` SET `bank`= '$bank'-'$bank1',`zarabotok`='$profit'+'$profit1'");



      $less_hilo = 100 / $diceRandom;  //коэффициент на меньше
      $less_hilo = round($less_hilo,2);
      $more_hilo = (1 / (100 - $diceRandom)) * 100;
      $more_hilo = round($more_hilo,2); // коэффициент на больше
      $query = mysqli_query($link,"UPDATE `users` SET `hilo` = '$diceRandom',`money` = '$money' - '$bet' WHERE `id` = '$id'");
      $query = mysqli_query($link, "INSERT INTO `hilos-games` (`id_users`, `login`, `hilo`, `diceRand`, `bet`, `result`,`click`,`coef`) VALUES ('$id', '$login', '$hilo', '$diceRandom', '$bet', 'lose','less','$less_hilo')");
      $money = $money - $bet;
      $ewwe = "<span class='number result-lose result'><span class='myBetsBox'>".$bet."</span> <i class='fas fa-coins'></i></span>";
      $obj = array("good"=>"bad","mess"=>"Вы проиграли $bet <i class='fas fa-coins'></i>","hilo"=>"$diceRandom","hi"=>"$less_hilo","lo"=>"$more_hilo","money"=>"$money","resultHistoryContentDice"=>"$ewwe");

    }

  }
  if($range == "h"){ // больше
    if($hilo < $diceRandom){ // выигрыш 
      $win = ($bet * $more_hilo);


       // для работы с антиминусом
   $query = ("SELECT * FROM `admin`");
   $row_admin = mysqli_query($link,$query);
   $admin = mysqli_fetch_array($row_admin);
  
   $bank = $admin['bank'];
   $profit = $admin['zarabotok'];
   $bank1 = $win - $bet;
   $query = mysqli_query($link, "UPDATE `admin` SET `bank`= '$bank'-'$bank1'");


      $win1 = $win - $bet; // для правильного начисления
      $query = mysqli_query($link,"UPDATE `users` SET `money` = '$money' + '$win1',`hilo` = '$diceRandom' WHERE `id` = '$id'");
      $query = mysqli_query($link, "INSERT INTO `hilos-games` (`id_users`, `login`, `hilo`, `diceRand`, `bet`, `result`,`click`,`coef`) VALUES ('$id', '$login', '$hilo', '$diceRandom', '$bet', '$win','more','$more_hilo')");

      $less_hilo = 100 / $diceRandom;  //коэффициент на меньше
      $less_hilo = round($less_hilo,2);
      $more_hilo = (1 / (100 - $diceRandom)) * 100;
      $more_hilo = round($more_hilo,2); // коэффициент на больше
      $money = $money + $win1;
      $ewwe = "<span class='number result-win result'><span class='myBetsBox'>".$win."</span> <i class='fas fa-coins'></i></span>";
      $obj = array("good"=>"good","mess"=>"Выигрыш $win <i class='fas fa-coins'></i>","hilo"=>"$diceRandom","hi"=>"$less_hilo","lo"=>"$more_hilo","money"=>"$money","resultHistoryContentDice"=>"$ewwe");
    }else{


             // для работы с антиминусом
   $query = ("SELECT * FROM `admin`");
   $row_admin = mysqli_query($link,$query);
   $admin = mysqli_fetch_array($row_admin);
  
   $bank = $admin['bank'];
   $profit = $admin['zarabotok'];
   $bank1 = $win - $bet * (1 - $komissia);
   $profit1 = $bet * $komissia;
   $query = mysqli_query($link, "UPDATE `admin` SET `bank`= '$bank'-'$bank1',`zarabotok`='$profit'+'$profit1'");


      $less_hilo = 100 / $diceRandom;  //коэффициент на меньше
      $less_hilo = round($less_hilo,2);
      $more_hilo = (1 / (100 - $diceRandom)) * 100;
      $more_hilo = round($more_hilo,2); // коэффициент на больше
      $query = mysqli_query($link,"UPDATE `users` SET `hilo` = '$diceRandom' WHERE `id` = '$id'");
      $query = mysqli_query($link,"UPDATE `users` SET `money` = '$money' - '$bet' WHERE `id` = '$id'"); // вычитаем баланс
      $query = mysqli_query($link, "INSERT INTO `hilos-games` (`id_users`, `login`, `hilo`, `diceRand`, `bet`, `result`,`click`,`coef`) VALUES ('$id', '$login', '$hilo', '$diceRandom', '$bet', 'lose','more','$more_hilo')");
      $money = $money - $bet;
      $ewwe = "<span class='number result-lose result'><span class='myBetsBox'>".$bet."</span> <i class='fas fa-coins'></i></span>";
      $obj = array("good"=>"bad","mess"=>"Вы проиграли $bet <i class='fas fa-coins'></i>","hilo"=>"$diceRandom","hi"=>"$less_hilo","lo"=>"$more_hilo","money"=>"$money","resultHistoryContentDice"=>"$ewwe");
    }
  }
  $less_hilo = 100 / $diceRandom;  //коэффициент на меньше
  $less_hilo = round($less_hilo,2);
  $more_hilo = (1 / (100 - $diceRandom)) * 100;
  $more_hilo = round($more_hilo,2); // коэффициент на больше
  if($range == "4et"){
    if(($diceRandom % 2) == 0){ // вы выиграли


      $win = $bet * 0.90;




       // для работы с антиминусом
   $query = ("SELECT * FROM `admin`");
   $row_admin = mysqli_query($link,$query);
   $admin = mysqli_fetch_array($row_admin);
  
   $bank = $admin['bank'];
   $profit = $admin['zarabotok'];
   $bank1 = $win * (1 - $komissia);
   $query = mysqli_query($link, "UPDATE `admin` SET `bank`= '$bank'-'$bank1'");


      $query = mysqli_query($link, "UPDATE `users` SET `money`= '$money' + '$win' WHERE `id` = '$id'");
      $query = mysqli_query($link,"UPDATE `users` SET `hilo` = '$diceRandom' WHERE `id` = '$id'");
      $query = mysqli_query($link, "INSERT INTO `hilos-games` (`id_users`, `login`, `hilo`, `diceRand`, `bet`, `result`,`click`,`coef`) VALUES ('$id', '$login', '$hilo', '$diceRandom', '$bet', 'win','Чет','1.90')");
      $money = $money + $win;
      $win = $bet * 1.90;
      $ewwe = "<span class='number result-win result'><span class='myBetsBox'>".$win."</span> <i class='fas fa-coins'></i></span>";
      $obj = array("good"=>"good","mess"=>"Выигрыш $win <i class='fas fa-coins'></i>","hilo"=>"$diceRandom","hi"=>"$less_hilo","lo"=>"$more_hilo","money"=>"$money","resultHistoryContentDice"=>"$ewwe");
    }else{ //проигрыш



       // для работы с антиминусом
   $query = ("SELECT * FROM `admin`");
   $row_admin = mysqli_query($link,$query);
   $admin = mysqli_fetch_array($row_admin);
  
   $bank = $admin['bank'];
   $profit = $admin['zarabotok'];
   $bank1 = $win - $bet * (1 - $komissia);
   $profit1 = $bet * $komissia;
   $query = mysqli_query($link, "UPDATE `admin` SET `bank`= '$bank'-'$bank1',`zarabotok`='$profit'+'$profit1'");


      $query = mysqli_query($link, "UPDATE `users` SET `money`= '$money' - '$bet' WHERE `id` = '$id'");
      $query = mysqli_query($link,"UPDATE `users` SET `hilo` = '$diceRandom' WHERE `id` = '$id'");
      $query = mysqli_query($link, "INSERT INTO `hilos-games` (`id_users`, `login`, `hilo`, `diceRand`, `bet`, `result`,`click`,`coef`) VALUES ('$id', '$login', '$hilo', '$diceRandom', '$bet', 'lose','Чет','1.90')");
      $money = $money - $bet;
      $ewwe = "<span class='number result-lose result'><span class='myBetsBox'>".$bet."</span> <i class='fas fa-coins'></i></span>";
      $obj = array("good"=>"bad","mess"=>"Вы проиграли $bet <i class='fas fa-coins'></i>","hilo"=>"$diceRandom","hi"=>"$less_hilo","lo"=>"$more_hilo","money"=>"$money","resultHistoryContentDice"=>"$ewwe");
    }
    
  }

  if($range == "ne4et"){
    if(($diceRandom % 2) == 1){ // вы выиграли
      $win = $bet * 0.90;


       // для работы с антиминусом
   $query = ("SELECT * FROM `admin`");
   $row_admin = mysqli_query($link,$query);
   $admin = mysqli_fetch_array($row_admin);
  
   $bank = $admin['bank'];
   $profit = $admin['zarabotok'];
   $bank1 = $win * (1 - $komissia);
   $query = mysqli_query($link, "UPDATE `admin` SET `bank`= '$bank'-'$bank1'");


      $query = mysqli_query($link, "UPDATE `users` SET `money`= '$money' + '$win' WHERE `id` = '$id'");
      $query = mysqli_query($link,"UPDATE `users` SET `hilo` = '$diceRandom' WHERE `id` = '$id'");
      $query = mysqli_query($link, "INSERT INTO `hilos-games` (`id_users`, `login`, `hilo`, `diceRand`, `bet`, `result`,`click`,`coef`) VALUES ('$id', '$login', '$hilo', '$diceRandom', '$bet', 'win','нечет','1.90')");
      $money = $money + $win;
      $win = $bet * 1.90;
      $ewwe = "<span class='number result-win result'><span class='myBetsBox'>".$win."</span> <i class='fas fa-coins'></i></span>";
      $obj = array("good"=>"good","mess"=>"Выигрыш $win <i class='fas fa-coins'></i>","hilo"=>"$diceRandom","hi"=>"$less_hilo","lo"=>"$more_hilo","money"=>"$money","resultHistoryContentDice"=>"$ewwe");
    }else{ //проигрыш



            // для работы с антиминусом
   $query = ("SELECT * FROM `admin`");
   $row_admin = mysqli_query($link,$query);
   $admin = mysqli_fetch_array($row_admin);
  
   $bank = $admin['bank'];
   $profit = $admin['zarabotok'];
   $bank1 = $win - $bet * (1 - $komissia);
   $profit1 = $bet * $komissia;
   $query = mysqli_query($link, "UPDATE `admin` SET `bank`= '$bank'-'$bank1',`zarabotok`='$profit'+'$profit1'");
    

      $query = mysqli_query($link, "UPDATE `users` SET `money`= '$money' - '$bet' WHERE `id` = '$id'");
      $query = mysqli_query($link,"UPDATE `users` SET `hilo` = '$diceRandom' WHERE `id` = '$id'");
      $query = mysqli_query($link, "INSERT INTO `hilos-games` (`id_users`, `login`, `hilo`, `diceRand`, `bet`, `result`,`click`,`coef`) VALUES ('$id', '$login', '$hilo', '$diceRandom', '$bet', 'lose','нечет','1.90')");
      $money = $money - $bet;
      $ewwe = "<span class='number result-lose result'><span class='myBetsBox'>".$bet."</span> <i class='fas fa-coins'></i></span>";
      $obj = array("good"=>"bad","mess"=>"Вы проиграли $bet <i class='fas fa-coins'></i>","hilo"=>"$diceRandom","hi"=>"$less_hilo","lo"=>"$more_hilo","money"=>"$money","resultHistoryContentDice"=>"$ewwe");
    }
  } 
  if($range == "ravno"){
    if($hilo == $diceRandom){ // вы выиграли
    $win = $bet * 95;
    $query = mysqli_query($link, "UPDATE `users` SET `money`= '$money' + '$win' WHERE `id` = '$id'");
    $query = mysqli_query($link,"UPDATE `users` SET `hilo` = '$diceRandom' WHERE `id` = '$id'");
    $query = mysqli_query($link, "INSERT INTO `hilos-games` (`id_users`, `login`, `hilo`, `diceRand`, `bet`, `result`,`click`,`coef`) VALUES ('$id', '$login', '$hilo', '$diceRandom', '$bet', 'win','равно','95')");



       // для работы с антиминусом
   $query = ("SELECT * FROM `admin`");
   $row_admin = mysqli_query($link,$query);
   $admin = mysqli_fetch_array($row_admin);
  
   $bank = $admin['bank'];
   $profit = $admin['zarabotok'];
   $bank1 = $win - $bet;
   $query = mysqli_query($link, "UPDATE `admin` SET `bank`= '$bank'-'$bank1'");

  

    $money = $win + $money;
    $ewwe = "<span class='number result-win result'><span class='myBetsBox'>".$win."</span> <i class='fas fa-coins'></i></span>";
    $obj = array("good"=>"good","mess"=>"Выигрыш $win <i class='fas fa-coins'></i>","hilo"=>"$diceRandom","hi"=>"$less_hilo","lo"=>"$more_hilo","money"=>"$money","resultHistoryContentDice"=>"$ewwe");
    }else{ //проигрыш

         // для работы с антиминусом
   $query = ("SELECT * FROM `admin`");
   $row_admin = mysqli_query($link,$query);
   $admin = mysqli_fetch_array($row_admin);
  
   $bank = $admin['bank'];
   $profit = $admin['zarabotok'];
   $bank1 = $win - $bet * (1 - $komissia);
   $profit1 = $bet * $komissia;
   $query = mysqli_query($link, "UPDATE `admin` SET `bank`= '$bank'-'$bank1',`zarabotok`='$profit'+'$profit1'");

    

      $query = mysqli_query($link, "UPDATE `users` SET `money`= '$money' - '$bet' WHERE `id` = '$id'");
      $query = mysqli_query($link,"UPDATE `users` SET `hilo` = '$diceRandom' WHERE `id` = '$id'");
      $query = mysqli_query($link, "INSERT INTO `hilos-games` (`id_users`, `login`, `hilo`, `diceRand`, `bet`, `result`,`click`,`coef`) VALUES ('$id', '$login', '$hilo', '$diceRandom', '$bet', 'lose','равно','95')");
      $money = $money - $bet;
      $ewwe = "<span class='number result-lose result'><span class='myBetsBox'>".$bet."</span> <i class='fas fa-coins'></i></span>";
      $obj = array("good"=>"bad","mess"=>"Вы проиграли $bet <i class='fas fa-coins'></i>","hilo"=>"$diceRandom","hi"=>"$less_hilo","lo"=>"$more_hilo","money"=>"$money","resultHistoryContentDice"=>"$ewwe");
    }
  }
}
else{
    $obj = array("good"=>"bad","mess"=>"Не хватает монет для игры");
  }
}else{
  $obj = array("good"=>"bad","mess"=>"Минимальная ставка 1 <i class='fas fa-coins'></i>","hilo"=>"$hilo");
}
}
if(isset($_POST['wheel'])){
  $colorWheel = $_POST['wheel'];
  $bet = $_POST['bet'];

   

   $arrayWheel = [5,2,3,2,3,2,3,2,5,2,5,2,3,2,3,2,3,2,5,2,5,2,3,2,3,2,3,2,3,2,3,2,5,2,5,2,3,2,3,2,3,2,5,2,5,2,3,2,3,2,3,2,5,50];
  if($bet <= $money){
   if($bet >= "1"){

    $query = ("SELECT * FROM `admin`"); 
    $row_admin = mysqli_query($link,$query); 
    $admin = mysqli_fetch_array($row_admin); 
    
    $bank = $admin['bank']; 


   $randWheel =  mt_rand(0,53); //цвет который выпадет
   $valuesWheel = $arrayWheel[$randWheel];
   $addbilet = $bet / 100;

  $query = mysqli_query($link, "UPDATE `users` SET `bilet`= '$bilet' + '$addbilet' WHERE `id`='$id'");


   if ($arrayWheel[$randWheel] == 2) {
    $key2Wheel = [
       1,  3,  5,  7,  9, 11, 13, 15,
      17, 19, 21, 23, 25, 27, 29, 31,
      33, 35, 37, 39, 41, 43, 45, 47,
      49, 51
    ];
    $random = mt_rand(0,25);
    $key = $key2Wheel[$random];
  }
  if ($arrayWheel[$randWheel] == 3) {
    $key3Wheel = [
      2,4,6,
      12,14,16,
      22,24,26,
      28,30,36,
      38,40,46,
      48,50
    ];
    $random = mt_rand(0,16);
    $key = $key3Wheel[$random];
  }
  if ($arrayWheel[$randWheel] == 5) {
    $key5Wheel = [
      0,8,10,18,20,32,34,42,44,52
    ];
    $random = mt_rand(0,9);
    $key = $key5Wheel[$random];
  }
  if ($valuesWheel == 50) {
    $key5Wheel = [
      53
    ];
    $key = 53;
  }
  
  $vozm_win = ($bet * $colorWheel) - $bet;
  if($bank >= $vozm_win){
  if($colorWheel == $valuesWheel){ // вы выиграли
    $win = $bet * $colorWheel - $bet;
    $query = mysqli_query($link, "UPDATE `users` SET `money` = '$money'+'$win' WHERE `id` = '$id'");
    $win = $bet * $colorWheel;
    $money = $money + $win - $bet;



   // для работы с антиминусом
   $query = ("SELECT * FROM `admin`");
   $row_admin = mysqli_query($link,$query);
   $admin = mysqli_fetch_array($row_admin);
  
   $bank = $admin['bank'];
   $profit = $admin['zarabotok'];
   $bank1 = $bet;
   $query = mysqli_query($link, "UPDATE `admin` SET `bank`= '$bank'-'$bank1'");
  


    $dfghjk = "<span class='number result-win result'><span class='myBetsBox'>".$win."</span> <i class='fas fa-coins'></i></span>";
    $obj = array("good"=>"good","mess"=>"Вы выиграли $win <i class='fas fa-coins'></i>","valuesWheel"=>"$valuesWheel","key"=>"$key","money"=>"$money","resultHistoryContentWheel"=>"$dfghjk");
    $query = mysqli_query($link, "INSERT INTO `wheel-games` (`id_users`, `login`, `bet`, `colorWheel`, `result`) VALUES ('$id', '$login', '$bet', '$colorWheel', '$valuesWheel');"); 
  }else{ //вы проиграли

        // для работы с антиминусом
   $query = ("SELECT * FROM `admin`");
   $row_admin = mysqli_query($link,$query);
   $admin = mysqli_fetch_array($row_admin);
  
   $bank = $admin['bank'];
   $profit = $admin['zarabotok'];
   $profit1 = $bet * $komissia;
   $bank1 = $bet * (1-$komissia);
   $query = mysqli_query($link, "UPDATE `admin` SET `bank`= '$bank'+'$bank1',`zarabotok`='$profit'+'$profit1'");

    $query = mysqli_query($link, "UPDATE `users` SET `money` = '$money'-'$bet' WHERE `id` = '$id'");
    $money = $money - $bet;
    $dfghjk = "<span class='number result-lose result'><span class='myBetsBox'>".$bet."</span> <i class='fas fa-coins'></i></span>";
    $obj = array("bad"=>"bad","mess"=>"Вы проиграли $bet <i class='fas fa-coins'></i>","valuesWheel"=>"$valuesWheel","key"=>"$key","money"=>"$money","resultHistoryContentWheel"=>"$dfghjk");
    $query = mysqli_query($link, "INSERT INTO `wheel-games` (`id_users`, `login`, `bet`, `colorWheel`, `result`) VALUES ('$id', '$login', '$bet', '$colorWheel', '$valuesWheel');");
  }
 }else{
  $query = mysqli_query($link, "UPDATE `users` SET `money` = '$money'-'$bet' WHERE `id` = '$id'");

          // для работы с антиминусом
          $query = ("SELECT * FROM `admin`");
          $row_admin = mysqli_query($link,$query);
          $admin = mysqli_fetch_array($row_admin);
         
          $bank = $admin['bank'];
          $profit = $admin['zarabotok'];
          $profit1 = $bet * $komissia;
          $bank1 = $bet * (1-$komissia);
          $query = mysqli_query($link, "UPDATE `admin` SET `bank`= '$bank'+'$bank1',`zarabotok`='$profit'+'$profit1'");


   $x = false;
   $colors = [5,2,3,2,3,2,3,2,5,2,5,2,3,2,3,2,3,2,5,2,5,2,3,2,3,2,3,2,3,2,3,2,5,2,5,2,3,2,3,2,3,2,5,2,5,2,3,2,3,2,3,2,5,50];
   $rand = mt_rand(0,53);
   while($colorWheel == $colors[$rand]){
     if($colorWheel == $colors[$rand]){
      $colors = [5,2,3,2,3,2,3,2,5,2,5,2,3,2,3,2,3,2,5,2,5,2,3,2,3,2,3,2,3,2,3,2,5,2,5,2,3,2,3,2,3,2,5,2,5,2,3,2,3,2,3,2,5,50];
      $rand = mt_rand(0,53);
     }else{
      $colors = [5,2,3,2,3,2,3,2,5,2,5,2,3,2,3,2,3,2,5,2,5,2,3,2,3,2,3,2,3,2,3,2,5,2,5,2,3,2,3,2,3,2,5,2,5,2,3,2,3,2,3,2,5,50];
      $rand = mt_rand(0,53);
      $colors[$rand];
     }
   }

  
   $colorWheel = $colors[$rand];

  if ($colorWheel == 2) {
    $key2Wheel = [
       1,  3,  5,  7,  9, 11, 13, 15,
      17, 19, 21, 23, 25, 27, 29, 31,
      33, 35, 37, 39, 41, 43, 45, 47,
      49, 51
    ];
    $random = mt_rand(0,25);
    $key = $key2Wheel[$random];
  }
  if ($colorWheel == 3) {
    $key3Wheel = [
      2,4,6,
      12,14,16,
      22,24,26,
      28,30,36,
      38,40,46,
      48,50
    ];
    $random = mt_rand(0,16);
    $key = $key3Wheel[$random];
  }
  if ($colorWheel == 5) {
    $key5Wheel = [
      0,8,10,18,20,32,34,42,44,52
    ];
    $random = mt_rand(0,9);
    $key = $key5Wheel[$random];
  }
  if ($colorWheel == 50) {
    $key5Wheel = [
      53
    ];
    $key = 53;
  }
  
  
  $money = $money - $bet;
  $dfghjk = "<span class='number result-lose result'><span class='myBetsBox'>".$bet."</span> <i class='fas fa-coins'></i></span>";
  $obj = array("bad"=>"bad","mess"=>"Вы проиграли $bet <i class='fas fa-coins'></i>","valuesWheel"=>"$colorWheel","key"=>"$key","money"=>"$money","resultHistoryContentWheel"=>"$dfghjk");
 } 
  }else{
    $obj = array("danger"=>"danger","mess"=>"Минимальная ставка 1 <i class='fas fa-coins'></i>");
  }
  }else{
    $obj = array("danger"=>"danger","mess"=>"Не хватает монет для игры");
  }
  }
if(isset($_POST['wallet'])){
  
  $wallet = $_POST['wallet']; // кошелек
  $w_amount = $_POST['w_amount']; //сумма
  $w_number_wallet = $_POST['w_number_wallet']; // номер кошелька
  if($deposit >= 50){
  if($money >= $w_amount){
  if($w_amount >= 50){ //все гуд
    $today2 = date("d.m.y");
    $today3 = date("H:i:s");
    $data = "$today2 $today3";

    $query = mysqli_query($link, "UPDATE `users` SET `money` = '$money' - '$w_amount',`vivod`='$vivod'+'$w_amount' WHERE `id` = '$id'"); // вычитаем баланс у игрока
    $query = mysqli_query($link, "INSERT INTO `payments` (`users_id`, `login`, `vk_id`, `wallet`, `sum`, `data`, `result`,`number_wallet`) VALUES ('$id', '$login', '$vk_id', '$wallet', '$w_amount', '$data', 'Ожидание','$w_number_wallet')");
    
    $money = $money - $w_amount;
  $withdraws = '<tr><td>'.$w_amount.' <i class="fas fa-coins"></i></td><td>'.$data.'</td><td>Ожидание</td></tr>';
  $obj = array("good"=>"true","mess"=>"Заявка на вывод успешно создана.","money"=>"$money","withdraws"=>"$withdraws"); 
  }else{
    $obj = array("good"=>"false","mess"=>"Минимальная сумма - 50 <i class='fas fa-coins'></i>"); 
  }
  }else{
    $obj = array("good"=>"false","mess"=>"Недостаточно средств"); 
  }
}else{
    $obj = array("good"=>"false","mess"=>"Для разблокировки выводов необходимо пополнить на сумму 50 рублей."); 

}
}
if(isset($_POST['del'])){
  $del = $_POST['del'];
  if($prava == 0 || $prava == 1){
  $query = mysqli_query($link, "DELETE FROM `chat` WHERE `id` = '$del'");
  }
}
if(isset($_POST['chat_ban'])){
  $chat_ban = $_POST['chat_ban'];
  if($prava == 0 || $prava == 1){
    $query = mysqli_query($link, "UPDATE `users` SET `chat_ban` = '1' WHERE `vk_id` = '$chat_ban'");
  }
}
  if(isset($_POST['no_chat_ban'])){
    $chat_ban = $_POST['no_chat_ban'];
    if($prava == 0 || $prava == 1){
      $query = mysqli_query($link, "UPDATE `users` SET `chat_ban` = '0' WHERE `vk_id` = '$chat_ban'");
    
}
  }

if(isset($_POST['openProfile'])){

$idProfile = $_POST['idProfile'];

$query = ("SELECT * FROM `users` WHERE `id`='$idProfile'");
$result444 = mysqli_query($link,$query);
$row5553 = mysqli_fetch_array($result444);

if($row5553){
$profileprava = $row5553['prava'];
if($profileprava != 1){
$vkprofileid = $row5553['vk_id'];
$vkprofileid = "vk.com/id$vkprofileid";
}else{
$vkprofileid = "Скрыто";
$admili = '<i class="fas fa-fire" style=" color: red;" title="Администратор"></i>';
}
if($profileprava == 2){
$admili = '<i class="fas fa-meteor" style="color: red;" title="Модератор"></i>';
}


$profiledeposit = $row5553['deposit'];
$profilevivod = $row5553['vivod'];
$profilevk = $row5553['vk_id'];
$profilereferalov = $row5553['referalov'];

$token_vk = 'bebd07563bf1d1aebd8b253e324c5d069cb59b5c4ae444b5f46ecc9c4898967142e0631121d8797ded9da';
  

$result2 = json_decode(file_get_contents("https://api.vk.com/method/groups.isMember?group_id=190597876&user_id=".$profilevk."&access_token=".$token_vk."&v=5.103"));
 $result2 = $result2->response;

if($result2 == 1){
$fjfj = '
    <div class="col" style="
    background: linear-gradient(0deg, rgb(19, 113, 193) 0%, rgb(50, 118, 243) 97%);
    border-radius: 5px;
    color: white; padding: 8px 10px 8px;margin: 5px;
    "><i class="fab fa-vk"></i> Подписался на нашу группу Вконтакте</div>
';
}
if($profilereferalov >= 10){
$fdkr = '<div class="col" style="
    background: linear-gradient(0deg, rgb(202, 47, 47) 0%, rgb(234, 140, 104) 97%);
    border-radius: 5px;
    color: white;
    padding: 8px 10px 8px;
    margin: 5px;
    "><i class="fas fa-users"></i><span style="margin-left: 5px">Пригласил 10 рефералов</span></div>';
}



$query = ("SELECT * FROM `mines-game` WHERE `id_users`='$idProfile'");
$result4447 = mysqli_query($link,$query);
$row55531 = mysqli_num_rows($result4447);

$query = ("SELECT * FROM `wheel-games` WHERE `id_users`='$idProfile'");
$result4446 = mysqli_query($link,$query);
$row55532 = mysqli_num_rows($result4446);

$query = ("SELECT * FROM `hilos-games` WHERE `id_users`='$idProfile'");
$result4445 = mysqli_query($link,$query);
$row55533 = mysqli_num_rows($result4445);

$fdf = $row55531+$row55532+$row55533;

$query = ("SELECT sum(`bet`) FROM `hilos-games` WHERE `id_users`='$idProfile'");
$result4445 = mysqli_query($link,$query);
$row555335 = mysqli_fetch_array($result4445);

$query = ("SELECT sum(`bet`) FROM `mines-game` WHERE `id_users`='$idProfile'");
$result4445 = mysqli_query($link,$query);
$row555336 = mysqli_fetch_array($result4445);

$query = ("SELECT sum(`bet`) FROM `wheel-games` WHERE `id_users`='$idProfile'");
$result4445 = mysqli_query($link,$query);
$row555337 = mysqli_fetch_array($result4445);

$query = ("SELECT max(`win`) FROM `mines-game` WHERE `id_users`='$idProfile'");
$result44456 = mysqli_query($link,$query);
$row555331 = mysqli_fetch_array($result44456);


$fjd = $row555335[0] + $row555336[0] + $row555337[0];

if($fdf >= 500){
$totalgamesdost = '<div class="col" style="
    background: linear-gradient(0deg, rgb(28, 131, 136) 0%, rgb(40, 204, 158) 97%);
    border-radius: 5px;
    color: white;
    padding: 8px 10px 8px;
    margin: 5px;
    "><i class="fas fa-dice-two"></i><span style="margin-left: 5px">Сыграно более 500-та игр</span></div>';
}


if($prava == 1){
$fdj = '<div>Сумма депозитов: <strong style="color: green">'.$profiledeposit.'</strong> монет</div> 
<div>Сумма выводов: <strong style="color: red">'.$profilevivod.'</strong> монет</div> 
<div>Баланс: <strong style="color: green">'.$row5553["money"].'</strong> монет</div>
';
}

$vs = '<div class="container row"> 
<div class="col-3"> 
<div class="avatarka-profile-box" style="width: 90px;height: 90px;"><img style="width: 90px;height: 90px;border-radius: 5px;border: 2px solid #19344e;" src="'.$row5553["photo_vk"].'"></div> 
</div> 
<div class="col-9">'.$row5553["login"].' '.$admili.' (#'.$row5553['id'].') 

<div class="container" style="padding: 0"> 
<div>Дата регистрации: <strong>'.$row5553["data"].'</strong></div> 
<div>Профиль Вконтакте: <strong><a target="_blank" href="https://'.$vkprofileid.'">'.$vkprofileid.'</a></strong></div> 
<div>Всего игр: <strong>'.$fdf.'</strong></div> 
<div>Сумма ставок: <strong>'.round($fjd,2).'</strong></div> 
<div>Игр в минах (<strong>'.$row55531.'</strong>),в hilo (<strong>'.$row55533.'</strong>),в x50 (<strong>'.$row55532.'</strong>)</div> 
<div>Самый большой выигрыш: <strong>'.round($row555331[0],2).'</strong> монет</div> 
'.$fdj.'


</div> 
</div> 

</div>
<div class="container">
<div class="container" style="padding:0"><strong>Достижения:</strong></div>
'.$fdkr.'
'.$totalgamesdost.'
'.$fjfj.'
</div>
';

    $obj = array("result"=>"true","profile"=>"$vs"); 

}else{
    $obj = array("result"=>"true","profile"=>"Игрок не найден."); 

}
}
if(isset($_POST['openMines'])){

$idMines = $_POST['idMines'];

$query = ("SELECT * FROM `mines-game` WHERE `id`='$idMines' AND `onOff`='2'");
$result4445 = mysqli_query($link,$query);
$row5554 = mysqli_fetch_array($result4445);

if($row5554){


$clickOpen = $row5554['click'];								
$clickOpen = unserialize($clickOpen);
$idbetMines = $row5554['bet'];
$winminesOpen = $row5554['win'];
$loseBomb = $row5554['loseBombs'];
$loginMinesOpen = $row5554['login'];
$coefMinesOpen = $winminesOpen / $idbetMines;
$idUsersOpenMines = $row5554["id_users"];

$minesclickopen = [];

for($i=1;$i<26;$i++){
if(in_array($i,$clickOpen)){
array_push($minesclickopen,'<button class="mine win-mine openMines" data-number="'.$i.'" disabled="disabled"><i class="fas fa-gem" style="font-size: 25px;"></i></button>');
}else{
array_push($minesclickopen,'<button class="mine openMines" data-number="'.$i.'"></button>');
}		
}
}     $minesclickopen= json_encode($minesclickopen);

    $obj = array("result"=>"true","minesopen"=>"$minesclickopen","idbetMines"=>"$idbetMines","winminesOpen"=>"$winminesOpen","coefMinesOpen"=>"х$coefMinesOpen","loseBomb"=>"$loseBomb","loginMinesOpen"=>"$loginMinesOpen","idUsersOpen"=>"$idUsersOpenMines"); 

}
if(isset($_POST['openx50'])){
$idx50 = $_POST['idx50'];
$query = ("SELECT * FROM `wheel-games` WHERE `id`='$idx50'");
$result12 = mysqli_query($link,$query);
$row15 = mysqli_fetch_array($result12);



}
if(isset($_POST['openSunduc'])){
if($bilet >=5){
$query = mysqli_query($link, "UPDATE `users` SET `bilet` = '$bilet' - '5' WHERE `id` = '$id'");
$randomMoney = mt_rand(1,500);
$randomMoney = $randomMoney / 100;

$newBilet = $bilet - 5;

$query = mysqli_query($link, "UPDATE `users` SET `money` = '$money' + '$randomMoney' WHERE `id` = '$id'");
$money = $money + $randomMoney;

$obj = array("result"=>"true","mess"=>"Вы выиграли $randomMoney <i class='fas fa-coins'></i>","newBilet"=>"$newBilet","money"=>"$money"); 


}else{
$obj = array("result"=>"false","mess"=>"Недостаточно билетов"); 

}
}

if(isset($_POST['MERCHANT_ORDER_ID'])){
 function getIP() {
                        if(isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
                        return $_SERVER['REMOTE_ADDR'];
                        }
                        if (!in_array(getIP(), array('136.243.38.147', '136.243.38.149', '136.243.38.150', '136.243.38.151', '136.243.38.189', '136.243.38.108'))) {
                        die("hacking attempt!");
                        }
getIP();


$depositFK = $_POST['AMOUNT'];
$MERCHANT_ORDER_ID = $_POST['MERCHANT_ORDER_ID'];
$intid = $_POST['intid'];
$P_PHONE = $_POST['P_PHONE'];
$SIGN = $_POST['SIGN'];
$P_EMAIL = $_POST['P_EMAIL'];


$query = ("SELECT * FROM `users` WHERE `id` = '$MERCHANT_ORDER_ID'");
$result = mysqli_query($link,$query);
$row55514 = mysqli_fetch_array($result);

$iddep = $row55514['money'];
$depositdep = $row55514['deposit'];



$query = mysqli_query($link, "UPDATE `users` SET `money` = '$iddep' + '$depositFK',`deposit`= '$depositdep'+'$depositFK' WHERE `id` = '$MERCHANT_ORDER_ID'");

$data = date('Y-m-d TH:i:s');

$query = mysqli_query($link, "INSERT INTO `deposit` (`AMOUNT`, `intid`, `user_id`, `P_PHONE`, `SIGN`, `P_EMAIL`, `result`,`data`) VALUES ('$depositFK', '$intid', '$MERCHANT_ORDER_ID', '$P_PHONE', '$SIGN', '$P_EMAIL', 'Выполнено','$data')");

$query = ("SELECT * FROM `users` WHERE `id` = '$MERCHANT_ORDER_ID'");
$result = mysqli_query($link,$query);
$row5554 = mysqli_fetch_array($result);

$invitedref = $row5554['invited'];
$moneyref = $row5554['invited'];
$ref_money_ref = $row5554['ref_money'];

$priceref = $depositFK/10;

if($invitedref >= 1){

$query = mysqli_query($link, "UPDATE`users` SET `money'= '$priceref'+'$moneyref',`ref_money`='$ref_money_ref'+'$priceref' WHERE `id` = '$invitedref'");


}


}

echo json_encode($obj);


?>