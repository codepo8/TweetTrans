<?php 
  /*
    Tweetrans by Christian Heilmann (YQL translation)
    Homepage: http://isithackday.com/yosdemo/tweettrans.php
    Copyright (c) 2009, Christian Heilmann
    Code licensed under the BSD License:
    http://wait-till-i.com/license.txt
  */
  $url = 'http://query.yahooapis.com/v1/public/yql?'.
         'q=select%20*%20from%20google.translate%20where%20q%3D%22'.
         urlencode($_GET['text']).'%22%20and%20target%3D%22'.
         $_GET['tl'].'%22%3B&format=json&env='.
         'http%3A%2F%2Fdatatables.org%2Falltables.env';
  $ch = curl_init(); 
  curl_setopt($ch, CURLOPT_URL, $url); 
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
  $output = curl_exec($ch); 
  curl_close($ch);
  $results = json_decode($output);
  echo $results->query->results->translatedText;  
?>