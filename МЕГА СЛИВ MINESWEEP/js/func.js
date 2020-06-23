var path = "/engine.php"; //Для удобства
var scroll = true;
var lastClick;
function checkClick(timeclick)
{var timeStamp = 0;
  if ( !lastClick || lastClick && timeStamp - lastClick > timeclick ) {
    lastClick = timeStamp;
    return true;
  }
  else
  {
    return false;
  }
}
function nortification(text,status)
{
  var notif = $('.notif-btn').attr('data-notif');
    if(notif == 'on')
    {
      if(status == 'good')
      {
        $("#notification").show('fast').html(text).removeClass('alert-danger').addClass('alert-success');
        setTimeout(function() { $("#notification").hide('fast'); }, 3500);
      }
      else
      {
        $("#notification").show('fast').html(text).removeClass('alert-success').addClass('alert-danger');
        setTimeout(function() { $("#notification").hide('fast'); }, 3500);
      }
    }
}
$(window).on('load', function () {
  $preloader = $('.loaderArea'),
    $loader = $preloader.find('.loader');
  $loader.fadeOut();
  $preloader.delay(350).fadeOut('slow');
  $('.chat-main').scrollTop('9999');
});
function volumechange()
{
  var volume = $('.volume-btn').attr('data-vol');
  if(volume == "on")
  {
    $('.volume-btn').attr('data-vol','off').html('<i class="fas fa-volume-mute"></i>');
  }
  else
  {
    $('.volume-btn').attr('data-vol','on').html('<i class="fas fa-volume-up">');
  }
}
function notifchange()
{
  var notif = $('.notif-btn').attr('data-notif');
  if(notif == "on")
  {
    $('.notif-btn').attr('data-notif','off').html('<i class="fas fa-bell-slash"></i>');
  }
  else
  {
    $('.notif-btn').attr('data-notif','on').html('<i class="fas fa-bell">');
  }
}
function nortification(text,status)
{
  var notif = $('.notif-btn').attr('data-notif');
    if(notif == 'on')
    {
      if(status == 'good')
      {
        $("#notification").show('slow').html(text).removeClass('alert-danger').addClass('alert-success');
        setTimeout(function() { $("#notification").hide('slow'); }, 3000);
      }
      else
      {
        $("#notification").show('slow').html(text).removeClass('alert-success').addClass('alert-danger');
        setTimeout(function() { $("#notification").hide('slow'); }, 3000);
      }
    }
}
function addChat(num){
  var click = checkClick(2000);
  if(click){
    if(num == 1)
    {
      mess = $('#inputChat1').val();
    }
    else
    {
      mess = $('#inputChat2').val();
    }
    if(mess.length >= "3"){
    $.ajax({
        type: 'POST',
        url: path,
        data: {
            mess: mess,
        },
        success: function(response) {
               obj = $.parseJSON(response);
               $(".chat-send").attr("disabled","disabled");

               setTimeout(
                 function(){
                  $(".chat-send").removeAttr("disabled","disabled");
                 },5000);


              $('#inputChat1').val('');
              $('#inputChat2').val('');

              if(obj.good == "false"){
                nortification(obj.mess,"bad");
              }else{
                nortification(obj.mess,"good");
              }
              
              if(obj.tamines != null){               
                  for(i = 0; i <= 25; i++){
                    if(obj.tamines[i] != null){
                    $('.mine[data-number="'+obj.tamines[i]+'"]').addClass('lose-mine fas fa-bomb');
                    }
                    }
               };
            
        }
    });
  }else{
    nortification("Введите как минимум 3 символа","bad");
  }
}else{
  var mess = "Не спешите!";
  nortification(mess,'bad');
}
}
function getDisplayChat(){
  $.ajax({
    url: path,
    dataType: "html",
    type: "POST",
    data: {
      chatGet: "ok",
    },
    success: function(response){
      obj =  $.parseJSON(response);
      $(".chat-main").html(obj.chat);
      $('.chat-main').html(obj.allmess).scrollTop('9999');
    }
  });
};
setInterval(getDisplayChat, 1000);


