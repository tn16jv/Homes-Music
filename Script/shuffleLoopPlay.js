var links;
var currentIndex;

$(document).ready(function() {
    $("#loopButton").addClass('active');
    loopInitialize();

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

    $("#hidePlayer").on("click", function() {
        hidden();
    });

    $("#reopenArea").hide();
    $("#showPlayer").on("click", function() {
        showing();
    })
});

function play() {
    links.get(currentIndex).click();
}

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

function shuffleInitialize() {
    links = $("button[name='playSong']:visible");
    links = fisherYates(links);
    currentIndex = 0;
}

function shuffle() {
    $("#shuffleButton").addClass("active");
    $("#loopButton").removeClass("active");
    //var randIndex = Math.floor(Math.random() * links.length);
    //links.get(randIndex).click();
    shuffleInitialize();
    play();
}

function loopInitialize() {
    links = $("button[name='playSong']:visible");
    currentIndex = 0;
}


function loop() {
    $("#shuffleButton").removeClass("active");
    $("#loopButton").addClass("active");
    loopInitialize()
    play();
}

const mod = (x, n) => (x % n + n) % n

function last() {
    currentIndex = mod(currentIndex-1, links.length);
    play();
}

function next() {
    currentIndex = mod(currentIndex+1, links.length);
    play();
}

function hidden() {
    $("#playerArea").hide();
    $("#reopenArea").show();
}

function showing() {
    $("#playerArea").show();
    $("#reopenArea").hide();
}