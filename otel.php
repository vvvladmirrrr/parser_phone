<?php
   // require 'phpQuery.php';
   // $url = 'https://privatbank.ua/';
   // $file = file_get_contents($url);
   // $doc = phpQuery::newDocument($file);
   // $tbl = $doc->find('.row-no-padding');
   // echo $tbl;
  
  include 'simple_html_dom.php';



  function curl_get($url, $referer = 'https://yandex.ru/') {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_HEADER, 0);	
      // curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/62.0.3202.89 Chrome/62.0.3202.89 Safari/537.36");
      curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322)");
      curl_setopt($ch, CURLOPT_REFERER, $referer);	
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120); // таймаут соединения
      curl_setopt($ch, CURLOPT_TIMEOUT, 120);        // таймаут ответа
      /*
      $content = curl_exec($ch);
      $err  = curl_errno($ch);
      $errmsg = curl_error($ch);
      $data= curl_getinfo($ch);
      curl_close($ch);
      $data['errno']   = $err;
      $data['errmsg']  = $errmsg;
      $data['content'] = $content;
      return $data;
      */
      $data = curl_exec($ch);
      curl_close($ch);
      return $data;
  }

  $html = curl_get('https://www.newegg.com/Product/ProductList.aspx?Submit=ENE&N=100167543%2050001514&IsNodeId=1&cm_sp=Cat_Unlocked-Cellphones_1-_-visnav_-_-Nokia');

  $dom = str_get_html($html);


  $linck = $dom->find('.item-container');



  foreach ($linck as $linck_mas) {
      $a = $linck_mas->find('a',0);
      // echo $a->plaintext.'<br />';
      echo $a->href.'<br />';
      // echo $linck_mas->plaintext;
      // echo "<br />";

      //получаем информацию о страницы 
      echo '<br />';
     
      $html = curl_get($a->href);
      $dom = str_get_html($html);
      $title = $dom->find('#grpDescrip_h',0);
      echo $title->plaintext;
      echo "<br />";
      $price = $dom->find(".background_F6F0E2 meta[itemprop='price']",0);
      echo $price->content;
      echo "<br />";
      $images_src = $dom->find('.objImages img',1);
      echo $images_src->src;
      echo "<br />";
      $text_content = $dom->find('.grpBullet ul',0);
      echo $text_content->outertext;
      
      // echo "<br />";echo "<br />";
      break;


          // $html_page = curl_get('http://www.komandirovka.ru'.$a->href);
          // $dom_page = str_get_html($html_page);
          // $linck_page = $dom_page->find('h1');
          // echo $linck_page->plaintext;
          
          // break;



  }


?>