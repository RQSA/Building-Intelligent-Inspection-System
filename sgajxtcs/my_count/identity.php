<?php
	require ("../conn.php");
	$mobile = $_POST["mobile"];
	$fgs ="";
	$sqldate="";
	$zgs = '总公司';
	
	$mysql = " SELECT 时间戳,所属公司 from `我的工程` where 时间戳 in(SELECT 工程时间戳 FROM `工程管理人员` WHERE 部门='分公司' AND 联系方式 = '".$mobile."' ) OR (部门负责人A手机 = '".$mobile."' OR 部门负责人B手机 = '".$mobile."' OR 部门负责人C手机 = '".$mobile."') ORDER  BY  时间戳 DESC LIMIT 1";
	$mysql1 = " SELECT 时间戳,所属公司 from `我的工程` where 时间戳 in(SELECT 工程时间戳 FROM `工程管理人员` WHERE 部门='总公司' AND 联系方式 = '".$mobile."' ) OR (总公司负责人A手机 = '".$mobile."' OR 总公司负责人B手机 = '".$mobile."' OR 总公司负责人C手机 = '".$mobile."'OR 总部巡查员手机 = '".$mobile."') ";
	$res = $conn->query($mysql);
	$res1 = $conn->query($mysql1);
	$count = mysqli_num_rows($res1);
	if($res->num_rows>0){
		while($myrow =$res->fetch_assoc()){
			$fgs = $myrow["所属公司"];
		}
	}
	if($count!=0){
		$ret_data[] = '总公司'.'|'.$zgs;
	}else if($count==0&&$fgs!=null){
		$ret_data[] = '分公司'.'|'.$fgs;
						
	}else if($count ==0&&$fgs==null){
		$mysql2 = "SELECT 时间戳,工程名称 from `我的工程` where 时间戳 in(SELECT 工程时间戳 FROM `工程管理人员` WHERE 部门='项目部' AND 联系方式='".$mobile."' ) OR (项目经理手机='".$mobile."' OR 安全主管手机='".$mobile."' OR `安全员手机`='".$mobile."'OR 生产经理手机='".$mobile."' OR 机械管理员手机='".$mobile."'OR 质量员手机='".$mobile."'OR 质量负责人手机='".$mobile."' ) ORDER  BY  时间戳 DESC";
		$res2 = $conn->query($mysql2);
		if($res2->num_rows>0){
		while($row1 =$res2->fetch_assoc()){
			$ret_data[] = '项目部'.'|'.$row1["工程名称"];
		}
	}
//		$ret_data[] = '项目部'.'|'.$xmb;
	}
	
	$sql = "select 部门 from 公司部门 ";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()) {
//				$sqldate= $sqldate.'{"部门":"'. $row["部门"].'",}';
//				$ret_data[] = $row['部门'];
			} 
	
	
//	$json = '['.$otherdate.",".$sqldate.']';
	$json = json_encode($ret_data);
	echo $json;
	$conn->close();
?>