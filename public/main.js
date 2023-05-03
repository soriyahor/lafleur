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

    // 0, //orange
    //     138, //number 7
    //     277, //bar
    //     415, //guava
    //     554, //banana
    //     692, //cherry
    //     830, //orange
    //     969, //number 7
    //     1108, //bar
    //     1246, //guava
    //     1385, //banana
    //     1523, //cherry
    //     1661, //orange
    //     1800, //number 7
    //     1939, //bar
    //     2077, //guava
    //     2216, //banana
    //     2354 //cherry
  ];

var win = [];
win[0] = win[830] = win[1661] = 1;
win[138] = win[969] = win[1800] = 2;
win[277] = win[1108] = win[1939] = 3;
win[415] = win[1246] = win[2077] = 4;
win[554] = win[1385] = win[2216] = 5;
win[692] = win[1523] = win[2354] = 6;

var start = document.getElementById("start");
start.addEventListener("click", spin);

var result = document.getElementById("resultat");

function spin() {
  start.style.pointerEvents = "none";
  var roulette1Pos = Math.floor(Math.random() * posArr.length),
    roulette2Pos = Math.floor(Math.random() * posArr.length),
    roulette3Pos = Math.floor(Math.random() * posArr.length),
    count = 0,
    speed = 50;

  var roulette1 = document.getElementById("roulette1");
  var roulette2 = document.getElementById("roulette2");
  var roulette3 = document.getElementById("roulette3");

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

function checkWin() {
  completed++;
  if (completed == 3) {
    let loteries;
    const xhttp = new XMLHttpRequest();

    xhttp.onload = function () {
      let res = this.responseText;
      if (res.charCodeAt(0) === 0xfeff) {
        res = res.substring(1);
      }
      loteries = JSON.parse(res);
      console.log("loteries", loteries);
    };
    xhttp.open(
      "GET",
      "index.php?uc=commander&action=trouverToutesLesLoteries&json=true",
      false
    );
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send();

    let sum = 0;

    loteries.forEach((element) => {
      console.log("loterie", element);
      sum += element.quantite_restant;
    });

    console.log("sum", sum);

    let sommeEncours = 0;
    loteries.forEach((element) => {
      console.log("loterie", element);
      sommeEncours += element.quantite_restant;
      element.winRate = sommeEncours / sum;
    });

    console.log("loteries", loteries);

    let array = ["0"];
    loteries.forEach((element) => {
      array.push(element.winRate.toFixed(2));
    });
    console.log("arr", array);

    let rate = Math.random().toFixed(2);
    console.log("rate", rate);

    let lot = -1;
    let max = 1,
      min = 0;

    for (let index = 0; index < array.length; index++) {
      const element = array[index];
      console.log("element", element);
      if (rate > element && element > min) {
        console.log("min", element);
        min = element;
      } else if (rate <= element && element <= max) {
        console.log("max", element);
        max = element;
        lot = index;
      }
    }

    console.log("min max index", min, max, lot);

    roulette1.style.backgroundPosition = "0px " + posArr[lot] + "px";
    roulette2.style.backgroundPosition = "0px " + posArr[lot] + "px";
    roulette3.style.backgroundPosition = "0 " + posArr[lot] + "px";

    var res =
      "JACKPOT !! Vous avez gagné un lot : " + loteries[lot - 1].produit;
    result.innerHTML = res;
    start.style.pointerEvents = "auto";
    completed = 0;

    document.getElementById("start").style.display = 'none';

    setTimeout(() => {
      document
        .getElementsByName("idLoterie")[0]
        .setAttribute("value", loteries[lot - 1].id);
      document.getElementById("ajouterPanier").click();
    }, "5000");
  }
}
