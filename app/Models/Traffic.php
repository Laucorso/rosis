<?php
namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Traffic
{
    static function get( $dates = null ) {
        if( $dates == null ) {
            $dates = [new \Date(),new \Date()];
        }
        $ip_blacklist = config('rosistirem.ip_blacklist');
        $file = base_path($dates[0]->format('Y-m').'-traffic.log');
        $handle = fopen($file, 'r');
        $rows = [];
        if( $handle ) {
            while( ($line = fgets($handle)) !== false ) {
                $line = rtrim($line, " \n\r\t\v\x00\\/");
                $row = explode(' ',$line);
                $row[4] = str_replace('www.','',$row[4]);
                if( $row[2] != '127.0.0.1' && (Str::startsWith($row[4],'https://www.rosistirem.com')||Str::startsWith($row[4],'https://rosistirem.com')) ) {
                    $ip = ip2long($row[2]);
                    $good = true;
                    foreach( $ip_blacklist as $ips ) {
                        if( $ip >= $ips[0] && $ip <= $ips[1] )
                            $good = false;
                    }
                    if( $good )
                        $rows[] = $row;
                }
            }
            fclose($handle);
        }
        return $rows;
    }
    static function all($dates = null) {
        $traffic = Traffic::get( $dates );
        $rows = [];
        foreach( $traffic as $row ) {
            $rows[] = (object)['date'=>$row[0],'time'=>$row[1],'ip'=>$row[2],'session'=>$row[3],'url'=>$row[4]];
        }
        //file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export(collect($rows)->duplicates('ip'), true)."\n", FILE_APPEND );
        return collect($rows);
    }
    static function getIps($dates=null) {
        $rows = Traffic::get($dates);
        $ips = array_count_values(array_column($rows,2));
        arsort($ips);
        return $ips;
    }
    static function getUrls($dates=null) {
        $rows = Traffic::get($dates);
        $urls = array_count_values(array_map( function ($a){
            $ret = rtrim(preg_replace('/\?.*/', '', $a), " \n\r\t\v\x00\\/");
            return $ret;
        },array_column($rows,4) ));
        arsort($urls);
        return $urls;
    }
}