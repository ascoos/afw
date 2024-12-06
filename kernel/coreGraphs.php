<?php 
/**
 *   __ _  ___  ___ ___   ___   ___     ____ _ __ ___   ___
 *  / _` |/  / / __/ _ \ / _ \ /  /    / __/| '_ ` _ \ /  /
 * | (_| |\  \| (_| (_) | (_) |\  \   | (__ | | | | | |\  \
 *  \__,_|/__/ \___\___/ \___/ /__/    \___\|_| |_| |_|/__/
 * 
 * 
 ************************************************************************************
 * @ASCOOS-NAME        	: ASCOOS CMS 24'                                            *
 * @ASCOOS-VERSION     	: 24.0.0                                                    *
 * @ASCOOS-CATEGORY    	: Framework (Frontend and Administrator Side)               *
 * @ASCOOS-CREATOR     	: Drogidis Christos                                         *
 * @ASCOOS-SITE        	: www.ascoos.com                                            *
 * @ASCOOS-LICENSE     	: [Commercial] http://docs.ascoos.com/lics/ascoos/AGL.html  *
 * @ASCOOS-COPYRIGHT   	: Copyright (c) 2007 - 2024, AlexSoft Software.             *
 ************************************************************************************
 *
 * @package            	: ASCOOS FRAMEWORK 24'
 * @subpackage         	: Graphs Core Handles
 * @source             	: afw/kernel/coreGraphs.php
 * @fileNo             	: 
 * @version            	: 24.0.4
 * @created            	: 2024-07-01 20:00:00 UTC+3 
 * @updated            	: 2024-12-05 07:00:00 UTC+3 
 * @author             	: Drogidis Christos
 * @authorSite         	: www.alexsoft.gr
 * @license 			: AGL-F
 * 
 * @since PHP 8.2.0
 */
declare(strict_types=1);
namespace ASCOOS\FRAMEWORK\Kernel\Graphs;
defined ("ALEXSOFT_RUN_CMS") or die("Prohibition of Access.");
defined ("ASCOOS_FRAMEWORK_RUN") or die("Prohibition of Access.");



/******************************************************************************
 * @startcode TColorHandler
 *****************************************************************************/
/**
 * @class   TColorHandler
 * @static
 * 
 * @summary Handles the colors.
 * 
 * [ METHODS ]
 * @method array adjustBrightness(array $color, float $factor)              Adjusts the brightness of a color.
 * @method float colorDistance(array $color1, array $color2)                Calculates the distance between two colors.
 * @method array complementaryColor(array $color)                           Generates the complementary color.
 * @method array getColor(mixed $index, int $shadeFactor = 1)               Return array of color elements.
 * @method array hsvToRgb(float $hue, float $saturation, float $value)      Converts HSV values to RGB.
 * @method array invertColor(array $color)                                  Inverts a color.
 * @method array mixColors(array $color1, array $color2, float $ratio)      Mixes two colors together.
 * @method array monochromeShades(array $color, int $steps)                 Generates monochrome shades of a color.
 * @method array randomColor()                                              Generates a random color in RGB format.
 * @method array rgbToHsv(int $r, int $g, int $b)                           Converts RGB values to HSV.
 * @method array shadeColor(array $color, float $factor)                    Creates a lighter or darker shade of a color.
 * @method bool validateColor(array $color)                                 Validates if the color values are within the correct range.
 */
