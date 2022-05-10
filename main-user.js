// SLIDER PAGE RESERVATION USER
let getId = document.getElementById('id-gite-resa');
let idGite = getId.value;
console.log(idGite);

let slide = [];
let slideNb = 0;

const right = document.getElementById("right");
const left = document.getElementById("left");


giteDisplay();

function giteDisplay() {
    
    const xhr = new XMLHttpRequest();

    xhr.open('GET', './select-slider.php?id=' + idGite, true);

    xhr.onreadystatechange = function () {

        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            let datas = JSON.parse(this.responseText)


            for (let data of datas) {
                slide.push("./img/gite/" + data.name_image);
            }
            
        }
    }
    xhr.send();
}

console.log(slide);

right.addEventListener('click', function () {

    slideNb++;

    if (slideNb > slide.length - 1) {
        slideNb = 0;
    }

    document.getElementById("slide").src = slide[slideNb];

    console.log(slideNb);

});

left.addEventListener('click', function() {
    slideNb--;

    if (slideNb < 0) {
        slideNb = 2;
    }

    document.getElementById("slide").src = slide[slideNb];

    console.log(slideNb);

});

setInterval(function(){

    slideNb++;
    
    if (slideNb > slide.length - 1) {
        slideNb = 0;
    }
    document.getElementById("slide").src = slide[slideNb];
}, 3000)


//Fermeture modal reservation
let btn = document.getElementById('btn-close-modal-resa');
let modal = document.getElementById('modal-resa-denied');

btn.addEventListener('click', function(){
    modal.classList.add('none')
})



