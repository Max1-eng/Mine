<?
/*
Привет моя сарделька :з
Если у тебя есть вопросы по скрипту или ты хочешь себе сайт с нуля на заказ, то ты в любое время можешь написать мне (https://vk.com/debl0w). Дешево!

(если чо, тут в рефке деньги не начисляются и в админке не работают некоторые функции (изменение банка/профита), а также статистика).
    
*/    
    
$link = mysqli_connect("localhost", "ИМЯ ОТ БД", "ПАРОЛЬ", "ТАБЛИЦА")
    or die("Ошибка " . mysqli_error($link));

    $domen = $_SERVER['SERVER_NAME']; // получаем домен, НЕ ТРОГАТЬ!
    $nameSite = "Netron"; // название сайта
    $client_id = '7284416'; // ID приложения
    $client_secret = 'hqCAX2uZUbQx0qlASEQq'; // Защищённый ключ
?>