final class TColorHandler {
    private $baseColors = [
            [0, 0, 0],        // Black
            [255, 255, 255],  // White
            [255, 0, 0],      // Red
            [0, 255, 0],      // Green
            [0, 0, 255],      // Blue
            [255, 255, 0],    // Yellow
            [0, 255, 255],    // Cyan
            [255, 0, 255],    // Magenta
            [128, 0, 0],      // Maroon
            [0, 128, 0],      // Dark Green
            [0, 0, 128],      // Navy
            [128, 128, 0],    // Olive
            [128, 0, 128],    // Purple
            [0, 128, 128],    // Teal
            [255, 165, 0],    // Orange
            [255, 192, 203],  // Pink
            [75, 0, 130],     // Indigo
            [255, 20, 147],   // Deep Pink
            [173, 216, 230],  // Light Blue
            [32, 178, 170],   // Light Sea Green
            [218, 165, 32],   // Goldenrod
            [250, 128, 114],  // Salmon
            [46, 139, 87],    // Sea Green
            [210, 105, 30],   // Chocolate
            [255, 69, 0],     // Orange Red
            [154, 205, 50],   // Yellow Green
            [255, 215, 0],    // Gold
            [0, 100, 0],      // Dark Green
            [255, 105, 180],  // Hot Pink
            [138, 43, 226],   // Blue Violet
            [0, 255, 127],    // Spring Green
            [70, 130, 180],   // Steel Blue
            [230, 230, 250],  // Lavender
            [255, 228, 225],  // Misty Rose
            [0, 0, 205],      // Medium Blue
            [128, 0, 128],    // Indigo
            [0, 139, 139],    // Dark Cyan
            [0, 206, 209],    // Dark Turquoise
            [25, 25, 112],    // Midnight Blue
            [135, 206, 250],  // Light Sky Blue
            [144, 238, 144],  // Light Green
            [255, 0, 0],      // Red
            [255, 105, 180],  // Hot Pink
            [85, 107, 47],    // Dark Olive Green
            [240, 230, 140],  // Khaki
            [220, 20, 60],    // Crimson
            [255, 215, 0],    // Gold
            [34, 139, 34],    // Forest Green
            [192, 192, 192],  // Silver
            [255, 99, 71],    // Tomato
            [70, 130, 180],   // Steel Blue
            [244, 164, 96],   // Sandy Brown
            [233, 150, 122],  // Dark Salmon
            [245, 245, 220],  // Beige
            [0, 255, 0],      // Lime
            [64, 224, 208],   // Turquoise
            [25, 25, 112],    // Midnight Blue
            [255, 160, 122],  // Light Salmon
            [47, 79, 79],     // Dark Slate Gray
            [123, 104, 238],  // Medium Slate Blue
            [60, 179, 113],   // Medium Sea Green
            [124, 252, 0],    // Lawn Green
            [106, 90, 205],   // Slate Blue
            [105, 105, 105],  // Dim Gray
            [255, 228, 181],  // Moccasin
            [127, 255, 212],  // Aquamarine
            [210, 105, 30],   // Chocolate
            [144, 238, 144],  // Light Green
            [176, 224, 230],  // Powder Blue
            [176, 196, 222],  // Light Steel Blue
            [255, 218, 185],  // Peach Puff
            [100, 149, 237],  // Cornflower Blue
            [95, 158, 160],   // Cadet Blue
            [169, 169, 169],  // Dark Gray
            [255, 192, 203],  // Pink
            [255, 69, 0],     // Orange Red
            [60, 179, 113],   // Medium Sea Green
            [123, 104, 238],  // Medium Slate Blue
            [70, 130, 180],   // Steel Blue
            [240, 128, 128],  // Light Coral
            [255, 165, 0],    // Orange
            [0, 0, 205],      // Medium Blue
            [199, 21, 133],   // Medium Violet Red
            [30, 144, 255],   // Dodger Blue
            [0, 191, 255],    // Deep Sky Blue
            [255, 228, 225],  // Misty Rose
            [176, 196, 222],  // Light Steel Blue
            [245, 245, 245],  // White Smoke
            [240, 255, 255],  // Azure
            [47, 79, 79],     // Dark Slate Gray
            [25, 25, 112],    // Midnight Blue
            [119, 136, 153],  // Light Slate Gray
            [30, 144, 255],   // Dodger Blue
            [135, 206, 250],  // Light Sky Blue
            [176, 224, 230],  // Powder Blue
            [95, 158, 160],   // Cadet Blue
            [127, 255, 0],    // Chartreuse
            [255, 127, 80],   // Coral
            [147, 112, 219],  // Medium Purple
            [64, 224, 208],   // Turquoise
            [238, 130, 238],  // Violet
            [210, 180, 140],  // Tan
            [255, 0, 255],    // Magenta
            [176, 196, 222],  // Light Steel Blue
            [255, 255, 224],  // Light Yellow
            [50, 205, 50],    // Lime Green
            [0, 0, 139],      // Dark Blue
            [72, 61, 139],    // Dark Slate Blue
            [210, 105, 30],   // Chocolate
            [0, 255, 0],      // Lime
            [0, 206, 209],    // Dark Turquoise
            [127, 255, 212],  // Aquamarine
            [0, 255, 127],    // Spring Green
            [50, 205, 50],    // Lime Green
            [255, 140, 0],    // Dark Orange
            [75, 0, 130],     // Indigo
            [255, 20, 147],   // Deep Pink
            [238, 232, 170],  // Pale Goldenrod
            [255, 105, 180],  // Hot Pink
            [199, 21, 133],   // Medium Violet Red
            [186, 85, 211],   // Medium Orchid
            [210, 105, 30],   // Chocolate
            [0, 0, 139],      // Dark Blue
            [0, 0, 128],      // Navy
            [255, 99, 71],    // Tomato
            [152, 251, 152],  // Pale Green
            [72, 61, 139],    // Dark Slate Blue
            [47, 79, 79],     // Dark Slate Gray
            [123, 104, 238],  // Medium Slate Blue
            [144, 238, 144],  // Light Green
            [127, 255, 0],    // Chartreuse
            [173, 216, 230]  // Light Blue
    ];


