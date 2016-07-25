<?php include '../../vendor/autoload.php'; ?>
<html>
<head>
    <title></title>
</head>
<body>

    <div id="currentColor" style="border: 1px dashed red; position: fixed; top: 10px; right: 10px; background: black; color: #fff;"></div>

    <h1>Hue/Lightness (Saturation: 100%)</h1>
    <?php
    $step = 1 / 90;
    for ($l = 0.0; $l < 1.0; $l += $step) {
        for ($h = 0; $h < 360; $h += 4) {

            echo '<div class="color" style="display: inline-block; width: 4px; height: 4px; background: '.(new \Phim\Color\HslColor($h, 1, $l)).'"></div>';
        }
        echo '<br>';
    }

    ?>
    <br>
    <h1>Hue/Saturation (Lightness: 50%)</h1>
    <?php
    $step = 1 / 90;
    for ($s = 0.0; $s < 1.0; $s += $step) {
        for ($h = 0; $h < 360; $h += 4) {

            echo '<div class="color" style="display: inline-block; width: 4px; height: 4px; background: '.(new \Phim\Color\HslColor($h, $s, .5)).'"></div>';
        }
        echo '<br>';
    }

    ?>
    <br>
    <h1>Lightness/Saturation (Hue: 0 (red))</h1>
    <?php
    $step = 1 / 90;
    for ($s = 0.0; $s < 1.0; $s += $step) {
        for ($l = 0; $l < 1.0; $l += $step) {

            echo '<div class="color" style="display: inline-block; width: 4px; height: 4px; background: '.(new \Phim\Color\HslColor(0, $s, $l)).'"></div>';
        }
        echo '<br>';
    }


    ?>
    <br>
    <h1>Hues (S: 100%, L: 50%)</h1>
    <?php
    for ($h = 0; $h < 360; $h++) {

        echo '<div class="color" style="display: inline-block; width: 4px; height: 20px; background: '.(new \Phim\Color\HslColor($h, 1, .5)).'"></div>';
    }

    ?>
    <script>

        window.addEventListener('DOMContentLoaded', function() {

            [].forEach.call(document.getElementsByClassName('color'), function (el) {

                el.addEventListener('mouseover', function () {

                    document.querySelector('#currentColor').innerHTML = el.style.backgroundColor;
                });
            });
        });
    </script>

</body>
</html>

