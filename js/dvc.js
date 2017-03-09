/*###########################
 * Variables
 ##########################*/
var p = 1 / 7;
var accuracy = 4;
var stats = ["health", "stamina", "oxygen", "food", "weight", "melee", "speed"];

/*###########################
 * Listeners
 ##########################*/
$('.numberInput').keyup(function (e)
{
    onlyNumbers(this);
});

$(".form-control").focusout(function (e) {
    calcChance(e);
    getBestChance();
});

$(".btn-primary").click(function () {
    saveToCookie();
});

$("#dinotype").change(function () {
    loadCookieValues();
});

/*###########################
 * Function
 ##########################*/
function onlyNumbers(e) {
    if (/\D/g.test(e.value))
    {
        // Filter non-digits from input value.
        e.value = e.value.replace(/\D/g, '');
    }
}

function calcChance(e) {
    var fieldtype = $(e.target).attr("aria-type");
    if ($("#" + fieldtype + "level").val() == '' ||
            $("#" + fieldtype + "wish").val() == '' ||
            $("#blevel").val() == '') {
        console.info("error");
        return;
    }
    if (e.target.id == "blevel") {
        stats.forEach(function (entry) {
            $("#" + entry + "chance").val(calcChances(entry));
        });
    } else {
        $("#" + fieldtype + "chance").val(calcChances(fieldtype));
    }
}

function saveToCookie() {
    console.info(document.cookie);
    var exdays = 999;
    var wishValues = {};
    var dino = $("#dinotype").val();
    if (dino != "Choose Dino") {
        wishValues[dino] = {};
        stats.forEach(function (entry) {
            wishValues[dino][entry] = {};
            wishValues[dino][entry] = $("#" + entry + "wish").val();
        });
        console.info(wishValues);
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = "wishes=" + JSON.stringify(wishValues) + ";" + expires + ";path=/";
    }
}

function loadCookieValues() {
    dinoType = $("#dinotype").val();
    console.info(dinoType);
    if (dinoType != "Choose Dino") {
        var parsed = JSON.parse(getCookie("wishes"));
        console.info(parsed);
        stats.forEach(function (entry) {

            $("#" + entry + "wish").val(parsed[dinoType][entry]);
        });
    }
}

function getBestChance() {
    var bestChance = 0;
    var bestType;
    stats.forEach(function (entry) {
        var testvalue = $("#" + entry + "chance").val();
        console.info(testvalue = parseInt(testvalue.replace("%", "")));
        if (testvalue > bestChance) {
            bestChance = testvalue;
            bestType = entry;
        }
    });
    $("#coi").val(calcChances(bestType));
}

function calcChances(fieldtype) {
    target = parseInt($("#" + fieldtype + "wish").val()) - parseInt($("#" + fieldtype + "level").val());
    console.info("target:" + target);
    return getChance(target, p, Number($("#blevel").val()));
}

function chanceForX(target, chance, rolls) {
    var bino = this.binomial(rolls, target);
    if (!bino) {
        console.error("ERROR: 100");
        return;
    }
    return bino * (Math.pow(chance, target)) * Math.pow((1 - chance), (rolls - target));
}

function getChance(target, chance, rolls) {
    var realChance = 1;
    for (var x = 0; x < target; x++) {
        var P = this.chanceForX(x, chance, rolls);
        realChance -= P;
        console.info("P(" + x + "):" + P)
    }
    console.info(realChance);
    return (realChance * 100).toFixed(accuracy) + "%";
}

function binomial(n, k) {
    if ((typeof n !== 'number') || (typeof k !== 'number'))
        return false;
    var coeff = 1;
    for (var x = n - k + 1; x <= n; x++)
        coeff *= x;
    for (x = 1; x <= k; x++)
        coeff /= x;
    return coeff;
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}