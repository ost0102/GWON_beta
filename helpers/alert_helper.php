<? if (!defined('BASEPATH')) exit('No direct script access allowed');

// 경고메세지를 경고창으로
function alert($msg = '', $url = '')
{
    $CI =& get_instance();

    if (!$msg) $msg = '올바른 방법으로 이용해 주십시오.';

    echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=" . $CI->config->item('charset') . "\">";
    echo "<script type='text/javascript'>alert('" . $msg . "');";
    if ($url)
        echo "location.replace('" . $url . "');";
    else
        echo "history.go(-1);";
    echo "</script>";
    exit;
}

// 경고메세지 출력후 창을 닫음
function alert_close($msg)
{
    $CI =& get_instance();

    echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=" . $CI->config->item('charset') . "\">";
    echo "<script type='text/javascript'> alert('" . $msg . "'); window.close(); </script>";
    exit;
}

// 경고메세지만 출력
function alert_only($msg)
{
    $CI =& get_instance();

    echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=" . $CI->config->item('charset') . "\">";
    echo "<script type='text/javascript'> alert('" . $msg . "'); </script>";
    exit;
}

function alert_continue($msg)
{
    $CI =& get_instance();

    echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=" . $CI->config->item('charset') . "\">";
    echo "<script type='text/javascript'> alert('" . $msg . "'); </script>";
}


function GetCenterFromDegrees($data)
{
    if (!is_array($data)) return FALSE;

    $num_coords = count($data);

    $X = 0.0;
    $Y = 0.0;
    $Z = 0.0;

    foreach ($data as $coord) {
        $lat = $coord[0] * pi() / 180;
        $lon = $coord[1] * pi() / 180;

        $a = cos($lat) * cos($lon);
        $b = cos($lat) * sin($lon);
        $c = sin($lat);

        $X += $a;
        $Y += $b;
        $Z += $c;
    }

    $X /= $num_coords;
    $Y /= $num_coords;
    $Z /= $num_coords;

    $lon = atan2($Y, $X);
    $hyp = sqrt($X * $X + $Y * $Y);
    $lat = atan2($Z, $hyp);

    return array($lat * 180 / pi(), $lon * 180 / pi());
}

function my_simple_crypt($string, $action = 'e')
{ // 아래값을 임의로 수정해주세요.
    $secret_key = 'gown';
    $secret_iv = '1004';
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ($action == 'e') {
        $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
    } else if ($action == 'd') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}


?>
