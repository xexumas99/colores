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

            $topColorInt =  $palette->getMostUsedColors(1);
            
            $topColor = Color::fromIntToRgb( array_key_first($topColorInt) );

            $rgb = ['r' => $topColor['r'], 'g' => $topColor['g'], 'b' => $topColor['b']];

            $res = ColorService::getColorProximidad($rgb);
    
            return ['realR' => $topColor['r'], 'realG' => $topColor['g'], 'realB' => $topColor['b'], 'r' => $res['r'], 'g' => $res['g'], 'b' => $res['b'], 'nombre' => $res['nombre']];
        } catch (\Exception $e) {
            return $e;
        }
    }
}