    /**
     * Adjusts the brightness of a color.
     * 
     * @desc <English> Adjusts the brightness of a color.
     * @desc <Greek> Ρυθμίζει τη φωτεινότητα ενός χρώματος.
     * 
     * @param array $color <English> The base color in RGB format.
     *                     <Greek> Το βασικό χρώμα σε μορφή RGB.
     * @param float $factor <English> The factor to adjust the brightness.
     *                      <Greek> Ο παράγοντας για τη ρύθμιση της φωτεινότητας.
     * @return array <English> The adjusted color in RGB format.
     *               <Greek> Το ρυθμισμένο χρώμα σε μορφή RGB.
     */
    public static function adjustBrightness($color, $factor) {
        $hsv = self::rgbToHsv($color[0], $color[1], $color[2]);
        $hsv[2] = min(1, max(0, $hsv[2] * $factor));
        return self::hsvToRgb($hsv[0], $hsv[1], $hsv[2]);
    }

    /**
     * Calculates the distance between two colors.
     * 
     * @desc <English> Calculates the distance between two colors.
     * @desc <Greek> Υπολογίζει την απόσταση μεταξύ δύο χρωμάτων.
     * 
     * @param array $color1 <English> The first color in RGB format.
     *                      <Greek> Το πρώτο χρώμα σε μορφή RGB.
     * @param array $color2 <English> The second color in RGB format.
     *                      <Greek> Το δεύτερο χρώμα σε μορφή RGB.
     * @return float <English> The distance between the two colors.
     *               <Greek> Η απόσταση μεταξύ των δύο χρωμάτων.
     */
    public static function colorDistance($color1, $color2) {
        return sqrt(
            pow($color1[0] - $color2[0], 2) + 
            pow($color1[1] - $color2[1], 2) + 
            pow($color1[2] - $color2[2], 2)
        );
    }

    /**
     * Generates the complementary color.
     * 
     * @desc <English> Generates the complementary color.
     * @desc <Greek> Δημιουργεί το συμπληρωματικό χρώμα.
     * 
     * @param array $color <English> The base color in RGB format.
     *                     <Greek> Το βασικό χρώμα σε μορφή RGB.
     * @return array <English> The complementary color in RGB format.
     *               <Greek> Το συμπληρωματικό χρώμα σε μορφή RGB.
     */
    public static function complementaryColor($color) {
        $hsv = self::rgbToHsv($color[0], $color[1], $color[2]);
        $hsv[0] = ($hsv[0] + 180) % 360; // Προσθήκη 180 μοιρών στην απόχρωση για το συμπληρωματικό χρώμα
        return self::hsvToRgb($hsv[0], $hsv[1], $hsv[2]);
    }




