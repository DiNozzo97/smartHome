<?php session_start();
if ($_SESSION['signedIn'] != true) {
            header("location:login.php?msg=3");
        }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SmartHouse 1.0</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <script src="js/jquery-1.11.3.js"></script>
    <script src="js/bootstrap.js"></script>
    <link href="assets/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet">
    <script src="assets/bootstrap-switch/dist/js/bootstrap-switch.js"></script>
    <script src="assets/RGraph/libraries/RGraph.common.core.js"></script>
    <script src="assets/RGraph/libraries/RGraph.vprogress.CUSTOM.js"></script>
    <script src="assets/bootstrap-slider/bootstrap-slider.js"></script>
    <script src="assets/colorPicker/spectrum.js"></script>
    <link href="assets/colorPicker/spectrum.css" rel="stylesheet">
    <link href="assets/bootstrap-slider/bootstrap-slider.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <script>
        $.get("assets/ajax/kitchenTemp.php", function(data) {
            $(".kitchenTempAjax").html(data);
            kitchenTemp = data;
            var kitchenProgress = new RGraph.VProgress({
                id: 'kitchenCanvas',
                min: 15,
                max: 40,
                value: kitchenTemp,
                options: {
                    tickmarks: 100,
                    numticks: 20,
                    gutterRight: 35,
                    margin: 5
                }
            }).draw();
        });
        $.get("assets/ajax/livingRoomTemp.php", function(data) {
            $(".livingRoomTempAjax").html(data);
            livingroom = data;
            var livingRoomProgress = new RGraph.VProgress({
                id: 'livingRoomCanvas',
                min: 15,
                max: 40,
                value: livingroom,
                color: "red",
                options: {
                    tickmarks: 100,
                    numticks: 20,
                    gutterRight: 35,
                    margin: 5
                }
            }).draw();
        });
        $.get("assets/ajax/utilityRoomTemp.php", function(data) {
            $(".utilityRoomTempAjax").html(data);
            utilityroom = data;
            var utilityRoomProgress = new RGraph.VProgress({
                id: 'utilityRoomCanvas',
                min: 15,
                max: 40,
                value: utilityroom,
                options: {
                    tickmarks: 100,
                    numticks: 20,
                    gutterRight: 35,
                    margin: 5,
                }
            }).draw();
        });

        setInterval(function() {
            $.get("assets/ajax/kitchenTemp.php", function(data) {
                $(".kitchenTempAjax").html(data);
                kitchenTemp = data;
                var kitchenProgress = new RGraph.VProgress({
                    id: 'kitchenCanvas',
                    min: 15,
                    max: 40,
                    value: kitchenTemp,
                    options: {
                        tickmarks: 100,
                        numticks: 20,
                        gutterRight: 35,
                        margin: 5
                    }
                }).draw();
            });
            $.get("assets/ajax/livingRoomTemp.php", function(data) {
                $(".livingRoomTempAjax").html(data);
                livingroom = data;
                var livingRoomProgress = new RGraph.VProgress({
                    id: 'livingRoomCanvas',
                    min: 15,
                    max: 40,
                    value: livingroom,
                    color: "red",
                    options: {
                        tickmarks: 100,
                        numticks: 20,
                        gutterRight: 35,
                        margin: 5
                    }
                }).draw();
            });
            $.get("assets/ajax/utilityRoomTemp.php", function(data) {
                $(".utilityRoomTempAjax").html(data);
                utilityroom = data;
                var utilityRoomProgress = new RGraph.VProgress({
                    id: 'utilityRoomCanvas',
                    min: 15,
                    max: 40,
                    value: utilityroom,
                    options: {
                        tickmarks: 100,
                        numticks: 20,
                        gutterRight: 35,
                        margin: 5,
                    }
                }).draw();
            });
        }, 30000);
    </script>
</head>

