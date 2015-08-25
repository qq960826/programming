
<?php
//echo "查询功能已关闭";
//exit;
error_reporting(0);
header("Content-type: text/html; charset=utf8"); 
	include("css.htm");
//访问方式判断
//$type=$_GET['type'];
//if($type != "admin"){
//$content = file_get_contents("404.htm");
//echo $content;
//exit;
//}
//访问方式判断


//MYSQL连接

//$link_ID = mysql_pconnect('174.139.147.154','root','960826wang');
$link_ID = mysql_pconnect('localhost','root','ypw+wzq+123');
if(mysql_select_db('fenshu',$link_ID)){
	//echo "OK";
}else{
	echo "连接失败";
                  exit;
}
//MYSQL连接



mysql_query("SET NAMES UTF8");



//登录验证
$cookies_get=$_COOKIE['user_cookies'];
$password_submit=$_POST['password'];


$sql="select * FROM admin where password='".$password_submit."'";
$Query_ID = mysql_query($sql,$link_ID);
$Record = mysql_fetch_assoc($Query_ID);



$password_user=$Record['password'];

$sql="select * FROM user_cookies where cookies='".$cookies_get."'";

$Query_ID = mysql_query($sql,$link_ID);
$Record = mysql_fetch_assoc($Query_ID);





$password_user_cookies= $Record['password'];


if ($password_submit=="" and $password_user_cookies=="")
{

	include("index_login.htm");
	
	


	exit;


}
if ($password_submit!=$password_user and $password_submit!="") {

	echo $Record['password'];
	
	
	echo "密码错误";
	include("index_refresh.htm");
	exit;
}else{

	if ($Record['password']=="") {
		$sql = "delete from user_cookies where `password`='".$password_submit."'";
		$Query_ID = mysql_query($sql,$link_ID);
		$Record = mysql_fetch_assoc($Query_ID);


		$time=microtime(true);
		$cookies=md5("".$password_submit."44wkjhkz45qxfgfdg04hnxfdh.00w56".$time."");
		$sql="insert into user_cookies set `password`='".$password_user."',`cookies`='".$cookies."'";

		setcookie("user_cookies",$cookies,time()+3600);
		$Query_ID = mysql_query($sql,$link_ID);
	include("fenshuhtm.htm");
	exit();
	}

}
//登录验证


$sql="select * FROM admin where password='".$password_user_cookies."'";

$Query_ID = mysql_query($sql,$link_ID);
$Record = mysql_fetch_assoc($Query_ID);


if ($password_user_cookies==$Record['password']) {
	$user_cishu=$Record['cishu'];
	$name=addslashes($_POST['name']);
	$class=addslashes($_POST['class']);
	$grade=addslashes($_POST['grade']);
	if ($user_cishu<1) {
		echo "使用次数以到";
		setcookie("user_cookies","",time()+3600);
		include("client_refresh.htm");
		
		exit;
	}
	if($name=="" or $class=="" or $grade==""){
		include ("fenshuhtm.htm");
		echo "</table> <font color=#FF0000> Designed BY WZQ</font>";
		exit;
	}
	
	
	
	//高一查询
	if($grade==1){
	
		$biao="gaoyi";
		$sql = "SELECT * FROM ".$biao." WHERE name='".$name."' and class='".$class."' ORDER BY number";
		$Query_ID = mysql_query($sql,$link_ID);
		$Record=mysql_fetch_assoc($Query_ID);
	
		if ($Record=="") {
			echo "你所查询的不存在";
			include("client_refresh.htm");
			exit;
		}
	
		$sql = "SELECT * FROM ".$biao." WHERE name='".$name."' and class='".$class."'";
		$Query_ID = mysql_query($sql,$link_ID);
		echo "<table border=1><tr><th>班级<th>姓名<th>语文<th>数学<th>英语<th>政治<th>历史<th>地理<th>物理<th>化学<th>生物<th>总分排名<th>理科排名<th>文科排名<th>考试编号";
		while($Record = mysql_fetch_assoc($Query_ID))
		{
			echo "<tr><td>$Record[class]<td>$Record[name]<td>$Record[chinese]<td>$Record[math]<td>$Record[english]<td>$Record[zhengzhi]<td>$Record[history]<td>$Record[geograophy]<td>$Record[physics]<td>$Record[chemistry]<td>$Record[biology]<td>$Record[qkpm]<td>$Record[lkpm]<td>$Record[wkpm]<td>$Record[number]";
		}
	}
	//高一查询
	
	
	
	
	//高二高三查询
	if($grade==2 or $grade==3){
if($grade==2){
		$biao="gaoer";}ELSE{
$biao="gaosan";}
		$sql = "SELECT * FROM ".$biao." WHERE name='".$name."' and class='".$class."' ORDER BY number";
		$Query_ID = mysql_query($sql,$link_ID);
		$Record=mysql_fetch_assoc($Query_ID);
		if ($Record=="") {
		echo "你所查询的不存在";
		include("client_refresh.htm");
		exit;
	}

	
	$sql = "SELECT * FROM ".$biao." WHERE name='".$name."' and class='".$class."'";
	$Query_ID = mysql_query($sql,$link_ID);
	
	
	if($class<241){
	
	
	
	
	
echo "<table border=1><tr><th>班级<th>姓名<th>语文<th>数学<th>英语<th>物理<th>化学<th>生物<th>总分<th>年级排名<th>班级排名<th>考试编号";
		while($Record = mysql_fetch_assoc($Query_ID))
		{
	
	
			 
			echo "<tr><td>$Record[class]<td>$Record[name]<td>$Record[chinese]<td>$Record[math]<td>$Record[english]<td>$Record[physics]<td>$Record[chemistry]<td>$Record[biology]<td>$Record[zongfen]<td>$Record[njpm]<td>$Record[bjpm]<td>$Record[number]";
	}
	
	}
	
	else{
	echo "<table border=1><tr><th>班级<th>姓名<th>语文<th>数学<th>英语<th>政治<th>历史<th>地理<th>总分<th>年级排名<th>班级排名<th>考试编号";
	while($Record = mysql_fetch_assoc($Query_ID))
	{
	echo "<tr><td>$Record[class]<td>$Record[name]<td>$Record[chinese]<td>$Record[math]<td>$Record[english]<td>$Record[zhengzhi]<td>$Record[history]<td>$Record[geograophy]<td>$Record[zongfen]<td>$Record[njpm]<td>$Record[bjpm]<td>$Record[number]";
	}
	
	
	}
	}
	
	
	
	
	//高二高三
	echo "</table>";
	
	
	$user_cishu=$user_cishu-1;
	echo "<title>成绩查询</title>";
	
	
	echo "剩余查询次数".$user_cishu."";
	echo "<font color=#FF0000> <h1>Designed BY WZQ</h1></font>";
	
	$sql = "update admin set `cishu`=".$user_cishu." where password='".$password_user_cookies."'";
	$Query_ID = mysql_query($sql,$link_ID);
	mysql_close($link_ID);
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}

















?>