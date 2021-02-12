<?php

namespace App\Helper;

use File;
use Image;

class fileUpload
{

    public static function newUpload($name, $directory, $file, $type = 0)
    {
        $dir = "images/" . $directory . "/" . $name;
        if (!empty($file)) {
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }
            $fileName = rand(1, 1000) . "." . $file->getClientOriginalExtension();
            if ($type == 0) {
                $path = public_path($dir . "/" . $fileName);
                Image::make($file->getRealPath())->save($path);
            } else {
                $path = public_path($dir . "/");
                $file->move($path, $fileName);
            }
            return $dir . "/" . $fileName;
        } else {
            return "";
        }
    }

    public static function changeUpload($name, $directory, $file, $type = 0, $data, $field)
    {
        if (!empty($file)) {

            $dir = "images/" . $directory . "/" . $name;
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }
            $fileName = rand(1, 990000) . "." . $file->getClientOriginalExtension();
            if ($type == 0) {
                $path = public_path($dir . "/" . $fileName);
                Image::make($file->getRealPath())->save($path);
            } else {

                $path = public_path($dir, "/");
                $file->move($path, $fileName);

            }
            if (Self::folderFounder("/", $data[0][$field], 3) != "") {
                File::deleteDirectory(public_path(self::folderFounder("/", $data[0][$field], 3)));
            }
            return $dir . "/" . $fileName;
        } else {
            return $data[0][$field];
        }
    }

    public static function folderFounder($char, $filename, $number)
    {
        $explode = explode($char, $filename);
        unset($explode[$number]);
        return implode($char, $explode);
    }

    public static function directoryDelete($filePath)
    {
        if (self::folderFounder('/', $filePath, 3) != "") {

            File::deleteDirectory(public_path(self::folderFounder('/', $filePath, 3)));
        }
    }
}
