<?php
/**
 * Created by PhpStorm.
 * User: MINO
 * Date: 2016-11-09
 * Time: 오후 2:44
 */

// 암호화해독
function ase_decrypt($val)
{
    if(!$val) return '';

    $salt = 'Wow1daY';
    $mode=MCRYPT_MODE_ECB;
    $enc=MCRYPT_RIJNDAEL_128;

    $iv = mcrypt_create_iv(mcrypt_get_iv_size($enc, $mode), MCRYPT_RAND);
    $val = mcrypt_decrypt($enc, $salt, pack("H*", $val), $mode, $iv );
    return rtrim($val,$val[strlen($val)-1]);
}

// 암호화함수
function ase_encrypt($val)
{

    $salt = 'Wow1daY';
    $mode=MCRYPT_MODE_ECB;
    $enc=MCRYPT_RIJNDAEL_128;
    $iv = mcrypt_create_iv(mcrypt_get_iv_size($enc, $mode),  MCRYPT_RAND);
    $pad_len= 16-(strlen($val) % 16);
    $val=str_pad($val, (16*(floor(strlen($val) / 16)+1)), chr($pad_len));
    return strtoupper( bin2hex(mcrypt_encrypt($enc, $salt, $val, $mode, $iv)));
}
function page_default_set(&$config)
{

    //페이지네이션 왼쪽에 위치할 여는태그입니다.
    $config['full_tag_open'] = '<div class="col-md-6"><div class="paging_bootstrap"><ul class="pagination">';

    //페이지네이션 오른쪽에 위치할 닫는태그 입니다.
    $config['full_tag_close'] = '</ul></div></div>';


//"처음으로"링크 커스터마이징 Customizing the First Link

$config['first_link'] = "처음으로";
//페이지네이션 맨 왼쪽에 위치할 "처음으로" 링크 글을 설정합니다.First 대신 "처음","맨처음" 등을 쓰시는게 좋겠지요 :)
$config['first_tag_open'] = '<li class="prev disabled">';
//"처음으로"링크의 여는태그 입니다.
$config['first_tag_close'] = '</li>';
//"처음으로"링크의 닫는태그 입니다.
//"끝으로"링크 커스터마이징 Customizing the Last Link
$config['last_link'] = "끝으로";
//페이지네이션 맨 오른쪽에 위치할 "끝으로" 링크 글을 설정합니다.
//값을 FALSE로 설정하면, 이 링크는 렌더링 되지않습니다.
$config['last_tag_open'] = '<li class="next">';
//"끝으로"링크의 여는태그 입니다.
$config['last_tag_close'] = '</li>';
//"끝으로"링크의 닫는태그 입니다.


//"다음" 링크 커스터마이징 Customizing the "Next" Link
$config['next_link'] = '&gt;';
//"다음" 링크 글을 설정합니다.
//값을 FALSE로 설정하면, 이 링크는 렌더링 되지않습니다.
$config['next_tag_open'] = '<li class="next">';
//"다음"링크의 여는태그 입니다.
$config['next_tag_close'] = '</li>';
//"다음"링크의 닫는태그 입니다.

//"이전"링크 커스터마이징 Customizing the "Previous" Link
$config['prev_link'] = '&lt;';
//"이전" 링크 글을 설정합니다.
//값을 FALSE로 설정하면, 이 링크는 렌더링 되지않습니다.
$config['prev_tag_open'] = '<li class="prev disabled">';
//"이전"링크의 여는태그 입니다.
$config['prev_tag_close'] = '</li>';
//"이전"링크의 닫는태그 입니다.

//"현재페이지"링크 커스터마이징 Customizing the "Current Page" Link

$config['cur_tag_open'] = '<li class = "active"><a>';
//"현재페이지"링크의 여는태그 입니다.
$config['cur_tag_close'] = '</a></li>';
//"현재페이지"링크의 닫는태그 입니다.

//링크숫자 커스터마이징 Customizing the "Digit" Link

$config['num_tag_open'] = '<li>';
//링크숫자 링크의 여는태그 입니다.
$config['num_tag_close'] = '</li>';
//링크숫자 링크의 닫는태그 입니다.



    $config['num_links'] = 6;
}

