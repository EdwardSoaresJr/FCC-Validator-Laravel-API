<?php

namespace App\Http\Controllers;

use App\Models\GmrsEn;
use App\Models\GmrsHd;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Exception;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use ZipArchive;

class DailyGmrsController extends Controller
{
    /**
     * @throws Exception
     */
    public function hd()
    {
        date_default_timezone_set('America/Denver');
//        echo "Sync Start " . $date = date('m/d/Y h:i:s a', time());
//        echo "<br>";

        $tz = 'America/Denver';
        $timestamp = time();
        $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
        $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
        $date = $dt->format('Y/m/d');

        //$date = date("Y/m/d");
        $cur_day = date('l', strtotime($date));
//        echo "Current Day: ".$cur_day;
//        echo "<br>";

        //echo $cur_day;

        if ($cur_day == "Tuesday") {
            $gmrs_daily = "https://data.fcc.gov/download/pub/uls/daily/l_gm_mon.zip";
            //echo $gmrs_daily;
        } elseif ($cur_day == "Wednesday") {
            $gmrs_daily = "https://data.fcc.gov/download/pub/uls/daily/l_gm_tue.zip";
            //echo $gmrs_daily;
        } elseif ($cur_day == "Thursday") {
            $gmrs_daily = "https://data.fcc.gov/download/pub/uls/daily/l_gm_wed.zip";
            //echo $gmrs_daily;
        } elseif ($cur_day == "Friday") {
            $gmrs_daily = "https://data.fcc.gov/download/pub/uls/daily/l_gm_thu.zip";
            //echo $gmrs_daily;
        } elseif ($cur_day == "Saturday") {
            $gmrs_daily = "https://data.fcc.gov/download/pub/uls/daily/l_gm_fri.zip";
            //echo $gmrs_daily;
        } elseif ($cur_day == "Sunday") {
            $gmrs_daily = "https://data.fcc.gov/download/pub/uls/daily/l_gm_sat.zip";
            //echo $gmrs_daily;
        } elseif ($cur_day == "Monday") {
            $gmrs_daily = "https://data.fcc.gov/download/pub/uls/daily/l_gm_sun.zip";
            //echo $gmrs_daily;
        }

        // public/gmrs_weekly/
        $path = "public/gmrs_daily/";

        //$gmrs_weekly = "https://data.fcc.gov/download/pub/uls/complete/l_gmrs.zip";
        // Use basename() function to return the base name of file
        // literal filename such as l_gm_sun.zip
        $file_name = $path . basename($gmrs_daily);

        // Remove directory and all old files, may not be necessary.
        File::deleteDirectory($path);

        //The name of the directory that we need to create.
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        // Use file_get_contents() function to get the file
        // from url and use file_put_contents() function to
        // save the file by using base name
        if (file_put_contents($file_name, file_get_contents($gmrs_daily))) {
            // Zip file name
            $zip = new ZipArchive;
            $res = $zip->open($file_name);
            if ($res === TRUE) {

                // Extract file
                $zip->extractTo($path);
                $zip->close();

//                $lines = array();
                $handle = fopen($path . "HD.dat", "r");
//                echo "SET HANDLE GOOD!";
//                echo "<br>";
                if ($handle) {
//                    echo "HANDLE GOOD!";
//                    echo "<br>";
                    while (($line = fgets($handle)) !== false) {
//                        echo "WHILE GOOD!";
//                        echo "<br>";
                        //$line=fgets($fp);

                        //process line however you like
                        //$line=trim($line);
                        $line_exp = explode("|", $line);
                        //print_r($line);

                        //add to array
                        if (isset($line_exp[1]) && isset($line_exp[4]) && isset($line_exp[5]) && isset($line_exp[8])) {
                            DB::table('gmrs_hd')->updateOrInsert(
                                ['usid'=>$line_exp[1]],
                                ['usid'=>$line_exp[1],
                                    'callsign'=>$line_exp[4],
                                    'status'=>$line_exp[5],
                                    'expiration'=>$line_exp[8]]);
                        }

                        //$lines[]=$line;

                    }
                    fclose($handle);

//                    $chunks = array_chunk($lines, 5000);
//                    foreach ($chunks as $chunk) {
//                        GmrsHd::insert($chunk);
//                    }


                } else {
                    $this->info($cur_day.' HD task executed successfully!');

                    Mail::raw("This is automatically generated ".$cur_day." GMRS HD Update", function($message) use ($cur_day) {
                        $message->from('noreply@fccvalidator.com');
                        $message->to('esoares9483@gmail.com')->subject($cur_day.' GMRS HD Update NULL');
                    });
                }

            }
        }
//        echo "Sync Stop " . $date = date('m/d/Y h:i:s a', time());
        $this->info($cur_day.' HD task executed successfully!');

        Mail::raw("This is automatically generated ".$cur_day." GMRS HD Update", function($message) use ($cur_day) {
            $message->from('noreply@fccvalidator.com');
            $message->to('esoares9483@gmail.com')->subject($cur_day.' GMRS HD Update');
        });
    }