function menuchange(){
  var amenu = $('.nav-link-4').attr('data-menu');
  if(amenu == 'main')
  {
    $('.icon-header').css('transform', 'rotate(90deg)');
    $('.nav-item-2').html("<a class=\"nav-link\" onclick=\"exit();\" style=\"cursor: pointer\">Выйти</a>");
    $('.nav-item-3').html('').css('display','none');
    $('.nav-item-5').html('').css('display','none');
    $('.nav-link-4').attr('data-menu','under');
  }
  else
  {
    $('.icon-header').css('transform', 'rotate(-90deg)');
    $('.nav-item-1').html('<a class="nav-link" href="#" data-toggle="modal" data-target="#giftModal">Бонусы</a>');
    $('.nav-item-2').html('<a class="nav-link" href="#" data-toggle="modal" data-target="#refillModal">Пополнить</a>');
    $('.nav-item-3').html('<a class="nav-link" href="#" data-toggle="modal" data-target="#withdrawModal">Вывести</a>').css('display','inline-block');
    $('.nav-link-4').attr('data-menu','main');
  }
}
function exit(){
  document.cookie= 'sid=;';
  window.location.reload();
}
function gamemenuchange(){
  var amenu = $('.game-open').attr('data-menu_game');
  if(amenu == 'open')
  {
    $('.game-menu-arrow').css('transform', 'rotate(180deg)');
    $('.game-none').css('display','none');
    $('.game-open').attr('data-menu_game','close');

  }
  else
  {
    $('.game-menu-arrow').css('transform', 'rotate(0deg)');
    $('.game-none').css('display','block');
    $('.game-open').attr('data-menu_game','open');
  }
}
function gameChange(game){
  console.log(game);
  if(game == 'bomb')
  {
    $('.game').addClass('display-none')
    $('#bombgame').removeClass('display-none');
  }
  if(game == 'x50')
  {
    $('.game').addClass('display-none')
    $('#x50game').removeClass('display-none');
  }
  if(game == 'dice')
  {
    $('.game').addClass('display-none')
    $('#dicegame').removeClass('display-none');
  }
  if(game == 'hilo')
  {
    $('.game').addClass('display-none')
    $('#hilogame').removeClass('display-none');
  }
}

function chanceGameCalculate(){
	var AmoutBetInput = parseInt($('#amountBetInputChanceGame').val());
	var procent = $('#amoutBetInputPercentChanceGame').val();
	var coeff = (100 / procent).toFixed(1);
	$('#winSummaBoxChanceGame').html(coeff * AmoutBetInput);
	//	console.log(AmoutBetInput);
}



function calculate(act)
{
    var AmoutBetInput = parseInt($('.amout-bet-input').val());
	var procent = $('#amoutBetInputPercentChanceGame').val();
	var coeff = (100 / procent).toFixed(1);
    
	switch (act){
        case "clean":
            $('.amout-bet-input').val('0');
			$('#winSummaBoxChanceGame').html(0);
          break;
        case "min":
            $('.amout-bet-input').val('1');
			$('#winSummaBoxChanceGame').html(coeff * 1);

          break;
        case "max":
            $('.amout-bet-input').val($('.balanceBox').html());
			$('#winSummaBoxChanceGame').html(coeff * $('.balanceBox').html());
          break;
        case "x2":
            $('.amout-bet-input').val(AmoutBetInput * 2);
      $('#winSummaBoxChanceGame').html(coeff * (AmoutBetInput * 2));
          break;
        case "1/2":
            $('.amout-bet-input').val(AmoutBetInput / 2);
			$('#winSummaBoxChanceGame').html(coeff * (AmoutBetInput / 2));
          break;
        case "+10":
            $('.amout-bet-input').val(AmoutBetInput + 10);
			$('#winSummaBoxChanceGame').html(coeff * (AmoutBetInput + 10));
          break;
        case "+100":
            $('.amout-bet-input').val(AmoutBetInput + 100);
			$('#winSummaBoxChanceGame').html(coeff * (AmoutBetInput + 100));
          break;
        case "-10":
            $('.amout-bet-input').val(AmoutBetInput - 10);

			$('#winSummaBoxChanceGame').html(coeff * (AmoutBetInput- 10));

          break;
      }

	

}

