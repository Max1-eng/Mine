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


$query = ("SELECT * FROM `users` WHERE `sid` = '$sid'");
$result = mysqli_query($link,$query);
$userInfo = mysqli_fetch_array($result);

$id = $userInfo['id'];
$login = $userInfo['login'];
$money = $userInfo['money'];
$prava = $userInfo['prava'];
$photo = $userInfo['photo_vk'];
$hilo = $userInfo['hilo'];
$ban = $userInfo['ban'];
$referalov = $userInfo['referalov'];
$ref_money = $userInfo['ref_money'];
$bilet = $userInfo['bilet'];

if($ban == 1){ //пользователь не авторизован
    header("Location: /ban.php");
}
$ref = $_GET['ref'];
if($sid == null){
if($ref == null){
header("Location: /auth.php");
}else{
header("Location: /auth.php?ref=$ref");
setcookie("ref", $ref, time()+36000000000000000000000000000000000, '/');
}
}
if(isset($_POST['pay'])){
$merchant_id = '181645';
$secret_word = 'm4r6b29j';
$order_id = $id;
$order_amount = $_POST['oa'];
$sign = md5($merchant_id.':'.$order_amount.':'.$secret_word.':'.$order_id);



header("location: http://www.free-kassa.ru/merchant/cash.php?m=$merchant_id&oa=$order_amount&s=$sign&o=$id");
}
?>

<html lang="ru"><head></head><body class="" style=""><div id="vk_api_transport" style="position: absolute; top: -10000px;"></div><doctype html="">
	

	
		<meta charset="UTF-8">
		<title><? echo "$nameSite"; ?></title>
		<meta name="keywords" content="майнсвип маинсвип mainswep minesweep минисвип майнсвэп minesweepru майнсвипру рулетка на деньги легкий заработок изи кеш драгон моней нвути nvuti dragonmoney мины плинко джекпот на деньги дайс2х изи кеш эпик моней plya2x rublix">
		<meta name="description" content="Сервис, где твой выигрыш зависит только от тебя! Забирай деньги в любой момент и выводи их на любую платёжную систему без комиссии!">
		<meta name="referrer" content="never">
		<meta name="referrer" content="no-referrer">
        <meta name="yandex-verification" content="b4fbb2141b72cb62">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		<link rel="stylesheet" href="/css/main.css">
        <link rel="stylesheet" href="/css/loader.css">
        <link rel="stylesheet" href="/css/toastr.css">
		<link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
		<script type="text/javascript" async="" src="https://www.gstatic.com/recaptcha/releases/mhgGrlTs_PbFQOW4ejlxlxZn/recaptcha__ru.js"></script><script async="" src="https://mc.yandex.ru/metrika/tag.js"></script>
		<script src="https://vk.com/js/api/openapi.js?160" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>




	


	 <div id="bg2">
	<script>
   <?
   if($prava == 1 || $prava == 2){
	   echo '
	   function delMess(num){
       $.ajax({
		   url: "engine.php",
		   type: "POST",
		   data: {
			del:num, 
		   },
		   dataType: "html",
		   success: function(response){
			obj = $.parseJSON(response);
			nortification("Сообщение удалено","good")	
		   }	   
	
		})};
		function blockUsers(num){
			$.ajax({
				url: "engine.php",
				type: "POST",
				data: {
				chat_ban: num, 
				},
				dataType: "html",
				success: function(response){
				 obj = $.parseJSON(response);
				 nortification("Пользователь заблокирован","good")	
				}	   
		 
			 })};
			 function noblockUsers(num){
				$.ajax({
					url: "engine.php",
					type: "POST",
					data: {
					no_chat_ban: num, 
					},
					dataType: "html",
					success: function(response){
					 obj = $.parseJSON(response);
					 nortification("Пользователь разблокирован","good")	
					}	   
			 
				 })};      
	   ';
   } 
   ?>
	</script>
	<div class="loaderArea" style="display: none;">
		<div id="loader"></div>
	</div>
	<!-- chat-modal -->
	<div class="modal fade" id="chatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-comments"></i> <span class="modal-title-tex">Чат игроков</span></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
				</div>
				<div class="modal-body">
					<div class="chat-up text-uppercase">Чат игроков</div>
					<div class="chat-main"> </div>
				</div>
				<div class="chat-down" id="chat-down-2">
					<input class="chat-input" placeholder="Введите текст..." id="inputChat2">
					<button class="chat-send" onclick="addChat(2);"> <i class="fab fa-telegram"></i> </button>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="open-profile-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-alt"></i> <span class="modal-title-tex">Профиль игрока</span></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
				</div>
				<div class="modal-body">
	           
			      <span id="spanProfile"></span>
			      
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade show" id="podarok-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-modal="true" style="display: none;">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-gift"></i> <span class="modal-title-tex">Подарок</span></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
				</div>
				<div class="modal-body">
	           
			      <div class="container" style="
">
				  <div class="col-12">Количество билетов: <span class="bilet" style="
    color: #fb00ff;
    font-weight: 600;
"><? echo $bilet;?></span></div>
				  <div class="col-6" style="
    width: 100%;
    margin: 0 auto;
">
				  <div class="container" style="
    height: 150px;
    width: 100%;
    background-image: url(&quot;sunduk.png&quot;);
    background-size: 180px;
">
				  
				  </div>
    <button class="btn btn-primary" onclick="openSunduc()" style="">Открыть сундук за 5 билетов</button>
				  </div>Билеты начисляются за ставки в каждой игре по формуле: ставка/100 = количество билетов</div>
			      
				</div>
			</div>
		</div>
	</div>


<div class="modal fade" id="open-mines-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-comments"></i> <span class="modal-title-tex">Проверка игры</span></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
				</div>
				<div class="modal-body">
	           
			      <span id="spanMines">
				  <div class="container">Игрок: <span id="openMinesLogin" onclick="openProfile()"></span></div>
				  <div class="container row">
				  <div class="col-4">

				  <div class="col-6" style="
    text-align: center;
    margin: 0 auto;
    padding: 0;
">Ставка</div>
				  <div class="col-6" style="
    margin: 0 auto;    text-align: center; display: flex;
"><span id="idbetMines">1</span> <i class="fas fa-coins" style="margin-left:3px;margin-top:3px"></i></div>
				  </div>
				  <div class="col-4">
				  <div class="col-6" style="
    text-align: center;
    margin: 0 auto;
    padding: 0;
">Коэффициент</div>
				  <div class="col" style="
    margin: 0 auto;      text-align: center;
"><span id="coefMinesOpen">1</span></div>
				  </div>
				  <div class="col-4">
				  <div class="col" style="
    text-align: center;
    margin: 0 auto;
    padding: 0;
