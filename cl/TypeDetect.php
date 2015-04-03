<?php

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