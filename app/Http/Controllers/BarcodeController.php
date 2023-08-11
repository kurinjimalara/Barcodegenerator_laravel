<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Milon\Barcode\DNS2D;
use Milon\Barcode\DNS1D;
use Illuminate\Support\Facades\Storage;

class BarcodeController extends Controller
{
    function post_data(Request $request)
    {

        $code = $request->productcode;
        $type = $request->type;
        $qrCode = \DNS1D::getBarcodePNG( $code,$type );
        $path= \Storage::disk('public')->put(time().'.png',base64_decode(\DNS1D::getBarcodePNG($code,$type )));
        $hostname = env("APP_URL"); 
        $st_path=$hostname.'/milon_final/milon_barcode/storage/app/public/'.time().'.png';
          return ['productcode'=>$code,'type'=>$type,'st_path'=>$st_path];
          
    }
   
}
