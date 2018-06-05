<?php
   // require 'phpQuery.php';
   // $url = 'https://privatbank.ua/';
   // $file = file_get_contents($url);
   // $doc = phpQuery::newDocument($file);
   // $tbl = $doc->find('.row-no-padding');
   // echo $tbl;
  
  include 'simple_html_dom.php';

  function curl_get($url, $referer = 'https://www.google.ru') {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_HEADER, 0);	
      curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/62.0.3202.89 Chrome/62.0.3202.89 Safari/537.36");
      curl_setopt($ch, CURLOPT_REFERER, $referer);	
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $data = curl_exec($ch);
      curl_close($ch);
      return $data;
  }

  $html = curl_get('http://www.komandirovka.ru/hotels/tambov/');
  $dom = str_get_html($html);

  $linck = $dom->find('.l_h_left');

echo "2222";

  foreach ($linck as $linck_mas) {
      $a = $linck_mas->find('a',0);
      // echo $a->plaintext.'<br />';
      echo $a->href.'<br />';
      // echo $linck_mas->plaintext;
      // echo "<br />";

      //получаем информацию о страницы 
      echo '<br />';
          $html_page = curl_get('http://www.komandirovka.ru'.$a->href);
          $dom_page = str_get_html($html_page);
         
print_r($dom_page);
          // $linck_page = $dom_page->find('h1');
          // echo $linck_page->plaintext;
          
          break;

      echo '<br />'; 

  }


?>