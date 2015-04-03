<?php

/*
- Do not use existing "complete" configuration parsing libraries/functions, we want to see how you would write the code to do this. - DONE
- Use of core and stdlib functions/objects such as string manipulation, regular expressions, etc is ok. - DONE
- We should be able to get the values of the config parameters in code, via their name. How this is done specifically is up to you. - DONE
- Boolean-like config values (on/off, yes/no, true/false) should return real booleans: true/false. - DONE
- Numeric config values should return real numerics: integers, doubles, etc - DONE
- Ignore or error out on invalid config lines, your choice - DONE
- Please include a short example usage of your code so we can see how you call it/etc. - DONE
- Push your work to a public github repository and send us the link. - DONE
*/

if (!class_exists('AdBoom')) require 'cl/AdBoom.php';

$ad_boom = new AdBoom('config.txt');
$ad_boom->process();
if ($err = $ad_boom->getError()) {
  die($err);
}
$data = $ad_boom->getContent();

// In the config file, I have set debug_mode to true.
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