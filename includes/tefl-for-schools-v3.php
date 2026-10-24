<?php
/**
 * TEFL for Schools — page template v3 (functions)
 *
 * Loaded from functions.php. Goes with:
 *   ti-tefl-for-schools-v3.php                (the page template, theme root)
 *   assets/css/ti-tefl-for-schools-v3.css
 *   assets/js/ti-tefl-for-schools-v3.js
 *   assets/fonts/tefl-for-schools/            (self hosted Source Serif 4 + Montserrat)
 *   assets/images/tfs-chloe.jpg               (fallback photo)
 *   acf-tefl-for-schools-v3-images.json       (ACF import: carousel + image spaces)
 *
 * Contents: default copy, helpers, ACF field groups, structured data,
 * planner AJAX, and small hooks. Everything is prefixed tfs2_.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'TFS2_TEMPLATE', 'ti-tefl-for-schools-v3.php' );


/* =========================================================================
 * Default content
 * ====================================================================== */
/**
 * Every ACF field falls back to the value here when it has never been saved,
 * so the page renders in full the moment the template is assigned. Editors
 * then override any of it from the page edit screen.
 */
function tfs2_defaults() {
	static $d = null;
	if ( null !== $d ) {
		return $d;
	}

	$d = array(

		/* ---------- Sub navigation ---------- */
		'enroll_label' => 'Enroll Now',
		'enroll_url'   => 'https://teflinstitute.com/product/120-hour-elective-tefl-course/',
		'staff_url'    => '/tefl-for-schools/for-staff/',
		'students_url' => '/tefl-for-schools/for-students/',

		/* ---------- Hero ---------- */
		'hero_variant'        => 'form',
		'hero_eyebrow'        => 'The TEFL Institute · Schools and sixth forms',
		'hero_title'          => 'Teach your students to teach.',
		'hero_lede'           => 'A 120-Hours internationally recognised TEFL qualification that runs quietly alongside A levels. Students study at their own pace, you see their progress, and they finish sixth form with something on the CV that very few of their peers will have.',
		'hero_meta'           => 'Delivered online · Six months of access · Progress visible to staff throughout',
		'hero_image'          => '',
		'hero_talk_text'      => 'Prefer to talk first?',
		'hero_talk_label'     => 'Book a call with Chloe',
		'hero_form_title'     => 'Let\'s talk TEFL for your students',
		'hero_form_intro'     => 'Want to find out more or get a quote for your school? Just fill in the form below and we’ll get back to you within 1 working day.',
		'hero_form_shortcode' => '[contact-form-7 id="04f1bda" title="TEFL for Schools"]',
		'hero_form_note'      => 'We use your email to send the quote and nothing else.',
		'hero_buy_text'       => 'Buying for yourself?',
		'hero_buy_label'      => 'Buy TEFL for students',
		'hero_buy_url'        => 'https://teflinstitute.com/product/120-hour-elective-tefl-course/',

		/* ---------- Social proof carousel (hero, under the left text) ---------- */
		'proof_label'  => 'Schools running TEFL for Schools',
		'proof_slides' => array(
			array( 'image' => '', 'caption' => 'Very rewarding!', 'name' => 'Amy, Sacred Heart Secondary School' ),
			array( 'image' => '', 'caption' => 'Great qualification that allows you explore different cultures!', 'name' => 'Sinead, Beara Community School' ),
			array( 'image' => '', 'caption' => 'My experience was 10/10 on this course.', 'name' => 'Amy, Athlone Community College' ),
		),

		/* ---------- Image spaces (optional, one per section) ---------- */
		'outcomes_image' => '',
		'cost_image'     => '',
		'why_image'      => '',
		'planner_image'  => '',
		'routes_image'   => '',
		'taster_image'   => '',
		'faq_image'      => '',

		/* ---------- Stats and trust line (now under the outcomes) ---------- */
		'stats' => array(
			array( 'icon' => 'graduation-cap', 'number' => '161,000', 'label' => "Teachers certified\nsince 2017" ),
			array( 'icon' => 'map-pin',        'number' => '80',      'label' => "Countries our graduates\nhave taught in" ),
			array( 'icon' => 'clock',          'number' => '120',     'label' => "Guided hours\nacross ten modules" ),
			array( 'icon' => 'calendar-days',  'number' => '6',       'label' => "Months of access\nfrom the start date" ),
		),
		'trust' => array(
			array( 'icon' => 'award',        'text' => 'One of Europe\'s largest TEFL trainers by teachers certified' ),
			array( 'icon' => 'shield-check', 'text' => 'Externally accredited by the Online Teaching Course Accreditation Committee (UK)' ),
			array( 'icon' => 'badge-check',  'text' => '120 CPD credits accredited by The CPD Group' ),
		),

		/* ---------- Chloe ---------- */
		'chloe_photo'   => '',
		'chloe_name'    => 'Chloe',
		'chloe_role'    => 'Head of Schools and Partnerships, The TEFL Institute',
		'chloe_email'   => 'chloe@teflinstitute.com',
		'chloe_phone'   => '+353 58 73135',
		'booking_url'   => 'https://dlopo.com/chloe-joomun/intro-call',
		'note_title'    => 'A note from Chloe',
		'note_body'     => '<p>Hello, I\'m Chloe and I look after Schools and Partnerships.</p>
<p>I have the pleasure of working with Heads of Sixth Form, Enrichment and Careers teams to introduce opportunities beyond the classroom.</p>
<p>Sixth Forms are often interested in helping students to broaden their horizons and go beyond the curriculum, gaining experience of the outside world before university. Many also want to support UCAS applications and build strong CVs for next steps. TEFL is the perfect way to do that, all the while ticking off Gatsby Benchmark 4 (linking curriculum to careers) and Benchmark 7 (encounters with higher education and training).</p>
<p>We have built a 120-Hour TEFL qualification designed for Sixth Forms. It is completed online, at each student\'s own pace, fitting in nicely with enrichment or independent study slots. Progress is visible to you throughout, so students can build something worthwhile for their future without adding to anyone\'s workload, since we handle all delivery, assessment and tutoring.</p>
<p>If you\'d like to discuss TEFL for your Sixth Form or High School, get in touch. Let\'s talk TEFL and open the doors for your learners.</p>
<p>Warmest wishes,<br>Chloe</p>',

		/* ---------- Teacher or student ---------- */
		'who_title'             => 'Are you a teacher or a student?',
		'door_staff_eyebrow'    => 'For heads of sixth form',
		'door_staff_title'      => 'Bring it into your school',
		'door_staff_text'       => 'Timetable models, enrichment credit, what staff actually have to do, and how the four step sign up works from quote to first login.',
		'door_staff_link'       => 'Read the staff brief',
		'door_student_eyebrow'  => 'For students',
		'door_student_title'    => 'What it actually gets you',
		'door_student_text'     => 'An honest account of what a TEFL certificate lets you do at eighteen, what it unlocks later, and what it is worth putting in a personal statement.',
		'door_student_link'     => 'Read the student brief',

		/* ---------- Outcomes ---------- */
		'outcomes_eyebrow' => 'Student outcomes',
		'outcomes_title'   => 'What students finish with',
		'outcomes_intro'   => 'Everything below is in hand on the day they complete the tenth module.',
		'outcomes'         => array(
			array( 'icon' => 'award',       'title' => 'An internationally recognised certificate', 'text' => '120-Hours, externally accredited by the Online Teaching Course Accreditation Committee.' ),
			array( 'icon' => 'badge-check', 'title' => '120 CPD credits',                           'text' => 'Accredited by The CPD Group.' ),
			array( 'icon' => 'file-badge',  'title' => 'A personalised reference letter',           'text' => 'Written for the individual student, not a template.' ),
			array( 'icon' => 'check',       'title' => 'A record employers can verify',             'text' => 'Checked with us directly, long after they have left school.' ),
			array( 'icon' => 'laptop',      'title' => 'A route into paid online tutoring',         'text' => 'Which is unusual for a school age activity.' ),
			array( 'icon' => 'globe',       'title' => 'Something specific for a personal statement', 'text' => 'Lesson planning, grammar under pressure, adapting to a learner who is not following.' ),
		),

		/* ---------- Why ---------- */
		'why_title' => 'Why schools put it on the enrichment list',
		'why_cards' => array(
			array( 'title' => 'It is a real qualification, not an activity',       'text' => 'Students come away with an internationally recognised certificate, a personalised reference letter and a record employers can verify. It survives the gap between school and the first job in a way that a lunchtime club does not.' ),
			array( 'title' => 'It gives them something concrete to write about',   'text' => 'Lesson planning, grammar under pressure, adapting to a learner who is not following. Those are specific experiences a student can describe, which is exactly what admissions tutors ask for and what most applicants struggle to produce.' ),
			array( 'title' => 'It costs you almost no timetable',                  'text' => 'The course is self paced online with six months of access. Schools typically give it a weekly enrichment slot and let students carry the rest. Staff monitor progress from a dashboard rather than teaching content.' ),
		),
		'week_label' => 'A typical sixth-form week',
		'week_note'  => 'Follows the slot you pick in the planner',

		/* ---------- Cost ---------- */
		'cost_eyebrow'   => 'Interactive · For staff',
		'cost_title'     => 'What it costs per student',
		'cost_intro'     => 'Move the slider to your cohort size and you get the per student price and the total for the group. No form, no email gate, and the figure on screen is the figure we quote.',
		'cost_card_title'=> 'The cost per student calculator',
		'cost_card_text' => 'Pricing is tiered, so the per student figure comes down as the group grows.',
		'tiers'          => array(
			array( 'min' => 5,  'max' => 14, 'price' => 95 ),
			array( 'min' => 15, 'max' => 29, 'price' => 75 ),
			array( 'min' => 30, 'max' => 49, 'price' => 55 ),
		),
		'bespoke_from'   => 50,
		'fx_eur'         => 1.17,
		'fx_usd'         => 1.27,
		'vat_note'       => 'Prices exclude VAT where it applies. The quote we send is the price you pay.',

		/* ---------- Planner ---------- */
		'planner_eyebrow'    => 'Interactive · For staff',
		'planner_title'      => 'Will it fit your enrichment programme',
		'planner_intro'      => 'Tell it your year group, the slot you have and the size of the cohort. It returns a delivery plan you can take to a curriculum meeting.',
		'planner_card_title' => 'The enrichment fit planner',
		'planner_card_text'  => 'Four quick questions about your year group, slot, start date and cohort. Tell us where to send a copy and the planner opens.',
		'planner_privacy'    => 'We only use this to send your plan.',
		'planner_notify'     => 'chloe@teflinstitute.com',

		/* ---------- Routes ---------- */
		'routes_eyebrow'   => 'Interactive · For students',
		'routes_title'     => 'Where could this actually take you',
		'routes_intro'     => 'Most teach abroad routes want a degree, so we have split the answer into what you can do at eighteen and what the certificate banks for later. No sales pitch, just the rules as they stand.',
		'routes_card_title'=> 'Where could this take you',
		'routes_card_text' => 'Three routes matched to what you say you want, with the age and qualification rules attached to each.',

		/* ---------- Taster ---------- */
		'taster_eyebrow'   => 'Interactive · For students',
		'taster_title'     => 'Sixty seconds of the actual course',
		'taster_intro'     => 'Five questions taken from the grammar and classroom modules. Not a personality quiz. These are the kinds of decisions a teacher makes in front of a room.',
		'taster_card_title'=> 'The 60 second taster',
		'taster_card_text' => 'Get one wrong and you will still learn something. That is rather the point of the course.',

		/* ---------- Programme ---------- */
		'programme_eyebrow' => 'The programme',
		'programme_title'   => 'Ten modules, each ending in a quiz they can retake',
		'programme_intro'   => 'The full 120-Hours. Students move through in order, at whatever pace the school sets.',
		'modules'           => array(
			array( 'title' => 'Introduction to TEFL and the English Language', 'text' => '' ),
			array( 'title' => 'The Role of the Teacher',                       'text' => '' ),
			array( 'title' => 'Teaching Grammar',                              'text' => '' ),
			array( 'title' => 'Teaching Vocabulary',                           'text' => '' ),
			array( 'title' => 'Receptive Skills: listening and reading',       'text' => '' ),
			array( 'title' => 'Productive Skills: speaking and writing',       'text' => '' ),
			array( 'title' => 'Pronunciation and Phonology',                   'text' => '' ),
			array( 'title' => 'Lesson Planning',                               'text' => '' ),
			array( 'title' => 'Young Learners, Testing and Business English',  'text' => '' ),
			array( 'title' => 'From Course to Classroom',                      'text' => '' ),
		),
		'programme_end'      => 'Then the certificate.',
		'programme_receive'  => 'What students receive',
		'brochure_label'     => 'Request the brochure',
		'brochure_url'       => 'mailto:chloe@teflinstitute.com?subject=TEFL%20for%20Schools%20brochure',

		/* ---------- FAQ ---------- */
		'faq_title' => 'What schools ask us first',
		'faqs'      => array(
			array( 'question' => 'Does this take teaching time away from A levels', 'answer' => 'No. The course is self paced online with six months of access. Schools typically give it a weekly enrichment slot and let students carry the rest.' ),
			array( 'question' => 'Who administers it at our end',                  'answer' => 'One member of staff watching a progress dashboard. It is delivered online and marked by us, each student has a tutor, and there are weekly Zoom sessions.' ),
			array( 'question' => 'What if a student does not finish',              'answer' => 'They keep whatever they have completed and can carry on until their access runs out. Because the assessment is by module quiz rather than a single terminal exam, a student who gets to module seven still has seven modules of genuine work to talk about.' ),
			array( 'question' => 'Is there an age limit',                          'answer' => 'The course itself can be taken by sixth form students. What changes with age is what you can do with it afterwards. Paid teaching abroad almost always requires you to be eighteen, and a great many countries also require a degree for the work visa. The student pages are explicit about that so nobody is sold a false promise.' ),
			array( 'question' => 'How is it assessed',                             'answer' => 'Each of the ten modules ends in a quiz students can retake, and the work is marked by us.' ),
			array( 'question' => 'What does it cost',                              'answer' => '£95 per student for 5 to 14 students, £75 for 15 to 29 and £55 for 30 to 49. Above 50 we price the cohort individually. The calculator on this page shows the total for your group.' ),
			array( 'question' => 'Can parents pay directly instead of the school', 'answer' => 'Yes. Some schools run it as a funded enrichment strand, others put the course on the optional list and let families enrol using the school code at the school rate. Both work and we can set either up.' ),
			array( 'question' => 'What can we show an inspector',                  'answer' => 'An externally accredited qualification (Online Teaching Course Accreditation Committee), 120 CPD credits accredited by The CPD Group, and each student\'s progress record from the staff dashboard.' ),
		),

		/* ---------- Testimonials ---------- */
		'quotes_eyebrow' => 'From schools running it',
		'quotes_title'   => 'What students and schools say',
		'quotes'         => array(
			array( 'logo' => '', 'quote' => 'Very rewarding!', 'name' => 'Amy', 'role' => 'Sacred Heart Secondary School' ),
			array( 'logo' => '', 'quote' => 'Great qualification that allows you explore different cultures!', 'name' => 'Sinead', 'role' => 'Beara Community School' ),
			array( 'logo' => '', 'quote' => 'My experience was 10/10 on this course.', 'name' => 'Amy', 'role' => 'Athlone Community College' ),
		),

		/* ---------- US schools ---------- */
		'us_eyebrow' => 'For US high schools',
		'us_title'   => 'Running it in grades 11 and 12',
		'us_text'    => 'Interested in TEFL courses for your US cohort? We work with schools in the USA too. Get in touch to talk TEFL for Grades 11 and 12.',
		'us_label'   => 'Email Chloe about a US cohort',

		/* ---------- Period Six ---------- */
		'p6_eyebrow'  => 'Period Six',
		'p6_title'    => 'The enrichment briefing, once a month',
		'p6_text'     => 'One email on the first Tuesday of the month for heads of sixth form, enrichment and careers leads, and heads of department. Nothing in August, because nobody is in.',
		'p6_button'   => 'Get the next edition',
		'p6_fine'     => 'One email a month and you can unsubscribe in one click. We use your details to send Period Six and nothing else.',
		'p6_endpoint' => 'https://assets.mailerlite.com/jsonp/995100/forms/195312648998356029/subscribe',

		/* ---------- How it works ---------- */
		'steps_eyebrow' => 'How it works',
		'steps_title'   => 'From quote to first login',
		'steps_intro'   => 'Four steps between asking for a price and your students starting the course.',
		'steps'         => array(
			array( 'title' => 'Confirm the number of students and receive your quote', 'text' => 'We have secured preferential pricing for UK schools: just confirm the number of students you want to enroll and we\'ll send a quote.' ),
			array( 'title' => 'An advisor talks it through with you',                  'text' => 'Cohort size, timetable, who is administering it at your end.' ),
			array( 'title' => 'You get a registration code',                           'text' => 'Students enrol themselves online using the school code.' ),
			array( 'title' => 'Students get instant access',                           'text' => 'They start straight away and you can see progress from day one.' ),
		),

		/* ---------- Closing quote ---------- */
		'quote_title'  => 'Get a quote for your cohort',
		'quote_text'   => 'Pricing is tiered by the number of students, so the per student figure comes down as the group grows. Tell us the year group and rough numbers and we will come back with a written quote and a start date.',
		'quote_reply'  => 'We will reply with a written quote rather than a phone chase.',
		'quote_button' => 'Request a quote',
		'quote_url'    => 'mailto:chloe@teflinstitute.com?subject=TEFL%20for%20Schools%20quote',

		/* ---------- Guides (internal links kept from the old page) ---------- */
		'guides_title' => 'Guides for sixth formers, gap years and enrichment',
		'guides'       => array(
			array( 'title' => 'Supercurriculars: 20 examples for UK sixth formers', 'text' => 'What counts as a supercurricular, how it differs from extracurricular activity, and how to write about it in a UCAS personal statement.', 'url' => 'https://teflinstitute.com/blog/supercurriculars/' ),
			array( 'title' => 'Gap year ideas UK: 15 options for 18 year olds',     'text' => 'Language assistant posts, working holidays, volunteering and teaching English online, with the age and degree rules for each.', 'url' => 'https://teflinstitute.com/blog/gap-year-ideas/' ),
			array( 'title' => 'Gap year work abroad: get paid teaching English at 18', 'text' => 'The paid routes open to UK school leavers without a degree, compared by pay, length and entry requirements.', 'url' => 'https://teflinstitute.com/blog/gap-year-work-abroad/' ),
		),
	);

	return $d;
}

