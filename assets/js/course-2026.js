/* Course Page 2026 — The TEFL Institute. No dependencies. */
(function () {
	'use strict';
	var root = document.getElementById('c26');
	if (!root || !window.tiC26) return;

	var $  = function (sel, ctx) { return (ctx || root).querySelector(sel); };
	var $$ = function (sel, ctx) { return Array.prototype.slice.call((ctx || root).querySelectorAll(sel)); };
	var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

	function offset() {
		var nav = $('.c26-subnav');
		return (nav ? nav.offsetHeight : 0) + (parseFloat(getComputedStyle(root).getPropertyValue('--c26-sticky-offset')) || 0) + 12;
	}

	/* ---------- Smooth jump links ---------- */
	$$('[data-c26-jump]').forEach(function (a) {
		a.addEventListener('click', function (e) {
			var el = document.getElementById(a.getAttribute('data-c26-jump'));
			if (!el) return;
			e.preventDefault();
			window.scrollTo({ top: el.getBoundingClientRect().top + window.pageYOffset - offset(), behavior: reduceMotion ? 'auto' : 'smooth' });
			history.replaceState(null, '', '#' + el.id);
		});
	});

	/* ---------- Scroll-spy for the section nav ---------- */
	var tabs = $$('.c26-tab');
	if (tabs.length) {
		var ids = tabs.map(function (t) { return t.getAttribute('data-c26-jump'); });
		var spy = function () {
			var cur = ids[0];
			ids.forEach(function (id) {
				var el = document.getElementById(id);
				if (el && el.getBoundingClientRect().top < offset() + 80) cur = id;
			});
			tabs.forEach(function (t) {
				var on = t.getAttribute('data-c26-jump') === cur;
				t.classList.toggle('is-active', on);
				if (on) t.setAttribute('aria-current', 'true'); else t.removeAttribute('aria-current');
			});
		};
		window.addEventListener('scroll', spy, { passive: true });
		spy();
	}

	/* ---------- Pricing: refresh for this visitor (cache-safe), add-ons, total ---------- */
	var selected = [];
	var card = $('[data-c26-price]');

	function post(action, extra) {
		var body = new URLSearchParams();
		body.append('action', action);
		body.append('post_id', tiC26.postId);
		selected.forEach(function (id) { body.append('addons[]', id); });
		return fetch(tiC26.ajaxUrl, { method: 'POST', credentials: 'same-origin', body: body })
			.then(function (r) { return r.json(); });
	}

	function setText(key, val) {
		$$('[data-c26="' + key + '"]').forEach(function (el) {
			el.textContent = val || '';
			if (key === 'saving') el.hidden = !val;
		});
	}

	var quoteTimer;
	function refreshQuote() {
		clearTimeout(quoteTimer);
		quoteTimer = setTimeout(function () {
			post('ti_c26_quote').then(function (res) {
				if (!res || !res.success || !res.data.ok) return;
				var d = res.data;
				setText('now', d.now); setText('was', d.was); setText('saving', d.saving); setText('total', d.total);
				Object.keys(d.addons || {}).forEach(function (id) {
					var a = d.addons[id], btn = $('[data-c26-addon="' + id + '"]');
					if (btn) $('[data-c26-addon-price]', btn).textContent = a.price + (a.save ? ' · save ' + a.save : '');
				});
			}).catch(function () { /* keep server-rendered prices */ });
		}, 120);
	}

	if (card) {
		$$('[data-c26-addon]', card).forEach(function (btn) {
			btn.addEventListener('click', function () {
				var id = btn.getAttribute('data-c26-addon');
				var on = btn.getAttribute('aria-pressed') !== 'true';
				btn.setAttribute('aria-pressed', on ? 'true' : 'false');
				$('[data-c26-addon-label]', btn).textContent = on ? 'Added' : '+ Add';
				selected = on ? selected.concat(id) : selected.filter(function (x) { return x !== id; });
				refreshQuote();
			});
		});

		refreshQuote();
	}


	/* ---------- Enrol buttons (hero, sticky nav, price card): cart + add-ons, then checkout ---------- */
	var errBox = card ? $('.c26-enrol-error', card) : null;
	$$('[data-c26-enrol]').forEach(function (enrol) {
		enrol.addEventListener('click', function (e) {
			e.preventDefault();
			enrol.classList.add('is-loading');
			if (errBox) errBox.hidden = true;
			post('ti_c26_enrol').then(function (res) {
				if (res && res.success && res.data.redirect) { window.location.href = res.data.redirect; return; }
				throw new Error(res && res.data && res.data.message);
			}).catch(function (err) {
				enrol.classList.remove('is-loading');
				// Fall back to WooCommerce's own add-to-cart link (main course only).
				if (!selected.length || !errBox) { window.location.href = enrol.href; return; }
				errBox.textContent = (err && err.message) || 'Sorry, something went wrong. Please try again or contact us.';
				errBox.hidden = false;
			});
		});
	});

	/* ---------- Countdown ---------- */
	var cd = $('[data-c26-countdown]');
	if (cd) {
		var end = parseInt(cd.getAttribute('data-c26-countdown'), 10);
		var cells = { d: $('[data-c26-cd="d"]', cd), h: $('[data-c26-cd="h"]', cd), m: $('[data-c26-cd="m"]', cd), s: $('[data-c26-cd="s"]', cd) };
		var pad = function (n) { return String(Math.floor(n)).padStart(2, '0'); };
		var tick = function () {
			var left = Math.max(0, end - Date.now()) / 1000;
			if (left <= 0) { cd.hidden = true; clearInterval(timer); return; }
			cells.d.textContent = pad(left / 86400);
			cells.h.textContent = pad(left % 86400 / 3600);
			cells.m.textContent = pad(left % 3600 / 60);
			cells.s.textContent = pad(left % 60);
		};
		var timer = setInterval(tick, 1000);
		tick();
	}

	/* ---------- Students: pinned horizontal scroll (desktop) / swipe (mobile) ---------- */
	var stud = $('[data-c26-students]');
	if (stud) {
		var track = $('[data-c26-track]', stud), bar = $('[data-c26-bar]', stud);
		var mq = window.matchMedia('(min-width: 769px)');
		var dist = 0;

		var size = function () {
			var pinned = mq.matches && !reduceMotion;
			stud.classList.toggle('is-static', !pinned);
			if (!pinned) { stud.style.height = ''; track.style.transform = ''; return; }
			dist = Math.max(0, track.scrollWidth - track.parentElement.clientWidth);
			stud.style.height = (window.innerHeight + dist) + 'px';
			move();
		};
		var move = function () {
			if (stud.classList.contains('is-static')) return;
			var total = stud.offsetHeight - window.innerHeight;
			var p = total > 0 ? Math.min(1, Math.max(0, -stud.getBoundingClientRect().top / total)) : 0;
			track.style.transform = 'translateX(' + (-dist * p) + 'px)';
			if (bar) bar.style.width = (p * 100) + '%';
		};
		window.addEventListener('scroll', move, { passive: true });
		window.addEventListener('resize', size);
		window.addEventListener('load', size);
		if (mq.addEventListener) mq.addEventListener('change', size);
		size();

		// Video modal
		var modal = document.querySelector('[data-c26-modal]'), mBody = modal && modal.querySelector('[data-c26-modal-body]');
		if (modal && typeof modal.showModal === 'function') {
			var close = function () { mBody.innerHTML = ''; if (modal.open) modal.close(); };
			$$('[data-c26-video]', stud).forEach(function (btn) {
				btn.addEventListener('click', function () {
					var tpl = $('template[data-c26-video-embed="' + btn.getAttribute('data-c26-video') + '"]', stud);
					if (!tpl) return;
					mBody.innerHTML = tpl.innerHTML;
					var iframe = mBody.querySelector('iframe');
					if (iframe) {
						var src = iframe.getAttribute('src') || '';
						iframe.setAttribute('src', src + (src.indexOf('?') > -1 ? '&' : '?') + 'autoplay=1');
						iframe.setAttribute('allow', 'autoplay; fullscreen; picture-in-picture');
					}
					modal.showModal();
				});
			});
			modal.querySelector('[data-c26-close]').addEventListener('click', close);
			modal.addEventListener('click', function (e) { if (e.target === modal) close(); });
			modal.addEventListener('close', function () { mBody.innerHTML = ''; });
		}
	}
})();