">Выигрыш</div>
				  <div class="col" style="
    margin: 0 auto;    text-align: center;
"><span id="winminesOpen">1</span> <i class="fas fa-coins"></i></div>
				  </div>
				  </div>

				  </div>
				  <div class="minefield openMines"> 
<button class="mine" data-number="1" disabled="">1</button> 
<button class="mine" data-number="2" disabled="">2</button> 
<button class="mine" data-number="3" disabled="">3</button> 
<button class="mine" data-number="4" disabled="">4</button> 
<button class="mine" data-number="5" disabled="">5</button> 
<button class="mine" data-number="6" disabled="">6</button> 
<button class="mine" data-number="7" disabled="">7</button> 
<button class="mine" data-number="8" disabled="">8</button> 
<button class="mine" data-number="9" disabled="">9</button> 
<button class="mine" data-number="10" disabled="">10</button> 
<button class="mine" data-number="11" disabled="">11</button> 
<button class="mine" data-number="12" disabled="">12</button> 
<button class="mine" data-number="13" disabled="">13</button> 
<button class="mine" data-number="14" disabled="">14</button> 
<button class="mine" data-number="15" disabled="">15</button> 
<button class="mine" data-number="16" disabled="">16</button> 
<button class="mine" data-number="17" disabled="">17</button> 
<button class="mine" data-number="18" disabled="">18</button> 
<button class="mine" data-number="19" disabled="">19</button> 
<button class="mine" data-number="20" disabled="">20</button> 
<button class="mine" data-number="21" disabled="">21</button> 
<button class="mine" data-number="22" disabled="">22</button> 
<button class="mine" data-number="23" disabled="">23</button> 
<button class="mine" data-number="24" disabled="">24</button> 
<button class="mine" data-number="25" disabled="">25</button>	
</div>
				  </span>

			      
				</div>
			</div>
		</div>
	</div>
</div>

<!-- rools-modal -->
<div class="modal fade" id="rulemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index:2000">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-list-ol"></i> <span class="modal-title-tex">Пользовательское соглашение</span></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
			</div>
			<div class="modal-body"> 1. ОБЩИЕ ПОЛОЖЕНИЯ. ТЕРМИНЫ.
				<hr>
				<p>1.1. Настоящее соглашение – официальный договор на пользование услугами сервиса <?echo "$domen"; ?>. Ниже приведены основные условия пользования услугами сервиса. Пожалуйста, прежде чем принять участие в проекте внимательно изучите правила.</p>
				<p>1.2. Услугами сервиса могут пользоваться исключительно лица, достигшие совершеннолетия (18 лет) и старше.</p>
				<p>1.3. On-line проект под названием <?echo "$domen"; ?> представляет собой систему добровольных пожертвований, принадлежит его организатору и находится в сети Интернет непосредственно по адресу – <?echo "$domen"; ?>.</p>
				<p>1.4. Участие пользователей в проекте является исключительно добровольным.</p>
				<hr> 2. УЧЁТНАЯ ЗАПИСЬ УЧАСТНИКА ПРОЕКТА (ПОЛЬЗОВАТЕЛЯ СИСТЕМЫ).
				<hr>
				<p>2.1. Способом непосредственной регистрации учетной записи является авторизация участников проекта с помощью логина и пароля.</p>
				<p>2.3. Кроме того, участник проекта несет непосредственную ответственность за любые предпринятые им действия в рамках проекта.</p>
				<p>2.4. Участник проекта обязуется своевременно сообщить о противозаконном доступе к его учетной записи, противозаконном использовании его учетной записи, по средствам технической поддержки сервиса.</p>
				<p>2.5. Сервис, а также его правообладатель не несут ответственность за любые предпринятые действия участником проекта касательно третьих лиц.</p>
				<p>2.6. При использовании несколькими участниками проекта одно и тоже устройство или выход в интернет для игры, необходимо согласование с администрацией.</p>
				<hr> 3. КОНФИДЕНЦИАЛЬНОСТЬ
				<hr>
				<p>3.1. В рамках проекта гарантируется абсолютная конфиденциальность информации, предоставленной участником проекта сервису.</p>
				<p>3.2. В рамках проекта гарантируется шифрование личных паролей участников.</p>
				<p>3.3 Личные данные участника проекта могут быть представлены третьим лицам исключительно в случаях непосредственного нарушения действующих законов РФ, в случаях оскорбительного поведения, клеветы в отношении третьих лиц.</p>
				<hr> 4. УЧАСТНИК ПРОЕКТА (ПОЛЬЗОВАТЕЛЬ СИСТЕМЫ).
				<hr>
				<p>4.1. В случае непосредственного нарушения участником проекта изложенных условий и правил настоящего соглашения, а также действующих законов РФ, учетная запись может быть заблокирована.</p>
				<p>4.2. Недопустимы попытки противозаконного доступа, нанесения вреда работе системы сервиса.</p>
				<p>4.3. Недопустима любая агрессия, сообщения, запрограммированные на причинение ущерба сервису (вирусы), информация, способная повлечь за собой несущественный, или существенный вред третьим лицам.</p>
				<hr> 5. КАТЕГОРИЧЕСКИ ЗАПРЕЩЕНО
				<hr>
				<p>5.1. Размещение информации, содержащей поддельные (неправдивые) данные.</p>
				<p>5.2. Проводить попыток взлома сайта и использовать возможные ошибки в скриптах. Нарушители будут немедленно забанены и удалены.</p>
				<p>5.3. Регистрация более чем одной учетной записи индивидуального участника проекта.</p>
				<p>5.4. Передача информации иным, третьим лицам, содержащей данные для доступа к личной учетной записи участника проекта.</p>
				<p>5.5. Выплата на одинаковые реквизиты с разных аккаунтов.</p>
				<p>5.6. Махинации с реферальной системой.</p>
				<hr> 6. Выплаты.
				<hr>
				<p>6.1 Выплаты производятся в ручном режиме.</p>
				<p>6.2 Если сумма последних пополнений равна сумме вывода, комиссию оплачивает пользователь.</p>
				<p>6.3 При выводе бонусных рублей может быть отказано без всяких причин.</p>
				<p>6.4 Администрация сайта может потребовать скан или фото паспорта для верификации.</p>
				<p>6.5 При выводе средств, необходимо сыграть хотя бы 15 игр на сумму более 5% последнего пополения счета.</p>
				<p>6.6 При отказе предоставить дополнительную информацию или верификации кошелька аккаунт может быть заблокирован.</p>
				<p>6.7 При нарушении правил баланс аккаунта может быть заморожен.</p>
				<hr> 7. ПРИНЯТИЕ ПОЛЬЗОВАТЕЛЬСКОГО СОГЛАШЕНИЯ.
				<hr>
				<p>7.1. Непосредственная регистрация в системе данного проекта предполагает полное принятие участником проекта условий и правил настоящего пользовательского соглашения.</p>
				<p>7.2. При нарушении правил учетная запись может быть заблокирована вместе с балансом.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>
