<?php

namespace App\Http\Controllers;

use App\Providers\ColorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\Providers\League\Color;
use App\Providers\League\Palette;
use App\Providers\League\ColorExtractor;

class ColorController extends Controller
{
    public function determinarColor(Request $request)
    {
        
        try {

            $img = $request->file('imagen')->storeAs('imagenes', 'imagen.png'); 

            $path = storage_path('app/' . $img);

            if (!File::exists($path)) {
                return 'No existe';
            }

            //$file = File::get($path);
            // $type = File::mimeType($path);
            // $i = '';

            // if($type == 'image/jpeg'){

            //     $i = imagecreatefromjpeg($path);
            // }            
            // else if($type == 'image/png'){

            //     $i = imagecreatefrompng($path);
            // }
            
            $palette = Palette::fromFilename($path);

            $topColorsInt =  $palette->getMostUsedColors(5);
            
            $topColor = Color::fromIntToRgb( array_key_first($topColorsInt) );

            $arrayColors = array_keys($topColorsInt);

            $complementarios = array();

            for ($i=1; $i < count($arrayColors); $i++) { 
                
                $color = Color::fromIntToRgb($arrayColors[$i]);
                array_push($complementarios, $color);
            }

            $rgb = ['r' => $topColor['r'], 'g' => $topColor['g'], 'b' => $topColor['b']];

            $res = ColorService::getColorProximidad($rgb);
    
            return response()->json([
                'r' => $res['r'], 
                'g' => $res['g'], 
                'b' => $res['b'], 
                'nombre' => $res['nombre'],
                'complementarios' => $complementarios
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'mensaje' => $e->getMessage()
            ]); 
        }
    }
}
