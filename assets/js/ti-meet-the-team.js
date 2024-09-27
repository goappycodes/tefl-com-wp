jQuery(document).ready(function($) {
    $(document).on('click', '.meet-the-team-tabs .tabs a.tablinks', function(){
        event.preventDefault();
        if(!$(this).hasClass('active')){
            $('.meet-the-team-tabs .tabs a.tablinks').removeClass('active');
            $(this).addClass('active');
        }
    })
    
});


const tabbedContent = ()=>{
    const tabs=document.querySelectorAll("[data-tab-target]")
    const tabContents = document.querySelectorAll("[data-tab-content]")
    tabs.forEach(tab =>{
    tab.addEventListener('click',()=>{
        const target = document.querySelector(tab.dataset.tabTarget);
        tabContents.forEach(tabContent=>{
            tabContent.classList.remove('active');
        })
        target.classList.add('active');
    })
})
}

window.onload=function(){
tabbedContent();
// carouselSlider();
//timer();
}