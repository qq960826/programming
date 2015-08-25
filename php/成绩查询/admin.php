<?php
header("Content-type: text/html; charset=gb2312"); 

@$link_ID = mysql_pconnect("127.0.0.1","root","ypw+wzq+123");
//$link_ID = mysql_pconnect('174.139.147.154','sq_qq960826','960826wang');
if(mysql_select_db("fenshu",$link_ID)){
	//echo "连接成功";
}else{
	echo "连接失败";
}

echo "<title>admin</title>";



//登录验证
$cookies_get=$_COOKIE['cookies'];
$password_submit=$_POST['password'];
$password_system="94296084wang";
//echo $cookies_get;

$sql="select * FROM cookies where cookies='".$cookies_get."'";
$Query_ID = mysql_query($sql,$link_ID);
$Record = mysql_fetch_assoc($Query_ID);


if ($password_submit=="" and $Record['password']!=$password_system and $Record['password']=="")
{
	$content= file_get_contents("admin_login.htm");
	echo $content;
	exit;

}
if ($password_submit!=$password_system and $password_submit!="") {
	echo "密码错误";
	include("admin_refresh.htm");
	exit;
}else{	
	
	if ($Record['password']=="") {
		$sql = "delete  from cookies";
		$Query_ID = mysql_query($sql,$link_ID);
		$Record = mysql_fetch_assoc($Query_ID);
		
		
	$time=microtime(true);
	$cookies=md5("".$password_submit."wkjhkzqxfgfdghnxfdh.00w56".$time."");
	$sql="insert into cookies set `password`='".$password_submit."',`cookies`='".$cookies."'";
	setcookie("cookies",$cookies,time()+3600);
	$Query_ID = mysql_query($sql,$link_ID);
	}
	
}
//登录验证

//修改

if ($_GET['method']=="edit" and $_POST['password_user']=="") {
	$password_user=$_GET['user'];
	$sql = "SELECT * FROM admin where password='".$password_user."'";
	$Query_ID = mysql_query($sql,$link_ID);
	$Record = mysql_fetch_assoc($Query_ID);
	$cishu=$Record['cishu'];
		include("admin_edit.htm");
		exit();
}
if ($_GET['method']=="edit" and $_POST['password_user']!="") {
	$password_user=$_GET['user'];
	$sql = "SELECT * FROM admin where password='".$password_user."'";
	$Query_ID = mysql_query($sql,$link_ID);
	$Record = mysql_fetch_assoc($Query_ID);
	$cishu=$Record['cishu'];
		$sql = "update admin set `cishu`=".$_POST['cishu'].",`password`='".$_POST['password_user']."' where password='".$password_user."'";
	$Query_ID = mysql_query($sql,$link_ID);
	$Record = mysql_fetch_assoc($Query_ID);
	include("admin_refresh.htm");
	echo "操作成功";
	exit;
}


if ($_GET['method']=="delete") {
	$password_user=$_GET['user'];


	$sql = "delete from admin where `password`='".$password_user."'";

	$Query_ID = mysql_query($sql,$link_ID);
	$Record = mysql_fetch_assoc($Query_ID);
	include("admin_refresh.htm");
	echo "操作成功";
	exit;
}



if ($_GET['method']=="add" and $_POST['password_user']=="") {
	include("admin_add.htm");
	exit;
}

if ($_GET['method']=="add" and $_POST['password_user']!="") {



	$sql = "insert into admin set `password`='".$_POST['password_user']."',`cishu`='".$_POST['cishu']."'";

	$Query_ID = mysql_query($sql,$link_ID);
	$Record = mysql_fetch_assoc($Query_ID);
	include("admin_refresh.htm");
	echo "操作成功";
	exit;
}




if ($_GET['method']=="exit") {

	$sql = "delete  from cookies";
	$Query_ID = mysql_query($sql,$link_ID);
	$Record = mysql_fetch_assoc($Query_ID);
	include("admin_refresh.htm");
	echo "注销成功";
	exit;
}







$sql = "SELECT * FROM admin";
$Query_ID = mysql_query($sql,$link_ID);
echo "<table border=1><tr><th>密码<th>次数<th>管理";
while($Record = mysql_fetch_assoc($Query_ID))
{
	echo "<tr><td>$Record[password]<td>$Record[cishu]<td>";
	include("admin_url.htm");

}
echo "</table>";
		include ("admin_url2.htm");

?>