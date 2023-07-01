// new change
//for menu link accordion
var acc = document.getElementsByClassName("menu-accordion");
var i;
for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function () {
        var panel = this.nextElementSibling;
        var menuPanel = document.getElementsByClassName("menu-panel");

        if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
        } else { 
          for (var iii = 0; iii < menuPanel.length; iii++) {
              menuPanel[iii].style.maxHeight = null;
          }
            panel.style.maxHeight = panel.scrollHeight + "px";
        }
    }
}
// new change



const sidebar = document.querySelector('.sidebar');
const hamber = document.querySelector('.hamber-icon');
const mainContent = document.querySelector('.main-content');
const menuToggle = document.querySelector('.menu-toggle');

hamber.addEventListener('click', function () {
  sidebar.classList.toggle('active');
  mainContent.classList.toggle('active');
  menuToggle.classList.toggle('active');
});

menuToggle.addEventListener('click', function () {
  sidebar.classList.toggle('active');
  mainContent.classList.toggle('active');
  menuToggle.classList.toggle('active');
});

// //submenu
// subemenu_sidebar.forEach(item => {
//   item.addEventListener('click', function () {
//     item.classList.toggle('show-subemenu');
//     const mega = item.nextElementSibling;
//     mega.classList.toggle('activemenu');
//   });
// });



// const accor = document.querySelectorAll('.subemene-sidebar');

// accor.forEach(item => {
//   item.addEventListener('click', function () {
//     item.classList.toggle('active');
//     const content = item.nextElementSibling;
//     if (content.style.height) {
//       content.style.height = null;
//     } else {
//       content.style.height = content.scrollHeight + 'px';
//     }
//   });
// });
