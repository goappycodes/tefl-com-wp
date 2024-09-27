// DISABLED BY RITESH - 07102023 - NOT USED FOR NOW
// Enabled By Bikram as requsted on skype 16-11-2023

// jQuery(document).ready(function ($) {
//     const mouseEvent = e => {
//         const shouldShowExitIntent =
//             !e.toElement &&
//             !e.relatedTarget &&
//             e.clientY < 5;

//         if (shouldShowExitIntent) {
//             document.removeEventListener('mouseout', mouseEvent);
//             Boxzilla.show(81200);
//             CookieService.setCookie('exitIntent', true, 30,'/');
//         }
//     };
//     if (!CookieService.getCookie('exitIntent')) {
//         setTimeout(() => {
//             document.addEventListener('mouseout', mouseEvent);
//         }, 10000);
//     }
// });