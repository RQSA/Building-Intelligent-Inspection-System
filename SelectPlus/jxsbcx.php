﻿<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/favicon.ico">
    <title>韶关一建企业有限公司项目质量安全检查管理系统</title> 
    
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-theme.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/docs.css"/>
    <!-- Custom styles for this template -->
    <link href="../css/theme.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="all" href="../css/daterangepicker-bs3.css"/>
    <!-- Custom styles for bootstrap-table -->
    <link href="../css/bootstrap-table.min.css" rel="stylesheet">
    <link href="../css/mycss.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  
  </head>

  <body>
  	<!-- 头部导航条 -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?php
	   						require("../conn.php");
								$yhid=$_GET["yhid"];
	   						$sql = "select * from 用户信息   where id='$yhid'";
	   						$result = $conn->query($sql);
	   						while($row = $result->fetch_assoc()) {
   					?>
          <a class="navbar-brand" href="../index.php?yhzh=<?php echo $row["账号"];?>">韶关一建</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="../index.php?yhzh=<?php echo $row["账号"];?>">项目管理</a></li>
            <li class="active"><a href="seclect.php?yhid=<?php echo $row["id"];?>">综合查询</a></li>
            <li><a href="../system.php?yhid=<?php echo $row["id"];?>">系统管理</a></li>
            <?php
								}
								$conn->close();		
						 ?>
          </ul>
        </div>
      </div>
    </nav>
    <div id="container" class="container">
    	<div class="row">
    		<!--左侧导航菜单 -->
    		<div class="col-md-2">
    			<div class="bs-docs-sidebar affix" role="complementary">
    				<ul class="nav bs-docs-sidenav">
    					<li ><a href="wxycx.php?yhid=<?php echo $yhid=$_GET["yhid"]; ?>">危险源查询</a></li>    					
    					<li class="active"><a href="jxsbcx.php?yhid=<?php echo $yhid=$_GET["yhid"]; ?>">机械设备查询</a></li>    					
    					<li><a href="../seclect.php?yhid=<?php echo $yhid=$_GET["yhid"]; ?>">巡查整改查询</a>
    							<ul class="nav">
    						<li  ><a href="../seclect.php?yhid=<?php echo $yhid=$_GET["yhid"]; ?>">巡查整改查询</a></li>
    						<li  ><a href="../wzdlcx.php?yhid=<?php echo $yhid=$_GET["yhid"]; ?>">违章大类查询</a></li>
    						
    					</ul>
    					</li>
    				</ul>
    			</div>    			
    		</div><!--左侧导航菜单 -->
    		
    			<!-- 内容区域 -->
    		<div class="col-md-10">
			  <div id="xmdj" class="panel panel-info">
				<div class="panel-heading">
				<h3 class="panel-title">机械设备查询</h3>
				</div>

				<div class="panel-body">
    			<div>
    			 <?php 
			         		$date=date("Y-m-d");
			         		$time=strtotime($date);
								  $firstday=date('m-01-Y',strtotime(date('Y',$time).'-'.(date('m',$time)-1).'-01'));
//												echo $firstday;
									$arr = getdate();
								  if($arr['mon'] == 12){
								   $year = $arr['year'] +1;
								   $month = $arr['mon'] -11;
								   $day = $arr['mday'];
								   if($day < 10){
								    $mday = '0'.$day;
								   }else {
								    $mday = $day;
								   }
								   $firstday1 = $year.'-0'.$month.'-01';
								  
								  }else{
								   $time=strtotime($date);
								   $firstday1=date('m-01-Y',strtotime(date('Y',$time).'-'.(date('m',$time)+1).'-01'));
								  }
