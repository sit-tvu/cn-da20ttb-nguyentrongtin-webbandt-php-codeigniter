//slider--------------------------------------
const rightbtn = document.querySelector(".fa-chevron-right");
const leftbtn = document.querySelector(".fa-chevron-left");
const imgNumber = document.querySelectorAll(".slider-content-left-top img");
console.log(imgNumber.length);
let index = 0;
rightbtn.addEventListener("click", function () {
	index = index + 1;
	if (index > imgNumber.length - 1) {
		index = 0;
	}
	document.querySelector(".slider-content-left-top").style.right =
		index * 100 + "%";
});
leftbtn.addEventListener("click", function () {
	index = index - 1;
	if (index < 0) {
		index = imgNumber.length - 1;
	}
	document.querySelector(".slider-content-left-top").style.right =
		index * 100 + "%";
});
const imgNumberLi = document.querySelectorAll(".slider-content-left-bottom li");
imgNumberLi.forEach(function (image, index) {
	image.addEventListener("click", function () {
		removeactive();
		document.querySelector(".slider-content-left-top").style.right =
			index * 100 + "%";
		image.classList.add("active");
	});
});
function removeactive() {
	let imgative = document.querySelector(".active");
	imgative.classList.remove("active");
}
function autoimg() {
	index = index + 1;
	if (index > imgNumber.length - 1) {
		index = 0;
	}
	removeactive();
	document.querySelector(".slider-content-left-top").style.right =
		index * 100 + "%";
	imgNumberLi[index].classList.add("active");
}
setInterval(autoimg, 4000);
//slider-------------------------------------------

//slider product-----------------------------------
const rightbtntwo = document.querySelector(".fa-chevron-right-two");
const leftbtntwo = document.querySelector(".fa-chevron-left-two");
const imgNumbertwo = document.querySelectorAll(
	".slider-product-one-content-items"
);
rightbtntwo.addEventListener("click", function () {
	index = index + 1;
	if (index > imgNumbertwo.length - 1) {
		index = 0;
	}
	document.querySelector(
		".slider-product-one-content-items-content"
	).style.right = index * 100 + "%";
});
leftbtntwo.addEventListener("click", function () {
	index = index - 1;
	if (index < 0) {
		index = imgNumbertwo.length - 1;
	}
	document.querySelector(
		".slider-product-one-content-items-content"
	).style.right = index * 100 + "%";
});
//ẩn hiện password--------------------------------
var x = true;
function myfunction() {
	if (x) {
		document.getElementById("pass").type = "text";
		x = false;
	} else {
		document.getElementById("pass").type = "password";
		x = true;
	}
}
