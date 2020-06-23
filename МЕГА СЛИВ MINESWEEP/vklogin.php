<?php
/*
Привет моя сарделька :з
Если у тебя есть вопросы по скрипту или ты хочешь себе сайт с нуля на заказ, то ты в любое время можешь написать мне (https://vk.com/debl0w). Дешево!

(если чо, тут в рефке деньги не начисляются и в админке не работают некоторые функции (изменение банка/профита), а также статистика).
    
*/
include_once("connect.php");

$client_id = "$client_id"; // ID приложения
$client_secret = "$client_secret"; // Защищённый ключ
$redirect_uri = "$domen/vklogin.php"; // Адрес сайта
$url = 'http://oauth.vk.com/authorize';

if (isset($_GET['code'])) {
    $result = true;
    $params = [
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'code' => $_GET['code'],
        'redirect_uri' => $redirect_uri
    ];

    $token = json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);

    if (isset($token['access_token'])) {
        $params = [
            'uids' => $token['user_id'],
            'fields' => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big',
            'access_token' => $token['access_token'],
            'v' => '5.101'];

        $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);
        if (isset($userInfo['response'][0]['id'])) {
            $userInfo = $userInfo['response'][0];
            $result = true;
        }
    }

function generateSid($length = 25){
$chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
$numChars = strlen($chars);
$string = '';
for ($i = 0; $i < $length; $i++) {
$string .= substr($chars, rand(1, $numChars) - 1, 1);
}
return $string;
}
$sid = generateSid(25);

    $vk_id = $userInfo['id'];
    $name = $userInfo['first_name'];
    $last_name = $userInfo['last_name'];
    $login = "$name $last_name";
    $photo = $userInfo['photo_big'];

  $query = ("SELECT * FROM `users` WHERE `vk_id` = '$vk_id'");
  $result1 = mysqli_query($link,$query);
	if(mysqli_num_rows($result1) > 0)
	{
$query = ("UPDATE `users` SET `sid` = '$sid' WHERE `vk_id` = '$vk_id'");
mysqli_query($link,$query);
	//юзер существует (обновление хеша, аватарки, имя)
  setcookie('sid', $sid, time()+3600*60, '/');
  header("Location: /");
	}
else{
  //юзера не существует
     $ip = $_SERVER['REMOTE_ADDR']; // получаем айпи юзера
     $today2 = date("d.m.y");
     $today3 = date("H:i:s");
     $data = "$today2 $today3";
     $query = ("SELECT * FROM `admin`");
     $resultad = mysqli_query($link,$query);
     $admin = mysqli_fetch_array($resultad);
     $bonus_reg = $admin['bonus_reg'];
     if($_COOKIE['ref'] != null){
     if($_COOKIE['ref'] >= 1 && $_COOKIE['ref'] < 250000000){
     $invited = $_COOKIE['ref'];
     
     $query = ("SELECT * FROM `users` WHERE `id` = '$invited'");
     $result225 = mysqli_query($link,$query);
     $row22 = mysqli_fetch_array($result225);
     
     $referalov = $row22['referalov'];
     if($row22){
     $query = mysqli_query($link,"UPDATE `users` SET `referalov` = '$referalov' + '1' WHERE `id` = '$invited'");
     }

     }
     }
     $query = ("INSERT INTO `users` (`sid`,`vk_id`, `login`, `money`, `photo_vk`,`ip`,`data`,`hilo`,`invited`) VALUES ('$sid','$vk_id', '$login', '$bonus_reg', '$photo','$ip','$data','50','$invited')");
     mysqli_query($link,$query);
     setcookie('sid', $sid, time()+3600*60, '/');

	  header("Location: /");
    }

}
?>
