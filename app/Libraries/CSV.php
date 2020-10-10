<?php

namespace App\Libraries;

class CSV
{ 
    public function arrayToCsv($path, $array) {
        $file_path = storage_path($path); 

        if(file_exists($file_path)){
            unlink($file_path);
        }

        $header=FALSE;

        $file = fopen($file_path, 'w+');

        foreach ($array as $row) {   

            if (!$header) {
                fputcsv($file, array_keys($row));
                $header=TRUE;
            }

            fputcsv($file,$row);
        }

        fclose($file);
    }
}