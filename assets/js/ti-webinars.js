function showpopupbox(boxid, webinarname, webinar_id) {
	Boxzilla.show(boxid);
	jQuery('input.wpcf7-form-control[name="webinar"]').val(webinarname);
	jQuery('input.wpcf7-form-control[name="webinar-id"]').val(webinar_id);
	console.log("webinarname" + webinarname);
}

// document.addEventListener('wpcf7submit', function (event) {
// 	if ('3093' === event.detail.contactFormId) {
// 		event.preventDefault();
// 	}
// }, false);
