<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
//echo $_SESSION['type'];
if (!isset($_SESSION['name']) OR $_SESSION['type'] != 'admin') {
   header('location: /admin33338/');
}
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');
//require __DIR__ . '/../../config.php';
?>

<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>
		<!-- Pe chart revenue per manager -->
		<div class="container-fluid">
			<div class="row">
				<!-- Big row -->
				<div class="col-md-2">

				</div>
				<div class="col-md-8 pray">
					<h1>Каждый день к прочтению</h1>
					<img class="img-responsive img-circle pull-right" src="/admin33338/img/pray.png">
                            <ul>
                            <li>My main goal is moving to US! Remember that!</li>
                            <li>Путь к большой цели состоит из огромного количества крохотных шагов. Ты придешь к цели только если будешь делать эти шаги. Других вариантов нет.</li>
                            <li>Управляй а не работай.</li>
                            <li>Не жри дерьмо.</li>
                            <li>Всегда говори НЕТ.</li>
                            <li>Не уходи от конфликта</li>
                            <li>Награждай подчиненных.</li>
                            <li>Наказывай подчиненных.</li>
                            <li>Будь стоиким и настойчивым. Терпение и труд все перетрут.</li>
                            <li>Будь позитивным.</li>
                            <li>Извинись, улыбнись и сделай, то, что тебе нужно.</li>
                            <li>Мало говори, много слушай. Открываясь ты уязвим.</li>
                            <li>Нигогда не принимай решения в гневе.</li>
                            <li>Давай слово редко но всегда держи свое слово.</li>
                            <li>Насрать на чужие правила.</li>
                            <li>Между уважением и стахом выбирай страх.</li>
                            <li>Хочешь мира - готовься к войне.</li>
                            <li>Слушай свои инстинкты.</li>
                            <li>Если сейчас хорошо - помни, не всегда так бывает.</li>
                            <li>Будь терпелив, будь готов получить меньше за свою работу.</li>
                            <li>Для того, чтобы заработать деньги - нужно их вложить.</li>
                            <li>Повышая голос ты показываешь свою слабость.</li>
                            <li>Ничего не жди от окружающих</li>
                            <li>Настойчивость окупается</li>
                            </ul>

					
					 <div class="col-md-2">

					</div>
				</div>
				<!-- Big row end -->
			</div>
	</body>
</html>

