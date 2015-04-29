<?php
class hunteron {
    public $cookie_file, $loginname, $membername, $password;
    function __construct($loginname, $membername, $password) {
        $this->cookie_file = tempnam('./tmp', 'HUNTERON');
        $this->loginname = $loginname;
        $this->membername = $membername;
        $this->password = $password;
    }

    function get_nonce() {
        $url = 'http://hr.hunteron.com/api/ucenter/link?v=1.3.5';
        $useragent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_2) AppleWebKit/600.3.18 (KHTML, like Gecko) Version/8.0.3 Safari/600.3.18';
        $headers = array(
            'Content-type: application/json;charset=UTF-8',
            'Server: HunterOn F2E',
            'Accept: application/json'
        );
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookie_file);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        //var_dump($result);
        $result = json_decode($result);
        return $result;
    }

    function login($realm, $nonce) {
        //var_dump($realm);
        //var_dump($nonce);
        //die();
        $e = strtolower($this->membername);
        $f = strtolower($this->loginname);
        $g = $this->password;
        $i = md5($g);
        $j = $i;
        $b = $e . ":" . $f . ":" . $realm . ":" . $i;
        $d = "POST:/hr/ucenter/login";
        $b = md5($b);
        $d = md5($d);
        $g = $b . ":" . $nonce . ":" . $d;
        $g = md5($g);
        $i = $g;

        $j = md5($j . "5OGP56W65A6D6LSD") . "x";
        $b = $e . ":" . $f . ":" . $realm . ":" . $j;
        $d = "POST:/hr/ucenter/login";
        $b = md5($b);
        $d = md5($d);
        $g = $b . ":" . $nonce . ":" . $d;
        $g = md5($g);
        $j = $g;

        $url = 'http://hr.hunteron.com/api/ucenter/login?v=1.3.5';
        $useragent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_2) AppleWebKit/600.3.18 (KHTML, like Gecko) Version/8.0.3 Safari/600.3.18';
        $post_fields = array(
            'loginName' => $this->loginname,
            'memberName' => $this->membername,
            'authorizeCode' => $i,
            'twoAuthorizeCode' => $j
        );
        $post_fields = http_build_query($post_fields);
        $post_len = strlen($post_fields);
        //echo $post_fields;die();
        $headers = array(
            'POST /api/ucenter/login?v=1.3.5 HTTP/1.1',
            'Host: hr.hunteron.com',
            'Accept: application/json, text/plain, */*',
            'Accept-Language: en-us',
            'Accept-Encoding: gzip, deflate',
            'Content-type: application/x-www-form-urlencoded;charset=UTF-8',
            'Origin: http://hr.hunteron.com',
            'Content-Length: '.$post_len,
            'X-AUTH-TOKEN: user token value',
            'X-PROP: ',
            'Referer: http://hr.hunteron.com/',
            'Connection: keep-alive'
        );
        //var_dump($headers);die();
        $ch = curl_init($url);
        // debug
        //curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookie_file);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookie_file);
        $result = curl_exec($ch);
        curl_close($ch);
        //var_dump($result);
        //die(); 
        $result = json_decode($result);
        return $result;
    }

    function get_hunter_list($page) {
        $url = 'http://hr.hunteron.com/api/v1/headhunter/query?v=1.1.0&pageSize=10&start='.$page.'&type=platform';
        $useragent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_2) AppleWebKit/600.3.18 (KHTML, like Gecko) Version/8.0.3 Safari/600.3.18';
        //echo $post_fields;die();
        $headers = array(
            'GET /api/v1/headhunter/query?v=1.1.0&pageSize=10&start='.$page.'&type=platform HTTP/1.1',
            'Host: hr.hunteron.com',
            'Accept: application/json, text/plain, */*',
            'Accept-Language: en-us',
            'Accept-Encoding: gzip, deflate',
            'X-AUTH-TOKEN: user token value',
            'X-PROP: ',
            'Referer: http://hr.hunteron.com/',
            'Connection: keep-alive'
        );
        //var_dump($headers);die();
        $ch = curl_init($url);
        // debug
        //curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
        //curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookie_file);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookie_file);
        $result = curl_exec($ch);
        curl_close($ch);
        //var_dump($result);
        //die(); 
        $result = json_decode($result);
        return $result;
    }

    function get_hunter_detail($user_id) {
        $url = 'http://hr.hunteron.com/api/v1/headhunter/queryHeadhunterDetail?v=1.1.0&headhunterUserId='.$user_id;
        $useragent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_2) AppleWebKit/600.3.18 (KHTML, like Gecko) Version/8.0.3 Safari/600.3.18';
        //echo $post_fields;die();
        $headers = array(
            'GET /api/v1/headhunter/queryHeadhunterDetail?v=1.1.0&headhunterUserId='.$user_id.' HTTP/1.1',
            'Host: hr.hunteron.com',
            'Accept: application/json, text/plain, */*',
            'Accept-Language: en-us',
            'Accept-Encoding: gzip, deflate',
            'X-AUTH-TOKEN: user token value',
            'X-PROP: ',
            'Referer: http://hr.hunteron.com/',
            'Connection: keep-alive'
        );
        //var_dump($headers);die();
        $ch = curl_init($url);
        // debug
        //curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
        //curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookie_file);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookie_file);
        $result = curl_exec($ch);
        curl_close($ch);
        //var_dump($result);
        //die(); 
        $result = json_decode($result);
        return $result;
    }
}
function writelog($logname, $logcontent) {
    $logfilename = $logname."_".date('Y-m-d').".log";
    $data = '['.date('Y-m-d H:i:s').'] : '.$logcontent."\r\n";
    $logfullpath = "/tmp/".$logfilename;
    $fh = fopen($logfullpath, "a");
    @fwrite($fh, $data);
    fclose($fh);
}
$pid = pcntl_fork();
if ($pid == -1) {
    die('could not fork');
}
else if ($pid) {
}
else {
    require_once 'Classes/SQL.php';
    $sql = new SQL('spider');
    $loginname = 'XXX';
    $membername = 'XXX';
    $password = '***';
    $h = new hunteron($loginname, $membername, $password);
    $data = $h->get_nonce();
    //var_dump($data);
    $nonce = $data->data->nonce;
    $realm = $data->data->realm;
    $login_ret = $h->login($realm, $nonce);
    if ($login_ret->success != true) {
        echo "login error\r\n";
        die();
    }
    sleep(2);
    //var_dump($login_ret);
    for ($i = 1; $i < 930; $i++) {
        $start = ($i - 1) * 10;
        $lists = $h->get_hunter_list($start);
        if ($lists->success != true) {
            echo "page ".$i." get hunter list error\r\n";
            die();
        }
        $hunters = $lists->data->hunters;
        $total = $lists->data->total;
        $sleep_sec = rand(1,5);
        foreach($hunters as $hunter) {
            $name = $hunter->hunterName;
            $gender = $hunter->gender;
            $phone = $hunter->phone;
            $email = $hunter->email;
            $company = $hunter->hunterCompany->companyName;
            $hunter_id = $hunter->id;
            $hunter_detail = $h->get_hunter_detail($hunter_id);
            if ($hunter_detail->success != true) {
                echo $name." detail error\r\n";
                continue;
                //die();
            }
            $industry_arr = array();
            if (isset($hunter_detail->data->industry1->childIndustryName)) {
                $industry1 = $hunter_detail->data->industry1->childIndustryName;
                $industry_arr[] = $industry1;
            }
            if (isset($hunter_detail->data->industry2->childIndustryName)) {
                $industry2 = $hunter_detail->data->industry2->childIndustryName;
                $industry_arr[] = $industry2;
            }
            $industryname = implode(',',$industry_arr);
            //Save in Database
            $query = 'insert into hunterondotcom (huntername,phone,email,gender,companyname,industryname) 
                values ("'.$name.'","'.$phone.'","'.$email.'","'.$gender.'","'.$company.'","'.$industryname.'")';
            $sql->query($query);
            $log_name = 'spider_hunteron';
            $log_content = $sql->insert_id." ".$name." inserted, page=".$i.", start=".$start;
            writelog($log_name, $log_content);
            sleep($sleep_sec);
            //die();
        } 
    }
}