<!-- Ref modal -->

<!-- giftModal -->
<div class="modal fade" id="giftModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-gift"></i> <span class="modal-title-tex">Бонусы</span></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
			</div>
			<div class="modal-body">
				<div class="auth-box">
				<div class="alert alert-primary" role="alert"><a href="https://vk.com/netron_fun" target="_blank" style="color: #004085 !important">Наша группа ВКонтакте (кликабельно)</a>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
				</div>
					 <i class="fas fa-gift"></i>
						<input type="text" placeholder="Введите промокод" class="auth-input form-control" id="input-promo">
						<button type="button" class="btn btn-success auth-btn" onclick="promocode();">Активировать</button>
						<hr>
						<div style="margin-top:20px;">
						<span style="color: rgba(0,0,0,0.7);font-weight: 600;">ЗАРАБАТЫВАЙ ДО 10% С ПОПОЛНЕНИЙ РЕФЕРАЛОВ!</span></br>
<span>Ваша реферальная ссылка:</span>
							<input type="text" value="http://<?echo "$domen?ref=$id"; ?>" disabled="disabled" class="auth-input form-control" id="input-promo-create-number">
							</div>
				
							<table class="table table-hover table-my-refs">
								<thead>
									<tr>
										<th scope="col">Рефералы</th>
										<th scope="col">Заработано</th>
									</tr>
								</thead>
								<tbody class="my-refs">
									<tr><td><span></span><?echo $referalov; ?> <span class="my-refs-count"> рефералов</span></td>
									<td><span class="my-m-refs"></span> <span><?echo $ref_money; ?> монет</span></td>
								</tr></tbody>
							</table>
						  <hr>
						  <!--
						  <div class="a-auth" data-toggle="collapse" href="#promo-tasks" role="button" aria-expanded="false" aria-controls="collapseExample"><span>Задания...</span></div>
					
				</div>
				
				<div id="promo-tasks" style="margin-top:10px;">
					<div class="promo-task">
						<div class="promo-task-code"> </div>
					</div>
					<div class="promo-task">
						<div> </div>
						<div class="collapse" id="my-auth-vk">
							<hr>
							
							<form>
								<div class="d-flex justify-content-around"> <a class="btn btn-outline-primary promo-task-btn" href="https://oauth.vk.com/authorize?client_id=6966644&amp;display=page&amp;redirect_uri=http://minesweep.ru/inc/engine.php/?ref=1001&amp;response_type=code&amp;v=5.92">Привязать</a>
									<button type="button" class="btn btn-outline-success promo-task-btn" onclick="vkauthcheck();">Проверить</button>
								</div>
								
									<hr> </form></div>
					</div>
					
					
					<div class="promo-task">
						<div class="promo-task-group">
							<div class="d-flex justify-content-between" data-toggle="collapse" href="#my-group-vk" role="button" aria-expanded="false" aria-controls="collapseExample">
								<div><i class="far fa-check-circle"></i> <span>Вступи в группу Вконтакте и получи 3 рубля</span></div>
								<div><span><a href="#">Выполнить</a></span></div>
							</div>
						</div>
						<div class="collapse show" id="my-group-vk">
							<hr>
							<form>
								<div class="d-flex justify-content-around"> <a href="https://vk.com/minesweep" class="btn btn-outline-primary promo-task-btn" target="_blank">Вступить</a>
									<button type="button" class="btn btn-outline-success promo-task-btn" onclick="vkgroupcheck();">Проверить</button>
								</div>
								<form>
									<hr> </div>
					</div>
					-->
					
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>
<!-- refillModal -->
<div class="modal fade" id="refillModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-coins"></i> <span class="modal-title-tex">Пополнение</span></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
			</div>
			<div class="modal-body">
				<div class="auth-box">
                                                <form method="POST">
						<input type="text" placeholder="Сумма пополнения" name="oa" class="auth-input form-control" id="d-amount">
 						<input type="submit" name="pay" class="btn btn-success auth-btn" value="Пополнить"></input></form>
					
				</div>
				<div style="margin-top:15px;">
					<table class="table table-hover table-my-withdraws">
						<thead>
							<tr>
								<th scope="col">Сумма пополнения</th>
								<th scope="col">Дата</th>
								<th scope="col">Статус</th>
							</tr>
						</thead>
						<tbody class="my-withdraws">
						<?
                 $query = ("SELECT * FROM `deposit` WHERE `user_id` = '$id' ORDER BY `id` DESC LIMIT 5");
				 $result22211 = mysqli_query($link,$query);
				 while(($deposit = mysqli_fetch_array($result22211))){
					
					$data = $deposit['data'];
					$amount = $deposit['AMOUNT'];
					
					$vs.="<tr>
					<td>$amount <i class='fas fa-coins'></i></td>
					 <td>$data</td>
					 <td>Успешно</td>
					 </tr>";
				 }
				 echo $vs;
						?>
						
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>
<!-- withdrawModal Modal -->
<div class="modal fade" id="withdrawModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-coins"></i> <span class="modal-title-tex">Вывод</span></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
			</div>
			<div class="modal-body">
			<?
			    $query = ("SELECT * FROM `admin`");
				$resultad = mysqli_query($link,$query);
				$admin = mysqli_fetch_array($resultad);
				$group_vk = $admin['group_vk'];
			?>
				<div class="alert alert-primary" role="alert"> Присылайте скрины выплат в <a href="<? echo $group_vk;?>" target="_blank">группу</a> и получайте бонусы!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
				</div>
				<div class="auth-box">
					<form> <i class="fas fa-ruble-sign"></i>
						<input type="text" placeholder="Сумма вывода" class="auth-input form-control" id="w-amount"> <i class="fas fa-wallet"></i>
						<select class="auth-input form-control" style="padding-left:24px;" id="w-system">
							<optgroup label="Платёжные системы">
								<option>Qiwi</option>
								<option>Payeer</option>
								<option>WebMoney</option>
							</optgroup>
							<optgroup label="Мобильная связь">
								<option>Билайн</option>
								<option>Мегафон</option>
								<option>Теле2</option>
								<option>МТС</option>
							</optgroup>
							<optgroup label="Банковские карты">
								<option>VISA (от 1100р)</option>
								<option>MASTERCARD (от 1100р)</option>
							</optgroup>
						</select> <i class="fas fa-credit-card"></i>
						<input type="text" placeholder="Номер кошелька" class="auth-input form-control" id="w-number-wallet">
						<button type="button" class="btn btn-success auth-btn" onclick="withdraw();">Вывести</button>
						<div style="font-size:13px;color:rgba(0,0,0,0.6);">* Внимательно проверьте введённые данные</div>
					</form>
				</div>
				<div>
					<table class="table table-hover table-my-withdraws">
						<thead>
							<tr>
								<th scope="col">Сумма вывода</th>
								<th scope="col">Дата вывода</th>
								<th scope="col">Статус</th>
							</tr>
						</thead>
						<tbody class="my-withdraws">
						<?
                 $query = ("SELECT * FROM `payments` WHERE `users_id` = '$id' ORDER BY `id` DESC LIMIT 5");
				 $result222 = mysqli_query($link,$query);
				 while(($payments = mysqli_fetch_array($result222))){
					
					$sum_pay = $payments['sum'];
					$data_pay = $payments['data'];
					$result_pay = $payments['result'];
					$pp.="<tr>
					<td>$sum_pay <i class='fas fa-coins'></i></td>
					 <td>$data_pay</td>
					 <td>$result_pay</td>
					 </tr>";
				 }
				 echo $pp;
						?>
						
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>
<!-- login Modal -->

		<header>
			<div class="navbar navbar-expand-lg navbar-light ">
				<div class="container"> 
					<a class="navbar-brand" href="/"><? echo $nameSite;?> <span class="pulse" title="Игроков онлайн"></span><span class="on-pulse"><span></span></span></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
					<div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
						<ul class="nav navbar-nav">
						<?if($prava == 1){echo '<li class="nav-item nav-item-1"><a class="nav-link" href="admin.php">Панель управления</a></li>';} ?>
							<li class="nav-item nav-item-1"><a class="nav-link" href="#" data-toggle="modal" data-target="#giftModal">Бонусы</a></li>
							<li class="nav-item nav-item-2"><a class="nav-link" href="#" data-toggle="modal" data-target="#refillModal">Пополнить</a></li>
							<li class="nav-item nav-item-3" style="display: inline-block;"><a class="nav-link" href="#" data-toggle="modal" data-target="#withdrawModal">Вывести</a></li>
							
							<li class="nav-item"> <a class="nav-link nav-link-4" href="#" onclick="menuchange();" data-menu="main"><?php echo $login; ?> <i class="fas fa-caret-down icon-header" style="margin-top: -2px; font-size: 10px; transform: rotate(-90deg);"></i></a> </li>
							
						</ul>
					</div>
				</div>
			</div>
		</header>
		<main>
			
			
			
		<div class="all-game">
				<div class="all-game-box">
					<div class="game-box game-open game-arrow" onclick="gamemenuchange();" data-menu_game="open"> <a><i class="fas fa-chevron-right game-menu-arrow"></i></a> </div>
					<div class="game-box bomb-game game-none" onclick="gameChange('bomb')" data-select_game="bomb"> <a><i class="fas fa-bomb"></i></a> </div>
					<div class="game-box dice-game game-none" onclick="gameChange('dice')" data-select_game="dice"> <a><i class="fas fa-dice"></i></a> </div>
					<div class="game-box dice-game game-none" onclick="gameChange('x50')" data-select_game="x50"> <a><i class="fas fa-circle-notch" style="color: green"></i></a> </div>
				<? if($prava == 1){$hilo21 ='gameChange("hilo")'; echo "<div class='game-box dice-game game-none' onclick='$hilo21' data-select_game='hilo'> <a><i class='fas fa-circle-notch' style='color: green'></i></a> </div>";} ?>
					<div class="game-box game-none"> <a href="#" class="dep" onclick="openProfile(<?echo $id;?>)" style="color: #ef6161;"><i class="fas fa-user-alt"></i></a> </div>
					<div class="game-box game-none" data-toggle="modal" data-target="#podarok-modal"> <a href="#" style="color: #293677;"><i class="fas fa-gift"></i></a> </div>
					<div class="game-box game-none dep"> <a href="#" class="dep" data-toggle="modal" data-target="#refillModal"><i class="fas fa-plus"></i></a> </div>
					<div class="game-box  game-none with"> <a href="#" class="with" data-toggle="modal" data-target="#withdrawModal"><i class="fas fa-minus"></i></a> </div>
					<div class="game-box game-none chachat"> <a class="chachat" href="#" data-toggle="modal" data-target="#chatModal"><i class="fas fa-comments"></i></a> </div>
				</div>
			</div>
			<!--<div class="container"></div>-->





