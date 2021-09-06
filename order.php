<?php
	include ("connect_database.php");

	// 建立與MySQL資料庫的連線
	$link = mysqli_connect($hostname, $username, $password, $database) OR die("Error: Unable to connect to MySQL.");
	// 設定編碼方式為UTF-8
	// 另一種寫法	mysqli_query($link, "SET NAMES utf8");
	mysqli_set_charset($link, "utf8");
	
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
			session_start();//session 開始
			if(isset($_SESSION['judgement'])&&isset($_COOKIE["name"])) //判斷是否登入
			{
				
				echo "<span class='blue'>".$_COOKIE["name"]."</span>"; 
			}
			else 
			{
				echo "<span class='red'>你還沒登入!</span>"; 
				echo "<br />"; 
				echo "<img src='images/no.png' alt='你還沒登入' width='300px'>";
			}
			
			if(isset($_COOKIE["user1"])) //判斷是否登入
			{

				echo " 會員您好，以下是您的訂單!";
				
				//查詢使用者訂單, 並且由大到小排列
				$query2 = "select * from `order_form` where `name` = '".$_COOKIE["name"]."' ORDER BY `ID` DESC;";
				$result2 = mysqli_query($link, $query2) or die("Connect DB Table Error!");
						
				echo "<center>";
				echo "<div style='border-width:3px; border-style:dashed; border-color:#8e8e8e;'>";
				echo "<table >";
				echo "<tr >";
				echo "<th bgcolor='#FFE8E8' >";
				echo "編號";
				echo "</th>";
				echo "<th  bgcolor='#FFFAF2'>"; 
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
					
					echo "<tr >";
					echo "<td bgcolor='#FFE8E8' >";
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
					echo nl2br($row['product']);//換行的指令
					echo "</td>";
					echo "<td bgcolor='#FFE8E8'>";
					echo $row['Time'];
					echo "</td>";
					echo "</tr>";
					
					$q++;
				}
				
				echo "</table>";
				if($q==1)
				{
					echo "<span class='red'>你目前訂單是空的喔!<br />趕快去購物吧~</span><br />"; 
					echo "<a href='shop.php'><img src='images/no_buy.png' alt='no_buy' width='200' height='250'></a><br />";
					//"去購物吧"的圖片超連結
				}
				echo "</div>";								
				echo "</center>";
				
				// 釋放結果集($result)所佔用的記憶體。(若無釋放，程式可能會錯誤，尤其是用"SELECT ..."的時候)
				mysqli_free_result($result2);

				// 關閉與MySQL資料庫的連線
				mysqli_close($link);
				
			}
			?>
			
			
			<br /><br /><br />
			網站製作: Robert's shopping mall
			</footer>
			
			

					
		</div>
		
		
	
	
</body>
</html>