<?php 
	header("Content-Type:text/html; Charset=UTF-8");
	$database = $_GET['database'];
	$table_name = $_GET['table_name'];
	$link = @ mysql_connect("localhost","root","xg") or die(mysql_error());
	mysql_set_charset('utf8');

	mysql_select_db($database);

	function show_query($sql)
	{
		$result = mysql_query($sql);
		$result or die("查询失败");

		// $num_rows = mysql_num_rows($result);
		$num_cols = mysql_num_fields($result);

		echo "<table border='1px' rules='all'>";
		// echo "<table>";
		//表头
		echo "<tr>";
		for ($j=0; $j < $num_cols; $j++) { 
			$field_name = mysql_field_name($result,$j);
			echo "<th>{$field_name}</th>";
		}
		echo "</tr>";
		//表中
		while($result_array = mysql_fetch_array($result)) { 
			echo "<tr>";
			for ($j=0; $j < $num_cols; $j++) { 
				$field_name = mysql_field_name($result,$j);
				echo "<td>{$result_array[$field_name]}</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	}
		
	// $sql = "insert into table1 values($i,1.2,'中国','2015-1-17')";	//插入数据
	// $sql = "show databases";	//显示数据库信息
	// $sql = "show tables";	//显示表信息
	$sql = "desc $table_name"; 	//显示表结构
	// $sql = "select * from table1";	//查询数据
	show_query($sql);
 ?>