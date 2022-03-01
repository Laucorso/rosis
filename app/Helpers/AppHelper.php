<?php
namespace App\Helpers;

use App\AsteriskManager;
use App\Models\Product;
use App\Models\Order;
use App\Models\Traffic;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class AppHelper
{
    public static function nextBusinessDay2($monday=true) {
        $yearHolidays = ['01-01','01-06','04-10','05-01','08-15','10-12','12-06','12-08','12-25'];
        $weekHolidays = [0,6];
        if( $monday )
            $weekHolidays[] = 1;

        $days = 1;
        while( in_array(\Date::parse('+'.$days.' day')->format('w'),$weekHolidays) || in_array(\Date::parse('+'.$days.' day')->format('m-d'), $yearHolidays) ) {
            $days++;
        }
        return Str::title(\Date::parse('+'.$days.' day')->format('D d-m-Y'));
    }
    public static function nextBusinessDay($monday=true) {
        $yearHolidays = ['01-01','01-06','04-10','05-01','08-15','10-12','12-06','12-08','12-25'];
        $weekHolidays = [0,6];
        if( $monday )
            $weekHolidays[] = 1;

        $days = 1;
        while( in_array(\Date::parse('+'.$days.' day')->format('w'),$weekHolidays) || in_array(\Date::parse('+'.$days.' day')->format('m-d'), $yearHolidays) ) {
            $days++;
        }
        if( $days == 1 )
            return Str::title('Mañana '.\Date::parse('+'.$days.' day')->format('l j F Y'));
        if( $days == 2 )
            return 'Pasado mañana '.Str::title(\Date::parse('+'.$days.' day')->format('l j F Y'));
        return Str::title(\Date::parse('+'.$days.' day')->format('l j F Y'));
    }
    public static function storeImage($src,$dst,$w=600) {
        $img = @file_get_contents($src);
        if( $img !== FALSE ) {
            $im = imagecreatefromstring($img);                   
            $width = imagesx($im);
            $height = imagesy($im);
            $h = ($height/$width)*$w;
            $newim = imagecreatetruecolor($w, $h);
            imagecopyresized($newim, $im, 0, 0, 0, 0, $w, $h, $width, $height);
            imagejpeg($newim,$dst);
            imagedestroy($newim); 
            imagedestroy($im);
            return true;
        } else {
            file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\nFailed to open stream: $src for $dst\n", FILE_APPEND );
            return false;
        }
    }
    public static function storeImageBlob($src,$dst,$w=600) {
        $im = imagecreatefromstring($src);
        if( $im !== false ) {
            $width = imagesx($im);
            $height = imagesy($im);
            $h = ($height/$width)*$w;
            $newim = imagecreatetruecolor($w, $h);
            imagecopyresized($newim, $im, 0, 0, 0, 0, $w, $h, $width, $height);
            imagejpeg($newim,$dst);
            imagedestroy($newim); 
            imagedestroy($im);
            return true;
        }
        return false;
    }
    public static function getImageData($data) {
        $r = explode(':',$data);
        if( count($r) == 2 && $r[0] == 'data' ) {
            $c = explode(';',$r[1]);
            if( count($c) == 2 ) {
                $type = '';
                switch($c[0]) {
                case 'image/jpeg':
                    $type = 'jpg';
                    break;
                case 'image/gif':
                    $type = 'gif';
                    break;
                case 'image/png':
                    $type = 'png';
                    break;
                case 'image/svg+xml':
                    $type = 'svg';
                    break;
                default:
                    $type = 'unknown';
                    break;
                }
                $d = explode(',',$c[1]);
                if( count($d) == 2 ) {
                    if( $d[0] == 'base64' ) {
                        $bd = base64_decode($d[1]);
                        return array('type' => $type,'data' => $bd);
                    }
                }
            }
        }
        return null;
    }

    public static function setLanguages( $es, $ca=null, $en=null ) {
        $ret = '{"es":"'.$es.'",';
        if( $ca ) 
            $ret .= '"ca":"'.$ca.'",';
        else
            $ret .= '"ca":"'.$es.'",';
        if( $en ) 
            $ret .= '"en":"'.$en.'"}';
        else
            $ret .= '"en":"'.$es.'"}';
        return $ret;
    }
    public static function setLanguagesJSON( $es, $ca=null, $en=null ) {
        $ret = '{"es":'.$es.',';
        if( $ca ) 
            $ret .= '"ca":'.$ca.',';
        else
            $ret .= '"ca":'.$es.',';
        if( $en ) 
            $ret .= '"en":'.$en.'}';
        else
            $ret .= '"en":'.$es.'}';
        return $ret;
    }
    public static function buildTaggedString( $src, $array ) {
        file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($src, true)."\n", FILE_APPEND );
        file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($array, true)."\n", FILE_APPEND );
        $ret = '';
        $i = 0;
        $f = 0;
        for( $n = 0 ; $n < strlen($src); $n++ ) {
            if( $f == 0 && $src[$n] != '<' ) {
                $ret .= $array[$i++];
                $f = 1;
            }
            if( $f == 1 && $src[$n] == '<' ) {
                $f = 2;
            }
            if( $f == 2 && $src[$n] != '>' ) {
                $ret .= $src[$n];
            }
            if( $f == 2 && $src[$n] == '>' ) {
                $ret .= $src[$n];
                $f = 0;
            }
        }
        return $ret;
    }
    public static function encrypt( $data ) {
        $cipher = "aes-128-cbc"; 
        $iv="364d4d3344483152";
        $key = base64_decode(env('APP_KEY',null));
        $encrypted_data = openssl_encrypt($data, $cipher, $key, 0, $iv);
        return bin2hex($encrypted_data);
    }
    public static function decrypt( $data ) {
        $cipher = "aes-128-cbc"; 
        $iv="364d4d3344483152";
        $key = base64_decode(env('APP_KEY',null));
        $decrypted_data = openssl_decrypt(hex2bin($data), $cipher, $key, 0, $iv); 
        return $decrypted_data;     
    }
    public static function generateQR( $data ) {
        $qr = new \TCPDF2DBarcode('https://rosistirem.com?'.$data, 'QRCODE,H');
        $data = $qr->getBarcodePngData(60, 60, array(0,0,0));
        return response($data,200)->header("Content-Type", 'image/png');
// send headers
		//header('Content-Type: image/png');
		//header('Cache-Control: public, must-revalidate, max-age=0'); // HTTP/1.1
		//header('Pragma: public');
		//header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		//header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		//header('Content-Length: '.strlen($data));
		//echo $data;
        //return;
    }
    public static function getSales( $from = null, $to = null )
    {
        if( $from == null ) $from = today();
        if( $to == null ) $to = today();
        $orders = Order::whereNotIn('status',['open','failed'])->whereBetween('created_at',[$from,$to]);
        return [$orders->count(),$orders->sum('total')];

    }
    public static function getVisits( $dates = null )
    {
        $rows = Traffic::get($dates);
        $ips = array_unique(array_column($rows,2));
        $sessions = array_unique(array_column($rows,3));
        return [count($sessions),count($ips)];
    }
    public static function getVisitsPerHour( $dates = null )
    {
        $rows = Traffic::get($dates);
        $res = [];
        foreach( $rows as $row ) {
            $time = explode(':',$row[1] );
            $res[(int)($time[0])][] = $row;
        }
        for( $n = 0; $n < 24; $n++ ) {
            $ret[0][$n] = isset($res[$n]) ? count(array_unique(array_column($res[$n],2))) : 0;
            $ret[1][$n] = isset($res[$n]) ? count(array_unique(array_column($res[$n],3))) : 0;
        }
        file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($ret, true)."\n", FILE_APPEND );
        return [implode(',',$ret[0]),implode(',',$ret[1])];
    }
    public static function getVisitsPerWeekDay( $dates = null )
    {
        $res = [];
        foreach( Traffic::get($dates) as $row ) {
            $date = new \DateTime($row[0]);
            $res[$date->format('N')-1][] = $row;
        }
        $ret = [];
        for( $n = 0; $n < 7; $n++ ) {
            if( isset($res[$n]) ) {
                $ret[0][$n] = count(array_unique(array_column($res[$n],2)));
                $ret[1][$n] = count(array_unique(array_column($res[$n],3)));
            } else {
                $ret[0][$n] = 0;
                $ret[1][$n] = 0;
            }
        }
        file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($ret, true)."\n", FILE_APPEND );
        return [implode(',',$ret[0]),implode(',',$ret[1])];
    }
    public static function call( $to, $name = null )
    {
        $extension = Auth::guard('admin')->user()->extension;
        if( $extension != '' ) {
            if( !$name )
                $name = $to;
            $ast = new AsteriskManager();
            $ast->connect();
            $ast->login( config('app.asterisk_user'), config('app.asterisk_secret'));
            
            $ast->originateCall($to,"Local/$extension@from-internal",'from-internal','Calling '.$name);
            $ast->logout();
            $ast->close();
        }
    }
    public static function getDate( $dt, $locale=null ) {
        if( $locale == null )
            $locale = locale();
        $d = $dt->day;
        $y = $dt->year;
        if( $locale == 'es' ) {
            $months = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Septiembre','Octubre','Noviembre','Diciembre'];
            $week = ['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo'];
            $m = $months[$dt->month-1];
            $w = $week[$dt->format('w')-1];
            return "$w $d de $m de $y";
        }
        if( $locale == 'ca' ) {
            $months = ['Gener','Febrer','Març','Abril','Maig','Juny','Juliol','Setembre','Octubre','Novembre','Decembre'];
            $week = ['Dilluns','Dimarts','Dimecres','Dijous','Divendres','Dissabte','Diumenge'];
            $m = $months[$dt->month-1];
            $w = $week[$dt->format('w')-1];
            return "$w $d de $m de $y";
        }
        return $dt->format('l jS \of F Y');
    }
    public static function createSlug($source, $locale) {
        $base = Str::slug($source);
        if( !AppHelper::checkSlug( $base, $locale ) )
            return $base;
        $n = 0;
        do {
            $n++;
            $slug = $base.'-'.$n;
        } while( AppHelper::checkSlug( $slug, $locale ) );
        return $slug;
    }
    public static function checkSlug( $slug, $locale ) {
        $search = \App\Models\Product::where($locale.'_slug',$slug)->first();
        if( $search )
            return true;
        $search = \App\Models\WebPage::where($locale.'_slug',$slug)->first();
        if( $search )
            return true;
        return false;
    }
}