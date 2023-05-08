let btn = document.querySelector(".btn1");
let list_nav = document.querySelector(".navUl");
let bye = document.querySelectorAll(".bye");

btn.addEventListener("click", (e) => {
  let nav = document.getElementById("navbar");
  let img = document.querySelector(".imgBanniere");
  img.classList.toggle("active");
  nav.classList.toggle("active");
  btn.classList.toggle("active");
  

  bye.forEach((element) => {
    element.classList.toggle("smallScreen");
  });
});

var completed = 0,
  imgHeight = 1374,
  posArr = [
    0, //orange
    80, //number 7
    165, //bar
    237, //guava
    310, //banana
    378, //cherry
    454, //orange
    539, //number 7
    624, //bar
    696, //guava
    769, //banana
    837, //cherry
    913, //orange
    1000, //number 7
    1085, //bar
    1157, //guava
    1230, //banana
    1298, //cherry
  ];

var win = [];
win[0] = win[454] = win[913] = 1;
win[80] = win[539] = win[1000] = 2;
win[165] = win[624] = win[1085] = 3;
win[237] = win[696] = win[1157] = 4;
win[310] = win[769] = win[1230] = 5;
win[378] = win[837] = win[1298] = 6;

var start = document.getElementById("start");
start.addEventListener("click", spin);

var result = document.getElementById("resultat");

/**
 * Permet de faire tourner les trois roulettes
 */
function spin() {

  // permets d'attribuer un index de position aléatoire pour les trois roulettes, qui seront utilisées pour initialiser la position de départ de chaque roulette lors du lancement de la fonction spin()
  start.style.pointerEvents = "none";
  var roulette1Pos = Math.floor(Math.random() * posArr.length),
    roulette2Pos = Math.floor(Math.random() * posArr.length),
    roulette3Pos = Math.floor(Math.random() * posArr.length),
    count = 0,
    speed = 50;

  var roulette1 = document.getElementById("roulette1");
  var roulette2 = document.getElementById("roulette2");
  var roulette3 = document.getElementById("roulette3");


  //  anime la première roulette en modifiant la position de l'image de fond à chaque itération, jusqu'à ce que la roulette tourne un certain nombre de fois (count > 50) 
  var blur1 = setInterval(function () {
    roulette1.style.backgroundPosition = "0px " + posArr[roulette1Pos] + "px";
    roulette1Pos++;
    if (roulette1Pos > posArr.length - 1) {
      roulette1Pos = 0;
    }
    count++;
    if (count > 50) {
      clearInterval(blur1);
      checkWin();
    }
  }, speed);

  //  anime la deuxieme roulette en modifiant la position de l'image de fond à chaque itération, jusqu'à ce que la roulette tourne un certain nombre de fois (count > 50)
  var blur2 = setInterval(function () {
    roulette2.style.backgroundPosition = "0px " + posArr[roulette2Pos] + "px";
    roulette2Pos++;
    if (roulette2Pos > posArr.length - 1) {
      roulette2Pos = 0;
    }
    count++;
    if (count > 50) {
      clearInterval(blur2);
      checkWin();
    }
  }, speed);

  //  anime la troisieme roulette en modifiant la position de l'image de fond à chaque itération, jusqu'à ce que la roulette tourne un certain nombre de fois (count > 50)
  var blur3 = setInterval(function () {
    roulette3.style.backgroundPosition = "0 " + posArr[roulette3Pos] + "px";
    roulette3Pos++;
    if (roulette3Pos > posArr.length - 1) {
      roulette3Pos = 0;
    }
    if (count > 50) {
      clearInterval(blur3);
      checkWin();
    }
  }, speed);
}

/**
 * Permet attribuer le lot gagné
 */
function checkWin() {
  completed++;

  // envoie une requête XMLHttpRequest pour récupérer les données des loteries à partir d'un fichier JSON.
  if (completed == 3) {
    let loteries;
    const xhttp = new XMLHttpRequest();

    xhttp.onload = function () {
      let res = this.responseText;
      if (res.charCodeAt(0) === 0xfeff) {
        res = res.substring(1);
      }
      loteries = JSON.parse(res);
      // console.log("loteries", loteries);
    };
    xhttp.open(
      "GET",
      "index.php?uc=commander&action=trouverToutesLesLoteries&json=true",
      false
    );
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send();


    // calcule la somme de toutes les quantités restantes de chaque loterie et stocke le résultat dans la variable sum.
    let sum = 0;

    loteries.forEach((element) => {
      // console.log("loterie", element);
      sum += Number(element.quantite_restant);
    });

    // console.log("sum", sum);

    let sommeEncours = 0;
    loteries.forEach((element) => {
      // console.log("loterie", element);
      sommeEncours += Number(element.quantite_restant);
      element.winRate = sommeEncours / sum;
    });

    // console.log("loteries", loteries);
// crée un tableau array qui contient tous les taux de gain des loteries arrondis à deux décimales.
    let array = ["0"];
    loteries.forEach((element) => {
      array.push(Number(element.winRate.toFixed(2)));
    });
    // console.log("arr", array);

    // génère un nombre aléatoire rate arrondi à deux décimales
    let rate = Math.random().toFixed(2);
    // console.log("rate", rate);


    // parcourt le tableau array et détermine le lot gagné en fonction du taux de gain et du nombre aléatoire généré.
    let lot = -1;
    let max = 1,
      min = 0;

    for (let index = 0; index < array.length; index++) {
      const element = array[index];
      // console.log("element", element);
      if (rate > element && element > min) {
        // console.log("min", element);
        min = element;
      } else if (rate <= element && element <= max) {
        // console.log("max", element);
        max = element;
        lot = index;
      }
    }

    // console.log("min max index", min, max, lot);

// affiche le résultat sur les trois roulettes et affiche le produit gagnant sur la page web
    roulette1.style.backgroundPosition = "0px " + posArr[lot] + "px";
    roulette2.style.backgroundPosition = "0px " + posArr[lot] + "px";
    roulette3.style.backgroundPosition = "0 " + posArr[lot] + "px";

    var res =
      "Bravo !! Vous avez gagné un lot : " + loteries[lot - 1].produit;
    result.innerHTML = res;
    start.style.pointerEvents = "auto";
    completed = 0;

    document.getElementById("start").style.display = 'none';

    // réinitialise les variables et les éléments de la page web pour permettre une nouvelle partie
    setTimeout(() => {
      document
        .getElementsByName("idLoterie")[0]
        .setAttribute("value", loteries[lot - 1].id);
      document.getElementById("ajouterPanier").click();
    }, "5000");
  }
}