    public function getColor($index, $shadeFactor = 1)
    {
        $baseColor = $this->baseColors[$index % count($this->baseColors)];
        return [
            $baseColor[0] * $shadeFactor,
            $baseColor[1] * $shadeFactor,
            $baseColor[2] * $shadeFactor
        ];
    }


    /**
     * Converts HSV values to RGB.
     *
     * @desc <English> Converts HSV values to RGB.
     * @desc <Greek> Μετατρέπει τιμές HSV σε RGB.
     *
     * @param float $hue <English> The hue value.
     *                   <Greek> Η τιμή της απόχρωσης.
     * @param float $saturation <English> The saturation value.
     *                          <Greek> Η τιμή του κορεσμού.
     * @param float $value <English> The value (brightness).
     *                     <Greek> Η τιμή της φωτεινότητας.
     * @return array <English> Array containing RGB values.
     *               <Greek> Πίνακας που περιέχει τις τιμές RGB.
     */
    public static function hsvToRgb($hue, $saturation, $value) {
        $c = $value * $saturation;
        $x = $c * (1 - abs(fmod($hue / 60, 2) - 1));
        $m = $value - $c;
        if ($hue < 60) {
            list($r, $g, $b) = [$c, $x, 0];
        } elseif ($hue < 120) {
            list($r, $g, $b) = [$x, $c, 0];
        } elseif ($hue < 180) {
            list($r, $g, $b) = [0, $c, $x];
        } elseif ($hue < 240) {
            list($r, $g, $b) = [0, $x, $c];
        } elseif ($hue < 300) {
            list($r, $g, $b) = [$x, 0, $c];
        } else {
            list($r, $g, $b) = [$c, 0, $x];
        }
        return [($r + $m) * 255, ($g + $m) * 255, ($b + $m) * 255];
    }



    /**
     * Inverts a color.
     * 
     * @desc <English> Inverts a color.
     * @desc <Greek> Αντιστρέφει ένα χρώμα.
     * 
     * @param array $color <English> The base color in RGB format.
     *                     <Greek> Το βασικό χρώμα σε μορφή RGB.
     * @return array <English> The inverted color in RGB format.
     *               <Greek> Το αντεστραμμένο χρώμα σε μορφή RGB.
     */
    public static function invertColor($color) {
        return [
            255 - $color[0],
            255 - $color[1],
            255 - $color[2]
        ];
    }



    /**
     * Mixes two colors together.
     *
     * @desc <English> Mixes two colors together.
     * @desc <Greek> Αναμειγνύει δύο χρώματα.
     *
     * @param array $color1 <English> The first color in RGB format.
     *                      <Greek> Το πρώτο χρώμα σε μορφή RGB.
     * @param array $color2 <English> The second color in RGB format.
     *                      <Greek> Το δεύτερο χρώμα σε μορφή RGB.
     * @param float $ratio <English> The ratio to mix the two colors.
     *                     <Greek> Ο λόγος ανάμειξης των δύο χρωμάτων.
     * @return array <English> The mixed color in RGB format.
     *               <Greek> Το αναμεμιγμένο χρώμα σε μορφή RGB.
     */
    public static function mixColors($color1, $color2, $ratio) {
        return [
            min(255, max(0, ($color1[0] * $ratio) + ($color2[0] * (1 - $ratio)))),
            min(255, max(0, ($color1[1] * $ratio) + ($color2[1] * (1 - $ratio)))),
            min(255, max(0, ($color1[2] * $ratio) + ($color2[2] * (1 - $ratio))))
        ];
    }


    /**
     * Generates monochrome shades of a color.
     * 
     * @desc <English> Generates monochrome shades of a color.
     * @desc <Greek> Δημιουργεί μονοχρωματικές αποχρώσεις ενός χρώματος.
     * 
     * @param array $color <English> The base color in RGB format.
     *                     <Greek> Το βασικό χρώμα σε μορφή RGB.
     * @param int $steps <English> The number of shades to generate.
     *                   <Greek> Ο αριθμός των αποχρώσεων που θα δημιουργηθούν.
     * @return array <English> An array of shades in RGB format.
     *               <Greek> Ένας πίνακας αποχρώσεων σε μορφή RGB.
     */
    public static function monochromeShades($color, $steps) {
        $shades = [];
        for ($i = 0; $i < $steps; $i++) {
            $factor = 1 - ($i / $steps);
            $shades[] = self::shadeColor($color, $factor);
        }
        return $shades;
    }



