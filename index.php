<?php

/*
- Do not use existing "complete" configuration parsing libraries/functions, we want to see how you would write the code to do this. - DONE
- Use of core and stdlib functions/objects such as string manipulation, regular expressions, etc is ok. - DONE
- We should be able to get the values of the config parameters in code, via their name. How this is done specifically is up to you. - DONE
- Boolean-like config values (on/off, yes/no, true/false) should return real booleans: true/false. - DONE
- Numeric config values should return real numerics: integers, doubles, etc - DONE
- Ignore or error out on invalid config lines, your choice - DONE
- Please include a short example usage of your code so we can see how you call it/etc. - DONE
- Push your work to a public github repository and send us the link.
*/

class TypeDetect {

  public function detectValue($str) {
    if ($val = $this->isNumeric($str)) {
      return $val;
    } else if ($this->isBool($str)) {
      return $this->getBool($str);
    } else {
      return (string)$str;
    }
  }

  private function isNumeric($str) {
    if (is_numeric($str)) {
      return (strpos($str,'.') !== false) ? (float)$str : (int)$str;
    }
    return null;
  }

  private function isBool($str) {
    if (preg_match('/(true|yes|on|false|no|off)/i',$str)) {
      return true;
    }
    return false;
  }

  private function getBool($str) {
    if (preg_match('/(true|yes|on)/i',$str)) {
      return true;
    }
    if (preg_match('/(false|no|off)/i',$str)) {
      return false;
    }
  }

}

class AdBoom {

  private $file;
  private $data;
  private $err;

  public function __construct($file) {
    $this->file = $file;
  }

  public function process() {
    try {
      if ($this->data = $this->getData()) {
        $this->typeSetData();
      } else {
        throw new Exception('File is empty.');
      }
    } catch (Exception $e) {
      $this->err = 'Caught exception: '.  $e->getMessage(). "\n";
    }
  }

  // #############################
  // Private Helpers #############
  // #############################

  private function typeSetData() {
    $td = new TypeDetect();
    foreach($this->data as &$val) {
      if (empty($val)) throw new Exception('Value can\'t be empty.');
      $val = $td->detectValue($val);
    }
  }

  private function getData() {
    if (file_exists($this->file)) {
      return $this->parseFile(@file_get_contents($this->file));
    } else {
      throw new Exception('File does not exist.');
    }
  }

  private function parseFile($string) {
    if (preg_match_all('/(?<=\s|\A)([^\s=]+)\s*=\s*(.*?)(?=(?:\s[^\s=]+=|$))/m', $string, $matches)) {
      return array_combine ( $matches[1], $matches[2] );
    }
    return false;
  }

  // ############################
  // Public Getters #############
  // ############################

  public function getContent() {
    return $this->data;
  }

  public function getError() {
    return $this->err;
  }

}

// Do it!
$ad_boom = new AdBoom('config.txt');
$ad_boom->process();
if ($err = $ad_boom->getError()) {
  die($err);
}

$data = $ad_boom->getContent();

if ($data['debug_mode']) {
  echo 'Where is the log file: '.$data['log_file_path']."\r\n";
  echo 'Server load alarm is: '.$data['server_load_alarm']."\r\n";
  echo 'Host '.$data['host']." on server ".$data['server_id']."\r\n";
  echo "\r\n\r\n";

  foreach($data as $val) {
    if (is_bool($val)) {
      echo $val." is a boolean.\r\n";
    } else if (is_integer($val)) {
      echo $val." is a integer.\r\n";
    } else if (is_float($val)) {
      echo $val." is a float.\r\n";
    } else {
      echo $val." is a string.\r\n";
    }
  }
}

die("\r\n".'Finished');