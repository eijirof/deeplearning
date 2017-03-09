<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<title>PHPテスト</title>
</head>
<body>

<h1>PHPのテストです</h1>

<p>
今日の日付は
<?php
echo date('Y年m月d日');
?>
です。
</p>

<?php
  $f = fopen("count.txt", "r+");
  $c = fgets($f, 10);
  $c = $c + 1;
  fseek($f, 0);
  fputs($f, $c);
  fclose($f);
?>

<p>あなたは 
<?php
  echo $c;
?>
 人目のお客様です。</p>

<form action="index.php" method="post">
  <table border="1">
    <tr>
      <td>Artist</td>
      <td><input type="text" name="name"></td>
      <td colspan="2" align="center">
        <input type="submit" value="Search">
      </td>
    </tr>
  </table>
</form>

<?php
//  $m = new Memcached();
//  $m->addServer('localhost', 22133);

// hogeというキューに現在の時間を投げる
  

  $name = $_POST['name'];
  print ("次のデータを受け取りました<br />");
  print ("Artist:$name<br/>");
//  $url = "http://ax.itunes.apple.com/WebObjects/MZStoreServices.woa/wa/wsSearch?term=$name&country=us&media=music&entity=musicTrack";
//  $json = file_get_contents("$url");
//  $data = json_decode($json); //オブジェクトを返す
//  echo $json;
//  foreach ($data->results as $t) {
//  $m->set('message', "$t->trackId");
//  shell_exec("wget $t->previewUrl -P /var/www/html/download -nc");
//  print $t->artistName;
//  print "<a href=\"";
//iTunesの音声ファイルurl
//  print $t->previewUrl;
//  print "\">";
//  print $t->trackName;
  
//  print "</a>";
//  print "<br>";
//}
?>

<?php 
require_once("twitteroauth/twitteroauth.php");
include "twitteroauth/eijirof.php";
 
$twObj = new TwitterOAuth($consumerKey,$consumerSecret,$accessToken,$accessTokenSecret);
$andkey = "$name";
$options = array('q'=>$andkey,'count'=>'30');
 
$json = $twObj->OAuthRequest(
    'https://api.twitter.com/1.1/search/tweets.json',
    'GET',
    $options
);
 
$jset = json_decode($json, true);
foreach ($jset['statuses'] as $result){
    $name = $result['user']['name'];
    $link = $result['user']['profile_image_url'];
    $content = $result['text'];
    $updated = $result['created_at'];
    $time = $time = date("Y-m-d H:i:s",strtotime($updated));
 
    echo "<img src='".$link."''>"." | ".$name." | ".$content." | ".$time;
    echo '<br>';
}
?>
