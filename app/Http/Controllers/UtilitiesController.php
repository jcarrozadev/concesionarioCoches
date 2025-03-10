<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilitiesController extends Controller
{
    /**
     * Summary of parseImg
     * @param mixed $img
     * @return string
     */
    public function parseImg($img):string {
        $timestamp = now()->format('Y-m-d_H-i-s') . '_' . round(microtime(true) * 1000);
        $filename = $timestamp . '_' . $img->getClientOriginalName();
        if(strlen($filename) >= 255){
            $filename = $timestamp;
        }
        return $filename;
    }
}