function startgame(){
  var bet = $("#amountBetInputBomb").val();
  var mine = "mine";
  $.ajax({
    url: path,
    type: "POST",
    dataType: "html",
    data: {
      type: mine,
      mines: $('.mineSelected').attr('data-mineamount'),
      bet: bet,
    },
    success: function(response){
      obj = $.parseJSON(response);
      if(obj.info == "warning"){
       nortification(obj.warning,"bad");

    }else{
      if(obj.info == "true"){
        $(".win").css("color","green").text("0");
        $(".allin-win").css("visibility","visible");

        for(i=0;i<26;i++){
        $(".mine[data-number="+i+"]").removeClass("win-mine").removeAttr("disabled","disabled").text("");
        $(".mine[data-number="+i+"]").removeClass("lose-mine fas fa-bomb").removeAttr("disabled","disabled").text("");
        }
        $(".take").removeAttr("disabled","disabled");
        $(".start-game-btn").attr("disabled","disabled");
        $(".finish-game-btn").removeAttr("disabled","disabled");
        nortification("Игра началась, приятной игры!","good");
        $(".balanceBox").text(obj.money);
        $(".mine-circle").attr("disabled","disabled");

      }
      if(obj.info == "false"){
        nortification("У вас есть активная игра!","bad");

      }
}
    }
  });
};
$( document ).ready(function() {
var click = checkClick(300);
if(click){
$(".mine").click(
  function minclick(){
  var pressmine = $(this).attr("data-number");
  $.ajax({
   url: path,
   type: "POST",
   dataType: "html",
   data: {
     mmine: pressmine,
   },
   success: function(response){ //response
     obj = $.parseJSON(response); //response
     if(obj.info == "warning"){
      nortification(obj.warning,"bad");
  }
    if(obj.info == "click"){
      if(obj.bombs == "true"){
           $(".mine[data-number="+obj.pressmine+"]").addClass("lose-mine fas fa-bomb");
           $('#historyGameContentBombGame').html("Поле "+obj.pressmine+" оказалось с миной");
           $(".finish-game-btn").attr("disabled","disabled");
           $(".start-game-btn").removeAttr("disabled","disabled");
           $(".mine-circle").removeAttr("disabled","disabled");
           $(".win").css("color","red").text("0");
           $("#nextRewardBoxBomb").text("1.03");
           obj.tamines = $.parseJSON(obj.tamines);
           for(i = 0; i < obj.tamines.length; i++){
           $(".mine[data-number="+obj.tamines[i]+"]").addClass('lose-mine fas fa-bomb');
          };
           for(i=0;i<26;i++){
             $(".mine[data-number="+i+"]").attr("disabled","disabled");
           };
           $("#bombHistoryContent").prepend(obj.resultHistoryContentBomb);
           }else{
           $(".mine[data-number="+obj.pressmine+"]").text("+"+obj.win).addClass("win-mine");
           $("#winSummaBoxBomb").text(obj.win);
           $(".mine[data-number="+obj.pressmine+"]").attr("disabled","disabled");
           $("#historyGameContentBombGame").text("Поле " +pressmine+" оказалось призовым");
           $("#nextRewardBoxBomb").text(obj.nextX);
           //прокрутка истории действий
         }
   }
 }
 })
  }
);
}else{
  nortification("Не спеши!","bad");
};
});
function finishgame(){
  $.ajax({
    url: path,
    type: "POST",
    dataType: "html",
    data: {
      finish: true,
    },
    success: function(response){
     obj = $.parseJSON(response);
     if(obj.info == "warning"){
       nortification(obj.warning,"bad");

   }else{
     obj.tamines = $.parseJSON(obj.tamines);
     if (obj.info = true){
       nortification("Поздравляем, вы выиграли "+obj.win+" монет!","good");
       $(".balanceBox").text(obj.money);
       $(".start-game-btn").removeAttr("disabled","disabled");
       $(".finish-game-btn").attr("disabled","disabled");
       $("#historyGameContentBombGame").text("Нажмите 'играть' чтобы начать игру");
       $("#bombHistoryContent").prepend(obj.resultHistoryContentBomb);
       
       for(i=0;i<26;i++){
         $(".mine[data-number="+i+"]").attr("disabled","disabled");
       }
      for(i = 0; i < obj.tamines.length; i++){
      $(".mine[data-number="+obj.tamines[i]+"]").addClass('lose-mine fas fa-bomb');
      }
      }
}

   },
  })
};
$( ".circle" ).click(function mineSelection()
{
  $('.circle').removeClass('mineSelected');
  $(this).addClass('mineSelected');
  if($(this).attr('data-mineamount') == 2)
  {
    $('#nextRewardBoxBomb').html(1.03);
    $('#winSummaBoxBomb').html(($('#amountBetInputBomb').val()*1.03).toFixed(2));
  }
  if($(this).attr('data-mineamount') == 3)
  {
    $('#nextRewardBoxBomb').html(1.07);
    $('#winSummaBoxBomb').html(($('#amountBetInputBomb').val()*1.07).toFixed(2));
  }
  if($(this).attr('data-mineamount') == 5)
  {
    $('#nextRewardBoxBomb').html(1.18);
    $('#winSummaBoxBomb').html(($('#amountBetInputBomb').val()*1.18).toFixed(2));
  }
  if($(this).attr('data-mineamount') == 24)
  {
    $('#nextRewardBoxBomb').html(24);
    $('#winSummaBoxBomb').html(($('#amountBetInputBomb').val()*24).toFixed(2));
  }
});
function live(){
  $.ajax({
    url: path,
    type: "POST",
    dataType: "html",
    data: {
      live: true,
    },
    success: function(response){
      obj = $.parseJSON(response);
      $("#allBetsBomb").html(obj.live);
    },
  }
)
};
setInterval(live,5000);
function hiloslive(){
  $.ajax({
    url: path,
    type: "POST",
    dataType: "html",
    data: {
      hilos: true,
    },
    success: function(response){
      obj = $.parseJSON(response);
      $("#allBetsDiceGame").html(obj.hilo);
    },
  }
)
};
setInterval(hiloslive,5000);
function wheellive(){
  $.ajax({
    url: path,
    type: "POST",
    dataType: "html",
    data: {
      wheelHis: true,
    },
    success: function(response){
      obj = $.parseJSON(response);
      $("#allBetsWheelGame").html(obj.wheel);
    },
  }
)
};
setInterval(wheellive,5000);
function promocode(){
   
  var promocode = $("#input-promo").val();

  $.ajax({
    url: path,
    type: "POST",
    dataType: "html",
    data: {
      promo: promocode,
    },
    success: function(response){
      obj = $.parseJSON(response);
      if(obj.good == "true"){
      nortification(obj.mess,"good");
      $(".balanceBox").text(obj.money);
      }else{
      nortification(obj.mess,"false");
      }
    }
  });
};
function animateDice(hilo){ 
  var hilo = hilo; 
  $('#diceProc').animate({hilo}, { 
  step: function (num){ 
  this.innerHTML = (num).toFixed(0) + '%' 
  } 
  }); 
  } 
