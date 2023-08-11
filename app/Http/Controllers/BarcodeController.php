<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Milon\Barcode\DNS2D;
use Milon\Barcode\DNS1D;
use Illuminate\Support\Facades\Storage;

class BarcodeController extends Controller
{
    // This function is used to generate 2D Barcode 
    function post_data(Request $request)
    {

        $data = $request->productcode;
        $type = $request->type;
        // Here we have created barcode based on barcode data and barcode type
        $qrCode = \DNS1D::getBarcodePNG( $data,$type );
        // Here we have stored the image of created barcode in storage->app->public folder
        $storage_status= \Storage::disk('public')->put(time().'.png',base64_decode(\DNS1D::getBarcodePNG($data,$type )));
        $hostname = env("APP_URL"); 
        // Here we have created storage path link for created barcode image
        $st_path=$hostname.'/milon_final/milon_barcode/storage/app/public/'.time().'.png';
          return ['productcode'=>$data,'type'=>$type,'storage_status'=>$storage_status,'st_path'=>$st_path];
          
    }
   
}
