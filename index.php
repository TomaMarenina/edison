<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/core/core.php';
$page_title = 'Test Edison';
include_once $_SERVER['DOCUMENT_ROOT']."/template/header.php";

// получение истории догадок и достоверности экстрасенсов
$history = array();
$rel = array();
$history[1] = $psychics1->getHistory();
$rel[1] = $psychics1->getReliability();

$history[2] = $psychics2->getHistory();
$rel[2] = $psychics2->getReliability();

$history[3] = $psychics3->getHistory();
$rel[3] = $psychics3->getReliability();

// получение загаданных чисел
$user_history = $User::getHistory();
?>

<h1 class="page__header">Тестирование экстрасенсов</h1>
<div class="flex">
	<div class="flex__column">
		<p>Загадайте любое двузначное число и нажмите кнопку</p>
		<button class="button js-guess">Загадать</button>
		<div class="js-right-answer right-answer">
			<p>Введите число, которое вы загадали:</p>
			<input type="text" class="input js-input" /><br>
			<button class="button js-check">Отправить экстрасенсам</button>
		</div>
	</div>
	<div class="flex__column">
		<div class="result" id="result-box">
			<div class="user-input">
				<div class="user-input__caption">Числа</div>
				<?php foreach ($user_history as $input) { ?>
				<div class="user-input__item"><?=$input?></div>
				<?php } ?>
			</div>
			<div class="result__guesses">
				<div class="result__row -caption">
					<div class="result__column">Экстрасенс 1</div>
					<div class="result__column">Экстрасенс 2</div>
					<div class="result__column">Экстрасенс 3</div>
				</div>
				<div class="result__row -rely">
				<?php foreach($rel as $key => $value) { ?>
					<div class="result__column js-rely-<?=$key?>"><i>Рейтинг:<br /><?=$value?></i></div>
				<?php } ?>
				</div>
				<div class="result__row">
				<?php foreach($history as $key => $value) { ?>
					<div class="result__column js-psy-<?=$key?>">
						<?php foreach($value as $one_guess) { ?>
							<div class="result__one"><?=$one_guess?></div>
						<?php } ?>
					</div>
				<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/template/footer.php"; 
?>