var header = document.querySelector(".header");
var nav = document.querySelector(".nav");
var header_txt = document.querySelector(".logo_text");
var burger_menu_txt = document.querySelector(".burger_menu");
const parentElement = document.querySelector(".menu");
let allChildren = parentElement.querySelectorAll(":scope > .menu_item >a");

var button = document.querySelector(".bi-menu_button_op");
var button_rv = document.querySelector(".bi-menu_button_cl");
var aside = document.querySelector(".aside");

function menu() {
  button.classList.toggle("active");
  button_rv.classList.toggle("active");
  aside.classList.toggle("aside_return");
}

// function swap_IMG(id) {
//   var selected_img = document.querySelector(".main_img");
//   var item_image = document.querySelector(".img_list_imge_" + id).src;

//   console.log(item_image);

//   console.log(selected_img.src);
//   selected_img.src = item_image;
// }