<div class="container">
				<div class="game" id="bombgame">
					<div class="main-content">
						<div class="left-side" style="padding-top: 0;">
							<div class="minefield">
								<?php
								$query = ("SELECT * FROM `mines-game` WHERE `id_users` = '$id' AND `onOff` = '1' ORDER BY `id` DESC LIMIT 1");
								$result = mysqli_query($link,$query);
								$minesgame = mysqli_fetch_array($result);
								if($minesgame != false){
									$mines = $minesgame['mines'];
									$click = $minesgame['click'];
									$click = unserialize($click);
									$winMines = $minesgame['win'];
									$countClick = count($click);
									if($click != null){
									$winMines1 = $winMines/$countClick;
									}
									
                                    for($i=1;$i<26;$i++){
										if(in_array($i,$click)){
										echo '<button class="mine win-mine" data-number="'.$i.'" disabled="disabled">+'.$winMines1.'</button>';
										}else{
										echo '<button class="mine" data-number="'.$i.'"></button>';
										}		
									}
								
								}else{								
                          echo '<button class="mine" data-number="1" disabled="">1</button>
								<button class="mine" data-number="2" disabled="">2</button>
								<button class="mine" data-number="3" disabled="">3</button>
								<button class="mine" data-number="4" disabled="">4</button>
								<button class="mine" data-number="5" disabled="">5</button>
								<button class="mine" data-number="6" disabled="">6</button>
								<button class="mine" data-number="7" disabled="">7</button>
								<button class="mine" data-number="8" disabled="">8</button>
								<button class="mine" data-number="9" disabled="">9</button>
								<button class="mine" data-number="10" disabled="">10</button>
								<button class="mine" data-number="11" disabled="">11</button>
								<button class="mine" data-number="12" disabled="">12</button>
								<button class="mine" data-number="13" disabled="">13</button>
								<button class="mine" data-number="14" disabled="">14</button>
								<button class="mine" data-number="15" disabled="">15</button>
								<button class="mine" data-number="16" disabled="">16</button>
								<button class="mine" data-number="17" disabled="">17</button>
								<button class="mine" data-number="18" disabled="">18</button>
								<button class="mine" data-number="19" disabled="">19</button>
								<button class="mine" data-number="20" disabled="">20</button>
								<button class="mine" data-number="21" disabled="">21</button>
								<button class="mine" data-number="22" disabled="">22</button>
								<button class="mine" data-number="23" disabled="">23</button>
								<button class="mine" data-number="24" disabled="">24</button>
								<button class="mine" data-number="25" disabled="">25</button>';	
								}
								?>	
                                </div>
                                </div>			
			
						<div class="right-side">
							<div class="right-side-row-1">
								<div class="volume" title="Включить/Выключить звук">
									<button class="volume-btn btn-sett" onclick="volumechange()" data-vol="on"><i class="fas fa-volume-up"></i></button>
								</div>
								<div class="notif" title="Включить/Выключить уведомления">
									<button class="notif-btn btn-sett" onclick="notifchange()" data-notif="on"><i class="fas fa-bell"></i></button>
								</div>
								<div class="balance box">
									<div class="title text-uppercase"> Баланс </div>
									<div class="content">
										<div class="balance-content number">
											<div><span class="balanceBox money"><? echo $money; ?></span><i style="margin-left:5px;" class="fas fa-coins"></i></div>
										</div>
									</div>
								</div>
								<div class="history box">
									<div class="title text-uppercase"> История игр </div>
									<div class="content">
										<div class="history-content" id="bombHistoryContent">
                        <?php
                        
                        $query = ("SELECT * FROM `mines-game` WHERE `onOff`= '2' AND `id_users` = '$id' ORDER BY `id` DESC LIMIT 6");
                        $result1 = mysqli_query($link,$query);
                        while(($minesHistory = mysqli_fetch_array($result1))){
                        
                        $betHistory = $minesHistory['bet'];
                        $bombsHistory = $minesHistory['num_mines'];
                        $resultHistory = $minesHistory['win'];
					  
						if($resultHistory == 0){
							$resultgame = 'lose';
							$resultHistory = $betHistory;
						}else{
							$resultgame = 'win';
						}

                        $h.="
                        <span class='number result-".$resultgame." result'><span class='myBetsBox'>".$resultHistory."</span> <i class='fas fa-coins'></i></span>";                            
						}            
						echo $h;
        
                        ?>
                                    </div>
									</div>
								</div>
							</div>
							<div class="right-side-row-2">
								<div class="amount-bet box">
									<div class="title text-uppercase">Сумма ставки</div>
									<div class="content amount-bet-content">
										<div class="amout-bet-content-inp"> <i class="fas fa-coins"></i>
											<input class="amout-bet-input number" type="text" value="10" id="amountBetInputBomb" onkeyup="var coef = $('#nextRewardBoxBomb').val(); var sum = $('#amountBetInputBomb').val();var otvet = sum*coef; $('#winSummaBoxBomb').text(otvet)"> </div>
										<div class="amount-bet-btns">
											<button type="button" class="btn  btn-outline-dark amout-bet-btn" data-btnamountbet="clean" onclick="calculate('clean')">C</button>
											<button type="button" class="btn  btn-outline-dark amout-bet-btn" data-btnamountbet="min" onclick="calculate('min')">Min</button>
											<button type="button" class="btn  btn-outline-dark amout-bet-btn" data-btnamountbet="max" onclick="calculate('max')">Max</button>
											<button type="button" class="btn  btn-outline-dark amout-bet-btn" data-btnamountbet="x2" onclick="calculate('x2')">x2</button>
											<button type="button" class="btn  btn-outline-dark amout-bet-btn" data-btnamountbet="1/2" onclick="calculate('1/2')">1/2</button>
											<button type="button" class="btn  btn-outline-dark amout-bet-btn" data-btnamountbet="+10" onclick="calculate('+10')">+10</button>
											<button type="button" class="btn  btn-outline-dark amout-bet-btn" data-btnamountbet="+100" onclick="calculate('+100')">+100</button>
											<button type="button" class="btn  btn-outline-dark amout-bet-btn" data-btnamountbet="-10" onclick="calculate('-10')">-10</button>
										</div>
									</div>
								</div>
							</div>
							<div class="right-side-row-3">
								<div class="box">
									<div class="title text-uppercase"> Число мин </div>
									<div class="content">
										<div class="amout-bomb-btns">
											<button type="button" class="btn btn-outline-primary circle mineSelected" data-mineamount="3">x3</button>
											<button type="button" class="btn btn-outline-success circle" data-mineamount="5">x5</button>
											<button type="button" class="btn btn-outline-warning circle" data-mineamount="10">x10</button>
											<button type="button" class="btn btn-outline-danger circle" data-mineamount="24">x24</button>
											<button type="button" class="btn btn-danger start-game-btn" onclick="startgame()" <?if($minesgame != null){echo "disabled='disabled'";} ?>>Играть</button>
										</div>
									</div>
								</div>
							</div>
							<div class="right-side-row-4">
								<div class="history-game box">
									<div class="title text-uppercase"> История игры </div>
									<div class="content history-game-content" id="historyGameContentBombGame"> Нажмите 'играть' чтобы начать игру </div>
								</div>
							</div>
							<div class="right-side-row-5">
								<div class="finish-game box">
									<button type="button" class="btn btn-danger finish-game-btn" onclick="finishgame()" <?if($minesgame == null){echo "disabled='disabled'";} ?>>Забрать</button>
									<div class="info-game-boxes">
										<div class="info-game">
											<div class="title text-uppercase"> Следующий ИКС </div> <span class="number">
                  <span>x</span> <span class="nextRewardBox" id="nextRewardBoxBomb">1.03</span> </span>
										</div>
										<div class="info-game">
											<div class="title text-uppercase"> Общий выигрыш </div> <span class="number">
                  <span class="winSummaBox" id="winSummaBoxBomb"><?if($minesgame == null){echo "10";}else{echo $winMines;} ?></span> <i class="fas fa-coins"></i> </span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<table class="table table-hover table-bets ttable" id="tableBetsBomb">
						<thead>
							<tr>
								<th scope="col" style="width: 25%">Игрок</th>
								<th scope="col" style="width: 25%; text-align:center;">Ставка</th>
								<th scope="col" style="width: 25%; text-align:center;">Число мин</th>
								<th scope="col" style="width: 25%; text-align:center;">Результат</th>
							</tr>
						</thead>
						<tbody class="allbets" id="allBetsBomb">
						<tr style="width: 100%">
				<td><span>История загружается....</span></td>
			</tr>
						</tbody>
					</table>
				</div>
			
				<!--HILO -->
				
				<div class="game display-none" id="hilogame">
					<div class="main-content">
						<div class="left-side" style="padding-top: 0;">
							<div class="minefield">
							     <div class="cards-box"></div>
                                </div>
                                </div>			
			
						<div class="right-side">
							<div class="right-side-row-1">
								<div class="volume" title="Включить/Выключить звук">
									<button class="volume-btn btn-sett" onclick="volumechange()" data-vol="on"><i class="fas fa-volume-up"></i></button>
								</div>
								<div class="notif" title="Включить/Выключить уведомления">
									<button class="notif-btn btn-sett" onclick="notifchange()" data-notif="on"><i class="fas fa-bell"></i></button>
								</div>
								<div class="balance box">
									<div class="title text-uppercase"> Баланс </div>
									<div class="content">
										<div class="balance-content number">
											<div><span class="balanceBox money"><? echo $money; ?></span><i style="margin-left:5px;" class="fas fa-coins"></i></div>
										</div>
									</div>
								</div>
								<div class="history box">
									<div class="title text-uppercase"> История игр </div>
									<div class="content">
										<div class="history-content" id="hilo2HistoryContent">
                           
                                    </div>
									</div>
								</div>
							</div>
							<div class="right-side-row-2">
								<div class="amount-bet box">
									<div class="title text-uppercase">Сумма ставки</div>
									<div class="content amount-bet-content">
										<div class="amout-bet-content-inp"> <i class="fas fa-coins"></i>
											<input class="amout-bet-input number" type="text" value="10" id="amountBetInputBomb" onkeyup="var coef = $('#nextRewardBoxBomb').val(); var sum = $('#amountBetInputBomb').val();var otvet = sum*coef; $('#winSummaBoxBomb').text(otvet)"> </div>
										<div class="amount-bet-btns">
											<button type="button" class="btn  btn-outline-dark amout-bet-btn" data-btnamountbet="clean" onclick="calculate('clean')">C</button>
											<button type="button" class="btn  btn-outline-dark amout-bet-btn" data-btnamountbet="min" onclick="calculate('min')">Min</button>
											<button type="button" class="btn  btn-outline-dark amout-bet-btn" data-btnamountbet="max" onclick="calculate('max')">Max</button>
											<button type="button" class="btn  btn-outline-dark amout-bet-btn" data-btnamountbet="x2" onclick="calculate('x2')">x2</button>
											<button type="button" class="btn  btn-outline-dark amout-bet-btn" data-btnamountbet="1/2" onclick="calculate('1/2')">1/2</button>
											<button type="button" class="btn  btn-outline-dark amout-bet-btn" data-btnamountbet="+10" onclick="calculate('+10')">+10</button>
											<button type="button" class="btn  btn-outline-dark amout-bet-btn" data-btnamountbet="+100" onclick="calculate('+100')">+100</button>
											<button type="button" class="btn  btn-outline-dark amout-bet-btn" data-btnamountbet="-10" onclick="calculate('-10')">-10</button>
										</div>
									</div>
								</div>
							</div>
							<div class="right-side-row-3">
								<div class="box">
								<div class="container row">
								<div class="col-6"><button style="margin: 5px;" class="btn btn-danger col-12">КРАСНЫЙ </br>2,00х</button></div>
								<div class="col-6"><button style="margin: 5px;" class="btn btn-dark col-12">ЧЕРНЫЙ </br>2,00х</button></div>
									</div>
									<div class="container row">
								<div class="col-6"><button style="margin: 5px;" class="btn btn-success col-12">2-9 </br>1,50х</button></div>
								<div class="col-6"><button style="margin: 5px;" class="btn btn-success col-12">J Q K A </br>3,00х</button></div>
									</div>
									<div class="container row">
								<div class="col-6"><button style="margin: 5px;" class="btn btn-success col-12">K A </br>6,00х</button></div>
								<div class="col-6"><button style="margin: 5px;" class="btn btn-success col-12">A </br>12,00х</button></div>
									</div>
									<div class="container row">
								<div class="col-12"><button style="margin: 5px;" class="btn btn-primary col-12">JOKER (24,00х)</button></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<table class="table table-hover table-bets ttable" id="tableBetsBomb">
						<thead>
							<tr>
								<th scope="col" style="width: 25%">Игрок</th>
								<th scope="col" style="width: 25%; text-align:center;">Ставка</th>
								<th scope="col" style="width: 25%; text-align:center;">Число мин</th>
								<th scope="col" style="width: 25%; text-align:center;">Результат</th>
							</tr>
						</thead>
						<tbody class="allbets" id="allBetsBomb">
						<tr style="width: 100%">
				<td><span>История загружается....</span></td>
			</tr>
						</tbody>
					</table>
				</div>
				<div class="game display-none" id="x50game">
					<div class="main-content">
						<div class="left-side" style="padding-top: 0 !important;">
							<div class="chance-game-wheel">
								<div id="activeBorder" class="wheel-circle">
								    <img id="x50" src="x50.svg" style="position: relative; margin-top: -50px;transform: rotate(183deg);"> 
									<div id="wheelCircle" class="wheel-circle">
								    </div> 
								</div> 
								<div class="arrow-chance"> <i class="fas fa-location-arrow" id="chanceArrow"></i> </div>
							</div>
						</div>
						<div class="right-side">
							<div class="right-side-row-1">
								<div class="volume" title="Включить/Выключить звук">
									<button class="volume-btn btn-sett" onclick="volumechange()" data-vol="on"><i class="fas fa-volume-up"></i></button>
								</div>
								<div class="notif" title="Включить/Выключить уведомления">
									<button class="notif-btn btn-sett" onclick="notifchange()" data-notif="on"><i class="fas fa-bell"></i></button>
								</div>
								<div class="balance box">
									<div class="title text-uppercase"> Баланс </div>
									<div class="content">
										<div class="balance-content number">
											<div><span class="balanceBox"><? echo $money; ?></span><i style="margin-left:5px;" class="fas fa-coins"></i></div>
										</div>
									</div>
								</div>
								<div class="history box">
									<div class="title text-uppercase"> История игр </div>
									<div class="content">
										<div class="history-content" id="historyGamesChanceGame"> 
										<?php
                        
                        $query = ("SELECT * FROM `wheel-games` WHERE `id_users` = '$id' ORDER BY `id` DESC LIMIT 6");
                        $result553 = mysqli_query($link,$query);
                        while(($wheelHistory = mysqli_fetch_array($result553))){
                        
                        $betHistory = $wheelHistory['bet'];
                        $colorWheelHistory = $wheelHistory['colorWheel'];
                        $resultHistory = $wheelHistory['result'];
					  
						if($colorWheelHistory == $resultHistory){
							$resultgame = 'win';
							$resultHistory = $betHistory * $resultHistory;
						}else{
							$resultgame = 'lose';
							$resultHistory = $betHistory;
						}
					

                        $tt.="
                        <span class='number result-".$resultgame." result'><span class='myBetsBox'>".$resultHistory."</span> <i class='fas fa-coins'></i></span>";                            
						}            
						echo $tt;
					
        
                        ?>
									
										</div>
									</div>
								</div>
							</div>
							<div class="right-side-row-2">
								<div class="amount-bet box">
									<div class="title text-uppercase">Сумма ставки</div>
									<div class="content amount-bet-content">
										<div class="amout-bet-content-inp"> <i class="fas fa-coins"></i>
											<input class="amout-bet-input number" type="text" value="10" id="amountBetInputWheelGame" onkeyup="chanceGameCalculate()" onkeydown="chanceGameCalculate()"> </div>
										<div class="amount-bet-btns">
											<button type="button" class="btn btn-outline-dark amout-bet-btn" data-btnamountbet="clean" onclick="calculate('clean')">C</button>
											<button type="button" class="btn btn-outline-dark amout-bet-btn" data-btnamountbet="min" onclick="calculate('min')">Min</button>
											<button type="button" class="btn btn-outline-dark amout-bet-btn" data-btnamountbet="max" onclick="calculate('max')">Max</button>
											<button type="button" class="btn btn-outline-dark amout-bet-btn" data-btnamountbet="x2" onclick="calculate('x2')">x2</button>
											<button type="button" class="btn btn-outline-dark amout-bet-btn" data-btnamountbet="1/2" onclick="calculate('1/2')">1/2</button>
											<button type="button" class="btn btn-outline-dark amout-bet-btn" data-btnamountbet="+10" onclick="calculate('+10')">+10</button>
											<button type="button" class="btn btn-outline-dark amout-bet-btn" data-btnamountbet="+100" onclick="calculate('+100')">+100</button>
											<button type="button" class="btn btn-outline-dark amout-bet-btn" data-btnamountbet="-10" onclick="calculate('-10')">-10</button>
										</div>
									</div>
								</div>
							</div>
							<div class="right-side-row-4">
								<div class="history-game box">
									<div class="title text-uppercase"> История игры </div>
									<div class="content history-game-content" id="historyGameContentWheelGame"> Нажмите на цвет, который по вашему выпадет </div>
								</div>
							</div>
							<div class="right-side-row-3">
								<div class="amount-bomb box">
									<div class="title text-uppercase"> Сделать ставку </div>
									<div class="content">
										
                                                <div class="dice-game-box-percent">
												<button type="button" class="btn btn-success btn-wheel-black dice-game-box-percent-btn" onclick="startWheelGame('2')">x2</button>
												<button type="button" class="btn btn-danger btn-wheel-red dice-game-box-percent-btn" onclick="startWheelGame('3')">x3</button>
											    </div><div class="dice-game-box-percent">
												<button type="button" class="btn btn-success btn-wheel-blue dice-game-box-percent-btn" onclick="startWheelGame('5')" style="background: #345ed7;">x5</button>
												<button type="button" class="btn btn-danger btn-wheel-yellow dice-game-box-percent-btn" onclick="startWheelGame('50')" style="background: #eed152;border: 0;">x50</button>
											    </div>
									</div>
								</div>
							</div>

	
						</div>
					</div>
					<table class="table table-hover table-bets">
						<thead>
							<tr>
								<th scope="col" style="width: 25%">Игрок</th>
								<th scope="col" style="width: 25%; text-align:center;">Ставка</th>
								<th scope="col" style="width: 25%; text-align:center;">Коэффициент</th>
								<th scope="col" style="width: 25%; text-align:center;">Результат</th>
							</tr>
						</thead>
						<tbody class="allbets" id="allBetsWheelGame"> 
							
			<tr style="width: 100%">
				<td><span>История загружается....</span></td>
			</tr>
						</tbody>
					</table>
				</div>
				
				<div class="game display-none" id="dicegame">
					<div class="main-content">
						<div class="left-side">
							<div class="dice-all-content">
								<div class="dice-content">
								<?
								
								$less_hilo = (100 / $hilo);  
								$less_hilo = round($less_hilo,2);
								if($hilo != 100){
								$more_hilo = (1 / (100 - $hilo)) * 100;
								$more_hilo = round($more_hilo,2);
								}else{
									$more_hilo = 0;
								}
                                ?>
									<div class="dn d1"> <span id="diceProc"><? echo $hilo; ?>%</span> </div>
								</div>
								<div class="dice-content-bottom">
									<div class="dice-content-bottom-item">Коэффициент меньше: x<span id="dice-c-l"><? echo $less_hilo; ?></span></div>
									<div class="dice-content-bottom-item">Коэффициент больше: x<span id="dice-c-h"><? echo $more_hilo; ?></span></div>
								</div>
							</div>
						</div>
						<div class="right-side">
							<div class="right-side-row-1">
								<div class="volume" title="Включить/Выключить звук">
									<button class="volume-btn btn-sett" onclick="volumechange()" data-vol="on"><i class="fas fa-volume-up"></i></button>
								</div>
								<div class="notif" title="Включить/Выключить уведомления">
									<button class="notif-btn btn-sett" onclick="notifchange()" data-notif="on"><i class="fas fa-bell"></i></button>
								</div>
								<div class="balance box">
									<div class="title text-uppercase"> Баланс </div>
									<div class="content">
										<div class="balance-content number">
											<div><span class="balanceBox"><?echo $money; ?></span><i style="margin-left:5px;" class="fas fa-coins"></i></div>
										</div>
									</div>
								</div>
								<div class="history box">
									<div class="title text-uppercase"> История игр </div>
									<div class="content">
										<div class="history-content" id="historyGamesDiceGame">
										<?php
                        
                        $query = ("SELECT * FROM `hilos-games` WHERE `id_users` = '$id' ORDER BY `id` DESC LIMIT 6");
                        $result2 = mysqli_query($link,$query);
                        while(($hilosHistory = mysqli_fetch_array($result2))){
                        
                        $betHistory = $hilosHistory['bet'];
                        $coefHistory = $hilosHistory['coef'];
                        $resultHistory = $hilosHistory['result'];
					  
						if($resultHistory == "lose"){
							$resultgame = 'lose';
							$resultHistory = $betHistory;
						}else{
							$resultgame = 'win';
							$resultHistory = $betHistory * $coefHistory;
						}

                        $ff.="
                        <span class='number result-".$resultgame." result'><span class='myBetsBox'>".$resultHistory."</span> <i class='fas fa-coins'></i></span>";                            
						}            
						echo $ff;
					
        
                        ?>
                                        </div>
									</div>
								</div>
							</div>
							<div class="right-side-row-2">
								<div class="amount-bet box">
									<div class="title text-uppercase">Сумма ставки</div>
									<div class="content amount-bet-content">
										<div class="amout-bet-content-inp"> <i class="fas fa-coins"></i>
											<input class="amout-bet-input number" type="text" value="10" id="amountBetInputDiceGame"> </div>
										<div class="amount-bet-btns">
											<button type="button" class="btn btn-outline-dark amout-bet-btn" data-btnamountbet="clean" onclick="calculate('clean')">C</button>
											<button type="button" class="btn btn-outline-dark amout-bet-btn" data-btnamountbet="min" onclick="calculate('min')">Min</button>
											<button type="button" class="btn btn-outline-dark amout-bet-btn" data-btnamountbet="max" onclick="calculate('max')">Max</button>
											<button type="button" class="btn btn-outline-dark amout-bet-btn" data-btnamountbet="x2" onclick="calculate('x2')">x2</button>
											<button type="button" class="btn btn-outline-dark amout-bet-btn" data-btnamountbet="1/2" onclick="calculate('1/2')">1/2</button>
											<button type="button" class="btn btn-outline-dark amout-bet-btn" data-btnamountbet="+10" onclick="calculate('+10')">+10</button>
											<button type="button" class="btn btn-outline-dark amout-bet-btn" data-btnamountbet="+100" onclick="calculate('+100')">+100</button>
											<button type="button" class="btn btn-outline-dark amout-bet-btn" data-btnamountbet="-10" onclick="calculate('-10')">-10</button>
										</div>
									</div>
								</div>
							</div>
							<div class="right-side-row-3">
								<div class="amount-bomb box">
									<div class="title text-uppercase"> Сделать ставку </div>
									
