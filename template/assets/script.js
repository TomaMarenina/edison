var last_guess;

// кнопка "загадать число"
$('.js-guess').click(function(){
	let $this = $(this);
	$.ajax({
		method: 'POST',
		data: 'guess',
	}).done(function(request){
		$this.html('Загадано &#10004;');
		$this.prop('disabled', true);
		last_guess = JSON.parse(request);
		for (key in last_guess) {
			$('.js-psy-' + key).append('<div class="result__one">' + last_guess[key] + '</div>');
		}
		$('.js-right-answer').show();
		$('.error').remove();
	})
});

// кнопка "отправить экстрасенсам свое загаданное число"
$('.js-check').click(function(){
	let value = $('.js-input').val();
	if (value.match(/^[1-9][0-9]$/)) {
		$.ajax({
			method: 'POST',
			data: {'user_input': value},
		}).done(function(request){
			$('.js-guess').html('Загадать');
			
			let rely = JSON.parse(request);
			for (key_r in rely['reliabilities']) {
				$('.js-rely-' + key_r).html('<i>Рейтинг:<br />' + rely['reliabilities'][key_r] + '</i>');
			}
			$('.user-input').append('<div class="user-input__item">' + value + '</div>');
			$('.js-guess').prop('disabled', false);
			$('.js-right-answer').hide();
			$('.js-input').val('');
			$('.error').remove();
		});
	} else {
		console.log('не двузначное число');
		$('.js-check').after('<p class="error"><br>Это не двузначное число!</p>');
	}
});

