//Liste des gites

//On récupère les valeurs du formulaire

//On récupère l'ID des input contenant nos valeurs

//Couchages et SdB
let sleep = document.getElementById('nb_sleep');
let bathroom = document.getElementById('nb_bathroom');

//Catégories
let cat1 = document.getElementById('cat1');
let cat2 = document.getElementById('cat2');
let cat3 = document.getElementById('cat3');
let cat4 = document.getElementById('cat4');

//Options
let opt1 = document.getElementById('option1');
let opt2 = document.getElementById('option2');
let opt3 = document.getElementById('option3');
let opt4 = document.getElementById('option4');

//On récupère les valeurs dans les inputs

//Couchages et SdB
let nbSleep = sleep.value;
let nbBathroom = bathroom.value;

//Catégories
categorie1 = cat1.value;
categorie2 = cat2.value;
categorie3 = cat3.value;
categorie4 = cat4.value;

//Options
option1 = opt1.value;
option2 = opt2.value;
option3 = opt3.value;
option4 = opt4.value;

//On récupère la recherche par nom
let searchByName = document.getElementById('search');
let search = searchByName.value;
console.log(search);


giteDisplay();

function giteDisplay() {
    const listGites = document.getElementById('list-gites')
    const xhr = new XMLHttpRequest();

    xhr.open('GET', './select-gite.php?nbSleep=' + nbSleep + '&nbBathroom=' + nbBathroom + '&cat1=' + categorie1 + '&cat2=' + categorie2 + '&cat3=' + categorie3 + '&cat4=' + categorie4 + '&opt1=' + option1 + '&opt2=' + option2 + '&opt3=' + option3 + '&opt4=' + option4 + '&search=' + search, true);

    xhr.onreadystatechange = function () {

        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            let datas = JSON.parse(this.responseText)
            let listDom = ''
            

            for (let data of datas) {
                listDom += '<li class="gites"><h2 class="text-list-gite">' + data.name_gite + '</h2><p class="text-list-gite">' + data.location_gite + '</p><div class="btn-bin-modif"><a href="../admin/modification.php?id=' + data.id_gite + '"><img src="../templates/img/icon/btn-modif.png" alt="icone de bouton modification"></a><a href="#" class="btn-del" data-id="' + data.id_gite + '"><img src="../templates/img/icon/btn-delete.png" alt="icone de bouton supprimer/poubelle"></a></div></li>'
            }

            listGites.innerHTML = listDom;

            showModal();

            hideModal();

            document.getElementById('nb-posts').innerHTML = countGite();
        }
    }
    xhr.send();
}

//Affichage de la modal

function showModal() {
    const btnDel = document.getElementsByClassName('btn-del');
    const confirm = document.getElementsByClassName('confirm');

    for (const element of btnDel) {
        element.addEventListener('click', function (e) {
            e.preventDefault();
            confirm[0].style.display = 'block';
            let idGite = this.dataset.id;
            console.log(idGite)
            deleteGite(idGite);
        })
    }
}

//Fermeture de la modal

function hideModal() {
    const no = document.getElementById('no');
    const yes = document.getElementById('yes');
    const confirm = document.getElementsByClassName('confirm');

    no.addEventListener('click', function () {
        confirm[0].style.display = 'none';
    })

    yes.addEventListener('click', function () {
        confirm[0].style.display = 'none';
    })
}

//Suppression d'un gite

function deleteGite(id) {

    const yes = document.getElementById('yes');

    yes.addEventListener('click', function () {

        const xhr = new XMLHttpRequest();
        xhr.open('POST', './delete-gite.php', true);

        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                giteDisplay();
            }
        }
        xhr.send('id_gite=' + id);
    })
}

function countGite() {
    return document.getElementsByClassName('gites').length;
}
