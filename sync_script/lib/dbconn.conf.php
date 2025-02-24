<?php
$conn_cms = mysql_connect('localhost', 'cmsdb', 'cc#$fDDD28^');
mysql_select_db('CMSDB',$conn_cms);

$conn_pcms = mysql_connect('115.68.42.14','rubysoft','rubyonrails');
mysql_select_db('terp_placem',$conn_pcms);
mysql_query('set names utf8',$conn_pcms);

$conn_sparo = mysql_connect('115.68.42.9','rubysoft','rubyonrails');
mysql_select_db('spadb',$conn_sparo);
mysql_query('set names utf8',$conn_sparo);

/*
$conn_sparo2 = mysql_connect('115.68.42.7','rubysoft','rubyonrails');
mysql_select_db('spadb',$conn_sparo2);
mysql_query('set names utf8',$conn_sparo2);
*/
$conn_sparo2 = mysql_connect('52.78.138.84','cmsdb','wsoqb?^NRl#PJluzxa3');
mysql_select_db('spadb',$conn_sparo2);
mysql_query('set names utf8',$conn_sparo2);

$conn_bar = mysql_connect('115.68.42.8','rubysoft','rubyonrails');
mysql_select_db('spadb',$conn_bar);


$conn_cms = mysql_connect('localhost', 'root', 'p2879@jjs');
mysql_select_db('pcmsdb',$conn_cms);
?>