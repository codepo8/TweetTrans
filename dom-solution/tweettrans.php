<?php
/*
  Tweetrans by Christian Heilmann (classic DOM example)
  Homepage: http://isithackday.com/yosdemo/tweettrans.php
  Copyright (c) 2009, Christian Heilmann
  Code licensed under the BSD License:
  http://wait-till-i.com/license.txt
*/

$search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_ENCODED);
$tl = filter_input(INPUT_GET, 'tl', FILTER_SANITIZE_ENCODED);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">  
  <title>TweetTrans</title>
  <link rel="stylesheet" href="http://yui.yahooapis.com/2.7.0/build/reset-fonts-grids/reset-fonts-grids.css" type="text/css">
  <link rel="stylesheet" href="tweettrans.css" type="text/css">
</head>
<body>
<div id="doc" class="yui-t7">
  <div id="hd" role="banner"><h1>TweetTrans</h1></div>
  <div id="bd" role="main">
    <form action="tweettrans.php" method="get" accept-charset="utf-8">
      <div>
        <label for="search">Search Twitter:</label>
        <input type="text" id="search" name="search" value="<?php echo $search;?>">
        <input type="submit" value="Go"> <label for="tl">Translate to:</label> 
        <select name="tl" id="tl">
          <option value="en">English</option>
          <option value="de">German</option>
          <option value="fr">French</option>
          <option value="cn">Chinese</option>
          <option value="cr">Croatian</option>
          <option value="cz">Czech</option>
          <option value="dk">Danish</option>
          <option value="nl">Dutch</option>
          <option value="fi">Finnish</option>
          <option value="fr">French</option>
          <option value="he">Hebrew</option>
          <option value="hi">Hindi</option>
          <option value="hu">Hungarian</option>
          <option value="it">Italian</option>
          <option value="no">Norwegian</option>
          <option value="pl">Polish</option>
          <option value="pr">Portuguese</option>
          <option value="ro">Romanian</option>
          <option value="ru">Russian</option>
          <option value="es">Spanish</option>
          <option value="se">Swedish</option>
          <option value="tr">Turkish</option>
          <option value="uk">Ukrainian</option>
        </select>
      </div>
    </form>
    <?php if(!isset($search)){?>
      <p class="intro">TweetTrans is a Twitter search that allows you to search for a certain topic and translate results into your own language if you need to.</p>
      <p class="intro">To start, simply enter a search term in the form above, pick your destination language and hit the go button.</p>
    <?php }?>
   <div id="results">
      <?php if(isset($search)){
        $twitter = 'http://query.yahooapis.com/v1/public/yql?q=select'.
                   '%20*%20from%20atom%20where%20url%3D%22http%3A%2F%2F'.
                   'search.twitter.com%2Fsearch.atom%3Fq%3D'.
                   urlencode($search).'%22&format=json&env='.
                   'http%3A%2F%2Fdatatables.org%2Falltables.env';
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $twitter); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $output = curl_exec($ch); 
        curl_close($ch);
        $results = json_decode($output);
        if($results->query->results->entry){
          echo '<p class="intro">Below are the Twitter search results.'.
               ' Simply hit the translate button to translate tweets that '.'
               are not in your language.</p>';
          echo '<ul>';
          foreach($results->query->results->entry as $e){
            echo '<li><a href="'.$e->author->uri.'">'.
                 '<img src="'.$e->link[1]->href.'" alt="'.$e->author->name.
                 '">'.$e->author->name.'</a>:'.$e->title.
                 ' <a href="'.$e->link[0]->href.'" class="permalink">#</a> '.
                 '<a href="translate.php?tl='.$tl.
                 '&text='.urlencode($e->title).'" class="trans">'.
                 'Translate</a></li>';
          }
          echo '</ul>';
        }
      }
      ?>
    </div>
  </div>
  <div id="ft" role="contentinfo"><p></p></div>
</div>
<script type="text/javascript" charset="utf-8">
  var x = document.getElementById('results');
  x.addEventListener('click',function(e){
    if(e.target.nodeName.toLowerCase()==='a' && 
       e.target.className==='trans'){   
      var t = e.target;  
      var url = t.getAttribute('href'); 
      var request;
       try{
         request = new XMLHttpRequest();
       }catch(error){
         try{
           request = new ActiveXObject("Microsoft.XMLHTTP");
         }catch(error){
           return true;
         }
       }
       request.open('get',url,true);
       request.onreadystatechange=function(){
         if(request.readyState == 1){
         }
         if(request.readyState == 4){
           if (request.status && /200|304/.test(request.status))
           {
             var span = document.createElement('span');
             span.innerHTML = request.responseText;
             e.target.parentNode.appendChild(span);
           }
         }
       }
       request.setRequestHeader('If-Modified-Since','Wed, 05 Apr 2006 00:00:00 GMT');
       request.send(null);
      e.preventDefault();
    }
  },true)
</script>
</body>
</html>