/* =========================================================================
 * Helpers
 * ====================================================================== */

/** Is the current request a page using this template? */
function tfs2_is_active() {
	return is_page_template( TFS2_TEMPLATE );
}

/** A single field, falling back to the default when empty. */
function tfs2_get( $name, $post_id = null ) {
	$post_id = $post_id ? $post_id : get_queried_object_id();
	$value   = function_exists( 'get_field' ) ? get_field( $name, $post_id ) : null;
	if ( null === $value || false === $value || '' === $value ) {
		$d     = tfs2_defaults();
		$value = isset( $d[ $name ] ) ? $d[ $name ] : '';
	}
	return $value;
}

/**
 * Repeater rows as plain arrays keyed by sub field name. Falls back to the
 * defaults only when the field has never been saved, so an editor can
 * remove every row to hide a section.
 */
function tfs2_rows( $name, $post_id = null ) {
	$post_id = $post_id ? $post_id : get_queried_object_id();
	$rows    = function_exists( 'get_field' ) ? get_field( $name, $post_id ) : null;
	if ( is_array( $rows ) && $rows ) {
		return array_values( $rows );
	}
	if ( $post_id && metadata_exists( 'post', (int) $post_id, $name ) ) {
		return array();
	}
	$d = tfs2_defaults();
	return isset( $d[ $name ] ) ? $d[ $name ] : array();
}

