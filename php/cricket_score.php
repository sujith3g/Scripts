<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php
include_once "cURL.php";

$f =fopen("../cric4cet/LINK.txt",'r');

$order = fgets($f, 999);
$cURL_home = new cURL();
$malestr=($cURL_home->post($order,""));
$schedule=$malestr;



$malestr = preg_replace('/\s\s+/', '', $malestr);
$malestr= str_replace("/", "_", $malestr);

$malestr=str_replace(array("\r", "\r\n", "\n"), "", $malestr);

$regex = '/<[^>]*>[^<]*<\/[^>]*>/';
$malestr = preg_replace($regex, '', $malestr);
$malestr = str_replace('*<span style="white-space: nowrap; padding-right: 5px;">', " ", $malestr);
$malestr = str_replace("<_span>", " ", $malestr);

$malestr = str_replace('class', "", $malestr);
$malestr = str_replace('"', '', $malestr);
$malestr = str_replace('<p =potMatchText mat_scores>', "laserjet1018", $malestr);
$malestr = str_replace('<span style=white-space: nowrap; padding-right: 5px;>', '', $malestr);
$malestr = str_replace('<_p><p =potMatchText mat_players>', " ", $malestr);
$malestr = str_replace('<_p><p =potMatchText mat_status>', 'creativespeaker', $malestr);


$reg_ex = '<a href=[A-Za-z]_top">';
$replace_word = ""; 
$malestr=preg_replace($reg_ex, $replace_word, $malestr);




$fp=fopen("../cric4cet/links.txt",'w');
fwrite ($fp, $malestr);

$regex = '/laserjet1018(.+?)creativespeaker/';
preg_match_all($regex,$malestr,$cget);

$result=count($cget[1]);

//echo $result;

//echo $cget[1][2];

$i=0;


$connection=mysql_connect("localhost", "username", "password") or die(mysql_error());
mysql_select_db("cricket",$connection) or die(mysql_error());

while ($i<$result) 
{
        $fp1=fopen("../cric4cet/teams.txt",'r'); 
        $fp2=fopen("../cric4cet/black_list.txt",'r');
	$insu=$cget[1][$i];

	$insu = str_replace('_', '/', $insu);
	$pos = strpos($insu, '*');
	$pose= strpos($insu, ';');
	$qry="SELECT * FROM data WHERE text=\"".$insu."\"";
	$flag=0;
	
// Note our use of ===.  Simply == would not work as expected
// because the position of 'a' was the 0th (first) character.
if (($pos === false && $pose===false) )
{
    //echo "false";
}
else 
{
	while(!feof($fp1))
	{
		$team=fgets($fp1,999);
		$team=rtrim($team);
		if($team != "")
		{
			$ps = substr_count($insu,$team);
			if($ps != 0)
			{
				$flag=1;
				break;
			}
		}

	}
    if($flag==1)
    {
	while(!feof($fp2))
        {
        $team1=fgets($fp2,999);
        $team1=rtrim($team1);  
        //echo "<br>team1:".$team1;
            if($team1 != "")
            {   
                $ps1 = substr_count($insu,$team1);
                if($ps1 != 0)
                {
                    $flag= 0;
                    break;
                }
            }
        }
     }
	if($flag==1)
	{
	
		$boy=mysql_query($qry,$connection);
		if(($abc=mysql_fetch_array($boy)) == NULL)
		{
		
 		$apple=mysql_query("INSERT INTO data VALUES ('','".$insu."','0')",$connection) or die(mysql_error());
                echo "<br>==>".$insu;
		}
	}
}

$i=$i+1;
fclose($fp1);
fclose($fp2);
}

mysql_close ($connection);




?>
<body>
</body>
</html>
