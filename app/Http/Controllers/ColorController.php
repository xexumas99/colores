<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ColorController extends Controller
{
    public function determinarColor(Request $request)
    {
        
        try {
            //$dominantColor = ColorThief::getColor("https://d2skuhm0vrry40.cloudfront.net/2020/articles/2020-03-16-08-08/persona-5-royal-analisis-1584346130165.jpg/EG11/thumbnail/750x422/format/jpg/quality/60");
            $img = $request->file('imagen')->store('imagenes'); 

            $path = storage_path('app/' . $img);

            if (!File::exists($path)) {
                return 'No existe';
            }

            //$file = File::get($path);
            $type = File::mimeType($path);
            $i = '';

            if($type == 'image/jpeg'){

                $i = imagecreatefromjpeg($path);
            }            
            else if($type == 'image/png'){

                $i = imagecreatefrompng($path);
            }

            $rTotal = 0;
            $vTotal = 0;
            $aTotal = 0;
            $total = 0;
            for ($x=0;$x<imagesx($i);$x++) {
                for ($y=0;$y<imagesy($i);$y++) {
                    $rgb = imagecolorat($i,$x,$y);
                    $r   = ($rgb >> 16) & 0xFF;
                    $v   = ($rgb >> 8) & 0xFF;
                    $a   = $rgb & 0xFF;
                    $rTotal += $r;
                    $vTotal += $v;
                    $aTotal += $a;
                    $total++;
                }
            }
            $rPromedio = round($rTotal/$total);
            $vPromedio = round($vTotal/$total);
            $aPromedio = round($aTotal/$total);
    
            return ['r' => $rPromedio, 'g' => $vPromedio, 'b' => $aPromedio];
        } catch (\Exception $e) {
            return $e;
        }
    }
}
