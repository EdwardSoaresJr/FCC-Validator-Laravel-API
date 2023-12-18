<?php

namespace App\Http\Controllers;

use App\Models\GmrsEn;
use App\Models\GmrsHd;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use ZipArchive;

class WeeklyGmrsController extends Controller
{
    public function dn()
    {
        date_default_timezone_set('America/Denver');
        echo "Download Start " . $date = date('m/d/Y h:i:s a', time());
        echo "<br>";

        $gmrs_weekly = "https://data.fcc.gov/download/pub/uls/complete/l_gmrs.zip";

        // public/gmrs_weekly/
        $path = "gmrs_weekly/";
        // Use basename() function to return the base name of file
        // literal filename such as l_gm_sun.zip
        $file_name = $path . basename($gmrs_weekly);


        //The name of the directory that we need to create.
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        // Use file_get_contents() function to get the file
        // from url and use file_put_contents() function to
        // save the file by using base name
        if (file_put_contents($file_name, file_get_contents($gmrs_weekly))) {
            // Zip file name
            $zip = new ZipArchive;
            $res = $zip->open($file_name);
            if ($res === TRUE) {
                // Extract file
                $zip->extractTo($path);
                $zip->close();
            }
        }
        echo "Download Stop " . $date = date('m/d/Y h:i:s a', time());
    }

    public function hd()
    {
        date_default_timezone_set('America/Denver');
        echo "Sync Start " . $date = date('m/d/Y h:i:s a', time());
        echo "<br>";

        // public/gmrs_weekly/
        $path = "gmrs_weekly/";

        DB::table('gmrs_hd')->truncate();

        $lines = array();
        $handle = fopen($path . "HD.dat", "r");

        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                //echo "WHILE GOOD!";
                //echo "<br>";
                //$line=fgets($fp);

                //process line however you like
                $line=trim($line);
                $line_exp = explode("|", $line);
//                        print_r($line);
//                        echo "<br>";

                //add to array
                if ($line_exp[5] == "A" && isset($line_exp[1]) && isset($line_exp[4]) && isset($line_exp[8])) {
                $lines[] = array('usid' => $line_exp[1], 'callsign' => $line_exp[4], 'status' => $line_exp[5], 'expiration' => $line_exp[8]);
                }
                //$lines[]=$line;
            }
            //print_r($lines);
        }
        fclose($handle);

        $chunks = array_chunk($lines, 1000);
        foreach ($chunks as $chunk) {
            GmrsHd::insert($chunk);
        }

        echo "Sync Stop " . $date = date('m/d/Y h:i:s a', time());
    }

    public function en()
    {
        date_default_timezone_set('America/Denver');
        echo "Sync Start " . $date = date('m/d/Y h:i:s a', time());
        echo "<br>";

        // public/gmrs_weekly/
        $path = "gmrs_weekly/";


        DB::table('gmrs_en')->truncate();

        $lines = array();
        $handle = fopen($path . "EN.dat", "r");

        if ($handle) {
            while (($line = fgets($handle)) !== false) {

                $line=trim($line);
                $line_exp = explode("|", $line);
                //print_r($line_exp);



                if (isset($line_exp[1]) && isset($line_exp[22])) {
                    $lines[] = array('usid' => $line_exp[1], 'city' => $line_exp[16], 'state' => $line_exp[17], 'frn' => $line_exp[22]);
                }
            }
        }
        fclose($handle);

        $chunks = array_chunk($lines, 5000);
        foreach ($chunks as $chunk) {
            GmrsEn::insert($chunk);
        }
        echo "Sync Stop " . $date = date('m/d/Y h:i:s a', time());
    }
}
