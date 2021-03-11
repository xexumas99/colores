<?php

namespace App\Providers;

class ColorService
{

    
    public static function getColorProximidad($rgb){

        $keys = array(
            'Aqua', 'Black', 'Blue', 'Fuchsia', 'Navi', 'Olive', 'Purple', 'Red', 'Gray', 'Green', 'Lime','Maroon',
            'Silver', 'Teal', 'White', 'Yellow'
        );

        $colores = [
            'Aqua' => '#00FFFF',
            'Black' => '#000000',
            'Blue' => '#0000FF',
            'Fuchsia' => '#FF00FF',
            'Navi' => '#000080',
            'Olive' => '#808000',
            'Purple' => '#800080',
            'Red' => '#FF0000',
            'Gray' => '#808080',
            'Green' => '#008000',
            'Lime' => '#00FF00',
            'Maroon' => '#800000',
            'Silver' => '#C0C0C0',
            'Teal' => '#008080',
            'White' => '#FFFFFF',
            'Yellow' => '#FFFF00',
        ];

        $bestNombre = '';
        $bestRGB = '';
        $bestDist = PHP_INT_MAX;

        for ($i=0; $i < count($keys); $i++) { 
            
            $index = $keys[$i];

            $auxHEX = $colores[$index];
            list($r, $g, $b) = sscanf($auxHEX, "#%02x%02x%02x");

            $auxRGB = ['r' => $r, 'g' => $g, 'b' => $b];

            $d = sqrt( pow($auxRGB['r'] - $rgb['r'], 2) + pow($auxRGB['g'] - $rgb['g'], 2) + pow($auxRGB['b'] - $rgb['b'], 2));

            if($d < $bestDist){

                $bestDist = $d;
                $bestNombre = $index;
                $bestRGB = $auxRGB;
            }

        }

        return ['r' => $bestRGB['r'], 'g' => $bestRGB['g'], 'b' => $bestRGB['b'], 'nombre' => $bestNombre];
    }
}
