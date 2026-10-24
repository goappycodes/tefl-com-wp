/* TEFL for Schools — landing template (design v3)
 * Plain JavaScript, no dependencies. Everything is scoped to #tfs2.
 */
(function () {
  'use strict';

  var root = document.getElementById('tfs2');
  if (!root) { return; }

  var C = window.TFS2_CONFIG || {};
  var REDUCED = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ------------------------------------------------------------------
   * Content that lives in code rather than in the page fields.
   * ---------------------------------------------------------------- */

  var QUIZ = [
    { q: 'A student writes: "I am living in London since 2019." What is the actual problem', note: 'This is the single most common error British teachers meet abroad.', o: ['Nothing, it is correct', 'It should be the present perfect continuous, "I have been living"', 'It should be the past simple, "I lived"', '"Since" should be "for"'], a: 1, why: 'An action that started in the past and continues now, marked with "since", takes the present perfect continuous. Many languages use the present tense here, so learners carry it across.' },
    { q: 'A learner says: "I am agree with you." What is the fix', note: 'A classic transfer error from Spanish and Italian speakers.', o: ['"I am agreeing with you"', '"I agree with you"', '"I have agree with you"', 'Nothing, it is fine in speech'], a: 1, why: '"Agree" is a verb in English, not an adjective, so it does not need "am".' },
    { q: 'You explain a new tense and ask "Do you understand?" Everyone nods. What should you do next', note: 'Classroom management module.', o: ['Move on, they said yes', 'Ask it again more slowly', 'Ask a concept checking question, such as "Is this finished or still happening?"', 'Set a written test'], a: 2, why: 'Learners nod to be polite. A concept checking question shows whether they actually have the meaning.' },
    { q: 'Which word carries its stress on the second syllable', note: 'Pronunciation and phonology module.', o: ['PHOtograph', 'phoTOgrapher', 'TAble', 'WINdow'], a: 1, why: 'Adding "-er" to "photograph" moves the stress, which is why learners find the word family hard to say.' },
    { q: 'In a 60 minute lesson, where should most of the student talking time sit', note: 'Lesson planning module.', o: ['The teacher presentation', 'Controlled and freer practice', 'The warmer', 'Explaining the homework'], a: 1, why: 'The practice stages are where learners use the language. The presentation should be short.' }
  ];

  /* Route pool for the matcher. Unchanged from the live tool: every age,
     degree and pay rule is taken from an official source, linked on the card. */
  var ROUTES = [
    { name: 'Tutoring closer to home', when: 'now', age: 'No minimum age of its own, though under 18 you need your school and your parents on side', degree: 'Not required', pay: 'The UK minimum wage floor is £8.00 an hour under 18 and £10.85 at 18 to 20, from April 2026', paySrc: ['gov.uk minimum wage rates', 'https://www.gov.uk/national-minimum-wage-rates'], body: 'Primary pupils, younger siblings of family friends, EAL students at your own school. It is the least glamorous route on this list and the one most likely to actually happen while you are still in Year 12.', honest: 'This is unstructured and you have to find the work yourself. What the certificate does here is give a parent a reason to pick you over another sixth former.', sc: { money: 3, travel: 0, cv: 3, people: 4 }, struct: 'low' },
    { name: 'Teaching English online', when: 'now', age: 'Cambly requires you to be at least 18', ageSrc: ['Cambly tutor requirements', 'https://studentsupport.cambly.com/hc/en-us/articles/44522545417485-Applying-to-become-a-tutor'], degree: 'Not required', pay: 'Cambly publishes $0.17 a minute, which is $10.20 an hour, and $12.00 an hour on Cambly Kids', paySrc: ['Cambly, become a tutor', 'https://www.cambly.com/english/tutors'], body: 'The first paid teaching most people do. You take booked conversation sessions from your own desk, at hours that suit a student in another time zone, and you build up hours you can point to later.', honest: 'Cambly says no certificate is needed, so the qualification is not what gets you in. It is what lets you charge more elsewhere and what makes the first lesson far less frightening.', sc: { money: 4, travel: 0, cv: 3, people: 3 }, struct: 'low' },
    { name: 'British Council English Language Assistant', when: 'gap', age: 'You must be 18 or over when applications close', ageSrc: ['British Council eligibility', 'https://www.britishcouncil.org/study-work-abroad/outside-uk/english-language-assistants/eligibility'], degree: 'Not required. The stated minimum is A level, Scottish Highers or the IB', degreeSrc: ['British Council eligibility', 'https://www.britishcouncil.org/study-work-abroad/outside-uk/english-language-assistants/eligibility'], pay: 'In Spain the monthly allowance is €800 in most regions, €935 in Extremadura and Galicia and €1,000 in Madrid, for 14 to 16 hours a week', paySrc: ['British Council, Spain', 'https://www.britishcouncil.org/study-work-abroad/outside-uk/english-language-assistants/destination-specific-information/spain'], body: 'The cleanest route abroad that does not need a degree. You are placed in a school overseas, supported, paid an allowance and treated as part of staff. Spanish posts run October to May.', honest: 'Destinations set their own rules. Austria, for example, wants you to be 20 to 35, or to have completed two years of a degree if you are 18 to 20. Check the country before you fall in love with it.', sc: { money: 3, travel: 5, cv: 5, people: 5 }, struct: 'high' },
    { name: 'A structured volunteer placement', when: 'gap', age: 'Project Trust takes volunteers aged 17 to 25', ageSrc: ['Project Trust', 'https://projecttrust.org.uk/'], degree: 'Not required', pay: 'Unpaid, and fundraising is part of the process', body: 'UK charities have been sending school leavers to teach overseas since long before TEFL was fashionable. Project Trust, founded in 1967, runs teaching and TESOL placements across Asia, Africa and Latin America.', honest: 'You raise the money rather than earn it, so this needs a year of planning and a family conversation. In exchange you get the longest and deepest placement available to someone your age.', sc: { money: 0, travel: 5, cv: 5, people: 5 }, struct: 'high' },
    { name: 'A working holiday visa', when: 'gap', age: 'Australia and New Zealand take UK citizens aged 18 to 35. Japan and Taiwan take 18 to 30', ageSrc: ['Immigration New Zealand', 'https://immigration.govt.nz/visas/united-kingdom-working-holiday-visa'], degree: 'Not required for the visa itself', pay: 'Varies entirely with the work you find', body: 'A year of living somewhere and taking work as you go. Australia opened to UK passport holders up to 35 in July 2023, and Japan now allows up to two years across two separate visits.', honest: 'Two warnings. Japan requires the work to be incidental to the holiday, and South Korea\u2019s youth visa states plainly that participants may not work as foreign language instructors, so it is not a teaching route at all.', honestSrc: ['Korean Ministry of Foreign Affairs', 'https://overseas.mofa.go.kr/gb-en/brd/m_20265/view.do?seq=679361'], sc: { money: 3, travel: 5, cv: 3, people: 3 }, struct: 'low' },
    { name: 'EPIK, teaching in South Korean state schools', when: 'after', age: 'No general age limit is published', degree: 'A bachelor\u2019s degree is required', degreeSrc: ['EPIK eligibility', 'https://www.epik.go.kr/web/epik/contents/Eligibility'], pay: 'Set by the programme by qualification band', body: 'One of the largest government run teaching schemes in the world. EPIK requires a TEFL, TESOL or CELTA of at least 100 hours unless you hold a teaching licence or an education degree.', honest: 'This is the clearest argument for doing the course at school. The 120 hours you complete at seventeen sit above EPIK\u2019s 100 hour minimum and are still valid when you graduate.', honestSrc: ['EPIK eligibility', 'https://www.epik.go.kr/web/epik/contents/Eligibility'], sc: { money: 4, travel: 5, cv: 5, people: 5 }, struct: 'high' },
    { name: 'Taiwan\u2019s government teaching programme', when: 'after', age: 'No age limit is published for the programme', degree: 'A bachelor\u2019s degree or above is required for both tracks', degreeSrc: ['TFETP eligibility', 'https://tfetp.k12ea.gov.tw/en/tfetp/web/eligibility'], pay: 'Foreign English Teachers earn NT$62,720 to NT$91,420 a month and teaching assistants receive an NT$45,000 stipend', paySrc: ['Taiwan Ministry of Education', 'https://depart.moe.edu.tw/LA/cp.aspx?n=A47D5B3502142BFD'], body: 'Taiwan recruits directly into its state schools. The teacher track accepts an approved 120 hour TESOL, TEFL or CELTA in place of a teaching licence, though distance learning is capped at two thirds of the hours.', honest: 'The degree is not negotiable, and the distance learning cap is worth reading carefully before you rely on an online certificate alone.', honestSrc: ['TFETP eligibility', 'https://tfetp.k12ea.gov.tw/en/tfetp/web/eligibility'], sc: { money: 5, travel: 5, cv: 5, people: 4 }, struct: 'high' },
    { name: 'The JET Programme in Japan', when: 'after', age: 'No age limit is published', degree: 'A bachelor\u2019s degree or higher is required by the arrival date', degreeSrc: ['JET Programme eligibility', 'https://jetprogramme.org/en/eligibility/'], pay: 'Set by the programme', body: 'Run by the Japanese government since 1987 and still the most competitive way in. Assistant language teachers are placed in schools across the country, including places tourists never see.', honest: 'A TEFL certificate is not listed as mandatory here, so treat it as something that strengthens an application rather than something that unlocks it.', sc: { money: 4, travel: 5, cv: 5, people: 5 }, struct: 'high' },
    { name: 'A work permit for China', when: 'after', age: 'Foreign talents should be 60 or younger', degree: 'A bachelor\u2019s degree or above plus two years of experience in language education', degreeSrc: ['Beijing Municipal Government', 'https://english.beijing.gov.cn/mostrequested/workpermit/noncreditbasedtalentsoutsideofchina/'], pay: 'Set by the employer', body: 'The rule here is the single best illustration of banking a qualification. A TEFL certificate exempts you from having to evidence the two years of experience, which is the barrier most graduates hit.', honest: 'It exempts you from the experience document only. The degree stays compulsory, so nobody is going at eighteen.', honestSrc: ['Beijing Municipal Government', 'https://english.beijing.gov.cn/mostrequested/workpermit/noncreditbasedtalentsoutsideofchina/'], sc: { money: 4, travel: 5, cv: 4, people: 4 }, struct: 'high' }
  ];

  var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
  var ORDINAL = ['one', 'two', 'three', 'four', 'five', 'six'];

  /* ------------------------------------------------------------------
   * Helpers
   * ---------------------------------------------------------------- */

  function $(s, r) { return (r || root).querySelector(s); }
  function $$(s, r) { return Array.prototype.slice.call((r || root).querySelectorAll(s)); }
  function esc(s) {
    return String(s == null ? '' : s).replace(/[&<>"']/g, function (c) {
      return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
    });
  }
  function bind(key, text) {
    $$('[data-bind="' + key + '"]').forEach(function (el) { el.textContent = text; });
  }
  function find(list, id) {
    for (var i = 0; i < list.length; i++) { if (list[i].id === id) { return list[i]; } }
    return list[0];
  }
  function clamp(v, a, b) { return Math.min(b, Math.max(a, v)); }
  function scrollToEl(el) {
    if (!el) { return; }
    var nav = $('.tfs2-subnav');
    var off = (nav ? nav.offsetHeight : 0) + 12 + (document.body.classList.contains('admin-bar') ? 32 : 0);
    var top = el.getBoundingClientRect().top + window.pageYOffset - off;
    window.scrollTo({ top: top, behavior: REDUCED ? 'auto' : 'smooth' });
  }

  /* ------------------------------------------------------------------
   * Shared state
   * ---------------------------------------------------------------- */

  var TIERS = (C.tiers && C.tiers.length) ? C.tiers : [{ min: 5, max: 14, price: 95 }, { min: 15, max: 29, price: 75 }, { min: 30, max: 49, price: 55 }];
  var FX = C.fx || { GBP: { r: 1, s: '£' }, EUR: { r: 1.17, s: '€' }, USD: { r: 1.27, s: '$' } };
  var P = C.planner || { years: [], slots: [], starts: [] };
  var BESPOKE = C.bespokeFrom || 50;
  var BASE = TIERS[0].price;

  var S = { n: 30, cur: 'GBP', year: 'y12', slot: 'hour', start: 'sep', lead: null };

  function priceFor(n) {
    for (var i = 0; i < TIERS.length; i++) { if (n >= TIERS[i].min && n <= TIERS[i].max) { return TIERS[i].price; } }
    return null;
  }
  function tierIndex(n) {
    for (var i = 0; i < TIERS.length; i++) { if (n >= TIERS[i].min && n <= TIERS[i].max) { return i; } }
    return -1;
  }
  function money(gbp, dp, cur) {
    var f = FX[cur || S.cur] || FX.GBP;
    return f.s + (gbp * f.r).toLocaleString('en-GB', { minimumFractionDigits: dp || 0, maximumFractionDigits: dp || 0 });
  }

  /* ------------------------------------------------------------------
   * Cost calculator and everything that follows cohort size
   * ---------------------------------------------------------------- */

  function renderCost() {
    var n = S.n, p = priceFor(n), ti = tierIndex(n);

    bind('n', String(n));
    $$('[data-tfs2-n]').forEach(function (r) { if (+r.value !== n) { r.value = n; } });

    bind('perStudent', p ? money(p) : 'Bespoke');
    bind('perLabel', p ? 'per student' : '');
    bind('tierName', p ? 'Tier ' + ORDINAL[ti] + ', ' + TIERS[ti].min + ' to ' + TIERS[ti].max + ' students' : BESPOKE + ' or more students');
    bind('curNote', S.cur === 'GBP' ? 'we invoice in pounds sterling' : 'approximate, we invoice in pounds sterling');
    bind('total', p ? money(p * n) : 'Bespoke');

    var tiers = $('[data-tfs2-tiers]');
    if (tiers) {
      var html = TIERS.map(function (t, i) {
        return '<div class="tfs2-tiers__row' + (i === ti ? ' is-on' : '') + '"><span>' + t.min + ' to ' + t.max + ' students</span><span>' + esc(money(t.price)) + ' each</span></div>';
      }).join('');
      html += '<div class="tfs2-tiers__row' + (ti < 0 ? ' is-on' : '') + '"><span>' + BESPOKE + ' or more students</span><span>Talk to Chloe</span></div>';
      tiers.innerHTML = html;
    }

    var rows = $('[data-tfs2-costrows]');
    if (rows) {
      var r = [['Students', String(n)]];
      if (p) {
        r.push(['Total for the group', money(p * n)]);
        r.push(['Cost per guided learning hour', money(p / 120, 2)]);
        r.push(['Against the smallest cohort rate', p === BASE ? 'Base rate' : 'Save ' + money((BASE - p) * n)]);
      }
      rows.innerHTML = r.map(function (x) { return '<div><dt>' + esc(x[0]) + '</dt><dd>' + esc(x[1]) + '</dd></div>'; }).join('');
    }

    var next = '';
    if (ti >= 0 && ti < TIERS.length - 1) {
      var nt = TIERS[ti + 1], more = nt.min - n;
      next = 'Add <b>' + more + ' more student' + (more === 1 ? '' : 's') + '</b> and the price drops to <b>' + esc(money(nt.price)) + ' each</b>.';
    } else if (ti === TIERS.length - 1) {
      var m2 = BESPOKE - n;
      next = 'Add <b>' + m2 + ' more student' + (m2 === 1 ? '' : 's') + '</b> and the cohort moves off the published table into bespoke pricing.';
    } else {
      next = 'At ' + BESPOKE + ' or more, Chloe prices the cohort individually.';
    }
    var nx = $('[data-bind="nextTier"]');
    if (nx) { nx.innerHTML = next; }

    bind('stickyPrice', p ? money(p) + ' per student' : 'Bespoke pricing');
    bind('stickySub', 'for ' + n + ' students');
  }

  $$('[data-tfs2-n]').forEach(function (r) {
    r.addEventListener('input', function () {
      S.n = clamp(parseInt(r.value, 10) || 30, 5, 60);
      renderCost();
      hidePlan();
    });
  });
  $$('input[name="tfs2-cur"]').forEach(function (r) {
    r.addEventListener('change', function () { if (r.checked) { S.cur = r.value; renderCost(); } });
  });

  /* ------------------------------------------------------------------
   * Week grid (follows the slot chosen in the planner)
   * ---------------------------------------------------------------- */

  function renderWeek() {
    var grid = $('[data-tfs2-week]');
    if (!grid) { return; }
    var days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
    var periods = ['Reg', 'P1', 'P2', 'P3', 'P4', 'P5', 'P6'];
    grid.innerHTML = days.map(function (day, di) {
      var blocks = periods.map(function (pp, pi) {
        var hit = (S.slot === 'reg' && di === 0 && pi === 0) || (S.slot === 'hour' && di === 2 && pi === 6) || (S.slot === 'two' && di === 2 && pi >= 5);
        return '<span class="tfs2-week__b' + (pi === 0 ? ' is-reg' : '') + (hit ? ' is-on' : '') + '">' + (hit ? 'TEFL' : pp) + '</span>';
      }).join('');
      return '<div class="tfs2-week__day"><span class="tfs2-week__dname">' + day + '</span>' + blocks +
        '<span class="tfs2-week__b is-eve' + (S.slot === 'home' ? ' is-on' : '') + '">Evening · self paced</span></div>';
    }).join('');
    var slot = find(P.slots, S.slot);
    bind('weekCaption', S.slot === 'home'
      ? 'No school time at all. Students study in the evenings and staff watch the dashboard.'
      : slot.label + ' in school, the rest carried by students in their own time.');
  }

  function renderPlannerLabels() {
    bind('yearLabel', find(P.years, S.year).label);
    bind('startLabel', find(P.starts, S.start).label);
  }

  /* ------------------------------------------------------------------
   * Dialogs
   * ---------------------------------------------------------------- */

  var openModal = null, lastFocus = null;

  function focusables(box) {
    return $$('a[href],button:not([disabled]),input:not([disabled]):not([type="hidden"]),select,textarea,iframe,[tabindex]:not([tabindex="-1"])', box)
      .filter(function (el) { return el.offsetParent !== null || el.tagName === 'IFRAME'; });
  }

  function showModal(name) {
    var m = $('[data-tfs2-modal="' + name + '"]');
    if (!m) { return; }
    if (openModal) { hideModal(); }
    lastFocus = document.activeElement;
    m.hidden = false;
    openModal = m;
    document.documentElement.classList.add('tfs2-lock');
    var x = $('[data-tfs2-close]', m);
    if (x) { x.focus(); }
    updatePill();
  }

  function hideModal() {
    if (!openModal) { return; }
    openModal.hidden = true;
    openModal = null;
    document.documentElement.classList.remove('tfs2-lock');
    if (lastFocus && lastFocus.focus) { lastFocus.focus(); }
    updatePill();
  }

  $$('[data-tfs2-modal]').forEach(function (m) {
    m.addEventListener('click', function (e) { if (e.target === m) { hideModal(); } });
    $$('[data-tfs2-close]', m).forEach(function (b) { b.addEventListener('click', hideModal); });
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      if (openModal) { hideModal(); }
      closeJump();
    }
    if (e.key === 'Tab' && openModal) {
      var f = focusables(openModal);
      if (!f.length) { return; }
      var first = f[0], last = f[f.length - 1];
      if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
      else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
    }
  });

  /* Booking links are handled by Dlopo's own embed script (embed.js). */

  /* ------------------------------------------------------------------
   * Jump menu and in-page links
   * ---------------------------------------------------------------- */

  var jumpBtn = $('.tfs2-jump__btn'), jumpMenu = $('#tfs2-jump-menu');

  function closeJump() {
    if (jumpBtn && jumpMenu && !jumpMenu.hidden) {
      jumpMenu.hidden = true;
      jumpBtn.setAttribute('aria-expanded', 'false');
    }
  }
  if (jumpBtn && jumpMenu) {
    jumpBtn.addEventListener('click', function (e) {
      e.stopPropagation();
      var open = jumpMenu.hidden;
      jumpMenu.hidden = !open;
      jumpBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
      if (open) { var first = $('a', jumpMenu); if (first) { first.focus(); } }
    });
    document.addEventListener('click', function (e) { if (!e.target.closest('.tfs2-jump')) { closeJump(); } });
  }

  root.addEventListener('click', function (e) {
    var a = e.target.closest('a[href^="#"]');
    if (!a || !root.contains(a)) { return; }
    var id = a.getAttribute('href').slice(1);
    var el = id && document.getElementById(id);
    if (!el) { return; }
    e.preventDefault();
    closeJump();
    if (openModal) { hideModal(); }
    scrollToEl(el);
    if (history.replaceState) { history.replaceState(null, '', '#' + id); }
    /* Request a quote / Put this in writing: land in the hero form, cursor in the first field. */
    if (id === 'letsTalkTEFL') {
      var field = el.querySelector('input:not([type="hidden"]):not([type="submit"]), select, textarea');
      if (field) { setTimeout(function () { field.focus({ preventScroll: true }); }, REDUCED ? 0 : 600); }
    }
  });

  /* ------------------------------------------------------------------
   * Chloe's note
   * ---------------------------------------------------------------- */

  var noteBtn = $('.tfs2-note__toggle'), noteBody = $('#tfs2-note-body');
  if (noteBtn && noteBody) {
    if (noteBody.scrollHeight <= 260) {
      noteBody.setAttribute('data-collapsed', 'false');
      noteBtn.hidden = true;
    }
    noteBtn.addEventListener('click', function () {
      var open = noteBtn.getAttribute('aria-expanded') !== 'true';
      noteBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
      noteBody.setAttribute('data-collapsed', open ? 'false' : 'true');
      $('span', noteBtn).textContent = open ? 'Read less' : 'Read more';
    });
  }

  /* ------------------------------------------------------------------
   * Planner: lead gate, dialog, plan
   * ---------------------------------------------------------------- */

  function post(data) {
    var fd = new FormData();
    fd.append('action', 'tfs2_planner');
    fd.append('page', C.page || root.getAttribute('data-page') || '');
    Object.keys(data).forEach(function (k) { fd.append(k, data[k]); });
    return fetch(C.ajax, { method: 'POST', body: fd, credentials: 'same-origin' })
      .then(function (r) { return r.json(); })
      .catch(function () { return { success: false }; });
  }

  var gate = $('[data-tfs2-gate]');
  if (gate) {
    gate.addEventListener('submit', function (e) {
      e.preventDefault();
      var err = $('[data-tfs2-gate-error]', gate);
      var nameI = gate.elements.name, mailI = gate.elements.email;
      var nm = nameI.value.trim(), em = mailI.value.trim();
      nameI.removeAttribute('aria-invalid');
      mailI.removeAttribute('aria-invalid');
      function fail(msg, el) { err.textContent = msg; err.hidden = false; el.setAttribute('aria-invalid', 'true'); el.focus(); }
      if (!nm) { return fail('Please add your name.', nameI); }
      if (!/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(em)) { return fail('Please add a valid email address.', mailI); }
      err.hidden = true;
      S.lead = { name: nm, email: em, website: gate.elements.website ? gate.elements.website.value : '' };
      bind('leadName', nm);
      post({ stage: 'lead', name: nm, email: em, website: S.lead.website });
      showModal('planner');
    });
  }

  var planner = $('[data-tfs2-planner]');

  function hidePlan() {
    var p = $('[data-tfs2-plan]');
    if (p) { p.hidden = true; }
  }

  function buildPlan() {
    var n = S.n, p = priceFor(n);
    var year = find(P.years, S.year), slot = find(P.slots, S.slot), start = find(P.starts, S.start);
    var home = Math.max(0, 120 / 26 - slot.h);
    var inSchool = slot.h ? slot.label.replace(/^One /, 'one ').replace(/^A /, 'a ') + ' a week' : 'none';
    var when = start.label.replace('Post exam season', 'after exams').replace('After Easter', 'after Easter');
    return {
      title: 'Plan for ' + n + ' ' + year.label + ' students, starting ' + when,
      rows: [
        ['In school', inSchool],
        ['Self paced, in their own time', 'about ' + home.toFixed(1) + ' hours a week'],
        ['Access runs until', 'end of ' + MONTHS[(start.m + 6) % 12]],
        ['Staff time', 'one member of staff on the dashboard'],
        ['Per student', p ? money(p) : 'bespoke'],
        ['Total for the group', p ? money(p * n) : 'talk to Chloe']
      ]
    };
  }

  if (planner) {
    $$('input[type="radio"]', planner).forEach(function (r) {
      r.addEventListener('change', function () {
        if (!r.checked) { return; }
        S[r.name] = r.value;
        hidePlan();
        renderWeek();
        renderPlannerLabels();
      });
    });

    planner.addEventListener('submit', function (e) {
      e.preventDefault();
      var plan = buildPlan();
      bind('planTitle', plan.title);
      $('[data-tfs2-planrows]', planner).innerHTML = plan.rows.map(function (r) {
        return '<div><dt>' + esc(r[0]) + '</dt><dd>' + esc(r[1]) + '</dd></div>';
      }).join('');
      var box = $('[data-tfs2-plan]', planner);
      box.hidden = false;
      var sent = $('[data-tfs2-plan-sent]', planner);
      sent.textContent = '';
      if (S.lead) {
        sent.textContent = 'Sending a copy to ' + S.lead.email + '…';
        post({ stage: 'plan', name: S.lead.name, email: S.lead.email, website: S.lead.website, year: S.year, slot: S.slot, start: S.start, n: S.n })
          .then(function (res) {
            sent.textContent = (res && res.success && res.data && res.data.sent)
              ? 'A copy is on its way to ' + S.lead.email + '.'
              : 'We could not email a copy just now. You can still print it.';
          });
      }
      box.scrollIntoView({ behavior: REDUCED ? 'auto' : 'smooth', block: 'nearest' });
    });

    var pr = $('[data-tfs2-print]', planner);
    if (pr) {
      pr.addEventListener('click', function () {
        document.documentElement.classList.add('tfs2-printing');
        window.print();
        setTimeout(function () { document.documentElement.classList.remove('tfs2-printing'); }, 500);
      });
    }
  }

  /* ------------------------------------------------------------------
   * Where could this take you
   * ---------------------------------------------------------------- */

  var routesForm = $('[data-tfs2-routes]');
  if (routesForm) {
    var WHEN = ['now', 'gap', 'after'], WANT = ['money', 'travel', 'cv', 'people'], STRUCT = ['high', 'low'];
    var ORDER = { now: 0, gap: 1, after: 2 };
    var TAG = { now: ['', 'Open to you now'], gap: ['is-later', 'From eighteen, after school'], after: ['is-later', 'Once you have a degree'] };
    var out = $('[data-tfs2-matches]', routesForm);

    function src(pair) {
      return pair ? ' <a href="' + esc(pair[1]) + '" target="_blank" rel="noopener">' + esc(pair[0]) + '</a>' : '';
    }
    function radio(name) { var r = routesForm.querySelector('input[name="' + name + '"]:checked'); return r ? +r.value : 0; }

    routesForm.addEventListener('change', function () { out.hidden = true; });

    routesForm.addEventListener('submit', function (e) {
      e.preventDefault();
      var when = WHEN[radio('when')], want = WANT[radio('want')], struct = STRUCT[radio('struct')];
      var ranked = ROUTES.map(function (r) {
        var s = 0;
        if (r.when === when) { s += 9; } else if (Math.abs(ORDER[r.when] - ORDER[when]) === 1) { s += 5; }
        s += (r.sc[want] || 0) * 1.6;
        if (r.struct === struct) { s += 2.5; }
        return { r: r, s: s };
      }).sort(function (a, b) { return b.s - a.s; });

      /* Keep at least one route that is open in the window they asked about. */
      var top = ranked.slice(0, 3);
      if (!top.some(function (m) { return m.r.when === when; })) {
        var best = ranked.filter(function (m) { return m.r.when === when; })[0];
        if (best) { top[2] = best; }
      }

      out.innerHTML =
        '<h3 class="tfs2-matches__title">Three routes worth looking at</h3>' +
        '<p class="tfs2-small tfs2-muted">Ranked for what you told us. Every age rule and pay figure links to the organisation that published it, so you can check it yourself.</p>' +
        '<div class="tfs2-matches__grid">' + top.map(function (m, i) {
          var r = m.r, t = TAG[r.when];
          return '<article class="tfs2-match"><div class="tfs2-match__top">' +
            '<span class="tfs2-match__rank">' + (i + 1) + '</span>' +
            '<h4 class="tfs2-match__name">' + esc(r.name) + '</h4>' +
            '<span class="tfs2-match__tag ' + t[0] + '">' + esc(t[1]) + '</span></div>' +
            '<div class="tfs2-match__body"><p>' + esc(r.body) + '</p>' +
            '<p class="tfs2-match__line"><strong>Age</strong>' + esc(r.age) + '.' + src(r.ageSrc) + '</p>' +
            '<p class="tfs2-match__line"><strong>Degree</strong>' + esc(r.degree) + '.' + src(r.degreeSrc) + '</p>' +
            '<p class="tfs2-match__line"><strong>Pay</strong>' + esc(r.pay) + '.' + src(r.paySrc) + '</p>' +
            '<p class="tfs2-match__honest">' + esc(r.honest) + src(r.honestSrc) + '</p></div></article>';
        }).join('') + '</div>' +
        '<p class="tfs2-matches__foot">One rule holds across almost all of it. Paid English teaching abroad starts at eighteen, and a great many countries also require a degree for the visa. The certificate does not change either of those. What it changes is what you can do the day you clear them.</p>';
      out.hidden = false;
      scrollToEl(out);
    });
  }

  /* ------------------------------------------------------------------
   * Sixty second taster
   * ---------------------------------------------------------------- */

  var quiz = $('[data-tfs2-quiz]');
  if (quiz) {
    var qi = 0, score = 0, picked = null;

    function prog() {
      return '<div class="tfs2-quiz__prog" aria-hidden="true">' + QUIZ.map(function (_, i) {
        return '<i class="' + (i < qi ? 'is-done' : i === qi ? 'is-now' : '') + '"></i>';
      }).join('') + '</div>';
    }

    function drawQ(focus) {
      var q = QUIZ[qi];
      picked = null;
      quiz.innerHTML = prog() +
        '<p class="tfs2-quiz__count">Question ' + (qi + 1) + ' of ' + QUIZ.length + '</p>' +
        '<h4 class="tfs2-quiz__q" tabindex="-1">' + esc(q.q) + '</h4>' +
        '<p class="tfs2-quiz__note">' + esc(q.note) + '</p>' +
        '<div class="tfs2-quiz__opts">' + q.o.map(function (t, i) {
          return '<button type="button" class="tfs2-opt" data-i="' + i + '"><span class="tfs2-opt__k">' + 'ABCD'.charAt(i) + '</span><span>' + esc(t) + '</span></button>';
        }).join('') + '</div><div data-fb></div>';
      if (focus) { $('.tfs2-quiz__q', quiz).focus(); }
    }

    function answer(i) {
      if (picked !== null) { return; }
      var q = QUIZ[qi];
      picked = i;
      if (i === q.a) { score++; }
      $$('.tfs2-opt', quiz).forEach(function (b, k) {
        b.disabled = true;
        if (k === q.a) { b.classList.add('is-right'); } else if (k === i) { b.classList.add('is-wrong'); }
      });
      var last = qi === QUIZ.length - 1;
      $('[data-fb]', quiz).outerHTML =
        '<div class="tfs2-quiz__fb"><p><strong>' + (i === q.a ? 'Right.' : 'Not quite.') + '</strong> ' + esc(q.why) + '</p>' +
        '<button type="button" class="tfs2-btn tfs2-btn--navy tfs2-btn--xs tfs2-self-start" data-next>' + (last ? 'See your score' : 'Next question') + '</button></div>';
      $('[data-next]', quiz).focus();
    }

    function drawDone() {
      qi = QUIZ.length;
      quiz.innerHTML = prog() +
        '<div class="tfs2-quiz__done"><p class="tfs2-quiz__score" tabindex="-1">' + score + ' of ' + QUIZ.length + '</p>' +
        '<p class="tfs2-muted">The full course works through these decisions across ten modules, each ending in a quiz you can retake.</p>' +
        '<button type="button" class="tfs2-btn tfs2-btn--ghost tfs2-btn--xs" data-again>Try again</button></div>';
      $('.tfs2-quiz__score', quiz).focus();
    }

    quiz.addEventListener('click', function (e) {
      var opt = e.target.closest('.tfs2-opt');
      if (opt) { answer(+opt.getAttribute('data-i')); return; }
      if (e.target.closest('[data-next]')) {
        if (qi === QUIZ.length - 1) { drawDone(); } else { qi++; drawQ(true); }
        return;
      }
      if (e.target.closest('[data-again]')) { qi = 0; score = 0; drawQ(true); }
    });

    drawQ(false);
  }

  /* ------------------------------------------------------------------
   * FAQ accordion
   * ---------------------------------------------------------------- */

  $$('.tfs2-faq__btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var open = btn.getAttribute('aria-expanded') === 'true';
      $$('.tfs2-faq__btn').forEach(function (b) {
        b.setAttribute('aria-expanded', 'false');
        var p = document.getElementById(b.getAttribute('aria-controls'));
        if (p) { p.hidden = true; }
      });
      if (!open) {
        btn.setAttribute('aria-expanded', 'true');
        var panel = document.getElementById(btn.getAttribute('aria-controls'));
        if (panel) { panel.hidden = false; }
      }
    });
  });

  /* ------------------------------------------------------------------
   * Period Six signup (MailerLite)
   * ---------------------------------------------------------------- */

  var p6 = $('[data-tfs2-p6]');
  if (p6) {
    var msg = $('[data-tfs2-p6-msg]');
    p6.addEventListener('submit', function (e) {
      e.preventDefault();
      var nm = p6.elements.name.value.trim(), em = p6.elements.email.value.trim();
      msg.classList.remove('is-error');
      if (!nm) { msg.textContent = 'Please add your first name.'; msg.classList.add('is-error'); p6.elements.name.focus(); return; }
      if (!/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(em)) { msg.textContent = 'That email address does not look right. Please check it.'; msg.classList.add('is-error'); p6.elements.email.focus(); return; }
      var btn = $('button', p6), label = btn.textContent;
      btn.disabled = true; btn.textContent = 'Sending';
      var fd = new FormData();
      fd.append('fields[email]', em);
      fd.append('fields[name]', nm);
      fd.append('ml-submit', '1');
      fd.append('anticsrf', 'true');
      fetch(C.p6Endpoint, { method: 'POST', body: fd })
        .then(function (r) { return r.json(); })
        .then(function (d) {
          if (d && d.success) {
            p6.hidden = true;
            msg.textContent = 'You are on the list. The next edition goes out on the first Tuesday of the month.';
          } else { throw new Error('ml'); }
        })
        .catch(function () {
          btn.disabled = false; btn.textContent = label;
          msg.textContent = 'That did not go through. Please try again in a moment.';
          msg.classList.add('is-error');
        });
    });
  }

  /* ------------------------------------------------------------------
   * Carousels: the hero photo carousel and the testimonial carousel.
   * Works with any number of slides per view (one photo, or two
   * testimonial cards on desktop and one on mobile). Swipe or scroll on
   * touch, arrows and dots everywhere. Auto-advances unless reduced
   * motion is on; pauses on hover, focus, touch, when off screen, and
   * from the pause button.
   * ---------------------------------------------------------------- */

  $$('[data-tfs2-carousel]').forEach(function (c) {
    var track = $('[data-tfs2-carousel-track]', c);
    var slides = track ? $$('[data-tfs2-slide]', track) : [];
    if (slides.length < 2) { c.classList.add('is-static'); return; }

    var dotsW = $('[data-tfs2-carousel-dots]', c);
    var pauseBtn = $('[data-tfs2-carousel-pause]', c);
    var prev = $('[data-tfs2-carousel-prev]', c), next = $('[data-tfs2-carousel-next]', c);
    var every = parseInt(c.getAttribute('data-interval'), 10) || 6000;
    var idx = 0, pages = 1, dots = [], timer = null, hold = false, stopped = REDUCED, settle;

    function stepW() { return (slides[1].offsetLeft - slides[0].offsetLeft) || track.clientWidth; }
    function maxLeft() { return Math.max(0, track.scrollWidth - track.clientWidth); }
    function leftFor(i) { return Math.min(i * stepW(), maxLeft()); }

    function mark(i) {
      idx = i;
      dots.forEach(function (d, k) {
        d.classList.toggle('is-on', k === i);
        if (k === i) { d.setAttribute('aria-current', 'true'); } else { d.removeAttribute('aria-current'); }
      });
      var l = leftFor(i), r = l + track.clientWidth;
      slides.forEach(function (s) {
        var shown = s.offsetLeft >= l - 2 && s.offsetLeft + s.offsetWidth <= r + 2;
        s.setAttribute('aria-hidden', shown ? 'false' : 'true');
      });
    }

    function build() {
      pages = Math.max(1, Math.round(maxLeft() / stepW()) + 1);
      c.classList.toggle('is-static', pages < 2);
      if (dotsW) {
        var html = '';
        for (var i = 0; i < pages; i++) {
          html += '<button type="button" class="tfs2-car__dot" data-i="' + i + '" aria-label="Show ' + (i + 1) + ' of ' + pages + '"></button>';
        }
        dotsW.innerHTML = html;
        dots = $$('.tfs2-car__dot', dotsW);
      }
      if (idx > pages - 1) { idx = pages - 1; }
      track.scrollTo({ left: leftFor(idx), behavior: 'auto' });
      mark(idx);
    }

    function go(i, byUser) {
      if (pages < 2) { return; }
      i = (i + pages) % pages;
      track.scrollTo({ left: leftFor(i), behavior: REDUCED ? 'auto' : 'smooth' });
      mark(i);
      if (byUser) { restart(); }
    }

    function tick() {
      if (stopped || hold || document.hidden || pages < 2 || !inView(c)) { return; }
      go(idx + 1);
    }
    function restart() {
      clearInterval(timer);
      if (!stopped) { timer = setInterval(tick, every); }
    }

    track.addEventListener('scroll', function () {
      clearTimeout(settle);
      settle = setTimeout(function () {
        var i = track.scrollLeft >= maxLeft() - 2 ? pages - 1 : clamp(Math.round(track.scrollLeft / stepW()), 0, pages - 1);
        if (i !== idx) { mark(i); }
      }, 90);
    }, { passive: true });

    if (dotsW) {
      dotsW.addEventListener('click', function (e) {
        var d = e.target.closest('.tfs2-car__dot');
        if (d) { go(+d.getAttribute('data-i'), true); }
      });
    }
    if (prev) { prev.addEventListener('click', function () { go(idx - 1, true); }); }
    if (next) { next.addEventListener('click', function () { go(idx + 1, true); }); }

    if (pauseBtn) {
      if (REDUCED) {
        pauseBtn.hidden = true;
      } else {
        pauseBtn.addEventListener('click', function () {
          stopped = !stopped;
          pauseBtn.classList.toggle('is-paused', stopped);
          pauseBtn.setAttribute('aria-label', stopped ? 'Play slideshow' : 'Pause slideshow');
          restart();
        });
      }
    }

    c.addEventListener('mouseenter', function () { hold = true; });
    c.addEventListener('mouseleave', function () { hold = false; });
    c.addEventListener('focusin', function () { hold = true; });
    c.addEventListener('focusout', function (e) { if (!c.contains(e.relatedTarget)) { hold = false; } });
    track.addEventListener('touchstart', function () { hold = true; }, { passive: true });
    track.addEventListener('touchend', function () { hold = false; restart(); }, { passive: true });

    /* Slides per view change with the screen width, so rebuild the dots. */
    var rt;
    window.addEventListener('resize', function () { clearTimeout(rt); rt = setTimeout(build, 150); });
    if (document.fonts && document.fonts.ready) { document.fonts.ready.then(build); }

    build();
    restart();
  });

  /* ------------------------------------------------------------------
   * Programme: pinned horizontal scroll on desktop, swipe on mobile
   * ---------------------------------------------------------------- */

  var prog = $('[data-tfs2-prog]'), track = $('[data-tfs2-track]');
  var mods = track ? $$('.tfs2-mod:not(.tfs2-mod--end)', track) : [];
  var modBar = $('[data-tfs2-modbar]'), modNum = $('[data-tfs2-modnum]');
  var pinMQ = window.matchMedia ? window.matchMedia('(min-width: 901px)') : { matches: true };
  var pinned = false, dist = 0, modI = 0;

  function setMod(i) {
    if (i === modI && mods[i] && mods[i].classList.contains('is-on')) { return; }
    modI = i;
    mods.forEach(function (m, k) {
      m.classList.toggle('is-on', k === i);
      m.classList.toggle('is-past', k < i);
    });
    if (modNum) { modNum.textContent = (i + 1 < 10 ? '0' : '') + (i + 1); }
  }

  function sizeProg() {
    if (!prog || !track) { return; }
    var want = pinMQ.matches && !REDUCED;
    if (want !== pinned) {
      pinned = want;
      prog.classList.toggle('is-pinned', pinned);
      track.style.transform = '';
      prog.style.height = '';
    }
    if (pinned) {
      dist = Math.max(0, track.scrollWidth - track.parentElement.clientWidth);
      prog.style.height = Math.round(window.innerHeight + dist) + 'px';
    }
    onProg();
  }

  function onProg() {
    if (!prog || !track) { return; }
    if (pinned) {
      var total = prog.offsetHeight - window.innerHeight;
      var p = total > 0 ? clamp(-prog.getBoundingClientRect().top / total, 0, 1) : 0;
      track.style.transform = 'translate3d(' + (-dist * p) + 'px,0,0)';
      if (modBar) { modBar.style.width = (10 + p * 90) + '%'; }
      setMod(Math.min(mods.length - 1, Math.round(p * (mods.length - 1))));
    }
  }

  if (track) {
    track.addEventListener('scroll', function () {
      if (pinned || !mods.length) { return; }
      var w = mods[0].offsetWidth + 20;
      setMod(clamp(Math.round(track.scrollLeft / w), 0, mods.length - 1));
    }, { passive: true });
    if (pinMQ.addEventListener) { pinMQ.addEventListener('change', sizeProg); }
  }

  /* ------------------------------------------------------------------
   * How it works: the step nearest the middle of the screen drives the
   * picture on the right (desktop only; on mobile the picture is hidden).
   * ---------------------------------------------------------------- */

  var story = $('[data-tfs2-story]');
  var steps = story ? $$('.tfs2-step', story) : [];
  var layers = story ? $$('.tfs2-layer', story) : [];
  var dots = story ? $$('.tfs2-story__dots i', story) : [];
  var step = 0;

  function setStep(i) {
    step = i;
    steps.forEach(function (s, k) { s.classList.toggle('is-on', k === i); s.classList.toggle('is-done', k <= i); });
    layers.forEach(function (l, k) { l.classList.toggle('is-on', k === i); l.classList.toggle('is-before', k < i); });
    dots.forEach(function (d, k) { d.classList.toggle('is-on', k === i); });
    bind('stepLabel', 'Step ' + (i + 1) + ' of ' + steps.length);
  }

  function onStory() {
    if (!steps.length || !pinMQ.matches) { return; }
    var best = 0, bd = 1e9, mid = window.innerHeight / 2;
    steps.forEach(function (el, i) {
      var r = el.getBoundingClientRect();
      var d = Math.abs(r.top + r.height / 2 - mid);
      if (d < bd) { bd = d; best = i; }
    });
    if (best !== step) { setStep(best); }
  }

  steps.forEach(function (el) {
    el.addEventListener('click', function () {
      if (!pinMQ.matches) { return; }
      var top = el.getBoundingClientRect().top + window.pageYOffset - window.innerHeight / 2 + el.offsetHeight / 2;
      window.scrollTo({ top: top, behavior: REDUCED ? 'auto' : 'smooth' });
    });
  });

  /* ------------------------------------------------------------------
   * Sticky price pill
   * ---------------------------------------------------------------- */

  var pill = $('[data-tfs2-pill]');
  var costSec = document.getElementById('cost'), quoteSec = document.getElementById('quote');

  function inView(el) {
    if (!el) { return false; }
    var r = el.getBoundingClientRect();
    return r.top < window.innerHeight && r.bottom > 0;
  }

  function updatePill() {
    if (!pill) { return; }
    var on = !openModal && window.pageYOffset > 800 && !inView(costSec) && !inView(quoteSec);
    if (on !== pill.classList.contains('is-on')) {
      pill.classList.toggle('is-on', on);
      pill.setAttribute('aria-hidden', on ? 'false' : 'true');
      var a = $('a', pill);
      if (a) { a.tabIndex = on ? 0 : -1; }
    }
  }

  /* ------------------------------------------------------------------
   * One scroll loop for everything that follows the scroll position
   * ---------------------------------------------------------------- */

  var ticking = false;
  function onScroll() {
    if (ticking) { return; }
    ticking = true;
    window.requestAnimationFrame(function () {
      ticking = false;
      onProg();
      onStory();
      updatePill();
    });
  }
  window.addEventListener('scroll', onScroll, { passive: true });

  var resizeT;
  window.addEventListener('resize', function () {
    clearTimeout(resizeT);
    resizeT = setTimeout(sizeProg, 120);
  });

  /* ------------------------------------------------------------------
   * Boot
   * ---------------------------------------------------------------- */

  renderCost();
  renderWeek();
  renderPlannerLabels();
  sizeProg();
  setTimeout(sizeProg, 600);           /* again once fonts have settled */
  if (document.fonts && document.fonts.ready) { document.fonts.ready.then(sizeProg); }
  onScroll();

  /* Arriving with a #hash: land below the sticky bar. */
  if (location.hash) {
    var target = document.getElementById(location.hash.slice(1));
    if (target && root.contains(target)) { setTimeout(function () { scrollToEl(target); }, 50); }
  }
})();