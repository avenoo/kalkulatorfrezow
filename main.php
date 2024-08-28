<!DOCTYPE html>
<html>
<head>
    <title>Rysowanie wielokąta</title>
</head>
<body>
    <form method="POST" action="">
        <label for="sides">Podaj liczbę kątów wielokąta (min. 3):</label>
        <input type="number" id="sides" name="sides" min="3" required>
        <input type="submit" value="Rysuj wielokąt">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sides = intval($_POST['sides']);

        // Sprawdzamy, czy liczba kątów jest przynajmniej 3
        if ($sides >= 3) {
            // Rozmiar obrazka
            $width = 300;
            $height = 300;

            // Tworzenie obrazu
            $image = imagecreatetruecolor($width, $height);

            // Kolory
            $background_color = imagecolorallocate($image, 255, 255, 255);
            $polygon_color = imagecolorallocate($image, 0, 0, 0);

            // Wypełnienie tła
            imagefill($image, 0, 0, $background_color);

            // Obliczanie wierzchołków wielokąta
            $centerX = $width / 2;
            $centerY = $height / 2;
            $radius = 100; // Promień wielokąta

            $points = [];
            for ($i = 0; $i < $sides; $i++) {
                $angle = 2 * M_PI * $i / $sides;
                $x = $centerX + $radius * cos($angle);
                $y = $centerY + $radius * sin($angle);
                $points[] = $x;
                $points[] = $y;
            }

            // Rysowanie wielokąta
            imagepolygon($image, $points, $sides, $polygon_color);

            // Wyświetlanie obrazu
            header('Content-Type: image/png');
            imagepng($image);

            // Czyszczenie
            imagedestroy($image);
        } else {
            echo "Liczba kątów musi być co najmniej 3.";
        }
    }
    ?>
</body>
</html>
