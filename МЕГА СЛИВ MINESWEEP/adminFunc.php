<?
    
  /*
Привет моя сарделька :з
Если у тебя есть вопросы по скрипту или ты хочешь себе сайт с нуля на заказ, то ты в любое время можешь написать мне (https://vk.com/debl0w). Дешево!

(если чо, тут в рефке деньги не начисляются и в админке не работают некоторые функции (изменение банка/профита), а также статистика).
    
*/  
    
include_once("connect.php");
if(isset($_POST['moneyRedact'])){
    $moneyRedact = $_POST['moneyRedact'];
    $num = $_POST['num'];
    $users_id = $_POST['users_id'];

    $query = ("SELECT * FROM `users` WHERE `id`= '$users_id' or `vk_id`='$users_id'");
    $result = mysqli_query($link,$query);
    $userInfo = mysqli_fetch_array($result);
    $money = $userInfo['money'];

    if($num == 1){ // прибавление монет
    $query = mysqli_query($link, "UPDATE `users` SET `money` = '$money'+'$moneyRedact' WHERE `id`= '$users_id' or `vk_id`='$users_id'");
    $money = $money + $moneyRedact;
    }else{
        $query = mysqli_query($link, "UPDATE `users` SET `money` = '$money'-'$moneyRedact' WHERE `id`= '$users_id' or `vk_id`='$users_id'");
        $money = $money - $moneyRedact;
    }


$obj = array("good"=>"good","money"=>"$money");
}
if(isset($_POST['create_Promo'])){
    $namePromo = $_POST['namePromo'];
    $amountActPromo = $_POST['amountActPromo'];
    $summPromo = $_POST['summPromo'];

    $query = ("SELECT * FROM `promocode` WHERE `name`= '$namePromo'");
    $result1 = mysqli_query($link,$query);
    $promoInfo = mysqli_num_rows($result1);
    
    $qqq = 0;
    $qqq = serialize($qqq);
    if($promoInfo == null){
        $sss = [];
        $sss = serialize($sss);
        $query = mysqli_query($link, "INSERT INTO `promocode` (`name`, `ost_activ`, `activ`,`sum`,`users`) VALUES ('$namePromo', '$qqq', '$amountActPromo','$summPromo','$sss')");
        $obj = array("qqq"=>"qqq","mess"=>"Вы успешно создали промокод на $amountActPromo активаций по $summPromo монет!");
    }else{
        $obj = array("qqq"=>"qqq","mess"=>"Существует промокод с таким названием!");
    }
}
if(isset($_POST['delpromo'])){
    $id = $_POST['delpromo'];
    $query = mysqli_query($link, "DELETE FROM `promocode` WHERE `id` = '$id'");
    $obj = array("qqq"=>"qqq","mess"=>"Промокод успешно удален");
}
if(isset($_POST['setpay'])){
    $setpay = $_POST['setpay'];
    $idpay = $_POST['idpay'];

    if($setpay == 1){
        $query = mysqli_query($link, "DELETE FROM `payments` WHERE `id` = '$idpay'");
        $obj = array("setpay"=>"1");
    }
    if($setpay == 2){
        $query = mysqli_query($link, "UPDATE `payments` SET `result` = 'Выполнено' WHERE `id` = '$idpay'");
        $obj = array("setpay"=>"2");
    }
    if($setpay == 3){
        $query = mysqli_query($link, "UPDATE `payments` SET `result` = 'Отменено' WHERE `id` = '$idpay'");
        $obj = array("setpay"=>"3");
    }
    if($setpay == 4){
        $query = mysqli_query($link, "UPDATE `payments` SET `result` = 'Отменено' WHERE `users_id` = '$idpay'");
        $obj = array("setpay"=>"4");
    }
}
if(isset($_POST['redAdmin'])){
    $redAdmin = $_POST['redAdmin'];
    $num = $_POST['num'];
    if($num == 1){
    $query = mysqli_query($link, "UPDATE `admin` SET `group_vk` = '$redAdmin'");
    }
    if($num == 2){
    $query = mysqli_query($link, "UPDATE `admin` SET `bonus_reg` = '$redAdmin'");

    }
    if($num == 3){
    $query = mysqli_query($link, "UPDATE `admin` SET `referalka` = '$redAdmin'");
    }
    if($num == 4){
        $query = mysqli_query($link, "UPDATE `admin` SET `chat` = '$redAdmin'");
     }
    $obj = array("mess"=>"Изменено!");
}
if(isset($_POST['updateus'])){
    $updteus = $_POST['updateus'];
    $pole = $_POST['pole'];
    $users = $_POST['users'];

if($updteus == 1){
$query = mysqli_query($link, "UPDATE `users` SET `login` = '$pole' WHERE `id` = '$users'"); 
$obj = array("mess"=>"Вы успешно изменили логин");
}
if($updteus == 2){
    $query = mysqli_query($link, "UPDATE `users` SET `vk_id` = '$pole' WHERE `id` = '$users'"); 
    $obj = array("mess"=>"Вы успешно изменили id_vk");
    }
    if($updteus == 3){
        $query = mysqli_query($link, "UPDATE `users` SET `sid` = '$pole' WHERE `id` = '$users'"); 
        $obj = array("mess"=>"Вы успешно изменили сид пользователя");
        }
        if($updteus == 4){
            $query = mysqli_query($link, "UPDATE `users` SET `money` = '$pole' WHERE `id` = '$users'"); 
            $obj = array("mess"=>"Вы успешно изменили количество монет");
            }
            if($updteus == 5){
                $query = mysqli_query($link, "UPDATE `users` SET `deposit` = '$pole' WHERE `id` = '$users'"); 
                $obj = array("mess"=>"Вы успешно изменили сумму депозита");
                }
                if($updteus == 6){
                    $query = mysqli_query($link, "UPDATE `users` SET `vivod` = '$pole' WHERE `id` = '$users'"); 
                    $obj = array("mess"=>"Вы успешно изменили сумма выводов");
                    }
                    if($updteus == 7){
                        $query = mysqli_query($link, "UPDATE `users` SET `photo_vk` = '$pole' WHERE `id` = '$users'"); 
                        $obj = array("mess"=>"Вы успешно изменили фотку");
                        }
                        if($updteus == 8){
                            $query = mysqli_query($link, "UPDATE `users` SET `prava` = '$pole' WHERE `id` = '$users'"); 
                            $obj = array("mess"=>"Вы успешно изменили права");
                            }
                            if($updteus == 9){
                                $query = mysqli_query($link, "UPDATE `users` SET `ban` = '$pole' WHERE `id` = '$users'"); 
                                $obj = array("mess"=>"Вы успешно изменили бан");
                                }
                                if($updteus == 10){
                                    $query = mysqli_query($link, "UPDATE `users` SET `referalov` = '$pole' WHERE `id` = '$users'"); 
                                    $obj = array("mess"=>"Вы успешно изменили количество рефералов");
                                    }
                                    if($updteus == 11){
                                        $query = mysqli_query($link, "UPDATE `users` SET `chat_ban` = '$pole' WHERE `id` = '$users'"); 
                                        $obj = array("mess"=>"Вы успешно изменили чат-бан");
                                        }
                                        if($updteus == 12){
                                            $query = mysqli_query($link, "UPDATE `users` SET `ref_money` = '$pole' WHERE `id` = '$users'"); 
                                            $obj = array("mess"=>"Вы успешно изменили заработок с рефералов");
                                            }
                                    

}
echo json_encode($obj);

?>