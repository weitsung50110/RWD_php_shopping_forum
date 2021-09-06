<?php
	include ("connect_database.php");

	// 建立與MySQL資料庫的連線
	$link = mysqli_connect($hostname, $username, $password, $database) OR die("Error: Unable to connect to MySQL.");
	// 設定編碼方式為UTF-8
	// 另一種寫法	mysqli_query($link, "SET NAMES utf8");
	mysqli_set_charset($link, "utf8");
	
	$query3 = "select * from `product` ORDER BY `id` DESC;";//由大到小排列
	$result3 = mysqli_query($link, $query3) or die("Connect DB Table Error!");
	
	while ($row=mysqli_fetch_array($result3))
	{
		$count=$row['id'];//取得商品裡面最大的ID值
		break;
	}
	
?>



<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
<!--    讓網頁不會自動因手機螢幕變小而扭曲，使得RWD網頁能正常執行-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Robert's shopping mall</title>
    <link href="first2.css" rel=stylesheet>
	
	<!-- 滑鼠的游標,查網路,加上去的~ 來源:http://www.cursors-4u.com/cursor/2012/02/12/chrome-pointer.html-->
	<style type="text/css">* {cursor: url(http://cur.cursors-4u.net/cursors/cur-11/cur1054.cur), auto !important;}
	</style><a href="http://www.cursors-4u.com/cursor/2012/02/12/chrome-pointer.html" 
	target="_blank" title="Chrome Pointer"><img src="http://cur.cursors-4u.net/cursor.png" 
	border="0" alt="Chrome Pointer" style="position:absolute; top: 0px; right: 0px;" /></a>

		
	
	<!--Start:插入jQuery-->
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
	<!--End:插入jQuery-->
	<!--Start:插入TOP套件-->
	<script type='text/javascript'>
	/* 返回最上面的Javascript不是自己寫的,來源:https://ezbox.idv.tw/131/back-to-top-button-without-images/*/
	$(function() {
		/* 按下GoTop按鈕時的事件 */
		$('#gotop').click(function(){
			$('html,body').animate({ scrollTop: 0 }, 'slow');   /* 返回到最頂上 */
			return false;
		});
		
		/* 偵測卷軸滑動時&#65292;往下滑超過400px就讓GoTop按鈕出現 */
		$(window).scroll(function() {
			if ( $(this).scrollTop() > 100){
				$('#gotop').fadeIn();
			} else {
				$('#gotop').fadeOut();
			}
		});
	});
	
	
	
	</script>
	<!--END:插入TOP套件-->



</head>
<body id="bg">
	
		<!--返回最上面的按鈕-->
		<div id='gotop'><center>^</center></div>
		
		<div >
			
			<!--右邊的飄浮選單-->
			
			<div id="cart">
				<span class="bold_black"><a href="cart.php">&nbsp;&nbsp;➤購物車</a></span>	
				<br />
				<a href="cart.php"><img src="images/cart.png" width="120px" height="120px"></a>
				<br />
				<?php 	
					if(isset($_COOKIE["name"]))//判斷是否登入,因為若有登入的話,COOKIE裡面會有名字
					{
						echo "<span class='font2'>&nbsp;&nbsp;姓名: </span>";	
						echo "<span class='blue'>".$_COOKIE["name"]."</span>";	

					}		
					else
					{
						echo "<span class='blue'>&nbsp;&nbsp;你還沒登入</span>";
					}
				?>
			</div>
			
			<div id="MyBlog">
			
				<span class="font1"><a href="index.php">➤首頁</a></span>	
				<br />
				<span class="font1"><a href="shop.php">➤商場</a></span>				
				<br />
				<span class="font1"><a href="login.php">➤登入</a></span>
				<br />
				<span class="font1"><a href="forum.php">➤留言板</a></span>
				<br />
				<span class="font1"><a href="register.php">➤註冊</a></span>
				<br />
				<span class="font1"><a href="disaster.php">➤防災教育</a></span>
				<br />
				<span class="font1"><a href="order.php">➤訂單</a></span>
				<br />
				<span class="font1"><a href="member.php">➤會員</a></span>
				
			</div>
			
			
			<!--上方的圖片,自己做的~-->
			<header><a href="index.php"><img src="images/bg2.png"  ></a></header>
			
			
			<!--按鈕,CSS裡面的語法是自己寫的-->
			<nav>
				<a href="index.php"><button class="bt"><span>首頁</span></button></a>
				<a href="register.php"><button class="bt"><span>註冊</span></button></a>
				<a href="login.php"><button class="bt"><span>登入</span></button></a>
				<a href="forum.php"><button class="bt"><span>留言板</span></button></a>
				<a href="shop.php"><button class="bt"><span>商場</span></button></a>
				<a href="disaster.php"><button class="bt"><span>防災</span></button></a>
				<a href="order.php"><button class="bt"><span>訂單</span></button></a>
				<a href="member.php"><button class="bt"><span>會員</span></button></a>
				
			</nav>
			
			
			<h1 id="h1">訂單</h1>
			
			

			
			<footer class="long">
				<?php 										

					
					$total2 =  $_POST["total2"];  //把商品的總價傳給$total2
					
					$pname=array();//宣告陣列
					$num=array();//宣告陣列
					$pname2='';
					
					for($i=1;$i<=$count;$i++)
					{
						if(isset($_COOKIE["text".$i.""])&&isset($_COOKIE["names".$i.""]))//判斷商品數量和名稱 是否存在
						{
							$num[$i]= $_COOKIE["text".$i.""];//把商品的數量傳給$num[$i]
							$pname[$i] = $_COOKIE["names".$i.""];//把商品的名稱傳給$pname[$i]
							
							$pname[$i]=$pname[$i].$num[$i];//把商品的名稱和數量連接起來, 也就是把這兩個字串連接在一起
							$pname2=$pname2.$pname[$i].'個\n';//在整個字串後面再加上"個"和"\n"換行符號
						}
					}
					
					for($i=0;$i<=$count;$i++)
					{
						if(isset($_COOKIE["text".$i.""])&&isset($_COOKIE["names".$i.""])&&isset($_COOKIE["price".$i.""]))//判斷商品數量和名稱 是否存在
						{
							Setcookie("names".$i."", "", time()-3600);	//當把訂單匯入資料庫後,就把商品的COOKIE給清空	
							Setcookie("price".$i."", "", time()-3600);	//當把訂單匯入資料庫後,就把商品的COOKIE給清空	
							Setcookie("text".$i."", "", time()-3600);	//當把訂單匯入資料庫後,就把商品的COOKIE給清空	
						}
					}
					
					
					//select user
					$query1 = "select * from `user` where `user1` = '".$_COOKIE["user1"]."' ORDER BY `id` DESC;";
					$result1 = mysqli_query($link, $query1) or die("Connect DB Table Error!");
					
					while ($row=mysqli_fetch_array($result1))
					{
						$uname=$row['name'];
						$mail=$row['mail'];
						$address=$row['address'];//把使用者地址傳進$address
					}
					
					//把新訂單插入`order_form`裡面
					$query = "INSERT INTO `order_form` (name,address,price,mail,product) 
					VALUES ('".$uname."','".$address."','".$total2."','".$mail."','".$pname2."') ;";
					$result = mysqli_query($link, $query) or die("Connect DB Table Error!");
					
					//查詢該位使用者的所有訂單, 並且由大到小排列
					$query2 = "select * from `order_form` where `name` = '".$uname."' ORDER BY `ID` DESC;";
					$result2 = mysqli_query($link, $query2) or die("Connect DB Table Error!");
							
					echo "<center>";
					echo "<div style='border-width:3px;border-style:dashed;border-color:#8e8e8e;'>";
					echo "<table >";
					echo "<tr>";
					echo "<th bgcolor='#FFE8E8'>";
					echo "編號";
					echo "</th>";
					echo "<th bgcolor='#FFFAF2'>"; 
					echo "姓名";
					echo "</th>";
					echo "<th class='email' bgcolor='#fff5f7'>"; 
					echo "Email";
					echo "</th>";
					echo "<th bgcolor='#FFE8E8'>";
					echo "地址";
					echo "</th>";
					
					echo "<th bgcolor='#FFFAF2'>";
					echo "總價";
					echo "</th>";
					echo "<th bgcolor='#fff5f7'>"; 
					echo "購買的商品";
					echo "</th>";
					echo "<th bgcolor='#FFE8E8'>";
					echo "Time";
					echo "</th>";
					echo "</tr>";
					
					
					$q=1;										
					while ($row=mysqli_fetch_array($result2))
					{

						// 在此例中，$row中有$row["Time"]與$row["Description"]兩欄位的值。
						
						echo "<tr>";
						echo "<td bgcolor='#FFE8E8'>";
						echo $q;
						echo "</td>";
						echo "<td bgcolor='#FFFAF2'>"; 
						echo $row['name'];
						echo "</td>";
						echo "<td class='email' bgcolor='#fff5f7'>"; 
						echo $row['mail'];
						echo "</td>";
						echo "<td bgcolor='#FFE8E8'>";
						echo $row['address'];
						echo "</td>";
						
						echo "<td bgcolor='#FFFAF2' style='font-weight:bold; color:#750000;'>";
						echo "$".$row['price'];
						echo "</td>";
						echo "<td bgcolor='#fff5f7'>";
						echo nl2br($row['product']);
						echo "</td>";
						echo "<td bgcolor='#FFE8E8'>";
						echo $row['Time'];
						echo "</td>";
						echo "</tr>";
						
						$q++;
						break;
					}
					
					echo "</table>";
					echo "</div>";
					echo "</center>";
					//echo "<HR color='#8e8e8e' size='4' >";
					
					// 釋放結果集($result)所佔用的記憶體。(若無釋放，程式可能會錯誤，尤其是用"SELECT ..."的時候)
					mysqli_free_result($result1);
					mysqli_free_result($result2);
					mysqli_free_result($result3);
					
					// 關閉與MySQL資料庫的連線
					mysqli_close($link);
					
				?>	
				
				
			<br /><br />
			網站製作: Robert's shopping mall
			</footer>
			
		

					
		</div>
		
		
	
	
</body>
</html>