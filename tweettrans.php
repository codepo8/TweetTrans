<?php
/*
  Tweetrans by Christian Heilmann (twitter list script)
  Homepage: http://isithackday.com/yosdemo/tweettrans.php
  Copyright (c) 2009, Christian Heilmann
  Code licensed under the BSD License:
  http://wait-till-i.com/license.txt
*/
?>
<style type="text/css" media="screen">
#doc{background:#9cf;color:#000;font-family:calibri,helvetica,arial,sans-serif;}
input[type='submit']{ border:1px solid #000; padding:0 .5em; margin:0 .5em;}
h1{font-size:200%; color:#036; font-weight:bold; margin:5px 0;}
form{border:1px solid #000; border-color:#69c #369 #036 #369;font-size:130%;background:#369;color:#fff;font-weight:bold;padding:.5em;margin:.5em 0;}
a.trans{text-decoration:none;background:#369;display:block;color:#fff;padding:.2em; font-weight:bold;}
#results ul,#results li{list-style:none;padding:0;margin:0;}
a{ color:#000; font-weight:bold;}
#results ul,p{padding:0 10px;}
#results ul,p{padding:0 30px 0 10px;}
#results li{font-size:107%;width:90%;position:relative;padding-right:5em;padding-left:60px;margin-right:10px;padding-bottom:.5em;}
#results li img{width:48px;left:0;top:0;position:absolute;}
#results .trans{position:absolute;top:0;right:0;}
#results li span{display:block;background:#fff;margin:.5em 0;}
p.intro{font-weight:bold;font-size:127%;margin:10px 0;}
</style>
<div id="doc" class="yui-t7">
  <div id="hd"><h1>TweetTrans</h1></div>
  <div id="bd">
    <yml:form params="twitterlist.php" insert="results" method="get">
      <div>
        <label for="search">Search Twitter:</label>
        <input type="text" id="search" name="search">
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
    </yml:form>
    <div id="results">
       <p class="intro">TweetTrans is a Twitter search that allows you to search for a certain topic and translate results into your own language if you need to.</p>
       <p class="intro">To start, simply enter a search term in the form above, pick your destination language and hit the go button.</p>
    </div>
  </div>
</div>
