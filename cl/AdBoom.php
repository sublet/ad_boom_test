<?php

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
    if (!class_exists('TypeDetect')) require 'TypeDetect.php';
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