<body>
    <div>
        <?php require 'assets/header.php';?>
        <div class="wrapper col-md-offset-2">
            <div class="row">
                <div class="room col-md-3">
                    <div class="col-md-12">
                        <h3>Master Override</h3>
                        <div class="form-group">
                            <label for="masterAutoSwitch">Mode: </label>
                            <input id="masterAutoSwitch" type="checkbox" name="masterAutoSwitch" data-on-color="success" data-off-color="danger" data-on-text="Auto" data-off-text="Manual">
                            <script>
                                $("#masterAutoSwitch").bootstrapSwitch();
                            </script>
                        </div>
                        <div id="sliderDiv" class="form-group">
                            <label for="autoSlider">Brightness: </label>
                            <input id="autoSlider" data-slider-id='autoSlider' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="50" />

                            <script>
                                var brightSlider = $('#autoSlider').slider({
                                    formatter: function(value) {
                                        return 'Current value: ' + value + '%';
                                    }
                                });
                                $("#sliderDiv").hide();
                            </script>
                        </div>
                        <div id="masterSwitchPanel">
                            <div class="btn-group" role="group">
                                <button id="allLightsOff" type="button" class="btn btn-danger">All Lights Off</button>
                            </div>
                            <div class="btn-group" role="group">
                                <button id="lockHouse" type="button" class="btn btn-danger">Lock House</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="room col-md-3">
                    <div class="col-md-8">
                        <h3>Living Room</h3>
                        <div class="form-group">
                            <label for="livingRoomSwitch">Light Switch: </label>
                            <input id="livingRoomSwitch" type="checkbox" name="livingRoomSwitch" data-on-color="success" data-off-color="danger">
                            <script>
                                $("[name='livingRoomSwitch']").bootstrapSwitch();
                            </script>
                        </div>
                        <div class="form-group">
                            <label for="livingRoomColourPick">Colour: </label>
                            <input id="livingRoomColourPick" type="text" name="livingRoomColourPick">
                            <script>
                                $("#livingRoomColourPick").spectrum({
                                    color: "#ffffff"
                                });
                            </script>
                        </div>
                        <div class="temperatureReading">
                            <h2><b><span class="livingRoomTempAjax"></span>&deg;C</b></h2></div>
                        </div>
                        <div class="thermometer col-md-4">
                            <canvas class="thermometerCanvas" id="livingRoomCanvas" width="75" height="275">
                                [No canvas support]
                            </canvas>
                        </div>
                    </div>

                    <div class="room col-md-3">
                        <div class="col-md-8">
                            <h3>Kitchen</h3>
                            <div class="form-group">
                                <label for="kitchenSwitch">Light Switch: </label>
                                <input id="kitchenSwitch" type="checkbox" name="kitchenSwitch" data-on-color="success" data-off-color="danger">
                                <script>
                                    $("[name='kitchenSwitch']").bootstrapSwitch();
                                </script>
                            </div>
                            <div class="form-group">
                                <label for="kitchenColourPick">Colour: </label>
                                <input id="kitchenColourPick" type="text" name="kitchenColourPick">
                                <script>
                                    $("#kitchenColourPick").spectrum({
                                        color: "#ffffff"
                                    });
                                </script>

                            </div>
                            <div class="temperatureReading">
                                <h2><b><span class="kitchenTempAjax"></span>&deg;C</b></h2></div>
                            </div>
                            <div class="thermometer col-md-4">
                                <canvas class="thermometerCanvas" id="kitchenCanvas" width="75" height="275">
                                    [No canvas support]
                                </canvas>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="room col-md-3">
                            <div class="col-md-8">
                                <h3>Utility Room</h3>
                                <div class="form-group">
                                    <label for="utilitySwitch">Light Switch: </label>
                                    <input id="utilitySwitch" type="checkbox" name="utilitySwitch" data-on-color="success" data-off-color="danger">
                                    <script>
                                        $("[name='utilitySwitch']").bootstrapSwitch();
                                    </script>
                                </div>
                                <div class="form-group">
                                    <label for="utilityColourPick">Colour: </label>
                                    <input id="utilityColourPick" type="text" name="garageColourPick">
                                    <script>
                                        $("#utilityColourPick").spectrum({
                                            color: "#ffffff"
                                        });
                                    </script>
                                </div>
                                <div class="temperatureReading">
                                    <h2><b><span class="utilityRoomTempAjax"></span>&deg;C</b></h2></div>
                                </div>
                                <div class="thermometer col-md-4">
                                    <canvas class="thermometerCanvas" id="utilityRoomCanvas" width="75" height="275">
                                        [No canvas support]
                                    </canvas>
                                </div>
                            </div>

                            <div class="room col-md-3">
                                <div class="col-md-12">
                                    <h3>Garage</h3>
                                    <div class="form-group">
                                        <label for="garageSwitch">Light Switch: </label>
                                        <input id="garageSwitch" type="checkbox" name="garageSwitch" data-on-color="success" data-off-color="danger">
                                        <script>
                                            $("[name='garageSwitch']").bootstrapSwitch();
                                        </script>
                                    </div>
                                    <div class="form-group">
                                        <label for="garageColourPick">Colour: </label>
                                        <input id="garageColourPick" type="text" name="garageColourPick">
                                        <script>
                                            $("#garageColourPick").spectrum({
                                                color: "#ffffff"
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>

                            <div class="room col-md-3">
                                <div class="col-md-12">
                                    <h3>Access Control</h3>
                                    <div class="form-group">
                                        <label for="frontDoorSwitch">Front Door: </label>
                                        <input id="frontDoorSwitch" type="checkbox" name="frontDoorSwitch" data-handle-width=85 data-on-color="success" data-off-color="danger" data-off-text="Locked" data-on-text="Unlocked">
                                        <script>
                                            $("[name='frontDoorSwitch']").bootstrapSwitch();
                                        </script>
                                    </div>
                                    <div class="form-group">
                                        <label for="backDoorSwitch">Back Door: </label>
                                        <input id="backDoorSwitch" type="checkbox" name="backDoorSwitch" data-handle-width=85 data-on-color="success" data-off-color="danger" data-off-text="Locked" data-on-text="Unlocked">
                                        <script>
                                            $("[name='backDoorSwitch']").bootstrapSwitch();
                                        </script>
                                    </div>
                                    <div class="form-group">
                                        <label for="garageDoorSwitch">Garage Door: </label>
                                        <input id="garageDoorSwitch" type="checkbox" name="garageDoorSwitch" data-handle-width=85 data-on-color="success" data-off-color="danger" data-off-text="Close" data-on-text="Open">
                                        <script>
                                            $("[name='garageDoorSwitch']").bootstrapSwitch();
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </body>

            <script>
    //Global Variables

    var utility = "false";
    var utilityColor = "ffffff";

    var living = "false";
    var livingColor = "ffffff";

    var garage = "false";
    var garageColor = "ffffff";

    var kitchen = "false";
    var kitchenColor = "ffffff";

    $.get("assets/jsPhpToPy/servo.php?servoNumber=0&position=l");
    $.get("assets/jsPhpToPy/servo.php?servoNumber=1&position=l");
    $.get("assets/jsPhpToPy/servo.php?servoNumber=2&position=c");



    // Master Auto Switch Actions
    $("#masterAutoSwitch").on('switchChange.bootstrapSwitch', function(event, state) {
        if (state) {
            var value = brightSlider.slider('getValue');
            $.get("assets/jsPhpToPy/activateAuto.php?sliderVal=" + value);
            $("#livingRoomSwitch").bootstrapSwitch('disabled', true);
            $("#utilitySwitch").bootstrapSwitch('disabled', true);
            $("#kitchenSwitch").bootstrapSwitch('disabled', true);
            $("#garageSwitch").bootstrapSwitch('disabled', true);
            $("#sliderDiv").show();

        } else {
            $.get("assets/jsPhpToPy/disableAuto.php");
            $("#livingRoomSwitch").bootstrapSwitch('disabled', false, true);
            $("#utilitySwitch").bootstrapSwitch('disabled', false, true);
            $("#kitchenSwitch").bootstrapSwitch('disabled', false, true);
            $("#garageSwitch").bootstrapSwitch('disabled', false), true;
            $("#livingRoomSwitch").bootstrapSwitch('disabled', false);
            $("#utilitySwitch").bootstrapSwitch('disabled', false);
            $("#kitchenSwitch").bootstrapSwitch('disabled', false);
            $("#garageSwitch").bootstrapSwitch('disabled', false);
            $("#sliderDiv").hide();
            $.get("assets/jsPhpToPy/turnOn.php?living=" + living + "&livingColor=" + livingColor + "&kitchen=" + kitchen + "&kitchenColor=" + kitchenColor + "&utility=" + utility + "&utilityColor=" + utilityColor + "&garage=" + garage + "&garageColor=" + garageColor);
        }
    });

    // Auto Brightness Slider
    brightSlider.slider().on('slideStop', function(nv) {
        var value2 = nv.value;
        $.get("assets/jsPhpToPy/activateAuto.php?sliderVal=" + value2);
    });

    // All Lights Off Button
    $('#allLightsOff').click(function() {
        $.get("assets/jsPhpToPy/disableAuto.php");
        living = "false";
        kitchen = "false";
        utility = "false";
        garage = "false";
        $("#masterAutoSwitch").bootstrapSwitch('state', false);
        $("#livingRoomSwitch").bootstrapSwitch('state', false, true);
        $("#utilitySwitch").bootstrapSwitch('state', false, true);
        $("#kitchenSwitch").bootstrapSwitch('state', false, true);
        $("#garageSwitch").bootstrapSwitch('state', false, true);
        //$("#masterAutoSwitch").bootstrapSwitch('state', false);
        $("#livingRoomSwitch").bootstrapSwitch('state', false);
        $("#utilitySwitch").bootstrapSwitch('state', false);
        $("#kitchenSwitch").bootstrapSwitch('state', false);
        $("#garageSwitch").bootstrapSwitch('state', false);
        $.get("assets/jsPhpToPy/turnOff.php");
    });

    // Lock House Button
    $('#lockHouse').click(function() {
        $.get("assets/jsPhpToPy/servo.php?servoNumber=0&position=l");
        $.get("assets/jsPhpToPy/servo.php?servoNumber=1&position=l");
        $.get("assets/jsPhpToPy/servo.php?servoNumber=2&position=c");
        $("#frontDoorSwitch").bootstrapSwitch('state', false, true);
        $("#backDoorSwitch").bootstrapSwitch('state', false, true);
        $("#garageDoorSwitch").bootstrapSwitch('state', false, true);

    });

    // Living Switch
    $("#livingRoomSwitch").on('switchChange.bootstrapSwitch', function(event, state) {
        if (state) {
            living = "true";
            livingColor = $("#livingRoomColourPick").spectrum('get').toHexString();
            livingColor = livingColor.replace("#", "");
            $.get("assets/jsPhpToPy/turnOn.php?living=" + living + "&livingColor=" + livingColor + "&kitchen=" + kitchen + "&kitchenColor=" + kitchenColor + "&utility=" + utility + "&utilityColor=" + utilityColor + "&garage=" + garage + "&garageColor=" + garageColor);

        } else {
            living = "false";
            livingColor = $("#livingRoomColourPick").spectrum('get').toHexString();
            livingColor = livingColor.replace("#", "");
            $.get("assets/jsPhpToPy/turnOn.php?living=" + living + "&livingColor=" + livingColor + "&kitchen=" + kitchen + "&kitchenColor=" + kitchenColor + "&utility=" + utility + "&utilityColor=" + utilityColor + "&garage=" + garage + "&garageColor=" + garageColor);
        }
    });


    // Kitchen Switch
    $("#kitchenSwitch").on('switchChange.bootstrapSwitch', function(event, state) {
        if (state) {
            kitchen = "true";
            kitchenColor = $("#kitchenColourPick").spectrum('get').toHexString();
            kitchenColor = kitchenColor.replace("#", "");
            $.get("assets/jsPhpToPy/turnOn.php?kitchen=" + kitchen + "&kitchenColor=" + kitchenColor + "&utility=" + utility + "&utilityColor=" + utilityColor + "&living=" + living + "&livingColor=" + livingColor + "&garage=" + garage + "&garageColor=" + garageColor);

        } else {
            kitchen = "false";
            kitchenColor = $("#kitchenColourPick").spectrum('get').toHexString();
            kitchenColor = kitchenColor.replace("#", "");
            $.get("assets/jsPhpToPy/turnOn.php?kitchen=" + kitchen + "&kitchenColor=" + kitchenColor + "&utility=" + utility + "&utilityColor=" + utilityColor + "&living=" + living + "&livingColor=" + livingColor + "&garage=" + garage + "&garageColor=" + garageColor);
        }
    });


    // Utility Switch
    $("#utilitySwitch").on('switchChange.bootstrapSwitch', function(event, state) {
        if (state) {
            utility = "true";
            utilityColor = $("#utilityColourPick").spectrum('get').toHexString();
            utilityColor = utilityColor.replace("#", "");
            $.get("assets/jsPhpToPy/turnOn.php?utility=" + utility + "&utilityColor=" + utilityColor + "&kitchen=" + kitchen + "&kitchenColor=" + kitchenColor + "&living=" + living + "&livingColor=" + livingColor + "&garage=" + garage + "&garageColor=" + garageColor);

        } else {
            utility = "false";
            utilityColor = $("#utilityColourPick").spectrum('get').toHexString();
            utilityColor = utilityColor.replace("#", "");
            $.get("assets/jsPhpToPy/turnOn.php?utility=" + utility + "&utilityColor=" + utilityColor + "&kitchen=" + kitchen + "&kitchenColor=" + kitchenColor + "&living=" + living + "&livingColor=" + livingColor + "&garage=" + garage + "&garageColor=" + garageColor);
        }
    });



    // Garage Switch
    $("#garageSwitch").on('switchChange.bootstrapSwitch', function(event, state) {
        if (state) {
            garage = "true";
            garageColor = $("#garageColourPick").spectrum('get').toHexString();
            garageColor = garageColor.replace("#", "");
            $.get("assets/jsPhpToPy/turnOn.php?garage=" + garage + "&garageColor=" + garageColor + "&kitchen=" + kitchen + "&kitchenColor=" + kitchenColor + "&living=" + living + "&livingColor=" + livingColor + "&utility=" + utility + "&utilityColor=" + utilityColor);

        } else {
            garage = "false";
            garageColor = $("#garageColourPick").spectrum('get').toHexString();
            garageColor = garageColor.replace("#", "");
            $.get("assets/jsPhpToPy/turnOn.php?garage=" + garage + "&garageColor=" + garageColor + "&kitchen=" + kitchen + "&kitchenColor=" + kitchenColor + "&living=" + living + "&livingColor=" + livingColor + "&utility=" + utility + "&utilityColor=" + utilityColor);
        }
    });


    // On Colour Changes....
    $("#garageColourPick").on('change.spectrum', function(event, state) {
        garageColor = $("#garageColourPick").spectrum('get').toHexString();
        garageColor = garageColor.replace("#", "");
        $.get("assets/jsPhpToPy/turnOn.php?garage=" + garage + "&garageColor=" + garageColor + "&kitchen=" + kitchen + "&kitchenColor=" + kitchenColor + "&living=" + living + "&livingColor=" + livingColor + "&utility=" + utility + "&utilityColor=" + utilityColor);
    });

    $("#livingRoomColourPick").on('change.spectrum', function(event, state) {
        livingColor = $("#livingRoomColourPick").spectrum('get').toHexString();
        livingColor = livingColor.replace("#", "");
        $.get("assets/jsPhpToPy/turnOn.php?living=" + living + "&livingColor=" + livingColor + "&kitchen=" + kitchen + "&kitchenColor=" + kitchenColor + "&utility=" + utility + "&utilityColor=" + utilityColor + "&garage=" + garage + "&garageColor=" + garageColor);
    });

    $("#utilityColourPick").on('change.spectrum', function(event, state) {
        utilityColor = $("#utilityColourPick").spectrum('get').toHexString();
        utilityColor = utilityColor.replace("#", "");
        $.get("assets/jsPhpToPy/turnOn.php?utility=" + utility + "&utilityColor=" + utilityColor + "&kitchen=" + kitchen + "&kitchenColor=" + kitchenColor + "&living=" + living + "&livingColor=" + livingColor + "&garage=" + garage + "&garageColor=" + garageColor);
    });

    $("#kitchenColourPick").on('change.spectrum', function(event, state) {
        kitchenColor = $("#kitchenColourPick").spectrum('get').toHexString();
        kitchenColor = kitchenColor.replace("#", "");
        $.get("assets/jsPhpToPy/turnOn.php?kitchen=" + kitchen + "&kitchenColor=" + kitchenColor + "&utility=" + utility + "&utilityColor=" + utilityColor + "&living=" + living + "&livingColor=" + livingColor + "&garage=" + garage + "&garageColor=" + garageColor);
    });

    // Front Door Switch
    $("#frontDoorSwitch").on('switchChange.bootstrapSwitch', function(event, state) {
        if (state) {
            $.get("assets/jsPhpToPy/servo.php?servoNumber=1&position=u");
        } else {
            $.get("assets/jsPhpToPy/servo.php?servoNumber=1&position=l");
        }
    });

    // Back Door Switch
    $("#backDoorSwitch").on('switchChange.bootstrapSwitch', function(event, state) {
        if (state) {
            $.get("assets/jsPhpToPy/servo.php?servoNumber=0&position=u");
        } else {
            $.get("assets/jsPhpToPy/servo.php?servoNumber=0&position=l");
        }
    });

    // Garage Door Switch
    $("#garageDoorSwitch").on('switchChange.bootstrapSwitch', function(event, state) {
        if (state) {
            $.get("assets/jsPhpToPy/servo.php?servoNumber=2&position=o");
        } else {
            $.get("assets/jsPhpToPy/servo.php?servoNumber=2&position=c");
        }
    });
</script>


</html>
