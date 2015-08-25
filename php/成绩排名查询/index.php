
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
	$name=addslashes($_POST['name']);
	$class=addslashes($_POST['class']);
	$grade=addslashes($_POST['grade']);
$method=addslashes($_GET['method']);
//MYSQL连接

$link_ID = mysql_pconnect('localhost','root','password');
if(mysql_select_db('fenshu',$link_ID)){
	//echo "OK";
}else{
	echo "连接失败";
                  exit;
}
//MYSQL连接
mysql_query("SET NAMES UTF8");


	if($name=="" or $class=="" or $grade==""){
		include ("fenshuhtm.htm");
		echo "</table> <font color=#FF0000> Designed BY WZQ</font>";
		exit;
	}




if($name=="王梓樯" and $method != "admin"){
echo "the information of author can't be printed";
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
	


		echo "<table border=1><tr><th>班级<th>姓名<th>语文<th>数学<th>英语<th>物理<th>化学<th>生物<th>政治<th>历史<th>地理<th>理科综合<th>文科综合<th>考试编号";
$i=3;
$i_max=7;
		while($i <= $i_max)
		{


$sql="SELECT a.name,a.class,a.rank_chinese,b.rank_math,c.rank_english,d.rank_physics,e.rank_chemistry,f.rank_biology,g.rank_zhengzhi,h.rank_history,i.rank_geograophy,j.rank_lizong,k.rank_wenzong FROM 
(SELECT name,class, chinese , (@rowNum1 := @rowNum1 +1) AS rank_chinese FROM ".$biao.", (SELECT (@rowNum1 :=0))e WHERE number = '".$i."' ORDER BY chinese DESC )a
,
(SELECT name,class, english , (@rowNum2 := @rowNum2 +1) AS rank_english FROM ".$biao.", (SELECT (@rowNum2 :=0))e WHERE number = '".$i."' ORDER BY english DESC )c
,
(SELECT name,class, math , (@rowNum3 := @rowNum3 +1) AS rank_math FROM ".$biao.", (SELECT (@rowNum3 :=0))e WHERE number = '".$i."' ORDER BY math DESC )b
,
(SELECT name,class, physics , (@rowNum4 := @rowNum4 +1) AS rank_physics FROM ".$biao.", (SELECT (@rowNum4 :=0))e WHERE number = '".$i."' ORDER BY physics DESC )d
,
(SELECT name,class, chemistry , (@rowNum5 := @rowNum5 +1) AS rank_chemistry FROM ".$biao.", (SELECT (@rowNum5 :=0))e WHERE number = '".$i."' ORDER BY chemistry DESC )e
,
(SELECT name,class, biology , (@rowNum6 := @rowNum6 +1) AS rank_biology FROM ".$biao.", (SELECT (@rowNum6 :=0))e WHERE number = '".$i."' ORDER BY biology DESC )f
,
(SELECT name,class, zhengzhi , (@rowNum7 := @rowNum7 +1) AS rank_zhengzhi FROM ".$biao.", (SELECT (@rowNum7 :=0))e WHERE number = '".$i."' ORDER BY zhengzhi DESC )g
,
(SELECT name,class, history , (@rowNum8 := @rowNum8 +1) AS rank_history FROM ".$biao.", (SELECT (@rowNum8 :=0))e WHERE number = '".$i."' ORDER BY history DESC )h
,
(SELECT name,class, geograophy , (@rowNum9 := @rowNum9 +1) AS rank_geograophy FROM ".$biao.", (SELECT (@rowNum9 :=0))e WHERE number = '".$i."' ORDER BY geograophy DESC )i
,
(SELECT name,class, physics+chemistry+biology , (@rowNum10 := @rowNum10 +1) AS rank_lizong FROM ".$biao." , (SELECT (@rowNum10 :=0))b WHERE number = '".$i."' ORDER BY physics+chemistry+biology DESC )j
,
(SELECT name,class, zhengzhi+history+geograophy , (@rowNum11 := @rowNum11 +1) AS rank_wenzong FROM ".$biao." , (SELECT (@rowNum11 :=0))b WHERE number = '".$i."' ORDER BY zhengzhi+history+geograophy DESC )k  
 WHERE a.name = '".$name."' and b.name='".$name."' and c.name='".$name."' and d.name='".$name."' and e.name='".$name."' and f.name='".$name."' and g.name='".$name."' and h.name='".$name."' and i.name='".$name."' and j.name='".$name."' and k.name='".$name."' and a.class = '".$class."' and b.class='".$class."' and c.class='".$class."' and d.class='".$class."' and e.class='".$class."' and f.class='".$class."' and g.class='".$class."' and h.class='".$class."' and i.class='".$class."' and j.class='".$class."' and k.class='".$class."';";




//echo $sql;
$Query_ID = mysql_query($sql,$link_ID);
$Record = mysql_fetch_assoc($Query_ID);

	 
$count=count($Record);

if($count!=1){
echo "<tr><td>$Record[class]<td>$Record[name]<td>$Record[rank_chinese]<td>$Record[rank_math]<td>$Record[rank_english]<td>$Record[rank_physics]<td>$Record[rank_chemistry]<td>$Record[rank_biology]<td>$Record[rank_zhengzhi]<td>$Record[rank_history]<td>$Record[rank_geograophy]<td>$Record[rank_lizong]<td>$Record[rank_wenzong]<td>$i";
}

			
$i=$i+1;
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

	
	//$sql = "SELECT * FROM ".$biao." WHERE name='".$name."' and class='".$class."'";
	$Query_ID = mysql_query($sql,$link_ID);
	
	
	if($class<241){
	
	
	
	
	
echo "<table border=1><tr><th>班级<th>姓名<th>语文<th>数学<th>英语<th>物理<th>化学<th>生物<th>理科综合<th>考试编号";
$i=1;

if($grade==2){
$i_max=7;
}
if($grade==3){
$i_max=7;
}


		while($i <= $i_max)
		{


$sql="SELECT a.name,a.class,b.rank_chinese,d.rank_math,c.rank_english,e.rank_physics,f.rank_chemistry,g.rank_biology,a.rank_lizong FROM 
(SELECT name,class, physics+chemistry+biology , (@rowNum := @rowNum +1) AS rank_lizong FROM ".$biao." , (SELECT (@rowNum :=0))b WHERE number = '".$i."' AND class <=240 ORDER BY physics+chemistry+biology DESC )a 
,
(SELECT name,class, chinese , (@rowNum1 := @rowNum1 +1) AS rank_chinese FROM ".$biao.", (SELECT (@rowNum1 :=0))e WHERE number = '".$i."' AND class <=240 ORDER BY chinese DESC )b
,
(SELECT name,class, english , (@rowNum2 := @rowNum2 +1) AS rank_english FROM ".$biao.", (SELECT (@rowNum2 :=0))e WHERE number = '".$i."' AND class <=240 ORDER BY english DESC )c
,
(SELECT name,class, math , (@rowNum3 := @rowNum3 +1) AS rank_math FROM ".$biao.", (SELECT (@rowNum3 :=0))e WHERE number = '".$i."' AND class <=240 ORDER BY math DESC )d
,
(SELECT name,class, physics , (@rowNum4 := @rowNum4 +1) AS rank_physics FROM ".$biao.", (SELECT (@rowNum4 :=0))e WHERE number = '".$i."' AND class <=240 ORDER BY physics DESC )e
,
(SELECT name,class, chemistry , (@rowNum5 := @rowNum5 +1) AS rank_chemistry FROM ".$biao.", (SELECT (@rowNum5 :=0))e WHERE number = '".$i."' AND class <=240 ORDER BY chemistry DESC )f
,
(SELECT name,class, biology , (@rowNum6 := @rowNum6 +1) AS rank_biology FROM ".$biao.", (SELECT (@rowNum6 :=0))e WHERE number = '".$i."' AND class <=240 ORDER BY biology DESC )g
 WHERE a.name = '".$name."' and b.name='".$name."' and c.name='".$name."' and d.name='".$name."' and e.name='".$name."' and f.name='".$name."' and g.name='".$name."' and a.class = '".$class."' and b.class='".$class."' and c.class='".$class."' and d.class='".$class."' and e.class='".$class."' and f.class='".$class."' and g.class='".$class."';";
//echo $sql;
$Query_ID = mysql_query($sql,$link_ID);
$Record = mysql_fetch_assoc($Query_ID);
$count=count($Record);

if($count!=1){
echo "<tr><td>$Record[class]<td>$Record[name]<td>$Record[rank_chinese]<td>$Record[rank_math]<td>$Record[rank_english]<td>$Record[rank_physics]<td>$Record[rank_chemistry]<td>$Record[rank_biology]<td>$Record[rank_lizong]<td>$i";

}

$i=$i+1;








		 
			
	}
	





	}
	
	else{
	echo "<table border=1><tr><th>班级<th>姓名<th>语文<th>数学<th>英语<th>政治<th>历史<th>地理<th>文科综合<th>考试编号";
$i=1;

if($grade==2){
$i_max=7;
}
if($grade==3){
$i_max=7;
}


		while($i <= $i_max)
		{


$sql="SELECT a.name,a.class,b.rank_chinese,d.rank_math,c.rank_english,e.rank_zhengzhi,f.rank_history,g.rank_geograophy,a.rank_wenzong FROM 
(SELECT name,class, zhengzhi+history+geograophy , (@rowNum := @rowNum +1) AS rank_wenzong FROM ".$biao." , (SELECT (@rowNum :=0))b WHERE number = '".$i."' AND class >240 ORDER BY zhengzhi+history+geograophy DESC )a 
,
(SELECT name,class, chinese , (@rowNum1 := @rowNum1 +1) AS rank_chinese FROM ".$biao.", (SELECT (@rowNum1 :=0))e WHERE number = '".$i."' AND class >240 ORDER BY chinese DESC )b
,
(SELECT name,class, english , (@rowNum2 := @rowNum2 +1) AS rank_english FROM ".$biao.", (SELECT (@rowNum2 :=0))e WHERE number = '".$i."' AND class >240 ORDER BY english DESC )c
,
(SELECT name,class, math , (@rowNum3 := @rowNum3 +1) AS rank_math FROM ".$biao.", (SELECT (@rowNum3 :=0))e WHERE number = '".$i."' AND class >240 ORDER BY math DESC )d
,
(SELECT name,class, zhengzhi , (@rowNum4 := @rowNum4 +1) AS rank_zhengzhi FROM ".$biao.", (SELECT (@rowNum4 :=0))e WHERE number = '".$i."' AND class >240 ORDER BY zhengzhi DESC )e
,
(SELECT name,class, history , (@rowNum5 := @rowNum5 +1) AS rank_history FROM ".$biao.", (SELECT (@rowNum5 :=0))e WHERE number = '".$i."' AND class >240 ORDER BY history DESC )f
,
(SELECT name,class, geograophy , (@rowNum6 := @rowNum6 +1) AS rank_geograophy FROM ".$biao.", (SELECT (@rowNum6 :=0))e WHERE number = '".$i."' AND class >240 ORDER BY geograophy DESC )g
 WHERE a.name = '".$name."' and b.name='".$name."' and c.name='".$name."' and d.name='".$name."' and e.name='".$name."' and f.name='".$name."' and g.name='".$name."' and a.class = '".$class."' and b.class='".$class."' and c.class='".$class."' and d.class='".$class."' and e.class='".$class."' and f.class='".$class."' and g.class='".$class."';";
//echo $sql;
$Query_ID = mysql_query($sql,$link_ID);
$Record = mysql_fetch_assoc($Query_ID);

$count=count($Record);


//echo $count;

if($count!=1){
echo "<tr><td>$Record[class]<td>$Record[name]<td>$Record[rank_chinese]<td>$Record[rank_math]<td>$Record[rank_english]<td>$Record[rank_zhengzhi]<td>$Record[rank_history]<td>$Record[rank_geograophy]<td>$Record[rank_wenzong]<td>$i";

}
$i=$i+1;


	}
	
	
	}
	}
	

	
	
	//高二高三
	echo "</table>";


		echo "<title>各科排名查询</title>";

	echo "<font color=#FF0000> <h1>Designed BY WZQ</h1></font>";
echo "注意:此处查询的是单科排名，不是分数";
if(method=="admin"){
$Query_ID = mysql_query($sql,$link_ID);
exit;
}
$sql="insert into record_pm(name,time,ip)values('".$name."','".date("Y-m-d H:i:s", time())  ."','".$_SERVER["REMOTE_ADDR"]."') ";
$Query_ID = mysql_query($sql,$link_ID);

?>