var animate = '';
function startDiceGame(range){
  $.ajax({
  url: path,
  type: "POST",
  dataType: "html",
  data: {
  range: range,
  bet: $("#amountBetInputDiceGame").val(),
  },
  success: function(response){
  obj = $.parseJSON(response);
  var hilo = obj.hilo;
  if(obj.good == "good"){
    var mess = obj.mess;
    setTimeout(
      function(){
      nortification(mess,"good")
    }
    ,1000);
  $("#dice-c-l").text(obj.hi);
  $("#dice-c-h").text(obj.lo);
  var resultHistoryContentDice = obj.resultHistoryContentDice;
  setTimeout(
    function(){
  $("#historyGamesDiceGame").prepend(resultHistoryContentDice);
  }
  ,1000);
  }else{
    var mess = obj.mess;
  setTimeout(
    function(){
    nortification(mess,"bad")
  }
  ,1000);
  $("#dice-c-l").text(obj.hi);
  $("#dice-c-h").text(obj.lo);
  var resultHistoryContentDice = obj.resultHistoryContentDice;
  setTimeout(
    function(){
  $("#historyGamesDiceGame").prepend(resultHistoryContentDice);
  }
  ,1000);
  }
  if(animate != ''){
    clearTimeout(animate)
    animate = ''
    return
    }
    animate = setTimeout(function(){
    animateDice(hilo);
    animate = ''
    },500);
    $(".dice-game-box-percent-btn").attr("disabled","disabled");
    setTimeout(
      function(){
        $(".dice-game-box-percent-btn").removeAttr("disabled","disabled");
      },1000);
      var money = obj.money;
      setTimeout(
        function(){
        $(".balanceBox").text(money); 
        },1000);

  }
  });
  };

  function startWheelGame(colorWheel){
    var animateInt = getRandomInt(7, 12);
    var animateRotateInt = getRandomInt(0, 4);
    $("#x50").css({"transform":"rotate(183deg)"});
    $("#x50").css({"transition":"0s"});
    $.ajax({
      url: path,
      type: "POST",
      dataType: "HTML",
      data: {
        wheel: colorWheel,
        bet: $("#amountBetInputWheelGame").val(),
      },
      success: function(response){
        obj = $.parseJSON(response);
        if(obj.danger == "danger"){
          nortification(obj.mess,"bad")
        }else{
        $("#historyGameContentWheelGame").text("Вращение рулетки...");
        if(obj.good == "good"){
          var mess = obj.mess;
          setTimeout(
            function(){
          nortification(mess,"good")
            },animateInt*1000);
          var rotateWheel = (obj.key*(360/54) + 360*3-3+180+11+animateRotateInt)
          $("#x50").css({"transform":"rotate("+rotateWheel+"deg)","transition":""+animateInt+"s"});
          $(".dice-game-box-percent-btn").attr("disabled","disabled");
          var money = obj.money;
          setTimeout(
            function(){
              $(".balanceBox").text(money);
              $(".dice-game-box-percent-btn").removeAttr("disabled","disabled");
              $("#historyGameContentWheelGame").text("Нажмите на цвет, который по вашему выпадет");
            },animateInt*1000);
            var resultHistoryContentWheel = obj.resultHistoryContentWheel;
            setTimeout(
              function(){
            $("#historyGamesChanceGame").prepend(resultHistoryContentWheel);
            }
            ,animateInt*1000);
        }
        if(obj.bad == "bad"){ 
          var resultHistoryContentWheel = obj.resultHistoryContentWheel; 
          setTimeout(
            function(){
          $("#historyGamesChanceGame").prepend(resultHistoryContentWheel);
          }
          ,animateInt*1000);
          var mess = obj.mess;
          setTimeout(
            function(){
          nortification(mess,"bad")
            },animateInt*1000);
          var rotateWheel = (obj.key*(360/54) + 360*3-3+180+11+animateRotateInt)
          $("#x50").css({"transform":"rotate("+rotateWheel+"deg)","transition":""+animateInt+"s"});
          $(".dice-game-box-percent-btn").attr("disabled","disabled");
          var money = obj.money;
          setTimeout(
            function(){
              $(".balanceBox").text(money);
              $(".dice-game-box-percent-btn").removeAttr("disabled","disabled");
              $("#historyGameContentWheelGame").text("Нажмите на цвет, который по вашему выпадет");
            },animateInt*1000);
        }
      }
        if(obj.valuesWheel == 2){
          setTimeout( function(){
          $("#chanceArrow").css("color","rgb(39, 45, 60)");
        },animateInt*1000);
        }
        if(obj.valuesWheel == 3){
          setTimeout( function(){
          $("#chanceArrow").css("color","rgb(191, 82, 111)");
        },animateInt*1000);
        }
        if(obj.valuesWheel == 5){
          setTimeout( function(){
          $("#chanceArrow").css("color","rgb(52, 94, 215)");
          },animateInt*1000);
        }
        if(obj.valuesWheel == 50){
          setTimeout( function(){
          $("#chanceArrow").css("color","rgb(238, 209, 82)");
        },animateInt*1000);
        }
      }
    });
  };
