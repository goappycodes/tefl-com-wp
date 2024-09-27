//Timer Expiry Countdown
const displayCountdown = () => {
	let timerContainer = document.querySelector('.countdown-timer');
	if (timerContainer) {

		const expiryDate = timerContainer.dataset.expiry;
		const countDownDate = new Date(expiryDate).getTime();
		const update = setInterval(() => {
			var now = new Date().getTime();
			const diff = countDownDate - now;
			if (diff > 0) {


				const days = Math.floor(diff / (1000 * 60 * 60 * 24));
				const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
				const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
				const seconds = Math.floor((diff % (1000 * 60)) / 1000);
				document.querySelector('#dayCount').innerHTML = days;
				if (days === 0) {
					document.querySelector('.timer__day').style.display = 'none';
				}
				document.querySelector('#hourCount').innerHTML = hours;
				if (days === 0 && hours === 0) {
					document.querySelector('.timer__hour').style.display = 'none';
				}
				if (days === 0 && hours > 0) {
					document.querySelector('.hours-remaining').innerHTML = `${hours} hours only`
				}
				document.querySelector('#minuteCount').innerHTML = minutes;
				if (days === 0 && hours === 0 && minutes === 0) {
					document.querySelector('timer__minute').style.display = 'none';
				}
				document.querySelector('#secondCount').innerHTML = seconds;

			} else {
				document.getElementsByClassName('countdown-timer').style.display = 'none';
			}
		}, 1000);

	}


}


jQuery(document).ready(function ($) {
	var current = 0,
		slides = document.getElementsByClassName("logo-group");

	setInterval(function () {
		for (var i = 0; i < slides.length; i++) {
			slides[i].style.opacity = 0;
		}
		current = (current != slides.length - 1) ? current + 1 : 0;
		slides[current].style.opacity = 1;
	}, 5000);
	displayCountdown();

	if (matchMedia('(min-width: 768px)').matches) {
		$('.training-courses .course-item').equalizeHeights();
	}




})