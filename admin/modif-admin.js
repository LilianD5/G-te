//Liste des images du gîte

let giteId = document.getElementById('id_gite');
let id = giteId.value;
console.log(id)

imageDisplay();

function imageDisplay() {

    const listImages = document.getElementById('list-images')

    const xhr = new XMLHttpRequest();

    xhr.open('GET', './select-image.php?id=' + id, true);

    xhr.onreadystatechange = function () {

        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            let datas = JSON.parse(this.responseText);
            let listDom = ''

            for (let data of datas) {
                listDom += '<li class="li-image"><img class="image-gite" src="../img/gite/' + data.name_image + '" alt=""><a href="#" class="icon-del" data-id="' + data.id_image + '" title="Delete"><img id="cross" src="../templates/img/icon/close.png" alt=""></a></li>'
            }

            listImages.innerHTML = listDom;

            showModal();

            hideModal()

        }
    }
    xhr.send();
}

function showModal() {
    const btnDel = document.getElementsByClassName('icon-del');
    const confirm = document.getElementsByClassName('confirm');

    for (const element of btnDel) {
        element.addEventListener('click', function (e) {
            e.preventDefault();
            confirm[0].style.display = 'block';
            let idImage = this.dataset.id;
            deleteImage(idImage);
        })
    }
}

function deleteImage(id){
    const yes = document.getElementById('oui');

    yes.addEventListener('click', function(){

        const xhr = new XMLHttpRequest();
        xhr.open('POST', './delete-image.php', true);

        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                imageDisplay();
            }
        }
        xhr.send('id_image=' + id);
        console.log(id);
    })
}

function hideModal() {
    const no = document.getElementById('non');
    const yes = document.getElementById('oui');
    const confirm = document.getElementsByClassName('confirm');

    no.addEventListener('click', function () {
        confirm[0].style.display = 'none';
    })

    yes.addEventListener('click', function () {
        confirm[0].style.display = 'none';
    })
}