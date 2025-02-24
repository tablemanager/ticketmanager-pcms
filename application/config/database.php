<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'default';
$active_record = TRUE;

/* 
$db['default']['hostname'] = '115.68.42.7';
$db['default']['username'] = 'rubysoft';
$db['default']['password'] = 'rubyonrails';
*/
//2번 레거시 pcmsdb
$db['default']['hostname'] = 'ticketmanager.cbwsoa0mqp56.ap-northeast-2.rds.amazonaws.com';
$db['default']['username'] = 'pcmsdb';
$db['default']['password'] = 'p981c!m90s^d43b';
$db['default']['database'] = 'pcmsdb';
$db['default']['dbdriver'] = 'mysqli';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;

//2번문자DB
$db['BGFSMS2']['hostname'] = 'ticketmanager.cbwsoa0mqp56.ap-northeast-2.rds.amazonaws.com';
/* $db['BGFSMS2']['username'] = 'BGFUSER';
$db['BGFSMS2']['password'] = 'WGAJdXamsPFbK5ds'; */
$db['BGFSMS2']['username'] = 'bgfsms2';
$db['BGFSMS2']['password'] = 'b91g@f97s26ms2';
$db['BGFSMS2']['database'] = 'BGFSMS2';
$db['BGFSMS2']['dbdriver'] = 'mysqli';
$db['BGFSMS2']['dbprefix'] = '';
$db['BGFSMS2']['pconnect'] = TRUE;
$db['BGFSMS2']['db_debug'] = TRUE;
$db['BGFSMS2']['cache_on'] = FALSE;
$db['BGFSMS2']['cachedir'] = '';
$db['BGFSMS2']['char_set'] = 'utf8';
$db['BGFSMS2']['dbcollat'] = 'utf8_general_ci';
$db['BGFSMS2']['swap_pre'] = '';
$db['BGFSMS2']['autoinit'] = TRUE;
$db['BGFSMS2']['stricton'] = FALSE;

//14번 레거시 안씀
$db['pcms']['hostname'] = 'ticketmanager.cbwsoa0mqp56.ap-northeast-2.rds.amazonaws.com';
$db['pcms']['username'] = 'terp';
$db['pcms']['password'] = 't90@e71r@p43';
$db['pcms']['database'] = 'terp_placem';
$db['pcms']['dbdriver'] = 'mysqli';
$db['pcms']['dbprefix'] = '';
$db['pcms']['pconnect'] = TRUE;
$db['pcms']['db_debug'] = TRUE;
$db['pcms']['cache_on'] = FALSE;
$db['pcms']['cachedir'] = '';
$db['pcms']['char_set'] = 'utf8';
$db['pcms']['dbcollat'] = 'utf8_general_ci';
$db['pcms']['swap_pre'] = '';
$db['pcms']['autoinit'] = TRUE;
$db['pcms']['stricton'] = FALSE;

//2번 레거시 cmsdb
$db['cms']['hostname'] = 'ticketmanager.cbwsoa0mqp56.ap-northeast-2.rds.amazonaws.com';
$db['cms']['username'] = 'bcmsdb';
$db['cms']['password'] = 'b83c^3m@s84d9b';
/* $db['cms']['hostname'] = '115.68.42.7';
$db['cms']['username'] = 'rubysoft';
$db['cms']['password'] = 'rubyonrails'; */
$db['cms']['database'] = 'CMSDB';
$db['cms']['dbdriver'] = 'mysqli';
$db['cms']['dbprefix'] = '';
$db['cms']['pconnect'] = TRUE;
$db['cms']['db_debug'] = TRUE;
$db['cms']['cache_on'] = FALSE;
$db['cms']['cachedir'] = '';
$db['cms']['char_set'] = 'utf8';
$db['cms']['dbcollat'] = 'utf8_general_ci';
$db['cms']['swap_pre'] = '';
$db['cms']['autoinit'] = TRUE;
$db['cms']['stricton'] = FALSE;

