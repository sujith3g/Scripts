<?php

class cURL {

   var $header_s;
   var $compression;
   var $cookie_file;
   var $proxy;
   var $u_agent;

   function cookie( $cookie_file ) {
   
   if(file_exists( $cookie_file )) {
   $this->cookie_file = $cookie_file;
   } else {
   $file_handle=fopen($cookie_file, 'w') or $this->error('cookie_file could not be opened');
   $this->cookie_file = $cookie_file;
   fclose( $file_handle );
   }
   
   }

   function cURL($cookie_s=true, $cookie='cookie_s.txt', $compression='gzip', $Proxy='') {
   
   $this->header_s[]='Content-type: application/x-www-form-urlencoded;charset=UTF-8';
   $this->header_s[]='Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
   $this->header_s[]='Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7';
   $this->header_s[]='Accept-Encoding: gzip,deflate';
   $this->header_s[]='Accept-Language: en-us,en;q=0.5';
   $this->header_s[]='Connection: Keep-Alive';
   $this->header_s[]='Keep-Alive: 300';
   
   $this->u_agent='iPhone 4.0';
   $this->compression = $compression;
   #$this->proxy = $proxy;
   $this->cookie_s = $cookie_s;
   
   if($this->cookie_s == true) $this->cookie( $cookie );
   
   }

   function get( $url ) {
   
   $handle = curl_init( $url );
   
   if($this->cookie_s == true) curl_setopt($handle, CURLOPT_COOKIEFILE, $this->cookie_file);
   if($this->cookie_s == true) curl_setopt($handle, CURLOPT_COOKIEJAR, $this->cookie_file);
   
   curl_setopt($handle, CURLOPT_ENCODING, $this->compression);
   #curl_setopt($handle, CURLOPT_FOLLOWLOCATION, 1);
   curl_setopt($handle, CURLOPT_HEADER, 0);
   curl_setopt($handle, CURLOPT_HTTPHEADER, $this->header_s);
   curl_setopt($handle, CURLOPT_PROXY, $this->proxy);
   curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($handle, CURLOPT_TIMEOUT, 5);
   curl_setopt($handle, CURLOPT_USERAGENT, $this->u_agent);
   
   $return = curl_exec( $handle );
   curl_close($handle);
   
   return $return;
   
   }

   function post($url, $data, $referer=false) {
   
   $handle = curl_init( $url );
   
   if($this->cookie_s == true) curl_setopt($handle, CURLOPT_COOKIEFILE, $this->cookie_file);
   if($this->cookie_s == true) curl_setopt($handle, CURLOPT_COOKIEJAR, $this->cookie_file);
   
   curl_setopt($handle, CURLOPT_ENCODING, $this->compression);
   #curl_setopt($handle, CURLOPT_FOLLOWLOCATION, 1);
   curl_setopt($handle, CURLOPT_HEADER, 1);
   curl_setopt($handle, CURLOPT_HTTPHEADER, $this->header_s);
   curl_setopt($handle, CURLOPT_POST, 1);
   curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
   curl_setopt($handle, CURLOPT_PROXY, $this->proxy);
   
   if($referer) curl_setopt($handle, CURLOPT_REFERER, $referer);
   
   curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, 2); 
   curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
   curl_setopt($handle, CURLOPT_TIMEOUT, 50);
   curl_setopt($handle, CURLOPT_USERAGENT, $this->u_agent);
   
   $return = curl_exec($handle);
   curl_close($handle);
   
   return $return;
   
   }

}

?>