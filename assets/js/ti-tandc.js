$( document ).ready(function() {

/*	if($(window).width() >= 1600){
		$('.table-of-contents').addClass('table-sticky');
	}
	
	
	var $fixedtoc = $('.table-of-contents');
    var tocPos = $fixedtoc.offset().top;
    $(window).scroll(function() {
    	var scrollPos = $(this).scrollTop();
    	if (scrollPos >= tocPos) {
    
    		$fixedtoc.addClass('fixed-toc');
    
    	} else {
    
    		$fixedtoc.removeClass('fixed-toc');
    
    	}
    
    });


    $("#toc_body").on('click','a',function(){
        $("#toc_body a.active").removeClass("active"); 
        $(this).addClass("active"); 
    });*/
    
})




/*function TableOfContents(container, output) {
	var toc = "";
	var level = 0;
	var container = document.querySelector(container) || document.querySelector('#contents');
	var output = output || '#toc_body';

	container.innerHTML =
		container.innerHTML.replace(
		/<h([\d])>([^<]+)<\/h([\d])>/gi,
		function (str, openLevel, titleText, closeLevel) {
		    
		    if(openLevel == 1 || openLevel ==3 || openLevel == 4 || openLevel == 5 || openLevel == 6){
		        return str;
		    }
		    
			if (openLevel != closeLevel) {
				return str;
			}

			toc += (new Array(1)).join('</li>');

			level = parseInt(openLevel);
			
			tempTitle = titleText.replace(/[1.2.3.4.5.6.7.8.9.10.]/g,"");
			
			var anchor = titleText.replace(/[ ?().!,$#@]/g, "_");

			toc += '<li><a href="#' + anchor + '">' + tempTitle
				+ '</a>';



			return '<h' + openLevel + ' id="' + anchor + '">'
				+ titleText + '</h' + closeLevel + '>';
		}
	);

	if (level) {
		toc += (new Array(level + 1)).join('</ul>');
	}
	document.querySelector(output).innerHTML += toc;
}



document.addEventListener('DOMContentLoaded', function() {
	var check = false;
	var flag = 0;
	
	if(jQuery('#contents h2').length  < 3){
	    jQuery(".table-of-contents").hide();
	}

	function setCheck(){
		setTimeout(() => { 
			check = true;
		}, 
	500);
	}


	setInterval(function(){ 
		setCheck(); 
		if(check === true && flag === 0){

			TableOfContents();

			flag = 1;
		}
	}, 500);
});*/



/*function createTOC() {
	var y = document.createElement('div');
	y.id = 'innertoc';
	var a = y.appendChild(document.createElement('span'));
	a.onclick = showhideTOC;
	a.id = 'contentheader';
	a.innerHTML = 'show page contents';
	var z = y.appendChild(document.createElement('div'));
	z.onclick = showhideTOC;
	var toBeTOCced = getElementsByTagNames('h2,h3,h4,h5');
	if (toBeTOCced.length < 2) return false;

	for (var i=0;i<toBeTOCced.length;i++) {
		var tmp = document.createElement('a');
		tmp.innerHTML = toBeTOCced[i].innerHTML;
		tmp.className = 'page';
		z.appendChild(tmp);
		if (toBeTOCced[i].nodeName == 'H4')
			tmp.className += ' indent';
		if (toBeTOCced[i].nodeName == 'H5')
			tmp.className += ' extraindent';
		var headerId = toBeTOCced[i].id || 'link' + i;
		tmp.href = '#' + headerId;
		toBeTOCced[i].id = headerId;
		if (toBeTOCced[i].nodeName == 'H2') {
			tmp.innerHTML = 'Top';
			tmp.href = '#top';
			toBeTOCced[i].id = 'top';
		}
	}
	return y;
}

var TOCstate = 'none';

function showhideTOC() {
	TOCstate = (TOCstate == 'none') ? 'block' : 'none';
	var newText = (TOCstate == 'none') ? 'show page contents' : 'hide page contents';
	document.getElementById('contentheader').innerHTML = newText;
	document.getElementById('innertoc').lastChild.style.display = TOCstate;
}
*/