//7번 뉴스파로 DB
$db['sparo2']['hostname'] = 'ticketmanager.cbwsoa0mqp56.ap-northeast-2.rds.amazonaws.com';
$db['sparo2']['username'] = 'spadb';
$db['sparo2']['password'] = 's91p18a^75d@2b';
$db['sparo2']['database'] = 'spadb';
$db['sparo2']['dbdriver'] = 'mysqli';
$db['sparo2']['dbprefix'] = '';
$db['sparo2']['pconnect'] = TRUE;
$db['sparo2']['db_debug'] = TRUE;
$db['sparo2']['cache_on'] = FALSE;
$db['sparo2']['cachedir'] = '';
$db['sparo2']['char_set'] = 'utf8';
$db['sparo2']['dbcollat'] = 'utf8_general_ci';
$db['sparo2']['swap_pre'] = '';
$db['sparo2']['autoinit'] = TRUE;
$db['sparo2']['stricton'] = FALSE;
/*
//7번 문자DB
$db['sparoBGF']['hostname'] = '115.68.42.7';
$db['sparoBGF']['username'] = 'rubysoft';
$db['sparoBGF']['password'] = 'rubyonrails';
$db['sparoBGF']['database'] = 'BGFSMS';
$db['sparoBGF']['dbdriver'] = 'mysql';
$db['sparoBGF']['dbprefix'] = '';
$db['sparoBGF']['pconnect'] = TRUE;
$db['sparoBGF']['db_debug'] = FALSE;
$db['sparoBGF']['cache_on'] = FALSE;
$db['sparoBGF']['cachedir'] = '';
$db['sparoBGF']['char_set'] = 'utf8';
$db['sparoBGF']['dbcollat'] = 'utf8_general_ci';
$db['sparoBGF']['swap_pre'] = '';
$db['sparoBGF']['autoinit'] = TRUE;
$db['sparoBGF']['stricton'] = FALSE;
 */
//8번 쿠폰DB
$db['bar']['hostname'] = 'ticketmanager.cbwsoa0mqp56.ap-northeast-2.rds.amazonaws.com';
$db['bar']['username'] = 'spadb';
$db['bar']['password'] = 's91p18a^75d@2b';
$db['bar']['database'] = 'spadb';
$db['bar']['dbdriver'] = 'mysqli';
$db['bar']['dbprefix'] = '';
$db['bar']['pconnect'] = TRUE;
$db['bar']['db_debug'] = TRUE;
$db['bar']['cache_on'] = FALSE;
$db['bar']['cachedir'] = '';
$db['bar']['char_set'] = 'utf8';
$db['bar']['dbcollat'] = 'utf8_general_ci';
$db['bar']['swap_pre'] = '';
$db['bar']['autoinit'] = TRUE;
$db['bar']['stricton'] = FALSE;

//9번 안씀
$db['sparo']['hostname'] = 'ticketmanager.cbwsoa0mqp56.ap-northeast-2.rds.amazonaws.com';
$db['sparo']['username'] = 'spadb';
$db['sparo']['password'] = 's91p18a^75d@2b';
$db['sparo']['database'] = 'spadb';
$db['sparo']['dbdriver'] = 'mysqli';
$db['sparo']['dbprefix'] = '';
$db['sparo']['pconnect'] = TRUE;
$db['sparo']['db_debug'] = TRUE;
$db['sparo']['cache_on'] = FALSE;
$db['sparo']['cachedir'] = '';
$db['sparo']['char_set'] = 'utf8';
$db['sparo']['dbcollat'] = 'utf8_general_ci';
$db['sparo']['swap_pre'] = '';
$db['sparo']['autoinit'] = TRUE;
$db['sparo']['stricton'] = FALSE;

