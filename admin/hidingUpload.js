function hide(x){
    var image_id = document.getElementById("img_" + x);
    image_id.style.display = "none";
}

const date = new Date();
const current_year = date.getFullYear();
document.getElementById("footer_description").innerHTML = `&copy; ${current_year} <a href="#">Rozwalka.com</a> All rights reserved`;
