jQuery(document).ready(function($) {
    $(document).on('click', '.filter-tabs .tabs a.tablinks', function(e){
        //e.preventDefault();
        if(!$(this).hasClass('active')){
            $('.filter-tabs .tabs a.tablinks').removeClass('active');
            $(this).addClass('active');
        }
    });
    
});