/** Echo escaped text. */
function tfs2_e( $name ) {
	echo esc_html( tfs2_get( $name ) );
}

/** Lucide icons, inline, coloured by currentColor. */
function tfs2_icon( $name, $size = 20, $class = '' ) {
	static $paths = array(
		'graduation-cap' => '<path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"/><path d="M22 10v6"/><path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"/>',
		'map-pin'        => '<path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/>',
		'clock'          => '<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>',
		'calendar-days'  => '<path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/><path d="M8 14h.01"/><path d="M12 14h.01"/><path d="M16 14h.01"/><path d="M8 18h.01"/><path d="M12 18h.01"/><path d="M16 18h.01"/>',
		'award'          => '<path d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526"/><circle cx="12" cy="8" r="6"/>',
		'shield-check'   => '<path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/>',
		'badge-check'    => '<path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z"/><path d="m9 12 2 2 4-4"/>',
		'file-badge'     => '<path d="M12 22h6a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v3"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M5 17a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/><path d="M7 16.5 8 22l-3-1-3 1 1-5.5"/>',
		'check'          => '<path d="M20 6 9 17l-5-5"/>',
		'laptop'         => '<path d="M20 16V7a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v9m16 0H4m16 0 1.28 2.55a1 1 0 0 1-.9 1.45H3.62a1 1 0 0 1-.9-1.45L4 16"/>',
		'globe'          => '<circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/>',
		'chevron-down'   => '<path d="m6 9 6 6 6-6"/>',
		'chevron-left'   => '<path d="m15 18-6-6 6-6"/>',
		'chevron-right'  => '<path d="m9 18 6-6-6-6"/>',
		'arrow-right'    => '<path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>',
		'pause'          => '<rect x="14" y="4" width="4" height="16" rx="1"/><rect x="6" y="4" width="4" height="16" rx="1"/>',
		'play'           => '<polygon points="6 3 20 12 6 21 6 3"/>',
		'image'          => '<rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/>',
		'mail'           => '<rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>',
		'phone'          => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>',
		'x'              => '<path d="M18 6 6 18"/><path d="m6 6 12 12"/>',
	);
	if ( ! isset( $paths[ $name ] ) ) {
		$name = 'check';
	}
	return sprintf(
		'<svg class="tfs2-ic%s" width="%2$d" height="%2$d" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">%3$s</svg>',
		$class ? ' ' . esc_attr( $class ) : '',
		(int) $size,
		$paths[ $name ]
	);
}

/**
 * An optional section image.
 *
 * Returns the image wrapped in .tfs2-slot when the field has one. When it is
 * empty, logged-in editors get a dashed placeholder naming the field, and
 * visitors get nothing (so the layout closes up). Logged-in users are not
 * served from WP Fastest Cache, so the placeholder never reaches the cache.
 *
 * @param string $field   ACF image field (return format: ID).
 * @param string $label   Name shown on the editor placeholder.
 * @param string $variant 'head' (beside a section heading) or 'side' (under a side column).
 */
