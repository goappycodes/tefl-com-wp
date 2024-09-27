<?php

/* Redirects Internship Guide Brochure form to the brochure page */

add_action( 'wp_footer', 'ti_redirect_cf7_brochure' );
function ti_redirect_cf7_brochure() { ?>
	<script>
		document.addEventListener( 'wpcf7mailsent', function( event ) {
            if ( '63500' == event.detail.contactFormId ) { 
               var inputs = event.detail.inputs;
               for ( var i = 0; i < inputs.length; i++ ) {
                   if ( 'selected-guide' == inputs[i].name ) {
                        location = inputs[i].value;
                        break;
                   }
               }
            } 
        }, false );
	</script>
<?php }