//											   echo $firstday1;
								 
         	?> 
							  <div class="well">
							  	 
               <form class="form-horizontal" method="post">
                 <fieldset>
                  <div class="control-group">
                  	<div>
						<input id="button" type="button" class="btn col-sm-offset-0 btn btn-primary" value="点击打印" onclick="preview()">
						</div>
                    <label class="control-label" for="reservationtime">检查日期选择</label>
                    <div class="controls"><!--startprint-->
                     <div class="input-prepend input-group">
                       <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                       <input type="text" style="width: 400px" name="reservation" id="reservationtime" class="form-control" value="<?php echo $firstday;  ?> 1:00 PM - <?php echo $firstday1;  ?> 1:30 PM"  class="span4"/>
                       <input type="text" style="width: 200px" id="liu" name="liu" class="form-control hidden" value="2016-08-12" >
                       <input type="text" style="width: 200px" id="endtime" name="endtime" class="form-control hidden" value="2017-08-12"/>
                       <input type="submit" class="btn col-sm-offset-1" value="查询">
                       	   <fieldset style="padding:7px;">



省 市 区选择：<select name="province6"></select><select name="city6"></select>


</fieldset>
                     </div>
                     <!--<div class="btn-group "  ">
									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
										项目选择
										<span class="caret"></span>
									</button>
									<ul class="dropdown-menu">
										<li><a href="wxycxfx.php">危险源</a></li>
										<li><a href="cxfx.php">隐患通知单</a></li>
										
									</ul>
							  </div>-->
                    </div>
                  </div>
                 </fieldset>
                
                 <?php
							require("../conn.php");
							error_reporting(E_ALL ^ E_NOTICE);
							$sql = "select * from 设备管理";
							$province6 =$_POST['province6'];
							$city6 =$_POST['city6'];
							$liu =$_POST['liu'];
							$endtime =$_POST['endtime'];	
							$Query = "Select count(*) as AllNum from 设备管理   where 设备类型='物料提升机' and 地区省='$province6' and 地区市='$city6' and  登记日期 between '$liu'and '$endtime'"; 
///							echo $Query;
							$a     = mysqli_query( $conn, $Query ); 
							$b     = mysqli_fetch_assoc( $a ); 