function tfs2_slot( $field, $label, $variant = 'head' ) {
	$id = (int) tfs2_get( $field );
	if ( $id ) {
		$img = wp_get_attachment_image( $id, 'large', false, array(
			'class'   => 'tfs2-slot__img',
			'loading' => 'lazy',
			'sizes'   => '(max-width: 900px) 100vw, 480px',
		) );
		if ( $img ) {
			return '<div class="tfs2-slot tfs2-slot--' . esc_attr( $variant ) . '">' . $img . '</div>';
		}
	}
	if ( current_user_can( 'edit_post', get_queried_object_id() ) ) {
		return tfs2_slot_empty( $label, 'Images → ' . $label, $variant );
	}
	return '';
}

/** The editors-only placeholder for an empty image space. */
function tfs2_slot_empty( $label, $where, $variant = 'head' ) {
	return '<div class="tfs2-slot tfs2-slot--' . esc_attr( $variant ) . ' tfs2-slot--empty" aria-hidden="true">'
		. '<span>' . tfs2_icon( 'image', 24 ) . 'Image space<strong>' . esc_html( $label ) . '</strong>'
		. '<small>Editors only. Add it in the page editor under ' . esc_html( $where ) . '.</small></span></div>';
}

/** Price tiers, sorted, as integers. */
function tfs2_tiers( $post_id = null ) {
	$out = array();
	foreach ( tfs2_rows( 'tiers', $post_id ) as $t ) {
		if ( ! isset( $t['min'], $t['max'], $t['price'] ) || '' === $t['price'] ) {
			continue;
		}
		$out[] = array( 'min' => (int) $t['min'], 'max' => (int) $t['max'], 'price' => (float) $t['price'] );
	}
	usort( $out, function ( $a, $b ) { return $a['min'] - $b['min']; } );
	return $out;
}

/** Price per student for a cohort, or null for bespoke. */
function tfs2_price_for( $n, $post_id = null ) {
	foreach ( tfs2_tiers( $post_id ) as $t ) {
		if ( $n >= $t['min'] && $n <= $t['max'] ) {
			return $t['price'];
		}
	}
	return null;
}

function tfs2_gbp( $v, $dp = 0 ) {
	return '£' . number_format( (float) $v, $dp );
}

/** Image URL from an attachment ID, with a fallback. */
function tfs2_img( $id, $fallback = '', $size = 'large' ) {
	if ( $id ) {
		$url = wp_get_attachment_image_url( (int) $id, $size );
		if ( $url ) {
			return $url;
		}
	}
	return $fallback;
}

/** Link helper: internal relative paths become absolute. */
function tfs2_url( $url ) {
	if ( is_string( $url ) && 0 === strpos( $url, '/' ) && 0 !== strpos( $url, '//' ) ) {
		return home_url( $url );
	}
	return $url;
}

/** Telephone href from a display number. */
function tfs2_tel( $display ) {
	return 'tel:' . preg_replace( '/[^0-9+]/', '', (string) $display );
}

/* -------------------------------------------------------------------------
 * Planner data, shared by the JS (as config) and the AJAX e-mail.
 * ---------------------------------------------------------------------- */
function tfs2_planner_options() {
	return array(
		'years'  => array(
			array( 'id' => 'y11',   'label' => 'Year 11',          'sub' => 'Grade 10, post exam' ),
			array( 'id' => 'y12',   'label' => 'Year 12',          'sub' => 'Grade 11' ),
			array( 'id' => 'y13',   'label' => 'Year 13',          'sub' => 'Grade 12' ),
			array( 'id' => 'mixed', 'label' => 'Mixed sixth form', 'sub' => 'Junior and senior' ),
		),
		'slots'  => array(
			array( 'id' => 'reg',  'label' => 'One 30 minute registration slot', 'h' => 0.5 ),
			array( 'id' => 'hour', 'label' => 'One hour enrichment period',      'h' => 1 ),
			array( 'id' => 'two',  'label' => 'A two hour afternoon',            'h' => 2 ),
			array( 'id' => 'home', 'label' => 'Nothing, it runs at home',        'h' => 0 ),
		),
		'starts' => array(
			array( 'id' => 'sep',    'label' => 'September',        'sub' => '',                'm' => 8 ),
			array( 'id' => 'jan',    'label' => 'January',          'sub' => 'Spring semester', 'm' => 0 ),
			array( 'id' => 'easter', 'label' => 'After Easter',     'sub' => '',                'm' => 3 ),
			array( 'id' => 'post',   'label' => 'Post exam season', 'sub' => '',                'm' => 5 ),
		),
	);
}

