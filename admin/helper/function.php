<?php

function get($param)
{
    global $mysqli;
    $d = isset($_GET[$param]) ? $_GET[$param] : null;
    $d = mysqli_real_escape_string($mysqli, $d);
    $d = filter_var($d, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    return $d;
}

function post($param)
{
    global $mysqli;
    $d = isset($_POST[$param]) ? $_POST[$param] : null;
    $d = mysqli_real_escape_string($mysqli, $d);
    $d = filter_var($d, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    return $d;
}


function getSingleValDB($table, $where, $param, $target)
{
    global $mysqli;
    $q = mysqli_query($mysqli, "SELECT * FROM `$table` WHERE `$where`='$param'");
    $row = mysqli_fetch_assoc($q);
    return $row[$target];
}

function getCountryIP($ip)
{
    $vie = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=$ip"));
    $countryIP = $vie->geoplugin_countryName;
    return $countryIP;
}

function getBrowser()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version = "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    } elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }

    // Next get the name of the useragent yes seperately and for good reason
    if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    } elseif (preg_match('/Firefox/i', $u_agent)) {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    } elseif (preg_match('/Chrome/i', $u_agent)) {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    } elseif (preg_match('/Safari/i', $u_agent)) {
        $bname = 'Apple Safari';
        $ub = "Safari";
    } elseif (preg_match('/Opera/i', $u_agent)) {
        $bname = 'Opera';
        $ub = "Opera";
    } elseif (preg_match('/Netscape/i', $u_agent)) {
        $bname = 'Netscape';
        $ub = "Netscape";
    } else {
        $bname = 'Unknown';
        $ub = "Unknown";
    }

    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
        ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }

    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
            $version = $matches['version'][0];
        } else {
            $version = $matches['version'][1];
        }
    } else {
        $version = $matches['version'][0];
    }

    // check if we have a number
    if ($version == null || $version == "") {
        $version = "?";
    }

    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
}

// now try it
$ua = getBrowser();
$browser = "Browser: " . $ua['name'] . " " . $ua['version'] . " on " . $ua['platform'] . " reports: <br >" . $ua['userAgent'];