//해외 클라우드 DB
$db['chapi']['hostname'] = 'ticketmanager.cbwsoa0mqp56.ap-northeast-2.rds.amazonaws.com';
$db['chapi']['username'] = 'cmsdb';
$db['chapi']['password'] = 'c92m8@s^d82b';
$db['chapi']['database'] = 'cmsdb';
$db['chapi']['dbdriver'] = 'mysqli';
$db['chapi']['dbprefix'] = '';
$db['chapi']['pconnect'] = TRUE;
$db['chapi']['db_debug'] = TRUE;
$db['chapi']['cache_on'] = FALSE;
$db['chapi']['cachedir'] = '';
$db['chapi']['char_set'] = 'utf8';
$db['chapi']['dbcollat'] = 'utf8mb4_unicode_ci';
$db['chapi']['swap_pre'] = '';
$db['chapi']['autoinit'] = TRUE;
$db['chapi']['stricton'] = FALSE;

//130번 백업 및 네이버 연동
$db['cms2']['hostname'] = 'ticketmanager.cbwsoa0mqp56.ap-northeast-2.rds.amazonaws.com';
$db['cms2']['username'] = 'apidb';
$db['cms2']['password'] = 'a912p@i^d83b';
$db['cms2']['database'] = 'apidb';
$db['cms2']['dbdriver'] = 'mysqli';
$db['cms2']['dbprefix'] = '';
$db['cms2']['pconnect'] = TRUE;
$db['cms2']['db_debug'] = TRUE;
$db['cms2']['cache_on'] = FALSE;
$db['cms2']['cachedir'] = '';
$db['cms2']['char_set'] = 'utf8';
$db['cms2']['dbcollat'] = 'utf8mb4_unicode_ci';
$db['cms2']['swap_pre'] = '';
$db['cms2']['autoinit'] = TRUE;
$db['cms2']['stricton'] = FALSE;

//130번 문자DB
$db['BGFSMS3']['hostname'] = 'ticketmanager.cbwsoa0mqp56.ap-northeast-2.rds.amazonaws.com';
$db['BGFSMS3']['username'] = 'bgfsms3';
$db['BGFSMS3']['password'] = 'b*6g4f31s0m4s';
$db['BGFSMS3']['database'] = 'BGFSMS3';
$db['BGFSMS3']['dbdriver'] = 'mysqli';
$db['BGFSMS3']['dbprefix'] = '';
$db['BGFSMS3']['pconnect'] = TRUE;
$db['BGFSMS3']['db_debug'] = TRUE;
$db['BGFSMS3']['cache_on'] = FALSE;
$db['BGFSMS3']['cachedir'] = '';
$db['BGFSMS3']['char_set'] = 'utf8';
$db['BGFSMS3']['dbcollat'] = 'utf8mb4_unicode_ci';
$db['BGFSMS3']['swap_pre'] = '';
$db['BGFSMS3']['autoinit'] = TRUE;
$db['BGFSMS3']['stricton'] = FALSE;


$db['rds']['hostname'] = 'ticketmanager.cbwsoa0mqp56.ap-northeast-2.rds.amazonaws.com';
$db['rds']['username'] = 'cmsdb';
$db['rds']['password'] = 'c92m8@s^d82b';
$db['rds']['database'] = 'cmsdb';
$db['rds']['dbdriver'] = 'mysqli';
$db['rds']['dbprefix'] = '';
$db['rds']['pconnect'] = TRUE;
$db['rds']['db_debug'] = TRUE;
$db['rds']['cache_on'] = FALSE;
$db['rds']['cachedir'] = '';
$db['rds']['char_set'] = 'utf8';
$db['rds']['dbcollat'] = 'utf8mb4_unicode_ci';
$db['rds']['swap_pre'] = '';
$db['rds']['autoinit'] = TRUE;
$db['rds']['stricton'] = FALSE;


//$conn_rds = @mysql_connect('','cmsdb','qRgZ9xM9AI#Cr3');
/* End of file database.php */
/* Location: ./application/config/database.php */
