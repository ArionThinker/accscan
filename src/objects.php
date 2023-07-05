<?php
class Text {
    public function color($string, $color = false) {
        $output = $string;

        switch ($color) {
            case 'blue':
                $output = "\e[36m$string\e[0m";
                break;
            case 'red':
                $output = "\e[31m$string\e[0m";
                break;
            case 'green':
                $output = "\e[32m$string\e[0m";
                break;
        }

        return $output;
    }
}

class Console {
    public function output($string) {
        $output = is_array($string) ? print_r($string, true) : $string;
        print("$output\n");
    }
}

class Web {
    public function check($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        $response = curl_exec($ch);
        
        if ($response === false) {
            echo "Request execution error: " . curl_error($ch) . "\n";
            curl_close($ch);
            exit();
        }
        
        $info = curl_getinfo($ch);
        $httpCode = $info['http_code'];
        
        curl_close($ch);
    
        return $httpCode == 200 ? $url : "none";
    }
}