function getRandomInt(min, max)
{
  return Math.floor(Math.random() * (max - min + 1)) + min;
}
function withdraw(){
var w_amount = $("#w-amount").val();
var wallet = $("#w-system").val();
var w_number_wallet = $("#w-number-wallet").val();
   $.ajax({
     url: path,
     type: "POST",
     dataType: "HTML",
     data: {
       w_amount: w_amount,
       wallet: wallet,
       w_number_wallet: w_number_wallet,
     },
     success: function(response){
       obj = $.parseJSON(response);
       if(obj.good == "true"){
        nortification(obj.mess,"good")
        $(".balanceBox").text(obj.money);
        $(".my-withdraws").prepend(obj.withdraws);
       }else{
        nortification(obj.mess,"bad")
       }
     }
   });
}
function openProfile(id){
	$.ajax({
		url: path,
		type: "POST",
  dataType: "HTML",
  data: {
  openProfile: 'openProfile',
  idProfile: id,
  },
  success: function(response){
  obj = $.parseJSON(response);

$('#open-profile-modal').modal();
$("#spanProfile").html(obj.profile);

  }
	}
	)
}

function openMines(id){
$.ajax({
		url: path,
		type: "POST",
  dataType: "HTML",
  data: {
  openMines: 'openMines',
  idMines: id,
  },
  success: function(response){
  obj = $.parseJSON(response);
  obj.minesopen = $.parseJSON(obj.minesopen);


$('#open-mines-modal').modal();
$(".openMines").html(obj.minesopen);
$("#idbetMines").text(obj.idbetMines);
$("#coefMinesOpen").text(obj.coefMinesOpen);

if(obj.loseBomb != null){
$(".openMines[data-number="+obj.loseBomb+"]").addClass("lose-mine fas fa-bomb");
}
$("#openMinesLogin").text(obj.loginMinesOpen); //attr("onclick='+obj.idUsersOpen+'")
$("#winminesOpen").text(obj.winminesOpen);

  }
	}
	) 

}
function openx50(id){
$.ajax({
		url: path,
		type: "POST",
  dataType: "HTML",
  data: {
  openx50: 'openx50',
  idx50: id,
  },
  success: function(response){
  obj = $.parseJSON(response);
  obj.minesopen = $.parseJSON(obj.minesopen);


$('#open-x50-modal').modal();

 }
	}
	) 

}

function openSunduc(){
$.ajax({
		url: path,
		type: "POST",
  dataType: "HTML",
  data: {
  openSunduc: 'openSunduc',
  },
  success: function(response){
  obj = $.parseJSON(response);


if(obj.result == "true"){
        nortification(obj.mess,"good");
$(".balanceBox").text(obj.money);
$(".bilet").text(obj.newBilet);

}else{
        nortification(obj.mess,"bad")

}



 }
	}
	) 
} 