<div class="content">
										<div class="amout-bomb-btns d-flex">
											<div class="dice-game-box-percent">
												<button type="button" class="btn btn-success dice-game-box-percent-btn" onclick="startDiceGame('l')">Меньше</button>
												<button type="button" class="btn btn-danger dice-game-box-percent-btn" onclick="startDiceGame('h')">Больше</button>
											</div>
										</div>
									</div><div class="content">
										<div class="amout-bomb-btns d-flex">
											<div class="dice-game-box-percent">
												<button type="button" class="btn btn-info dice-game-box-percent-btn" onclick="startDiceGame('4et')">Чет (х1.90)</button>
												<button type="button" class="btn btn-info dice-game-box-percent-btn" onclick="startDiceGame('ne4et')">Нечет (х1.90)</button>
											</div>
										</div>
									</div>
<div class="content">
										<div class="amout-bomb-btns d-flex">
											<div class="dice-game-box-percent">
												<button type="button" class="btn btn-info dice-game-box-percent-btn" onclick="startDiceGame('ravno')" style="
    width: 100%;
">Равно (95х)</button>
						
											</div>
										</div>
									</div>
								</div>
							</div>
							</div>
					</div>
					<table class="table table-hover table-bets">
						<thead>
							<tr>
								<th scope="col" style="width: 25%">Игрок</th>
								<th scope="col" style="width: 25%; text-align:center;">Ставка</th>
								<th scope="col" style="width: 25%; text-align:center;">Коэффициент</th>
								<th scope="col" style="width: 25%; text-align:center;">Результат</th>
							</tr>
						</thead>
						<tbody class="allbets" id="allBetsDiceGame">
						<tr style="width: 100%">
				<td><span>История загружается....</span></td>
			</tr>
			</tbody>
					</table>
				</div>
			
			
			
			</div>
			
			
			
	
			<div class="chat">
				<div class="chat-box">
					<div class="chat-up text-uppercase">Чат игроков</div>
					<div class="chat-main"> 

                    
					
					</div>
				</div>
				<div class="chat-down" id="chat-down-1">
					<input class="chat-input" placeholder="Введите текст..." id="inputChat1">
					<button class="chat-send" onclick="addChat(1);"> <i class="fab fa-telegram"></i> </button>
				</div>
				<script>
				$('#chat-down-1').keypress(function(e) {
					if(e.which == 13) {
						addChat(1);
					}
				});
				$('#chat-down-2').keypress(function(e) {
					if(e.which == 13) {
						addChat(2);
					}
				});
				</script>
			</div>
					
			
			
			
			
			
			
			
			
			
			
			<div class="alert notification-box alert-success" role="alert" id="notification" style="display: none;">Вы выиграли 1.22 <i class="fas fa-coins"></i></div>
		</main>
		
		<footer>
			<div class="container">
				<div class="footer"> <span>2019 © <?echo "$domen"; ?> <span class="footer-link"><a href="#" data-toggle="modal" data-target="#rulemodal">Пользовательское соглашение</a></span><span class="footer-link"><a class="footer-link" href="https://vk.com/netron_fun" target="_blank">Вконтакте</a></span></span>
				