    /**
     * Converts RGB values to HSV.
     *
     * @desc <English> Converts RGB values to HSV.
     * @desc <Greek> Μετατρέπει τιμές RGB σε HSV.
     *
     * @param int $r <English> The red value (0-255).
     *               <Greek> Η τιμή του κόκκινου (0-255).
     * @param int $g <English> The green value (0-255).
     *               <Greek> Η τιμή του πράσινου (0-255).
     * @param int $b <English> The blue value (0-255).
     *               <Greek> Η τιμή του μπλε (0-255).
     * @return array <English> Array containing HSV values.
     *               <Greek> Πίνακας που περιέχει τις τιμές HSV.
     */
    public static function rgbToHsv($r, $g, $b) {
        $r /= 255;
        $g /= 255;
        $b /= 255;

        $max = max($r, $g, $b);
        $min = min($r, $g, $b);
        $delta = $max - $min;

        $hue = 0;
        if ($delta != 0) {
            if ($max == $r) {
                $hue = 60 * fmod((($g - $b) / $delta), 6);
            } elseif ($max == $g) {
                $hue = 60 * ((($b - $r) / $delta) + 2);
            } elseif ($max == $b) {
                $hue = 60 * ((($r - $g) / $delta) + 4);
            }
        }

        $saturation = ($max == 0) ? 0 : ($delta / $max);
        $value = $max;

        return [$hue, $saturation, $value];
    }


    /**
     * Generates a random color in RGB format.
     *
     * @desc <English> Generates a random color in RGB format.
     * @desc <Greek> Δημιουργεί ένα τυχαίο χρώμα σε μορφή RGB.
     *
     * @return array <English> Array containing RGB values.
     *               <Greek> Πίνακας που περιέχει τις τιμές RGB.
     */
    public static function randomColor() {
        $r = rand(0, 255);
        $g = rand(0, 255);
        $b = rand(0, 255);
        return [$r, $g, $b];
    }


    /**
     * Creates a lighter or darker shade of a color.
     *
     * @desc <English> Creates a lighter or darker shade of a color.
     * @desc <Greek> Δημιουργεί μια πιο ανοιχτή ή πιο σκούρα απόχρωση ενός χρώματος.
     *
     * @param array $color <English> The base color in RGB format.
     *                     <Greek> Το βασικό χρώμα σε μορφή RGB.
     * @param float $factor <English> The factor to lighten or darken the color.
     *                      <Greek> Ο παράγοντας για να ανοίξει ή να σκουρύνει το χρώμα.
     * @return array <English> The shaded color in RGB format.
     *               <Greek> Η απόχρωση του χρώματος σε μορφή RGB.
     */
    public static function shadeColor($color, $factor) {
        return [
            min(255, max(0, $color[0] * $factor)),
            min(255, max(0, $color[1] * $factor)),
            min(255, max(0, $color[2] * $factor))
        ];
    }


    /**
     * Validates if the color values are within the correct range.
     * 
     * @desc <English> Validates if the color values are within the correct range.
     * @desc <Greek> Ελέγχει αν οι τιμές του χρώματος είναι εντός της σωστής κλίμακας.
     * 
     * @param array $color <English> The color in RGB format.
     *                     <Greek> Το χρώμα σε μορφή RGB.
     * @return bool <English> True if valid, otherwise false.
     *              <Greek> True αν είναι έγκυρο, αλλιώς false.
     */
    public static function validateColor($color) {
        return (
            is_array($color) && count($color) == 3 && 
            $color[0] >= 0 && $color[0] <= 255 &&
            $color[1] >= 0 && $color[1] <= 255 &&
            $color[2] >= 0 && $color[2] <= 255
        );
    }

}
/******************************************************************************
 * @endcode TColorHandler
 *****************************************************************************/

?>