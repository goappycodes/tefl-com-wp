jQuery(document).ready(function($){

	// Load More JS
    function load_more_jobs(){
        $('.job-row .job-col').hide();
        $('#loadMore').show();
        var size_li = $(".job-row .job-col").size();
        console.log(size_li);
        var x=20;
        $('.job-row .job-col:lt('+x+')').show();
        if(x >= size_li){
            $('#loadMore').hide();
        }
        $('#loadMore').click(function () {
            x= (x+12 <= size_li) ? x+12 : size_li;
            console.log(x)
            $('.job-row .job-col:lt('+x+')').show();
            if(x === size_li){
                $('#loadMore').hide();
            }
        });
    }
	
    load_more_jobs();

    $('.job-preloader').hide();

    $(document).on("keypress", ".job-search", function(e){
        if(e.which == 13){
            $('.job-row').attr('style', 'opacity:0.3;');
            $('.job-preloader').show();
            var searchVal = $(this).val();

            var data = {
	            'action': 'ti_job_search',
	            'searchVal': searchVal
	        };

	        $.post(ti_obj.ti_ajax, data, function(response) {

	            var res = JSON.parse(response);

	            if (res.status === true) {
	                var job_content = res.content;
                    $('.job-row').html(job_content);
                    load_more_jobs();
                    $('.job-row').attr('style', 'opacity:1;');
                    $('.job-preloader').hide();
	            }else{
	                $('.job-row').html("<p>No job found with the keyword <b>'"+searchVal+"'</b></p>");
                    $('.job-row').attr('style', 'opacity:1;');
                    $('.job-preloader').hide();
                    $('#loadMore').hide();
	            }

	        });
        }
    });

    
})