    /**
     * @throws Exception
     */
    public function en()
    {
        date_default_timezone_set('America/Denver');
//        echo "Sync Start " . $date = date('m/d/Y h:i:s a', time());
//        echo "<br>";

        $tz = 'America/Denver';
        $timestamp = time();
        $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
        $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
        $date = $dt->format('Y/m/d');

        //$date = date("Y/m/d");
        $cur_day = date('l', strtotime($date));
//        echo "Current Day: ".$cur_day;
//        echo "<br>";

        //echo $cur_day;

//        if ($cur_day == "Monday") {
//            $gmrs_daily = "https://data.fcc.gov/download/pub/uls/daily/l_gm_sun.zip";
//            //echo $gmrs_daily;
//        } elseif ($cur_day == "Tuesday") {
//            $gmrs_daily = "https://data.fcc.gov/download/pub/uls/daily/l_gm_mon.zip";
//            //echo $gmrs_daily;
//        } elseif ($cur_day == "Wednesday") {
//            $gmrs_daily = "https://data.fcc.gov/download/pub/uls/daily/l_gm_tue.zip";
//            //echo $gmrs_daily;
//        } elseif ($cur_day == "Thursday") {
//            $gmrs_daily = "https://data.fcc.gov/download/pub/uls/daily/l_gm_wed.zip";
//            //echo $gmrs_daily;
//        } elseif ($cur_day == "Friday") {
//            $gmrs_daily = "https://data.fcc.gov/download/pub/uls/daily/l_gm_thu.zip";
//            //echo $gmrs_daily;
//        } elseif ($cur_day == "Saturday") {
//            $gmrs_daily = "https://data.fcc.gov/download/pub/uls/daily/l_gm_fri.zip";
//            //echo $gmrs_daily;
//        } elseif ($cur_day == "Sunday") {
//            $gmrs_daily = "https://data.fcc.gov/download/pub/uls/daily/l_gm_sat.zip";
//            //echo $gmrs_daily;
//        }

        // public/gmrs_weekly/
        $path = "public/gmrs_daily/";

        //$gmrs_weekly = "https://data.fcc.gov/download/pub/uls/complete/l_gmrs.zip";
        // Use basename() function to return the base name of file
        // literal filename such as l_gm_sun.zip
//        $file_name = $path . basename($gmrs_daily);


        //The name of the directory that we need to create.
//        if (!is_dir($path)) {
//            mkdir($path, 0777, true);
//        }

        // Use file_get_contents() function to get the file
        // from url and use file_put_contents() function to
        // save the file by using base name
//        if (file_put_contents($file_name, file_get_contents($gmrs_daily))) {
            // Zip file name
//            $zip = new ZipArchive;
//            $res = $zip->open($file_name);
//            if ($res === TRUE) {

                // Extract file
//                $zip->extractTo($path);
//                $zip->close();

//                $lines = array();
                $handle = fopen($path . "EN.dat", "r");
                if ($handle) {
                    while (($line = fgets($handle)) !== false) {
                        //$line=fgets($fp);

                        //process line however you like
                        //$line=trim($line);
                        $line_exp = explode("|", $line);
                        //print_r($line);

                        //add to array
                        if (isset($line_exp[1]) && isset($line_exp[22])) {
                            //$lines[] = array('usid' => $line_exp[1], 'frn' => $line_exp[22]);
                            DB::table('gmrs_en')->updateOrInsert(
                                ['usid'=>$line_exp[1]],
                                ['usid'=>$line_exp[1],
                                'city'=>$line_exp[16],
                                'state'=>$line_exp[17],
                                    'frn'=>$line_exp[22]]);
                        }
                    }
                    fclose($handle);
                } else {
                    $this->info($cur_day.' HD task executed successfully!');

                    Mail::raw("This is automatically generated ".$cur_day." GMRS HD Update", function($message) use ($cur_day) {
                        $message->from('noreply@fccvalidator.com');
                        $message->to('esoares9483@gmail.com')->subject($cur_day.' GMRS HD Update NULL');
                    });
                }

//            }
//        }
//        echo "Sync Stop " . $date = date('m/d/Y h:i:s a', time());
        $this->info($cur_day.' EN task executed successfully!');

        Mail::raw("This is automatically generated ".$cur_day." GMRS EN Update", function($message) use ($cur_day) {
            $message->from('noreply@fccvalidator.com');
            $message->to('esoares9483@gmail.com')->subject($cur_day.' GMRS EN Update');
        });
    }

    private function info(string $string)
    {
    }
}
