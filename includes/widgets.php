<?php

add_action('tefl_footer_scripts', 'footer_tracking_scripts');
function footer_tracking_scripts(){
    ?>
    <!-- TrustBox script -->
    <!-- <script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" defer></script> -->
    <!-- End TrustBox script -->
    <script defer id="salesiq" type="text/javascript">
    var $zoho=$zoho || {};
    $zoho.salesiq = $zoho.salesiq || 
    {widgetcode:"74a26abd2f179ee9efd8b1197e292e5a95a723cab12c21d03d540347f90270198167740cc29dc87330a4487db8a55c4d", values:{},ready:function(){}};
    var d=document;s=d.createElement("script");s.type="text/javascript";s.id="zsiqscript";s.defer=true;
    s.src="https://salesiq.zoho.eu/widget";t=d.getElementsByTagName("script")[0];t.parentNode.insertBefore(s,t);d.write("<div id='zsiqwidget'></div>");
    </script>

    <?php
}

