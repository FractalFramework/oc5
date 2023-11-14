(function () {
var input = document.getElementById("images"),
formdata = false;

if (window.FormData) {
formdata = new FormData();
document.getElementById("btn").style.display = "none";
}
}
();

function showUploadedItem (source) {
var list = document.getElementById("image-list"),
li = document.createElement("li"),
img = document.createElement("img");
img.src = source;
li.appendChild(img);
list.appendChild(li);
}
