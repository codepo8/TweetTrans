<?php
  /*
    Tweetrans by Christian Heilmann (twitter list script)
    Homepage: http://isithackday.com/yosdemo/tweettrans.php
    Copyright (c) 2009, Christian Heilmann
    Code licensed under the BSD License:
    http://wait-till-i.com/license.txt
  */
  $tl = filter_input(INPUT_GET, 'tl', FILTER_SANITIZE_ENCODED);
  $twitter = 'http://query.yahooapis.com/v1/public/yql?q=select'.
             '%20*%20from%20atom%20where%20url%3D%22http%3A%2F%2F'.
             'search.twitter.com%2Fsearch.atom%3Fq%3D'.
             urlencode($_GET['search']).'%22&format=json&env='.
             'http%3A%2F%2Fdatatables.org%2Falltables.env';
  $ch = curl_init(); 
  curl_setopt($ch, CURLOPT_URL, $twitter); 
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
  $output = curl_exec($ch); 
  curl_close($ch);
  $results = json_decode($output);
  if($results->query->results->entry){
    echo '<p class="intro">Below are the Twitter search results.'.
         ' Simply hit the "translate" link to translate tweets that '.
         'are not in your language.</p>';
    echo '<ul>';
    $count = 0;
    foreach($results->query->results->entry as $e){
      $count++;
      echo '<li style="background:url('.$e->link[1]->href.
           ') top left no-repeat"><a href="'.$e->author->uri.'">'.
           $e->author->name.'</a>:'.$e->title.
           ' <a href="'.$e->link[0]->href.'" class="permalink">#</a> '.
           '<yml:a view="YahooFullView" params="translate.php?tl='.$tl.
            '&text='.urlencode($e->title).'" insert="output'.
            $count.'">Translate</yml:a><span id="output'.
            $count.'"></span></li>';
    }
    echo '</ul>';
  }
?>