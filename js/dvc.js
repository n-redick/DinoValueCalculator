/*###########################
 * Variables
 ##########################*/
var p = 1 / 7;
var accuracy = 4;
var stats = ["health", "stamina", "oxygen", "food", "weight", "melee", "movement"];
var cookies = false;
var dino_data = null;
var current_dino_data = null;

/*###########################
 * Listeners
 ##########################*/
$('.numberInput').keyup(function (e)
{
    onlyNumbers(this);
});

$(".acceptCookie").click(function () {
    console.log("cookies:OK!");
    cookies = true;
    $(".btn-primary").removeClass('disabled');
});

$(".form-control").focusout(function (e) {
    calcChance(e);
    getBestChance();
});

$(".btn-primary").click(function () {
    saveToCookie();
});

$(".btn-info").click(function () {
    $(".impressum").slideToggle();
});

$("#dinotype").change(function () {
    loadCookieValues();
    setCurrentDinoData();
});

$(".wildValue").focusout(function(e){
    $("#"+$(e.target).attr("aria-type")+"level").val(
        getLevelUpsPreTame($(e.target).attr("aria-type"),$(e.target).val())
    );
});
/*###########################
 * Function
 ##########################*/
function loadDinoData() {
    $.ajaxSetup({
        async: false
    });
    $.getJSON("./data/dino_data.json", function (json) {
        dino_data = json;
        //console.log(dino_data);
    });
    $.ajaxSetup({
        async: true
    });
}

function setCurrentDinoData() {
    if (dino_data === null) {
        loadDinoData();
    }
    var dino = $("#dinotype").val();
    //console.log("test");
    jQuery.each(dino_data, function (i, val) {
        if (dino === val.name) {
            current_dino_data = val;
            return;
        }
    });

}

function getLevelUpsPreTame(stat, value) {
    var dino = $("#dinotype").val();
    var base = 0;
    var wild = 0;
    if (dino == "Choose Dino" || dino == "Wähle Dino") {
        return
    }
    jQuery.each(current_dino_data, function (i, val) {
        if (i === stat + "_base") {
            base = val;
        }
        if (i === stat + "_inc_wild") {
            wild = val;
        }
    });
    if (stat != 'movement') {
        var rawValue = value;
        rawValue -= base;
        console.info(rawValue);
        //round down;
        return rawValue / wild;
    } else {

    }
}

function getLevelUpsTame(stat, value) {
    var dino = $("#dinotype").val();
    var add = 0;
    var mul = 0;
    if (dino == "Choose Dino" || dino == "Wähle Dino") {
        return
    }
    jQuery.each(current_dino_data, function (i, val) {
        if (i === stat + "_tamed_add") {
            add = val;
        }
        if (i === stat + "_tamed_mul") {
            mul = val;
        }
    });
    value = ((value/(100+mul))*100)-7;
    //Round UP
    return getLevelUpsPreTame(stat,value);
}

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
    if (cookies) {
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
}

function loadCookieValues() {
    if (cookies) {
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
}

function getBestChance() {
    var bestChance = 0;
    var bestType;
    stats.forEach(function (entry) {
        var testvalue = $("#" + entry + "chance").val();
        testvalue = parseInt(testvalue.replace("%", ""));
        if (isNaN(testvalue)) {
            return false;
        }
        if (testvalue > bestChance) {
            bestChance = testvalue;
            bestType = entry;
        }
    });
    $("#coi").val(calcChances(bestType));
}

function calcChances(fieldtype) {
    target = parseInt($("#" + fieldtype + "wish").val()) - parseInt($("#" + fieldtype + "level").val());
    if (isNaN(target)) {
        return false;
    }
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
    if (cookie) {
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
    }
    return "";

}