function countCEK($table, $where = null, $param = null)
{
    global $mysqli;
    if ($where == null && $param == null) {
        $q = mysqli_query($mysqli, "SELECT * FROM $table");
    } else {
        $q = mysqli_query($mysqli, "SELECT * FROM $table");
    }
    $row = mysqli_num_rows($q);
    return $row;
}
function checkmyip()
{
    if ($_SERVER['REMOTE_ADDR'] == '::1') {
        $ip = 'localhost';
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}


function redirect($target)
{
    echo '
    <script>
    window.location = "' . $target . '";
    </script>
    ';
    exit;
}
function redirectTime($target, $time)
{
    echo '
    <script>
    setTimeout(function () {
    window.location = "' . $target . '";
}, ' . $time . ');
    </script>
    ';
    exit;
}



function insertToDB($conn, $table, $data)
{

    // Get keys string from data array
    $columns = implodeArray(array_keys($data));

    // Get values string from data array with prefix (:) added
    $prefixed_array = preg_filter('/^/', ':', array_keys($data));
    $values = implodeArray($prefixed_array);

    try {
        // prepare sql and bind parameters
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        $stmt = $conn->prepare($sql);

        // insert row
        $stmt->execute($data);

        echo "New records created successfully";
    } catch (PDOException $error) {
        echo $error;
    }
}

function implodeArray($array)
{
    return implode(", ", $array);
}

function randomString($numb)
{
    $result = bin2hex(random_bytes($numb));
    return $result;
}


function cekDate($date)
{

    $t = new DateTime($date);
    $s = new DateTime();
    $p = $t->diff($s);

    $th = $p->y;
    $mo = $p->m;
    $da = $p->d;
    $hd = $p->h;
    $mi = $p->i;
    $se = $p->s;
    if ($th > 0) {
        $ho = $th . ' Years ago';
    } else if ($mo > 0) {
        $ho = $mo . ' Month ago';
    } else if ($da > 0) {
        $ho = $da . ' Day ago';
    } else if ($hd > 0) {
        $ho = $hd . ' Hours ago';
    } else if ($mi > 0) {
        $ho = $mi . ' Minutes ago';
    } else {
        $ho = '<div class="badge bg-danger">
<span class="text-capitalize">Just now</span>
</div>';
    }
    return $ho;
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// function uploadImage($name, $dest){
//     // Upload Image
//     $fileName = $_FILES[$name]['name'];
//     $fileTmpName = $_FILES[$name]['tmp_name'];
//     $fileError = $_FILES[$name]['error'];

//     if($fileError === 0){
//         $fileDestination = $dest.$fileName;
//         move_uploaded_file($fileTmpName, $fileDestination);
//         echo "Image Upload Successful";
//     }else {
//         echo "Image Upload Error";
//     }
// }

function uploadImage1($name, $dest, $filen)
{

    if (!empty($_FILES[$name]) && $_FILES[$name]['error'] == UPLOAD_ERR_OK) {
        // Be sure we're dealing with an upload
        if (is_uploaded_file($_FILES[$name]['tmp_name']) === false) {
            throw new \Exception('Error on upload: Invalid file definition');
        }
        if ($_FILES[$name]["size"] > 500000) {
            echo "File size is too large. Max size is 3MB.";
            exit;
        }
        // Rename the uploaded file
        $uploadName = $_FILES[$name]['name'];
        $ext = strtolower(substr($uploadName, strripos($uploadName, '.') + 1));
        $allow = ['png', 'jpeg', 'jpg'];
        if (in_array($ext, $allow)) {
            if ($ext == "png") {
                $filename = $filen . '.png';
            }
            if ($ext == "jpg") {
                $filename = $filen . '.png';
            }

            if ($ext == "jpeg") {
                $filename = $filen . '.png';
            }
        } else {
            echo  "Format png, jpg only";
        }
        // mkdir("../uploads/");
        move_uploaded_file($_FILES[$name]['tmp_name'], $dest . $filename);
    }
}

function uploadImage2($name, $dest)
{

    $target_dir = $dest;
    $target_file = $target_dir . basename($_FILES[$name]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES[$name]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES[$name]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES[$name]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES[$name]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

function uploadImageSize($name, $dest, $width, $heigt)
{

    $target_dir = $dest;
    $target_file = $target_dir . basename($_FILES[$name]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES[$name]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES[$name]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Width Check
    if ($check[0] !== $width) {
        echo "Sorry, your width max large.";
        $uploadOk = 0;
    }

    // Height Check
    if ($check[0] !== $heigt) {
        echo "Sorry, your height max large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES[$name]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES[$name]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}


function sendWAMSG($sender, $receiver, $message)
{
    $data = [
        'api_key' => 'IpNAQjaJ5fobnfMeMRQW9uxA6q60cs',
        'sender' => $sender,
        'number' => $receiver,
        'message' => $message
    ];

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://botly.blastjet.icu:10000/send-message',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
}

function sendWADoc($sender, $receiver, $urlDoc)
{
    $data = [
        'api_key' => 'Hbr139e2IPt2DqQ',
        'sender' => $sender,
        'number' => $receiver,
        'url' => $urlDoc
    ];
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://botly.blastjet.icu:10000/send-document',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
}


function sendWAIMG($sender, $receiver, $message, $urlMed)
{
    $data = [
        'api_key' => 'Hbr139e2IPt2DqQ',
        'sender' => $sender,
        'number' => $receiver,
        'message' => $message,
        'url' => $urlMed
    ];
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://botly.blastjet.icu:10000/send-media',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
}



function slugify($text, $length = null)
{

    $replacements = [
        '<' => '',
        '>' => '',
        '-' => ' ',
        '&' => '',
        '"' => '',
        'À' => 'A',
        'Á' => 'A',
        'Â' => 'A',
        'Ã' => 'A',
        'Ä' => 'Ae',
        'Ä' => 'A',
        'Å' => 'A',
        'Ā' => 'A',
        'Ą' => 'A',
        'Ă' => 'A',
        'Æ' => 'Ae',
        'Ç' => 'C',
        "'" => '',
        'Ć' => 'C',
        'Č' => 'C',
        'Ĉ' => 'C',
        'Ċ' => 'C',
        'Ď' => 'D',
        'Đ' => 'D',
        'Ð' => 'D',
        'È' => 'E',
        'É' => 'E',
        'Ê' => 'E',
        'Ë' => 'E',
        'Ē' => 'E',
        'Ę' => 'E',
        'Ě' => 'E',
        'Ĕ' => 'E',
        'Ė' => 'E',
        'Ĝ' => 'G',
        'Ğ' => 'G',
        'Ġ' => 'G',
        'Ģ' => 'G',
        'Ĥ' => 'H',
        'Ħ' => 'H',
        'Ì' => 'I',
        'Í' => 'I',
        'Î' => 'I',
        'Ï' => 'I',
        'Ī' => 'I',
        'Ĩ' => 'I',
        'Ĭ' => 'I',
        'Į' => 'I',
        'İ' => 'I',
        'Ĳ' => 'IJ',
        'Ĵ' => 'J',
        'Ķ' => 'K',
        'Ł' => 'L',
        'Ľ' => 'L',
        'Ĺ' => 'L',
        'Ļ' => 'L',
        'Ŀ' => 'L',
        'Ñ' => 'N',
        'Ń' => 'N',
        'Ň' => 'N',
        'Ņ' => 'N',
        'Ŋ' => 'N',
        'Ò' => 'O',
        'Ó' => 'O',
        'Ô' => 'O',
        'Õ' => 'O',
        'Ö' => 'Oe',
        'Ö' => 'Oe',
        'Ø' => 'O',
        'Ō' => 'O',
        'Ő' => 'O',
        'Ŏ' => 'O',
        'Œ' => 'OE',
        'Ŕ' => 'R',
        'Ř' => 'R',
        'Ŗ' => 'R',
        'Ś' => 'S',
        'Š' => 'S',
        'Ş' => 'S',
        'Ŝ' => 'S',
        'Ș' => 'S',
        'Ť' => 'T',
        'Ţ' => 'T',
        'Ŧ' => 'T',
        'Ț' => 'T',
        'Ù' => 'U',
        'Ú' => 'U',
        'Û' => 'U',
        'Ü' => 'Ue',
        'Ū' => 'U',
        'Ü' => 'Ue',
        'Ů' => 'U',
        'Ű' => 'U',
        'Ŭ' => 'U',
        'Ũ' => 'U',
        'Ų' => 'U',
        'Ŵ' => 'W',
        'Ý' => 'Y',
        'Ŷ' => 'Y',
        'Ÿ' => 'Y',
        'Ź' => 'Z',
        'Ž' => 'Z',
        'Ż' => 'Z',
        'Þ' => 'T',
        'à' => 'a',
        'á' => 'a',
        'â' => 'a',
        'ã' => 'a',
        'ä' => 'ae',
        'ä' => 'ae',
        'å' => 'a',
        'ā' => 'a',
        'ą' => 'a',
        'ă' => 'a',
        'æ' => 'ae',
        'ç' => 'c',
        'ć' => 'c',
        'č' => 'c',
        'ĉ' => 'c',
        'ċ' => 'c',
        'ď' => 'd',
        'đ' => 'd',
        'ð' => 'd',
        'è' => 'e',
        'é' => 'e',
        'ê' => 'e',
        'ë' => 'e',
        'ē' => 'e',
        'ę' => 'e',
        'ě' => 'e',
        'ĕ' => 'e',
        'ė' => 'e',
        'ƒ' => 'f',
        'ĝ' => 'g',
        'ğ' => 'g',
        'ġ' => 'g',
        'ģ' => 'g',
        'ĥ' => 'h',
        'ħ' => 'h',
        'ì' => 'i',
        'í' => 'i',
        'î' => 'i',
        'ï' => 'i',
        'ī' => 'i',
        'ĩ' => 'i',
        'ĭ' => 'i',
        'į' => 'i',
        'ı' => 'i',
        'ĳ' => 'ij',
        'ĵ' => 'j',
        'ķ' => 'k',
        'ĸ' => 'k',
        'ł' => 'l',
        'ľ' => 'l',
        'ĺ' => 'l',
        'ļ' => 'l',
        'ŀ' => 'l',
        'ñ' => 'n',
        'ń' => 'n',
        'ň' => 'n',
        'ņ' => 'n',
        'ŉ' => 'n',
        'ŋ' => 'n',
        'ò' => 'o',
        'ó' => 'o',
        'ô' => 'o',
        'õ' => 'o',
        'ö' => 'oe',
        'ö' => 'oe',
        'ø' => 'o',
        'ō' => 'o',
        'ő' => 'o',
        'ŏ' => 'o',
        'œ' => 'oe',
        'ŕ' => 'r',
        'ř' => 'r',
        'ŗ' => 'r',
        'š' => 's',
        'ś' => 's',
        'ù' => 'u',
        'ú' => 'u',
        'û' => 'u',
        'ü' => 'ue',
        'ū' => 'u',
        'ü' => 'ue',
        'ů' => 'u',
        'ű' => 'u',
        'ŭ' => 'u',
        'ũ' => 'u',
        'ų' => 'u',
        'ŵ' => 'w',
        'ý' => 'y',
        'ÿ' => 'y',
        'ŷ' => 'y',
        'ž' => 'z',
        'ż' => 'z',
        'ź' => 'z',
        'þ' => 't',
        'α' => 'a',
        'ß' => 'ss',
        'ẞ' => 'b',
        'ſ' => 'ss',
        'ый' => 'iy',
        'А' => 'A',
        'Б' => 'B',
        'В' => 'V',
        'Г' => 'G',
        'Д' => 'D',
        'Е' => 'E',
        'Ё' => 'YO',
        'Ж' => 'ZH',
        'З' => 'Z',
        'И' => 'I',
        'Й' => 'Y',
        'К' => 'K',
        'Л' => 'L',
        'М' => 'M',
        'Н' => 'N',
        'О' => 'O',
        'П' => 'P',
        'Р' => 'R',
        'С' => 'S',
        'Т' => 'T',
        'У' => 'U',
        'Ф' => 'F',
        'Х' => 'H',
        'Ц' => 'C',
        'Ч' => 'CH',
        'Ш' => 'SH',
        'Щ' => 'SCH',
        'Ъ' => '',
        'Ы' => 'Y',
        'Ь' => '',
        'Э' => 'E',
        'Ю' => 'YU',
        'Я' => 'YA',
        'а' => 'a',
        'б' => 'b',
        'в' => 'v',
        'г' => 'g',
        'д' => 'd',
        'е' => 'e',
        'ё' => 'yo',
        'ж' => 'zh',
        'з' => 'z',
        'и' => 'i',
        'й' => 'y',
        'к' => 'k',
        'л' => 'l',
        'м' => 'm',
        'н' => 'n',
        'о' => 'o',
        'п' => 'p',
        'р' => 'r',
        'с' => 's',
        'т' => 't',
        'у' => 'u',
        'ф' => 'f',
        'х' => 'h',
        'ц' => 'c',
        'ч' => 'ch',
        'ш' => 'sh',
        'щ' => 'sch',
        'ъ' => '',
        'ы' => 'y',
        'ь' => '',
        'э' => 'e',
        'ю' => 'yu',
        'я' => 'ya',
        '.' => '-',
        '€' => '-eur-',
        '$' => '-usd-'
    ];
    // Replace non-ascii characters
    $text = strtr($text, $replacements);
    // Replace non letter or digits with "-"
    $text = preg_replace('~[^\pL\d.]+~u', '-', $text);
    // Replace unwanted characters with "-"
    $text = preg_replace('~[^-\w.]+~', '-', $text);
    // Trim "-"
    $text = trim($text, '-');
    // Remove duplicate "-"
    $text = preg_replace('~-+~', '-', $text);
    // Convert to lowercase
    $text = strtolower($text);
    // Limit length
    if (isset($length) && $length < strlen($text))
        $text = rtrim(substr($text, 0, $length), '-');

    return $text;
}

// OOP 
class Pagination
{
    public $perpage;

    function __construct()
    {
        $this->perpage = 1;
    }
    function getPrevNext($count, $href)
    {
        $output = '';
        if (!isset($_GET["page"])) $_GET["page"] = 1;
        if ($this->perpage != 0)
            $pages  = ceil($count / $this->perpage);
        if ($pages > 1) {
            if ($_GET["page"] == 1)
                $output = $output . '<span class="link disabled first">Prev</span>';
            else
                $output = $output . '<a class="link first" onclick="getresult(\'' . $href . ($_GET["page"] - 1) . '\')" >Prev</a>';

            if ($_GET["page"] < $pages)
                $output = $output . '<a  class="link" onclick="getresult(\'' . $href . ($_GET["page"] + 1) . '\')" >Next</a>';
            else
                $output = $output . '<span class="link disabled">Next</span>';
        }
        return $output;
    }
}

class CountDB
{

    function DBand($table, $where = null, $param = null, $and = null, $param2 = null)
    {
        global $mysqli;
        if ($where == null && $param == null && $param2 == null && $and == null) {
            $q = mysqli_query($mysqli, "SELECT * FROM `$table`");
        } else {
            $q = mysqli_query($mysqli, "SELECT * FROM `$table` WHERE `$where`='$param' AND `$and`='$param2'");
        }
        $row = mysqli_num_rows($q);
        return $row;
    }

    function DBwhere($table, $where = null, $param = null)
    {
        global $mysqli;
        if ($where == null && $param == null) {
            $q = mysqli_query($mysqli, "SELECT * FROM `$table`");
        } else {
            $q = mysqli_query($mysqli, "SELECT * FROM `$table` WHERE `$where`='$param'");
        }
        $row = mysqli_num_rows($q);
        return $row;
    }
    function DBwhereand($table, $where, $param, $and = null, $param2 = null)
    {
        global $mysqli;
        if ($and == null && $param2 == null) {
            $q = mysqli_query($mysqli, "SELECT * FROM `$table` WHERE `$where`='$param'");
        } else {
            $q = mysqli_query($mysqli, "SELECT * FROM `$table` WHERE `$where`='$param' AND `$and`='$param2'");
        }
        $row = mysqli_num_rows($q);
        return $row;
    }

    function DBlessthan($table, $where, $param, $order = null, $limit = null)
    {
        global $mysqli;
        if ($order == null && $limit == null) {
            $q = mysqli_query($mysqli, "SELECT * FROM `$table` WHERE `$where`<'$param'");
        } else {
            $q = mysqli_query($mysqli, "SELECT * FROM `$table` WHERE `$where`<'$param' ORDER BY `$order` DESC LIMIT $limit");
        }
        $row = mysqli_num_rows($q);
        return $row;
    }

    function DBmorethan($table, $where, $param, $order = null, $limit = null)
    {
        global $mysqli;
        if ($order == null && $limit == null) {
            $q = mysqli_query($mysqli, "SELECT * FROM `$table` WHERE `$where`>'$param'");
        } else {
            $q = mysqli_query($mysqli, "SELECT * FROM `$table` WHERE `$where`>'$param' ORDER BY `$order` DESC LIMIT $limit");
        }
        $row = mysqli_num_rows($q);
        return $row;
    }
}


function swal_set($status, $msg, $link)
{
    $_SESSION['swal'] = true;
    $_SESSION['swal_status'] = $status;
    $_SESSION['swal_msg'] = $msg;
    $_SESSION['swal_link'] = $link;
}
function swal_show()
{
    $t = isset($_SESSION['swal']) ? $_SESSION['swal'] : null;
    $t_s = isset($_SESSION['swal_status']) ? $_SESSION['swal_status'] : null;
    $t_m = isset($_SESSION['swal_msg']) ? $_SESSION['swal_msg'] : null;
    $t_l = isset($_SESSION['swal_link']) ? $_SESSION['swal_link'] : null;
    if ($t == true) {
        if ($t_s == "success") {
            swal_success($t_m, $t_l);
        }
        if ($t_s == "error") {
            swal_error($t_m, $t_l);
        }

        unset($_SESSION['swal']);
        unset($_SESSION['swal_status']);
        unset($_SESSION['swal_msg']);
        unset($_SESSION['swal_link']);
    }
}

function swal_success($text, $link)
{
    echo "
    Swal.fire({
icon: 'success',
title: 'Success',
text:'" . $text . "',
confirmButtonText: 'Yes!',
}).then((result) => {
    if (result.isConfirmed) {
      Swal.fire('Saved!', '', 'success')
        window.location.href = '" . $link . "';
    }
  });
   ";
}
function swal_error($text, $link)
{
    echo "
    Swal.fire({
icon: 'error',
title: 'Error!',
text:'" . $text . "',
confirmButtonText: 'Yes!',
}).then((result) => {
    if (result.isConfirmed) {
      Swal.fire('Saved!', '', 'success')
        window.location.href = '" . $link . "';
    }
  });
   ";
}
