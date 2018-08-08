var links;
var currentIndex = 0;

$(document).ready(function() {
    $("#shuffleButton").on("click", function () {
        shuffle();
    });

    $("#loopButton").on("click", function () {
        loop();
    });

    $("#lastTrack").on("click", function () {
        last();
    });

    $("#nextTrack").on("click", function () {
        next();
    });
});

function fisherYates(array) {
    var currentIndex = array.length, temporaryValue, randomIndex;

    // While there remain elements to shuffle...
    while (0 !== currentIndex) {

        // Pick a remaining element...
        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex -= 1;

        // And swap it with the current element.
        temporaryValue = array[currentIndex];
        array[currentIndex] = array[randomIndex];
        array[randomIndex] = temporaryValue;
    }

    return array;
}

function shuffle() {
    $("#shuffleButton").css("background-color", "limegreen");
    $("#loopButton").css("background-color", "darkslategray");
    links = $("button[name='playSong']");
    //var randIndex = Math.floor(Math.random() * links.length);
    //links.get(randIndex).click();
    links = fisherYates(links);
    currentIndex = 0;
    play();
}

function loop() {
    $("#shuffleButton").css("background-color", "darkslategray");
    $("#loopButton").css("background-color", "limegreen");
    links = $("button[name='playSong']");
    currentIndex = 0;
    play();
}

const mod = (x, n) => (x % n + n) % n

function play() {
    links.get(currentIndex).click();
}

function last() {
    currentIndex = mod(currentIndex-1, links.length);
    play();
}

function next() {
    currentIndex = mod(currentIndex+1, links.length);
    play();
}