//							echo $b['AllNum']; //条数  	
							$Query1 = "Select count(*) as AllNum1 from 设备管理 where 设备类型='塔吊' and 地区省='$province6' and 地区市='$city6' and 登记日期 between '$liu'and '$endtime'"; 
							$a1     = mysqli_query( $conn, $Query1 ); 
							$b1     = mysqli_fetch_assoc( $a1 );
							$Query2 = "Select count(*) as AllNum2 from 设备管理 where 设备类型='施工升降机'  and 地区省='$province6' and 地区市='$city6' and 登记日期 between '$liu'and '$endtime'"; 
							$a2     = mysqli_query( $conn, $Query2 ); 
							$b2     = mysqli_fetch_assoc( $a2 );
							$Query3 = "Select count(*) as AllNum3 from 设备管理 where 设备类型='架桥机' and 地区省='$province6' and 地区市='$city6' and 登记日期 between '$liu'and '$endtime'"; 
							$a3     = mysqli_query( $conn, $Query3 ); 
							$b3     = mysqli_fetch_assoc( $a3 );
							$Query4 = "Select count(*) as AllNum4 from 设备管理 where 设备类型='桥（门）式起重机' and 地区省='$province6' and 地区市='$city6' and 登记日期 between '$liu'and '$endtime'"; 
							$a4     = mysqli_query( $conn, $Query4 ); 
							$b4     = mysqli_fetch_assoc( $a4 );
							$Query5 = "Select count(*) as AllNum5 from 设备管理 where 设备类型='起重吊装' and 地区省='$province6' and 地区市='$city6' and 登记日期 between '$liu'and '$endtime'"; 
							$a5     = mysqli_query( $conn, $Query5 ); 
							$b5     = mysqli_fetch_assoc( $a5 );
							$Query6 = "Select count(*) as AllNum6 from 设备管理 where 设备类型='施工机具' and 地区省='$province6' and 地区市='$city6' and 登记日期 between '$liu'and '$endtime'"; 
							$a6     = mysqli_query( $conn, $Query6 ); 
							$b6     = mysqli_fetch_assoc( $a6 );
							$Query7 = "Select count(*) as AllNum7 from 设备管理 where 设备类型='吊篮' and 地区省='$province6' and 地区市='$city6' and 登记日期 between '$liu'and '$endtime'"; 
							$a7     = mysqli_query( $conn, $Query7 ); 
							$b7     = mysqli_fetch_assoc( $a7 );																					
							$result = $conn->query($sql);
							while($row = $result->fetch_assoc()) {
                         					
             ?>
						<?php
							 }
							 $conn->close();
																							
						?>
														
									
                 <div  style="display:inline">
                 
							  </div>
               </form>
            </div> 
    			</div>
    			<div class="row">
    				<div class="col-lg-3">
    				<div style="text-align: center;">明细表</div>
    					
	    			<table class="table  table-bordered">
							<tr class="">
							  <td class="col-xs-4">设备管理登记</td>
							  <td class="col-xs-4">份</td>
							</tr>
							<tr>
							  <td><a href="#" data-toggle="modal" data-target="#myModal">物料提升机</a></td>
							  <td ><?php echo $b['AllNum'];?></td>
							</tr>			
							<tr>
							  <td><a href="#" data-toggle="modal" data-target="#myModal1">塔吊</a></td>
							  <td><?php echo $b1['AllNum1'];?></td>
							</tr>	
							<tr>
							  <td><a href="#" data-toggle="modal" data-target="#myModal2">施工升降机</td></a>
							  <td><?php echo $b2['AllNum2'];?></td>
							</tr>	
							<tr>
							  <td ><a href="#" data-toggle="modal" data-target="#myModal3">架桥机</td></a>
							  <td><?php echo $b3['AllNum3'];?></td>
							  </tr>
							  
							  <tr>
							  <td><a href="#" data-toggle="modal" data-target="#myModal4">桥（门）式起重机</td></a>
							  <td ><?php echo $b4['AllNum4'];?></td>
							</tr>	
							<tr>
							  <td><a href="#" data-toggle="modal" data-target="#myModal5">起重吊装</td></a>
							  <td><?php echo $b5['AllNum5'];?></td>
							</tr>	
							<tr>
							  <td><a href="#" data-toggle="modal" data-target="#myModal6">施工机具</td></a>
							  <td><?php echo $b6['AllNum6'];?></td>
							</tr>
							<tr>
							  <td><a href="#" data-toggle="modal" data-target="#myModal7">吊篮</td></a>
							  <td><?php echo $b7['AllNum7'];?></td>
							</tr>
							
						</table>
						
						
						</div>
						<div id="container1" class="col-lg-8 col-md-offset-8" style="width:650px; height: 400px; margin: 0 auto" ></div>
    				</div>
    				
    				
    				<div>
		    				<!-- 模态框（Modal） -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">
											物料提升机
										</h4>
									</div>
									<div class="modal-body">
										  <table class="table table-bordered">
	
													<thead>
								      <tr>
								      	<th>工程名称</th>
								         <th>起重机械名称</th>
								         <th>设备状态</th>
								         <th>产权备案号</th>
								         <th>使用年限</th>
								         <th>型号</th>
								         <th>生产制造单位</th>
								         <th>登记日期</th>
								         <th>出厂编号</th>
								         <th>最大起重力矩 (kN*m)</th>
								         <th>设计最大起重高度</th>
								         <th>最大起重量(KN)</th>
								         <th>本工理桩高度(m)</th>
								        
								      </tr>
								   </thead>
								   <tbody>
								     				
                   						<?php
                   						require("../conn.php");
															
                   						$sql = "select * from 设备管理   where 设备类型='物料提升机'";
                   						$result = $conn->query($sql);
                   						while($row = $result->fetch_assoc()) {
                        					
                   						?>
                   						<tr class="">
                   						<td><?php echo $row["工程名称"];?></td>
                   						<td><?php echo $row["起重机械名称"];?></td>
                  						<td><?php echo $row["设备状态"];?></td>
							                <td><?php echo $row["产权备案号"];?></td>
							                <td><?php echo $row["使用年限"];?></td>
							                <td><?php echo $row["规格型号"];?></td>
							                <td><?php echo $row["生产制造单位"];?></td>
							                <td><?php echo $row["登记日期"];?></td>
							                <td><?php echo $row["出厂编号"];?></td>
							                <td><?php echo $row["最大起重力矩"];?></td>
							                <td><?php echo $row["设计最大起升高度"];?></td>
							                <td><?php echo $row["最大起重量"];?></td>
							                <td><?php echo $row["本工理桩高度"];?></td>
							               
										         <?php
															}
															$conn->close();		
														?>
								   </tbody>
    					
											</table>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">关闭
										</button>
										
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal -->
							</div>
							
							
							
							<div>	<!-- 模态框（Modal） -->
						<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel1">
											塔吊
										</h4>
									</div>
									<div class="modal-body">
										 <table class="table table-bordered">
	
													<thead>
								      <tr>
								      	<th>工程名称</th>
								         <th>起重机械名称</th>
								         <th>设备状态</th>
								         <th>产权备案号</th>
								         <th>使用年限</th>
								         <th>型号</th>
								         <th>生产制造单位</th>
								         <th>登记日期</th>
								         <th>出厂编号</th>
								         <th>最大起重力矩 (kN*m)</th>
								         <th>设计最大起重高度</th>
								         <th>最大起重量(KN)</th>
								         <th>本工理桩高度(m)</th>
								        
								      </tr>
								   </thead>
								   <tbody>
								     				
                   						<?php
                   						require("../conn.php");
															
                   						$sql = "select * from 设备管理   where 设备类型='塔吊'";
                   						$result = $conn->query($sql);
                   						while($row = $result->fetch_assoc()) {
                        					
                   						?>
                   						<tr class="">
                   							<td><?php echo $row["工程名称"];?></td>
                   						<td><?php echo $row["起重机械名称"];?></td>
                  						<td><?php echo $row["设备状态"];?></td>
							                <td><?php echo $row["产权备案号"];?></td>
							                <td><?php echo $row["使用年限"];?></td>
							                <td><?php echo $row["规格型号"];?></td>
							                <td><?php echo $row["生产制造单位"];?></td>
							                <td><?php echo $row["登记日期"];?></td>
							                <td><?php echo $row["出厂编号"];?></td>
							                <td><?php echo $row["最大起重力矩"];?></td>
							                <td><?php echo $row["设计最大起升高度"];?></td>
							                <td><?php echo $row["最大起重量"];?></td>
							                <td><?php echo $row["本工理桩高度"];?></td>
							               
										         <?php
															}
															$conn->close();		
														?>
								   </tbody>
    					
											</table>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">关闭
										</button>
										
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal -->
							</div>
							
							
							<div>	<!-- 模态框（Modal） -->
						<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel2">
											施工升降机
										</h4>
									</div>
									<div class="modal-body">
										  <table class="table table-bordered">
	
													<thead>
								      <tr>
								      	<th>工程名称</th>
								         <th>起重机械名称</th>
								         <th>设备状态</th>
								         <th>产权备案号</th>
								         <th>使用年限</th>
								         <th>型号</th>
								         <th>生产制造单位</th>
								         <th>登记日期</th>
								         <th>出厂编号</th>
								         <th>最大起重力矩 (kN*m)</th>
								         <th>设计最大起重高度</th>
								         <th>最大起重量(KN)</th>
								         <th>本工理桩高度(m)</th>
								        
								      </tr>
								   </thead>
								   <tbody>
								     				
                   						<?php
                   						require("../conn.php");
															
                   						$sql = "select * from 设备管理   where 设备类型='施工升降机'";
                   						$result = $conn->query($sql);
                   						while($row = $result->fetch_assoc()) {
                        					
                   						?>
                   						<tr class="">
                   							<td><?php echo $row["工程名称"];?></td>
                   						<td><?php echo $row["起重机械名称"];?></td>
                  						<td><?php echo $row["设备状态"];?></td>
							                <td><?php echo $row["产权备案号"];?></td>
							                <td><?php echo $row["使用年限"];?></td>
							                <td><?php echo $row["规格型号"];?></td>
							                <td><?php echo $row["生产制造单位"];?></td>
							                <td><?php echo $row["登记日期"];?></td>
							                <td><?php echo $row["出厂编号"];?></td>
							                <td><?php echo $row["最大起重力矩"];?></td>
							                <td><?php echo $row["设计最大起升高度"];?></td>
							                <td><?php echo $row["最大起重量"];?></td>
							                <td><?php echo $row["本工理桩高度"];?></td>
							               
										         <?php
															}
															$conn->close();		
														?>
								   </tbody>
    					
											</table>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">关闭
										</button>
										
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal -->
							</div>
							
							<div>	<!-- 模态框（Modal） -->
						<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel3">
											架桥机
										</h4>
									</div>
									<div class="modal-body">
										  <table class="table table-bordered">
	
													<thead>
								      <tr>
								      	<th>工程名称</th>
								         <th>起重机械名称</th>
								         <th>设备状态</th>
								         <th>产权备案号</th>
								         <th>使用年限</th>
								         <th>型号</th>
								         <th>生产制造单位</th>
								         <th>登记日期</th>
								         <th>出厂编号</th>
								         <th>最大起重力矩 (kN*m)</th>
								         <th>设计最大起重高度</th>
								         <th>最大起重量(KN)</th>
								         <th>本工理桩高度(m)</th>
								        
								      </tr>
								   </thead>
								   <tbody>
								     				
                   						<?php
                   						require("../conn.php");
															
                   						$sql = "select * from 设备管理   where 设备类型='架桥机'";
                   						$result = $conn->query($sql);
                   						while($row = $result->fetch_assoc()) {
                        					
                   						?>
                   						<tr class="">
                   							td><?php echo $row["工程名称"];?></td>
                   						<td><?php echo $row["起重机械名称"];?></td>
                  						<td><?php echo $row["设备状态"];?></td>
							                <td><?php echo $row["产权备案号"];?></td>
							                <td><?php echo $row["使用年限"];?></td>
							                <td><?php echo $row["规格型号"];?></td>
							                <td><?php echo $row["生产制造单位"];?></td>
							                <td><?php echo $row["登记日期"];?></td>
							                <td><?php echo $row["出厂编号"];?></td>
							                <td><?php echo $row["最大起重力矩"];?></td>
							                <td><?php echo $row["设计最大起升高度"];?></td>
							                <td><?php echo $row["最大起重量"];?></td>
							                <td><?php echo $row["本工理桩高度"];?></td>
							               
										         <?php
															}
															$conn->close();		
														?>
								   </tbody>
    					
											</table>
											</table>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">关闭
										</button>
										
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal -->
							</div>
							
							<div>	<!-- 模态框（Modal） -->
						<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel4">
											桥（门）式起重机
										</h4>
									</div>
									<div class="modal-body">
										  <table class="table table-bordered">
	
													<thead>
								      <tr>
								      	<th>工程名称</th>
								         <th>起重机械名称</th>
								         <th>设备状态</th>
								         <th>产权备案号</th>
								         <th>使用年限</th>
								         <th>型号</th>
								         <th>生产制造单位</th>
								         <th>登记日期</th>
								         <th>出厂编号</th>
								         <th>最大起重力矩 (kN*m)</th>
								         <th>设计最大起重高度</th>
								         <th>最大起重量(KN)</th>
								         <th>本工理桩高度(m)</th>
								        
								      </tr>
								   </thead>
								   <tbody>
								     				
                   						<?php
                   						require("../conn.php");
															
                   						$sql = "select * from 设备管理   where 设备类型='桥（门）式起重机'";
                   						$result = $conn->query($sql);
                   						while($row = $result->fetch_assoc()) {
                        					
                   						?>
                   						<tr class="">
                   							<td><?php echo $row["工程名称"];?></td>
                   						<td><?php echo $row["起重机械名称"];?></td>
                  						<td><?php echo $row["设备状态"];?></td>
							                <td><?php echo $row["产权备案号"];?></td>
							                <td><?php echo $row["使用年限"];?></td>
							                <td><?php echo $row["规格型号"];?></td>
							                <td><?php echo $row["生产制造单位"];?></td>
							                <td><?php echo $row["登记日期"];?></td>
							                <td><?php echo $row["出厂编号"];?></td>
							                <td><?php echo $row["最大起重力矩"];?></td>
							                <td><?php echo $row["设计最大起升高度"];?></td>
							                <td><?php echo $row["最大起重量"];?></td>
							                <td><?php echo $row["本工理桩高度"];?></td>
							               
										         <?php
															}
															$conn->close();		
														?>
								   </tbody>
    					
											</table>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">关闭
										</button>
										
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal -->
							</div>
							
							<div>	<!-- 模态框（Modal） -->
						<div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel5">
											起重吊装
										</h4>
									</div>
									<div class="modal-body">
										  <table class="table table-bordered">
	
													<thead>
								      <tr><th>工程名称</th>
								         <th>起重机械名称</th>
								         <th>设备状态</th>
								         <th>产权备案号</th>
								         <th>使用年限</th>
								         <th>型号</th>
								         <th>生产制造单位</th>
								         <th>登记日期</th>
								         <th>出厂编号</th>
								         <th>最大起重力矩 (kN*m)</th>
								         <th>设计最大起重高度</th>
								         <th>最大起重量(KN)</th>
								         <th>本工理桩高度(m)</th>
								        
								      </tr>
								   </thead>
								   <tbody>
								     				
                   						<?php
                   						require("../conn.php");
															
                   						$sql = "select * from 设备管理   where 设备类型='起重吊装'";
                   						$result = $conn->query($sql);
                   						while($row = $result->fetch_assoc()) {
                        					
                   						?>
                   						<tr class="">
                   							<td><?php echo $row["工程名称"];?></td>
                   						<td><?php echo $row["起重机械名称"];?></td>
                  						<td><?php echo $row["设备状态"];?></td>
							                <td><?php echo $row["产权备案号"];?></td>
							                <td><?php echo $row["使用年限"];?></td>
							                <td><?php echo $row["规格型号"];?></td>
							                <td><?php echo $row["生产制造单位"];?></td>
							                <td><?php echo $row["登记日期"];?></td>
							                <td><?php echo $row["出厂编号"];?></td>
							                <td><?php echo $row["最大起重力矩"];?></td>
							                <td><?php echo $row["设计最大起升高度"];?></td>
							                <td><?php echo $row["最大起重量"];?></td>
							                <td><?php echo $row["本工理桩高度"];?></td>
							               
										         <?php
															}
															$conn->close();		
														?>
								   </tbody>
    					
											</table>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">关闭
										</button>
										
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal -->
							</div>
							
							<div>	<!-- 模态框（Modal） -->
						<div class="modal fade" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel4">
											施工机具
										</h4>
									</div>
									<div class="modal-body">
										  <table class="table table-bordered">
	
													<thead>
								      <tr>
								      	<th>工程名称</th>
								         <th>起重机械名称</th>
								         <th>设备状态</th>
								         <th>产权备案号</th>
								         <th>使用年限</th>
								         <th>型号</th>
								         <th>生产制造单位</th>
								         <th>登记日期</th>
								         <th>出厂编号</th>
								         <th>最大起重力矩 (kN*m)</th>
								         <th>设计最大起重高度</th>
								         <th>最大起重量(KN)</th>
								         <th>本工理桩高度(m)</th>
								        
								      </tr>
								   </thead>
								   <tbody>
								     				
                   						<?php
                   						require("../conn.php");
															
                   						$sql = "select * from 设备管理   where 设备类型='施工机具'";
                   						$result = $conn->query($sql);
                   						while($row = $result->fetch_assoc()) {
                        					
                   						?>
                   						<tr class="">
                   							<td><?php echo $row["工程名称"];?></td>
                   						<td><?php echo $row["起重机械名称"];?></td>
                  						<td><?php echo $row["设备状态"];?></td>
							                <td><?php echo $row["产权备案号"];?></td>
							                <td><?php echo $row["使用年限"];?></td>
							                <td><?php echo $row["规格型号"];?></td>
							                <td><?php echo $row["生产制造单位"];?></td>
							                <td><?php echo $row["登记日期"];?></td>
							                <td><?php echo $row["出厂编号"];?></td>
							                <td><?php echo $row["最大起重力矩"];?></td>
							                <td><?php echo $row["设计最大起升高度"];?></td>
							                <td><?php echo $row["最大起重量"];?></td>
							                <td><?php echo $row["本工理桩高度"];?></td>
							               
										         <?php
															}
															$conn->close();		
														?>
								   </tbody>
    					
											</table>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">关闭
										</button>
										
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal -->
							</div>
							
							
							<div>	<!-- 模态框（Modal） -->
						<div class="modal fade" id="myModal7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel4">
											吊篮
										</h4>
									</div>
									<div class="modal-body">
										  <table class="table table-bordered">
	
													<thead>
								      <tr>
								      	 <th>工程名称</th>
								         <th>起重机械名称</th>
								         <th>设备状态</th>
								         <th>产权备案号</th>
								         <th>使用年限</th>
								         <th>型号</th>
								         <th>生产制造单位</th>
								         <th>登记日期</th>
								         <th>出厂编号</th>
								         <th>最大起重力矩 (kN*m)</th>
								         <th>设计最大起重高度</th>
								         <th>最大起重量(KN)</th>
								         <th>本工理桩高度(m)</th>
								        
								      </tr>
								   </thead>
								   <tbody>
								     				
                   						<?php
                   						require("../conn.php");
															
                   						$sql = "select * from 设备管理   where 设备类型='吊篮'";
                   						$result = $conn->query($sql);
                   						while($row = $result->fetch_assoc()) {
                        					
                   						?>
                   						<tr class="">
                   						<td><?php echo $row["工程名称"];?></td>
                   						<td><?php echo $row["起重机械名称"];?></td>
                  						<td><?php echo $row["设备状态"];?></td>
							                <td><?php echo $row["产权备案号"];?></td>
							                <td><?php echo $row["使用年限"];?></td>
							                <td><?php echo $row["规格型号"];?></td>
							                <td><?php echo $row["生产制造单位"];?></td>
							                <td><?php echo $row["登记日期"];?></td>
							                <td><?php echo $row["出厂编号"];?></td>
							                <td><?php echo $row["最大起重力矩"];?></td>
							                <td><?php echo $row["设计最大起升高度"];?></td>
							                <td><?php echo $row["最大起重量"];?></td>
							                <td><?php echo $row["本工理桩高度"];?></td>
							               
										         <?php
															}
															$conn->close();		
														?>
								   </tbody>
    					
											</table>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">关闭
										</button>
										
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal -->
							</div>
							
							</div>
							</div>
							</div>
							
    					
    				<!-- 内容区域 -->

    
    <footer class="bs-docs-footer" role="contentinfo"></footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/jquery-1.10.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
   <!--js of bootstrap-table -->
   <script src="../js/bootstrap-table.min.js"></script>
   <!--js of bootstrap-table—export -->
   <script src="../js/export/tableExport.js"></script>
   <script src="../js/export/bootstrap-table-export.js"></script>
   <script src="../js/bootstrap-table-zh-CN.min.js"></script>
   <script src="../js/highcharts.js"></script>
   <script type="text/javascript" src="../js/jquery.print.js"></script>
   <script language="javascript" src="../js/PCASClass.js"></script>
	 <script language="javascript">
			
			function preview() { 
			bdhtml=window.document.body.innerHTML; 
			sprnstr="<!--startprint-->"; 
			eprnstr="<!--endprint-->"; 
			prnhtml=bdhtml.substr(bdhtml.indexOf(sprnstr)+17); 
			prnhtml=prnhtml.substring(0,prnhtml.indexOf(eprnstr)); 
			window.document.body.innerHTML=prnhtml; 
			window.print(); 
			window.document.body.innerHTML=bdhtml; 
			}
		</script>
		<script language="JavaScript">
								    var bianliang=document.getElementById("liu");
								    	var endtime=document.getElementById("endtime");
											$(document).ready(function() { 
												$('#reservationtime').daterangepicker({
										          timePicker: true,
										          timePickerIncrement: 30,
										          format: 'MM/DD/YYYY h:mm A'
										          }, function(start, end, label) {
										          console.log(start.toISOString(), end.toISOString(), label);
										          var a=document.getElementById("reservationtime").value;    
										        	  //alert(start.toISOString()); 
										          	  bianliang.value=start.toISOString();
										          	  endtime.value=end.toISOString();
										        	  //alert(bianliang.getAttribute("value"));
										//    	   bianliang.value=start.toISOString();
										          });//时间段的  
											   var chart = {
											       plotBackgroundColor: null,
											       plotBorderWidth: null,
											       plotShadow: false
											   };
											   var title = {
											      text: '分析图'   
											   };      
											   var tooltip = {
											      pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
											   };
											   var plotOptions = {
											      pie: {
											         allowPointSelect: true,
											         cursor: 'pointer',
											         dataLabels: {
											            enabled: true,
											            format: '<b>{point.name}%</b>: {point.percentage:.1f} %',
											            style: {
											               color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
											            }
											         }
											      }
											   };
											   var series= [{
											      type: 'pie',
											      name: '所占比例',
											      data: [
											         ['施工机具',   <?php echo $b6['AllNum6'];?>],
											         ['吊篮',   <?php echo $b7['AllNum7'];?>],
											         ['起重吊装',      <?php echo $b5['AllNum5'];?> ],
											         {
											            name: '桥（门）式起重机',
											            y: <?php echo $b4['AllNum4'];?>,
											            sliced: true,
											            selected: true
											         }, 
											         ['架桥机',    <?php echo $b3['AllNum3'];?>],
											         ['施工升降机',     <?php echo $b2['AllNum2'];?>],
											         ['塔吊',   <?php echo $b1['AllNum1'];?>],
											         ['物料提升机', <?php echo $b['AllNum'];?>]
											      ]
											   }];     
											      
											   var json = {};   
											   json.chart = chart; 
											   json.title = title;     
											   json.tooltip = tooltip;  
											   json.series = series;
											   json.plotOptions = plotOptions;
											   $('#container1').highcharts(json);  
											});
									</script><!--endprint-->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>
    <script src="../js/mySidenav.js" type="text/javascript" charset="utf-8"></script>
    

     	<!--<script type="text/javascript" src="../js/jquery.min.js">
			</script>-->
			<!--<script type="text/javascript" src="../js/bootstrap.min.js">
			</script>-->
			<script type="text/javascript" src="../js/moment.js">
			</script>
			<script type="text/javascript" src="../js/daterangepicker.js">
			</script>
			 <script language="javascript" defer>

				     
				new PCAS("province6","city6","请选择省份","请选择市区");

			
				
				</script>
  </body>
</html>
