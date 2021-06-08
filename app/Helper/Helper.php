<?php

namespace App\Helper;

use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as ImageManager;
use Carbon\Carbon;

class Helper
{
    public static function storeImage($image, $destinationPath) {
        $ext = strtolower($image->getClientOriginalExtension());

        if (!File::isDirectory($destinationPath)){
            File::makeDirectory($destinationPath, 0777, true, true);
        }

        while(true){
            $newName = rand(100000,PHP_INT_MAX).'.'.$ext;
            if (!file_exists($destinationPath.$newName)){
                break;
            }
        }

        if ($ext == 'jpg' || $ext == 'jpeg') {
            $img_created = ImageManager::make($image->getRealpath());
            $img_created->orientate();
            $img_created->save($destinationPath.$newName, 75);
        } else {
            $image->move($destinationPath, $newName);
        }

        return $destinationPath.$newName;
    }

    public static function storeFile($file, $destinationPath) {
        $ext = strtolower($file->getClientOriginalExtension());

        if (!File::isDirectory($destinationPath)){
            File::makeDirectory($destinationPath, 0777, true, true);
        }

        while(true){
            $newName = rand(100000,PHP_INT_MAX).'.'.$ext;
            if (!file_exists($destinationPath.$newName)){
                break;
            }
        }
        
        $file->move($destinationPath, $newName);

        return $destinationPath.$newName;
    }

    public static function getUsableStars($user) {
        $substractStars = $user->stars()->where('type', 'Subtract')->get();
        $addStars = $user->stars()->where('type', 'Add')->whereDate('valid_until', '>=', Carbon::today())->get();
        
        $total_stars = 0;
        
        foreach ($addStars as $star) 
            $total_stars += $star->stars;
        
        foreach ($substractStars as $star) 
            $total_stars -= $star->stars;

        return $total_stars;
    }

    public static function getUnusableStars($user) {
        $stars = $user->stars()->where('valid_until', '<', Carbon::today())->get();
        
        $total_stars = 0;
        foreach ($stars as $star) {
            $total_stars += $star->stars;
        }

        return $total_stars;
    }
}