<a href="//showstreams.tv/"><img src="//www.free-kassa.ru/img/fk_btn/14.png" title="Бесплатный видеохостинг"></a>				
				</div>
			</div>
		</footer>
		<!--<div class="vk-mess-box">
					<script type="text/javascript" src="https://vk.com/js/api/openapi.js?160"></script>
					<div id="vk_community_messages"></div>
					<script type="text/javascript">
					VK.Widgets.CommunityMessages("vk_community_messages", 171304030, {disableExpandChatSound: "1",disableNewMessagesSound: "1",tooltipButtonText: "Есть вопрос?"});
					</script>
			</div>-->
		<!-- Js -->
        <script src="js/func.js"></script>
        <script src="js/toastr.js"></script>
		<script src="js/js.cookie.js"></script>
		<script type="text/javascript">
		VK.init({
			apiId: 6966644
		});
		</script>
		<script type="text/javascript" src="https://vk.com/js/api/openapi.js?160"></script>
		<script type="text/javascript" src="https://vk.com/js/api/openapi.js?160"></script>

		<!-- VK Widget -->
		<!-- Bootstrap -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	</doctype><iframe name="ym-native-frame" title="ym-native-frame" frameborder="0" aria-hidden="true" style="opacity: 0; width: 0px; height: 0px; position: absolute; left: 100%; bottom: 100%; border: 0px !important;"></iframe></body></html>