/** The plan rows, computed the same way as the JS. Returns [title, rows]. */
function tfs2_build_plan( $year_id, $slot_id, $start_id, $n, $post_id = null ) {
	$o      = tfs2_planner_options();
	$find   = function ( $list, $id ) {
		foreach ( $list as $x ) {
			if ( $x['id'] === $id ) {
				return $x;
			}
		}
		return null;
	};
	$year   = $find( $o['years'], $year_id );
	$slot   = $find( $o['slots'], $slot_id );
	$start  = $find( $o['starts'], $start_id );
	if ( ! $year || ! $slot || ! $start ) {
		return null;
	}
	$n      = max( 5, min( 60, (int) $n ) );
	$p      = tfs2_price_for( $n, $post_id );
	$months = array( 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' );
	$home   = max( 0, 120 / 26 - $slot['h'] );
	$in     = $slot['h'] ? preg_replace( array( '/^One /', '/^A /' ), array( 'one ', 'a ' ), $slot['label'] ) . ' a week' : 'none';
	$when   = str_replace( array( 'Post exam season', 'After Easter' ), array( 'after exams', 'after Easter' ), $start['label'] );

	return array(
		'Plan for ' . $n . ' ' . $year['label'] . ' students, starting ' . $when,
		array(
			array( 'In school', $in ),
			array( 'Self paced, in their own time', 'about ' . number_format( $home, 1 ) . ' hours a week' ),
			array( 'Access runs until', 'end of ' . $months[ ( $start['m'] + 6 ) % 12 ] ),
			array( 'Staff time', 'one member of staff on the dashboard' ),
			array( 'Per student', $p ? tfs2_gbp( $p ) : 'bespoke' ),
			array( 'Total for the group', $p ? tfs2_gbp( $p * $n ) : 'talk to Chloe' ),
		),
	);
}

/* =========================================================================
 * ACF field groups
 * ====================================================================== */
/**
 * Registered in code only if you opt in (see below). Simple fields carry
 * their default as default_value; repeaters are pre-filled with the default
 * rows until the page is first saved.
 */

function tfs2_icon_choices() {
	return array(
		'graduation-cap' => 'Graduation cap',
		'map-pin'        => 'Map pin',
		'clock'          => 'Clock',
		'calendar-days'  => 'Calendar',
		'award'          => 'Award',
		'shield-check'   => 'Shield',
		'badge-check'    => 'Badge',
		'file-badge'     => 'Certificate',
		'check'          => 'Tick',
		'laptop'         => 'Laptop',
		'globe'          => 'Globe',
	);
}

/* Small builders so the groups below stay readable. */
function tfs2_k( $name ) {
	return 'field_tfs2_' . $name;
}

function tfs2_fld( $type, $name, $label, $extra = array() ) {
	$d   = tfs2_defaults();
	$fld = array(
		'key'   => tfs2_k( $name ),
		'name'  => $name,
		'label' => $label,
		'type'  => $type,
	);
	if ( isset( $d[ $name ] ) && is_scalar( $d[ $name ] ) && 'image' !== $type ) {
		$fld['default_value'] = $d[ $name ];
	}
	return array_merge( $fld, $extra );
}

function tfs2_tab( $label ) {
	return array(
		'key'       => tfs2_k( 'tab_' . sanitize_title( $label ) ),
		'label'     => $label,
		'name'      => '',
		'type'      => 'tab',
		'placement' => 'left',
	);
}

function tfs2_rep( $name, $label, $subs, $extra = array() ) {
	$sub_fields = array();
	foreach ( $subs as $s ) {
		list( $type, $sname, $slabel ) = $s;
		$sf = array(
			'key'   => tfs2_k( $name . '_' . $sname ),
			'name'  => $sname,
			'label' => $slabel,
			'type'  => $type,
		);
		if ( isset( $s[3] ) && is_array( $s[3] ) ) {
			$sf = array_merge( $sf, $s[3] );
		}
		$sub_fields[] = $sf;
	}
	return array_merge(
		array(
			'key'          => tfs2_k( $name ),
			'name'         => $name,
			'label'        => $label,
			'type'         => 'repeater',
			'layout'       => 'block',
			'button_label' => 'Add row',
			'sub_fields'   => $sub_fields,
		),
		$extra
	);
}

/* Which repeaters exist, and their sub field names, for pre-population. */
function tfs2_repeater_map() {
	return array(
		'stats'        => array( 'icon', 'number', 'label' ),
		'trust'        => array( 'icon', 'text' ),
		'outcomes'     => array( 'icon', 'title', 'text' ),
		'why_cards'    => array( 'title', 'text' ),
		'tiers'        => array( 'min', 'max', 'price' ),
		'modules'      => array( 'title', 'text' ),
		'faqs'         => array( 'question', 'answer' ),
		'quotes'       => array( 'logo', 'quote', 'name', 'role' ),
		'steps'        => array( 'title', 'text' ),
		'guides'       => array( 'title', 'text', 'url' ),
		'proof_slides' => array( 'image', 'caption', 'name' ),
	);
}

/** The fields of the "images" group: the hero carousel and every image space. */
function tfs2_image_fields() {
	$img = function ( $name, $label, $hint ) {
		return tfs2_fld( 'image', $name, $label, array(
			'return_format' => 'id',
			'preview_size'  => 'medium',
			'library'       => 'all',
			'instructions'  => $hint . ' Optional: leave empty and the section closes up.',
		) );
	};
	return array(
		tfs2_fld( 'text', 'proof_label', 'Carousel name for screen readers' ),
		tfs2_rep( 'proof_slides', 'Social proof slides', array(
			array( 'image', 'image', 'Photo', array( 'return_format' => 'id', 'preview_size' => 'medium', 'instructions' => 'Landscape, 2:1 works best (e.g. 1240 × 620). Slides without a photo are skipped.' ) ),
			array( 'textarea', 'caption', 'Caption or short quote', array( 'rows' => 2, 'new_lines' => '' ) ),
			array( 'text', 'name', 'Name and school' ),
		), array(
			'button_label' => 'Add slide',
			'max'          => 8,
			'instructions' => 'Shown under the hero text as a carousel. Two or more slides turn on the arrows and auto-advance.',
		) ),
		$img( 'outcomes_image', 'Outcomes image', 'Beside the “What students finish with” heading. Landscape 3:2.' ),
		$img( 'cost_image', 'Cost section image', 'Beside the “What it costs” heading. Landscape 3:2.' ),
		$img( 'why_image', 'Why schools image', 'Beside the “Why schools put it on the enrichment list” heading. Landscape 3:2.' ),
		$img( 'planner_image', 'Planner image', 'Beside the planner heading. Landscape 3:2.' ),
		$img( 'routes_image', 'Routes image', 'Beside the “Where could this take you” heading. Landscape 3:2.' ),
		$img( 'taster_image', 'Taster image', 'Under the taster intro, left column. 4:3.' ),
		$img( 'faq_image', 'FAQ image', 'Under the FAQ heading, left column. 4:3.' ),
	);
}

/* The field groups are managed in ACF → Field Groups:
 *   acf-tefl-for-schools-v3.json         (main group)
 *   acf-tefl-for-schools-v3-images.json  (carousel + image spaces)
 * Import both via ACF → Tools → Import. The definitions below mirror those
 * exports and only register in code if you opt in:
 *     add_filter( 'tfs2_fields_in_code', '__return_true' );
 * Never do both, or ACF will show the groups twice. */
add_action( 'acf/init', function () {
	if ( ! function_exists( 'acf_add_local_field_group' ) || ! apply_filters( 'tfs2_fields_in_code', false ) ) {
		return;
	}

	$icon = array( 'choices' => tfs2_icon_choices(), 'ui' => 0 );
	$ta3  = array( 'rows' => 3, 'new_lines' => '' );
	$ta2  = array( 'rows' => 2, 'new_lines' => '' );

	$fields = array(

		tfs2_tab( 'Hero' ),
		tfs2_fld( 'select', 'hero_variant', 'Hero layout', array(
			'choices'      => array( 'form' => 'Quote form on the right', 'image' => 'Photo on the right with two buttons' ),
			'instructions' => 'The design ships with the form layout.',
		) ),
		tfs2_fld( 'text', 'hero_eyebrow', 'Label above the headline' ),
		tfs2_fld( 'text', 'hero_title', 'Headline (the page H1)' ),
		tfs2_fld( 'textarea', 'hero_lede', 'Intro paragraph', $ta3 ),
		tfs2_fld( 'text', 'hero_meta', 'Small line under the intro' ),
		tfs2_fld( 'image', 'hero_image', 'Hero photo', array(
			'return_format' => 'id',
			'instructions'  => 'Only used with the photo layout.',
			'conditional_logic' => array( array( array( 'field' => tfs2_k( 'hero_variant' ), 'operator' => '==', 'value' => 'image' ) ) ),
		) ),
		tfs2_fld( 'text', 'hero_talk_text', 'Prompt before the booking link' ),
		tfs2_fld( 'text', 'hero_talk_label', 'Booking link label' ),
		tfs2_fld( 'text', 'hero_form_title', 'Form card heading' ),
		tfs2_fld( 'textarea', 'hero_form_intro', 'Form card intro', $ta2 ),
		tfs2_fld( 'text', 'hero_form_shortcode', 'Form shortcode', array(
			'instructions' => 'Contact Form 7 shortcode for the quote form. See the README for the recommended two field form.',
		) ),
		tfs2_fld( 'text', 'hero_form_note', 'Privacy line under the form' ),
		tfs2_fld( 'text', 'hero_buy_text', 'Buy for yourself, prompt' ),
		tfs2_fld( 'text', 'hero_buy_label', 'Buy for yourself, link label' ),
		tfs2_fld( 'url', 'hero_buy_url', 'Buy for yourself, link' ),

		tfs2_tab( 'Sub navigation' ),
		tfs2_fld( 'text', 'enroll_label', 'Enrol button label' ),
		tfs2_fld( 'url', 'enroll_url', 'Enrol button link' ),
		tfs2_fld( 'text', 'staff_url', 'For staff page link' ),
		tfs2_fld( 'text', 'students_url', 'For students page link' ),

		tfs2_tab( 'Stats and trust' ),
		tfs2_rep( 'stats', 'Stats (shown under the outcomes)', array(
			array( 'select', 'icon', 'Icon', $icon ),
			array( 'text', 'number', 'Number' ),
			array( 'textarea', 'label', 'Label (a line break is kept)', array( 'rows' => 2, 'new_lines' => '' ) ),
		), array( 'max' => 4, 'layout' => 'table' ) ),
		tfs2_rep( 'trust', 'Trust line', array(
			array( 'select', 'icon', 'Icon', $icon ),
			array( 'text', 'text', 'Text' ),
		), array( 'layout' => 'table' ) ),

		tfs2_tab( 'Chloe' ),
		tfs2_fld( 'image', 'chloe_photo', 'Photo', array( 'return_format' => 'id', 'instructions' => 'Leave empty to use the photo from the design.' ) ),
		tfs2_fld( 'text', 'chloe_name', 'Name' ),
		tfs2_fld( 'text', 'chloe_role', 'Role' ),
		tfs2_fld( 'email', 'chloe_email', 'Email' ),
		tfs2_fld( 'text', 'chloe_phone', 'Phone, as displayed' ),
		tfs2_fld( 'url', 'booking_url', 'Dlopo booking link' ),
		tfs2_fld( 'text', 'note_title', 'Note heading' ),
		tfs2_fld( 'wysiwyg', 'note_body', 'Note', array( 'media_upload' => 0, 'toolbar' => 'basic' ) ),

		tfs2_tab( 'Teacher or student' ),
		tfs2_fld( 'text', 'who_title', 'Heading' ),
		tfs2_fld( 'text', 'door_staff_eyebrow', 'Staff card label' ),
		tfs2_fld( 'text', 'door_staff_title', 'Staff card heading' ),
		tfs2_fld( 'textarea', 'door_staff_text', 'Staff card text', $ta2 ),
		tfs2_fld( 'text', 'door_staff_link', 'Staff card link label' ),
		tfs2_fld( 'text', 'door_student_eyebrow', 'Student card label' ),
		tfs2_fld( 'text', 'door_student_title', 'Student card heading' ),
		tfs2_fld( 'textarea', 'door_student_text', 'Student card text', $ta2 ),
		tfs2_fld( 'text', 'door_student_link', 'Student card link label' ),

		tfs2_tab( 'Outcomes' ),
		tfs2_fld( 'text', 'outcomes_eyebrow', 'Label' ),
		tfs2_fld( 'text', 'outcomes_title', 'Heading' ),
		tfs2_fld( 'textarea', 'outcomes_intro', 'Intro', $ta2 ),
		tfs2_rep( 'outcomes', 'Outcomes', array(
			array( 'select', 'icon', 'Icon', $icon ),
			array( 'text', 'title', 'Title' ),
			array( 'textarea', 'text', 'Text', array( 'rows' => 2, 'new_lines' => '' ) ),
		) ),

		tfs2_tab( 'Why schools' ),
		tfs2_fld( 'text', 'why_title', 'Heading' ),
		tfs2_rep( 'why_cards', 'Cards', array(
			array( 'text', 'title', 'Title' ),
			array( 'textarea', 'text', 'Text', array( 'rows' => 3, 'new_lines' => '' ) ),
		) ),
		tfs2_fld( 'text', 'week_label', 'Week grid label' ),
		tfs2_fld( 'text', 'week_note', 'Week grid note' ),

		tfs2_tab( 'Pricing' ),
		tfs2_fld( 'text', 'cost_eyebrow', 'Label' ),
		tfs2_fld( 'text', 'cost_title', 'Heading' ),
		tfs2_fld( 'textarea', 'cost_intro', 'Intro', $ta2 ),
		tfs2_fld( 'text', 'cost_card_title', 'Calculator heading' ),
		tfs2_fld( 'text', 'cost_card_text', 'Calculator intro' ),
		tfs2_rep( 'tiers', 'Price tiers (GBP per student)', array(
			array( 'number', 'min', 'From (students)' ),
			array( 'number', 'max', 'To (students)' ),
			array( 'number', 'price', 'Price per student, £' ),
		), array( 'layout' => 'table', 'instructions' => 'Used by the calculator, the planner, the quote card and the Course schema. Keep the FAQ answer on price in step.' ) ),
		tfs2_fld( 'number', 'bespoke_from', 'Bespoke pricing from (students)' ),
		tfs2_fld( 'number', 'fx_eur', 'Euro rate (1 GBP =)', array( 'step' => 0.01 ) ),
		tfs2_fld( 'number', 'fx_usd', 'Dollar rate (1 GBP =)', array( 'step' => 0.01 ) ),
		tfs2_fld( 'text', 'vat_note', 'VAT line' ),

		tfs2_tab( 'Planner' ),
		tfs2_fld( 'text', 'planner_eyebrow', 'Label' ),
		tfs2_fld( 'text', 'planner_title', 'Heading' ),
		tfs2_fld( 'textarea', 'planner_intro', 'Intro', $ta2 ),
		tfs2_fld( 'text', 'planner_card_title', 'Card heading' ),
		tfs2_fld( 'textarea', 'planner_card_text', 'Card text', $ta2 ),
		tfs2_fld( 'text', 'planner_privacy', 'Privacy line' ),
		tfs2_fld( 'email', 'planner_notify', 'Send planner leads to', array( 'instructions' => 'Gets an email for every planner sign up and a copy of every plan sent.' ) ),

		tfs2_tab( 'Routes and taster' ),
		tfs2_fld( 'text', 'routes_eyebrow', 'Routes label' ),
		tfs2_fld( 'text', 'routes_title', 'Routes heading' ),
		tfs2_fld( 'textarea', 'routes_intro', 'Routes intro', $ta2 ),
		tfs2_fld( 'text', 'routes_card_title', 'Routes card heading' ),
		tfs2_fld( 'text', 'routes_card_text', 'Routes card text' ),
		tfs2_fld( 'text', 'taster_eyebrow', 'Taster label' ),
		tfs2_fld( 'text', 'taster_title', 'Taster heading' ),
		tfs2_fld( 'textarea', 'taster_intro', 'Taster intro', $ta2 ),
		tfs2_fld( 'text', 'taster_card_title', 'Taster card heading' ),
		tfs2_fld( 'text', 'taster_card_text', 'Taster card text' ),

		tfs2_tab( 'Programme' ),
		tfs2_fld( 'text', 'programme_eyebrow', 'Label' ),
		tfs2_fld( 'text', 'programme_title', 'Heading' ),
		tfs2_fld( 'textarea', 'programme_intro', 'Intro', $ta2 ),
		tfs2_rep( 'modules', 'Modules', array(
			array( 'text', 'title', 'Title' ),
			array( 'textarea', 'text', 'Description', array( 'rows' => 2, 'new_lines' => '' ) ),
		), array( 'instructions' => 'Descriptions are optional. Empty ones are not shown.' ) ),
		tfs2_fld( 'text', 'programme_end', 'Final card heading' ),
		tfs2_fld( 'text', 'programme_receive', 'Final card first button' ),
		tfs2_fld( 'text', 'brochure_label', 'Brochure button label' ),
		tfs2_fld( 'text', 'brochure_url', 'Brochure button link' ),

		tfs2_tab( 'FAQ' ),
		tfs2_fld( 'text', 'faq_title', 'Heading' ),
		tfs2_rep( 'faqs', 'Questions', array(
			array( 'text', 'question', 'Question' ),
			array( 'textarea', 'answer', 'Answer', array( 'rows' => 3, 'new_lines' => '' ) ),
		), array( 'instructions' => 'Also published as FAQPage structured data.' ) ),

		tfs2_tab( 'Testimonials' ),
		tfs2_fld( 'text', 'quotes_eyebrow', 'Label' ),
		tfs2_fld( 'text', 'quotes_title', 'Heading' ),
		tfs2_rep( 'quotes', 'Quotes', array(
			array( 'image', 'logo', 'School logo', array( 'return_format' => 'id', 'preview_size' => 'thumbnail', 'instructions' => 'Square or upright crest works best. Optional.' ) ),
			array( 'textarea', 'quote', 'Quote, without quotation marks', array( 'rows' => 2, 'new_lines' => '' ) ),
			array( 'text', 'name', 'Name' ),
			array( 'text', 'role', 'School' ),
		), array( 'layout' => 'block', 'instructions' => 'Add as many as you like. Shown as a carousel under the hero, two at a time on desktop and one on mobile.' ) ),

		tfs2_tab( 'US schools' ),
		tfs2_fld( 'text', 'us_eyebrow', 'Label' ),
		tfs2_fld( 'text', 'us_title', 'Heading' ),
		tfs2_fld( 'textarea', 'us_text', 'Text', $ta2 ),
		tfs2_fld( 'text', 'us_label', 'Button label' ),

		tfs2_tab( 'Period Six' ),
		tfs2_fld( 'text', 'p6_eyebrow', 'Label' ),
		tfs2_fld( 'text', 'p6_title', 'Heading' ),
		tfs2_fld( 'textarea', 'p6_text', 'Text', $ta2 ),
		tfs2_fld( 'text', 'p6_button', 'Button label' ),
		tfs2_fld( 'text', 'p6_fine', 'Small print' ),
		tfs2_fld( 'url', 'p6_endpoint', 'MailerLite form endpoint' ),

		tfs2_tab( 'How it works' ),
		tfs2_fld( 'text', 'steps_eyebrow', 'Label' ),
		tfs2_fld( 'text', 'steps_title', 'Heading' ),
		tfs2_fld( 'textarea', 'steps_intro', 'Intro', $ta2 ),
		tfs2_rep( 'steps', 'Steps', array(
			array( 'text', 'title', 'Title' ),
			array( 'textarea', 'text', 'Text', array( 'rows' => 2, 'new_lines' => '' ) ),
		), array( 'min' => 4, 'max' => 4, 'instructions' => 'Exactly four steps: each one is paired with a picture on the right.' ) ),

		tfs2_tab( 'Quote and guides' ),
		tfs2_fld( 'text', 'quote_title', 'Quote heading' ),
		tfs2_fld( 'textarea', 'quote_text', 'Quote text', $ta3 ),
		tfs2_fld( 'text', 'quote_reply', 'Reply promise' ),
		tfs2_fld( 'text', 'quote_button', 'Button label' ),
		tfs2_fld( 'text', 'quote_url', 'Button link' ),
		tfs2_fld( 'text', 'guides_title', 'Guides heading' ),
		tfs2_rep( 'guides', 'Guides', array(
			array( 'text', 'title', 'Title' ),
			array( 'textarea', 'text', 'Text', array( 'rows' => 2, 'new_lines' => '' ) ),
			array( 'url', 'url', 'Link' ),
		), array( 'instructions' => 'Remove every row to hide the section.' ) ),
	);

	$location = array( array( array(
		'param'    => 'page_template',
		'operator' => '==',
		'value'    => TFS2_TEMPLATE,
	) ) );

	acf_add_local_field_group( array(
		'key'                   => 'group_tfs2_landing',
		'title'                 => 'TEFL for Schools landing',
		'fields'                => $fields,
		'location'              => $location,
		'position'              => 'acf_after_title',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'hide_on_screen'        => array( 'excerpt', 'discussion', 'comments' ),
		'active'                => true,
	) );

	acf_add_local_field_group( array(
		'key'             => 'group_tfs2_images',
		'title'           => 'TEFL for Schools landing: images',
		'fields'          => tfs2_image_fields(),
		'location'        => $location,
		'menu_order'      => 1,
		'position'        => 'normal',
		'style'           => 'default',
		'label_placement' => 'top',
		'active'          => true,
	) );
} );

/* Pre-fill repeaters with the default rows until the page is first saved. */
add_action( 'acf/init', function () {
	foreach ( tfs2_repeater_map() as $name => $subs ) {
		add_filter( 'acf/load_value/key=' . tfs2_k( $name ), function ( $value, $post_id ) use ( $name, $subs ) {
			if ( ! empty( $value ) ) {
				return $value;
			}
			if ( is_numeric( $post_id ) && metadata_exists( 'post', (int) $post_id, $name ) ) {
				return $value; // Saved empty on purpose.
			}
			$d = tfs2_defaults();
			if ( empty( $d[ $name ] ) ) {
				return $value;
			}
			$rows = array();
			foreach ( $d[ $name ] as $row ) {
				$r = array();
				foreach ( $subs as $s ) {
					$r[ tfs2_k( $name . '_' . $s ) ] = isset( $row[ $s ] ) ? $row[ $s ] : '';
				}
				$rows[] = $r;
			}
			return $rows;
		}, 10, 2 );
	}
} );

/* =========================================================================
 * Structured data
 * ====================================================================== */
/**
 * The Course with its price tiers and the FAQPage. Yoast already outputs
 * WebPage, Organization and breadcrumbs, so this adds only what Yoast cannot
 * know. Everything is built from the same fields the page shows.
 */
add_action( 'wp_head', function () {
	if ( ! tfs2_is_active() ) {
		return;
	}

	$url   = get_permalink();
	$nodes = array();

	$modules = array();
	foreach ( tfs2_rows( 'modules' ) as $m ) {
		if ( ! empty( $m['title'] ) ) {
			$modules[] = $m['title'];
		}
	}

	$offers = array();
	foreach ( tfs2_tiers() as $t ) {
		$offers[] = array(
			'@type'            => 'Offer',
			'name'             => $t['min'] . ' to ' . $t['max'] . ' students',
			'category'         => 'Paid',
			'availability'     => 'https://schema.org/InStock',
			'eligibleQuantity' => array(
				'@type'    => 'QuantitativeValue',
				'minValue' => $t['min'],
				'maxValue' => $t['max'],
				'unitText' => 'student',
			),
			'price'            => $t['price'],
			'priceCurrency'    => 'GBP',
			'priceSpecification' => array(
				'@type'         => 'UnitPriceSpecification',
				'price'         => $t['price'],
				'priceCurrency' => 'GBP',
				'unitText'      => 'per student',
			),
		);
	}

	$nodes[] = array(
		'@type'       => 'Course',
		'@id'         => $url . '#course',
		'name'        => 'TEFL for Schools, a 120 hour TEFL qualification',
		'description' => wp_strip_all_tags( tfs2_get( 'hero_lede' ) ),
		'url'         => $url,
		'provider'    => array( '@id' => home_url( '/' ) . '#organization' ),
		'inLanguage'  => 'en',
		'timeRequired' => 'PT120H',
		'educationalCredentialAwarded' => 'TEFL certificate, 120 guided learning hours across ten modules',
		'isAccessibleForFree' => false,
		'teaches'     => $modules,
		'audience'    => array(
			'@type'           => 'EducationalAudience',
			'educationalRole' => 'student',
			'audienceType'    => 'Secondary school and sixth form students',
		),
		'hasCourseInstance' => array(
			'@type'          => 'CourseInstance',
			'courseMode'     => 'Online',
			'courseWorkload' => 'PT120H',
		),
		'offers'      => $offers,
	);

	$qa = array();
	foreach ( tfs2_rows( 'faqs' ) as $f ) {
		if ( empty( $f['question'] ) || empty( $f['answer'] ) ) {
			continue;
		}
		$qa[] = array(
			'@type'          => 'Question',
			'name'           => wp_strip_all_tags( $f['question'] ),
			'acceptedAnswer' => array( '@type' => 'Answer', 'text' => wp_strip_all_tags( $f['answer'] ) ),
		);
	}
	if ( $qa ) {
		$nodes[] = array(
			'@type'      => 'FAQPage',
			'@id'        => $url . '#faq',
			'url'        => $url,
			'inLanguage' => 'en',
			'mainEntity' => $qa,
		);
	}

	echo "\n<!-- TEFL for Schools landing: structured data -->\n<script type=\"application/ld+json\">"
		. wp_json_encode( array( '@context' => 'https://schema.org', '@graph' => $nodes ), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
		. "</script>\n";
}, 99 );

/* =========================================================================
 * Planner AJAX
 * ====================================================================== */
/**
 * stage=lead : someone filled in name and email to open the planner. Chloe
 *              (or whoever is set in the Planner tab) gets a notification.
 * stage=plan : they built a plan. The plan is e-mailed to them, with a copy
 *              to the notification address.
 *
 * No nonce, on purpose: the page is served from WP Fastest Cache, and a
 * cached nonce goes stale within a day. Abuse is limited instead by a
 * honeypot, a same-site referer check, a per-IP rate limit, and by building
 * the e-mail entirely from fixed option IDs (no free text except a short,
 * stripped name).
 */
add_action( 'wp_ajax_tfs2_planner', 'tfs2_ajax_planner' );
add_action( 'wp_ajax_nopriv_tfs2_planner', 'tfs2_ajax_planner' );

function tfs2_ajax_planner() {
	$fail = function ( $msg, $code = 400 ) {
		wp_send_json_error( array( 'message' => $msg ), $code );
	};

	// Honeypot.
	if ( ! empty( $_POST['website'] ) ) {
		wp_send_json_success( array( 'ok' => true ) );
	}

	// Same-site only.
	$ref = isset( $_SERVER['HTTP_REFERER'] ) ? wp_parse_url( wp_unslash( $_SERVER['HTTP_REFERER'] ), PHP_URL_HOST ) : '';
	if ( $ref !== wp_parse_url( home_url(), PHP_URL_HOST ) ) {
		$fail( 'Bad origin.', 403 );
	}

	// Ten requests an hour per IP.
	$ip  = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '0';
	$key = 'tfs2_rl_' . md5( $ip );
	$hits = (int) get_transient( $key );
	if ( $hits >= 10 ) {
		$fail( 'Too many requests. Please try again later.', 429 );
	}
	set_transient( $key, $hits + 1, HOUR_IN_SECONDS );

	$page_id = isset( $_POST['page'] ) ? absint( $_POST['page'] ) : 0;
	if ( ! $page_id || TFS2_TEMPLATE !== get_page_template_slug( $page_id ) ) {
		$fail( 'Unknown page.' );
	}

	$name  = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$name  = trim( preg_replace( '#(https?://|www\.)\S*#i', '', $name ) );
	$name  = mb_substr( $name, 0, 60 );
	$email = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$stage = isset( $_POST['stage'] ) && 'plan' === $_POST['stage'] ? 'plan' : 'lead';

	if ( '' === $name ) {
		$fail( 'Please add your name.' );
	}
	if ( ! is_email( $email ) ) {
		$fail( 'Please add a valid email address.' );
	}

	$notify = tfs2_get( 'planner_notify', $page_id );
	$notify = is_email( $notify ) ? $notify : get_option( 'admin_email' );
	$chloe  = tfs2_get( 'chloe_email', $page_id );
	$site   = get_bloginfo( 'name' );

	if ( 'lead' === $stage ) {
		$body = "Someone opened the enrichment fit planner on the TEFL for Schools page.\n\n"
			. 'Name: ' . $name . "\n"
			. 'Email: ' . $email . "\n"
			. 'Page: ' . get_permalink( $page_id ) . "\n\n"
			. "If they build a plan, you will get a copy of it too.\n";
		$sent = wp_mail(
			$notify,
			'Planner lead: ' . $name,
			$body,
			array( 'Reply-To: ' . $name . ' <' . $email . '>' )
		);
		wp_send_json_success( array( 'sent' => (bool) $sent ) );
	}

	$plan = tfs2_build_plan(
		isset( $_POST['year'] ) ? sanitize_key( $_POST['year'] ) : '',
		isset( $_POST['slot'] ) ? sanitize_key( $_POST['slot'] ) : '',
		isset( $_POST['start'] ) ? sanitize_key( $_POST['start'] ) : '',
		isset( $_POST['n'] ) ? absint( $_POST['n'] ) : 30,
		$page_id
	);
	if ( ! $plan ) {
		$fail( 'That plan could not be built.' );
	}

	$lines = '';
	foreach ( $plan[1] as $row ) {
		$lines .= str_pad( $row[0], 32 ) . $row[1] . "\n";
	}
	$body = 'Hello ' . $name . ",\n\n"
		. "Here is the enrichment plan you built on the TEFL for Schools page.\n\n"
		. $plan[0] . "\n\n"
		. $lines . "\n"
		. "Prices exclude VAT where it applies. The quote we send is the price you pay.\n\n"
		. "If you would like a written quote or a call, reply to this email.\n\n"
		. tfs2_get( 'chloe_name', $page_id ) . "\n"
		. tfs2_get( 'chloe_role', $page_id ) . "\n"
		. get_permalink( $page_id ) . "\n";

	$headers = array( 'Reply-To: ' . $chloe, 'Bcc: ' . $notify );
	$sent    = wp_mail( $email, 'Your TEFL enrichment plan', $body, $headers );

	wp_send_json_success( array( 'sent' => (bool) $sent ) );
}

/* =========================================================================
 * Hooks used only on this template
 * ====================================================================== */

/* Body class the stylesheet uses to release the Astra container. */
add_filter( 'body_class', function ( $classes ) {
	if ( tfs2_is_active() ) {
		$classes[] = 'tfs2-page';
	}
	return $classes;
} );

/* Preload the two fonts used above the fold. */
add_action( 'wp_head', function () {
	if ( ! tfs2_is_active() ) {
		return;
	}
	foreach ( array( 'source-serif-4-latin.woff2', 'montserrat-latin.woff2' ) as $f ) {
		printf(
			'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
			esc_url( get_stylesheet_directory_uri() . '/assets/fonts/tefl-for-schools/' . $f )
		);
	}
}, 2 );

/* Config for the page script (prices, planner options, endpoints).
 * Used in functions.php: wp_add_inline_script( ..., tfs2_js_config(), 'before' ). */
function tfs2_js_config() {
	$id = get_queried_object_id();
	return 'window.TFS2_CONFIG=' . wp_json_encode( array(
		'ajax'        => admin_url( 'admin-ajax.php' ),
		'page'        => $id,
		'tiers'       => tfs2_tiers( $id ),
		'bespokeFrom' => (int) tfs2_get( 'bespoke_from' ),
		'fx'          => array(
			'GBP' => array( 'r' => 1, 's' => '£' ),
			'EUR' => array( 'r' => (float) tfs2_get( 'fx_eur' ), 's' => '€' ),
			'USD' => array( 'r' => (float) tfs2_get( 'fx_usd' ), 's' => '$' ),
		),
		'planner'     => tfs2_planner_options(),
		'p6Endpoint'  => esc_url_raw( tfs2_get( 'p6_endpoint' ) ),
		'bookingUrl'  => esc_url_raw( tfs2_get( 'booking_url' ) ),
	) ) . ';';
}

/* Warn editors if the old [tfs_hub] shortcode is still in the page content:
 * the old snippet would keep loading its own CSS, JS and duplicate schema. */
add_action( 'wp_footer', function () {
	if ( ! tfs2_is_active() || ! current_user_can( 'edit_post', get_queried_object_id() ) ) {
		return;
	}
	$post = get_post( get_queried_object_id() );
	if ( $post && has_shortcode( $post->post_content, 'tfs_hub' ) ) {
		echo '<div style="position:fixed;left:16px;bottom:16px;z-index:99999;max-width:420px;padding:14px 16px;border-radius:10px;background:#8C2F2A;color:#fff;font:14px/1.45 Arial,sans-serif">'
			. '<strong>Editors only.</strong> This page still contains the old [tfs_hub] shortcode in its content. Empty the page content so the old styles, scripts and schema stop loading.'
			. '</div>';
	}
} );