<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="css/bootstrap.css">
        <style>
            .input-group-addon{
                width:110px;
            }

            .btn-primary{
                width: 100%;    
            }
            .input-group > .form-control{
                width:75px !important;
            }
            .row{
                margin-bottom: 7px;
            }
            .container{
                width: 640px;
                padding-top: 50px;
            }
            .chance{
                width:  75px;
            }
            .chance + .form-control{
                width: 110px !important;
                text-align: right;
            }
        </style>
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        -->
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <select class="form-control" id="dinotype">
                        <option>Choose Dino</option>
                        <?php
                        $handle = fopen("./data/dinos.html", "r");
                        if ($handle) {
                            while (($line = fgets($handle)) !== false) {
                                echo "<option>" . $line . "</option>";
                            }

                            fclose($handle);
                        } else {
                            // error opening the file.
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon">Bonus Level</span>
                        <input type="text" class="form-control" id="blevel">
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="btn btn-primary"> Save Wish Values</div>
                </div>
            </div>
            <div class="row"style="margin-top:50px;">
                <div class="col-xs-12">
                    <div class="input-group" style="width:255px;margin:0 auto;">
                        <span class="input-group-addon">Chance of Improvement</span>
                        <input type="text" class="form-control" disabled id="coi">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <div class="input-group">
                        <span class="input-group-addon" >HP Tame</span>
                        <input type="text" class="form-control" id="hplevel" aria-type="hp">
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="input-group">
                        <span class="input-group-addon" >HP Wish</span>
                        <input type="text" class="form-control" id="hpwish" aria-type="hp">
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="input-group">
                        <span class="input-group-addon chance">Chance</span>
                        <input type="text" class="form-control" disabled  id="hpchance">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <div class="input-group">
                        <span class="input-group-addon">Stam Tame</span>
                        <input type="text" class="form-control" id="stamlevel" aria-type="stam">
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="input-group">
                        <span class="input-group-addon" >Stam Wish</span>
                        <input type="text" class="form-control" id="stamwish" aria-type="stam">
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="input-group">
                        <span class="input-group-addon chance">Chance</span>
                        <input type="text" class="form-control" disabled id="stamchance">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <div class="input-group">
                        <span class="input-group-addon" >Oxy Tame</span>
                        <input type="text" class="form-control" id="oxylevel" aria-type="oxy">
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="input-group">
                        <span class="input-group-addon" >Oxy Wish</span>
                        <input type="text" class="form-control" id="oxywish"  aria-type="oxy">
                    </div>
                </div>

                <div class="col-xs-4">
                    <div class="input-group">
                        <span class="input-group-addon chance">Chance</span>
                        <input type="text" class="form-control" disabled id="oxychance">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <div class="input-group">
                        <span class="input-group-addon" >Food Tame</span>
                        <input type="text" class="form-control" id="foodlevel" aria-type="food">
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="input-group">
                        <span class="input-group-addon" >Food Wish</span>
                        <input type="text" class="form-control" id="foodwish"  aria-type="food">
                    </div>
                </div>

                <div class="col-xs-4">
                    <div class="input-group">
                        <span class="input-group-addon chance">Chance</span>
                        <input type="text" class="form-control" disabled id="foodchance">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <div class="input-group">
                        <span class="input-group-addon" >Weight Tame</span>
                        <input type="text" class="form-control" id="weightlevel" aria-type="weight">
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="input-group">
                        <span class="input-group-addon" >Weight Wish</span>
                        <input type="text" class="form-control" id="weightwish" aria-type="weight">
                    </div>
                </div>

                <div class="col-xs-4">
                    <div class="input-group">
                        <span class="input-group-addon chance">Chance</span>
                        <input type="text" class="form-control" disabled id="weightchance">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <div class="input-group">
                        <span class="input-group-addon" >Melee Tame</span>
                        <input type="text" class="form-control" id="meleelevel" aria-type="melee">
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="input-group">
                        <span class="input-group-addon" >Melee Wish</span>
                        <input type="text" class="form-control" id="meleewish"  aria-type="melee">
                    </div>
                </div>

                <div class="col-xs-4">
                    <div class="input-group">
                        <span class="input-group-addon chance">Chance</span>
                        <input type="text" class="form-control" disabled id="meleechance">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <div class="input-group">
                        <span class="input-group-addon" >Speed Tame</span>
                        <input type="text" class="form-control" id="speedlevel"  aria-type="speed">
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="input-group">
                        <span class="input-group-addon" >Speed Wish</span>
                        <input type="text" class="form-control" id="speedwish"  aria-type="speed">
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="input-group">
                        <span class="input-group-addon chance">Chance</span>
                        <input type="text" class="form-control" disabled id="speedchance">
                    </div>
                </div>
            </div>
            <div class="alert alert-danger alert-dismissable" contenteditable="true">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">OK! I accept that</button>
                <h4>This site uses Cookies!</h4>
                To save your wishstats for specific Dinos this Site uses Cookies.
        </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script>
            var p = 1 / 7;
            var stats = ["hp", "stam", "oxy", "food", "weight", "melee", "speed"];

            $(".form-control").focusout(function (e) {
                var fieldtype = $(e.target).attr("aria-type");
                if ($("#" + fieldtype + "level").val() == '' ||
                        $("#" + fieldtype + "wish").val() == '' ||
                        $("#blevel").val() == '') {
                    console.log("error");
                    return;
                }
                if (e.target.id == "blevel") {
                    stats.forEach(function (entry) {
                        $("#" + entry + "chance").val(calcChances(entry));
                    });
                } else {
                    $("#" + fieldtype + "chance").val(calcChances(fieldtype));
                }
                getBestChance();
            });

            function getBestChance() {
                var bestChance = 0;
                var bestType;
                stats.forEach(function (entry) {
                    var testvalue = $("#" + entry + "chance").val();
                    console.log(testvalue = parseInt(testvalue.replace("%", "")));
                    if (testvalue > bestChance) {
                        bestChance = testvalue;
                        bestType = entry;
                    }
                });
                $("#coi").val(calcChances(bestType));
            }

            $(".btn-primary").click(function () {
                console.log(document.cookie);
                var exdays = 999;
                var wishValues = {};
                var dino = $("#dinotype").val();
                if (dino != "Choose Dino") {
                    wishValues[dino] = {};
                    stats.forEach(function (entry) {
                        wishValues[dino][entry] = {};
                        wishValues[dino][entry] = $("#" + entry + "wish").val();
                    });
                    console.log(wishValues);
                    var d = new Date();
                    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
                    var expires = "expires=" + d.toUTCString();
                    document.cookie = "wishes=" + JSON.stringify(wishValues) + ";" + expires + ";path=/";
                }


            });


            function calcChances(fieldtype) {
                target = parseInt($("#" + fieldtype + "wish").val()) - parseInt($("#" + fieldtype + "level").val());
                console.log("target:" + target);
                return getChance(target, p, Number($("#blevel").val()));
            }


            function chanceForX(target, chance, rolls) {
                var bino = this.binomial(rolls, target);
                if (!bino) {
                    console.log("ERROR: 100");
                    return;
                }
                return bino * (Math.pow(chance, target)) * Math.pow((1 - chance), (rolls - target));
            }

            function getChance(target, chance, rolls) {
                var realChance = 1;
                for (var x = 0; x < target; x++) {
                    var P = this.chanceForX(x, chance, rolls);
                    realChance -= P;
                    console.log("P(" + x + "):" + P)
                }
                console.log(realChance);
                return (realChance * 100).toFixed(5) + "%";
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
            $("#dinotype").change(function () {
                dinoType = $("#dinotype").val();
                console.log(dinoType);
                if (dinoType != "Choose Dino") {
                    var parsed = JSON.parse(getCookie("wishes"));
                    console.log(parsed);
                    stats.forEach(function (entry) {

                        $("#" + entry + "wish").val(parsed[dinoType][entry]);
                    });
                }
            });
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

        </script>
    </body>
</html>
