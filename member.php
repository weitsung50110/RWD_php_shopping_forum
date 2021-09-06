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
    <link href="first2.css" rel="stylesheet" type="text/css">
	
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
				<span class="bold_black"><a href="cart.php">&nbsp;&nbsp;➤商場</a></span>	
				<br />
				<a href="cart.php"><img src="images/cart.png" width="120px" height="120px"></a>
				<br />
				<?php 	
					session_start();//SESSION 開始
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
			

			<h1 id="h1">會員名冊</h1>
			
			
			
			

			<aside class="member">			
				<?php	
				
				if(isset($_SESSION['judgement'])&&isset($_COOKIE["name"])) //判斷是否登入
				{
					if($_SESSION['judgement']==1)//判斷是否登入
					{
						echo '<br>'; 
						echo "<span class='font1'>下表所列的是本商城會員名冊</span>";
						echo '<br>'; 

						//查詢所有已註冊的會員
						$query2 = "SELECT * FROM `user`;";			
						$result2 = mysqli_query($link, $query2) or die("Connect DB Table Error!");
			
						
						echo "<center>";
						echo "<table border='1';>  ";
						//表格第一行作為說明
						echo "<tr>";
							echo "<td >"; 
							echo "筆數";
							echo "</td>";
							
							echo "<td >"; 
							echo "使用者帳號";
							echo "</td>";
							
							echo "<td >";
							echo "使用者密碼";
							echo "</td>";
							
							echo "<td >";
							echo "使用者mail";
							echo "</td>";
							
							echo "<td >";
							echo "寄送住址";
							echo "</td>";
							
							echo "<td >";
							echo "姓名";
							echo "</td>";
						echo "</tr>";

						$i=0;
						while ($row=mysqli_fetch_array($result2))
						{
							echo "<tr>";
								echo "<td >"; 
								echo $row['id'];
								echo "</td>";
								
								echo "<td >"; 
								echo $row['user1'];
								echo "</td>";
								
								echo "<td >";
								echo "****";
								echo "</td>";
								
								echo "<td >";
								echo $row['mail'];
								echo "</td>";
								
								echo "<td >";
								echo "******";
								echo "</td>";
								
								echo "<td >";
								echo $row['name'];
								echo "</td>";
							echo "</tr>";
			
							$i++;
						}
						echo "</table>";
						echo "</center>";
						

						
						// 釋放結果集($result)所佔用的記憶體。(若無釋放，程式可能會錯誤，尤其是用"SELECT ..."的時候)
						mysqli_free_result($result2);
										
						// 關閉與MySQL資料庫的連線
						mysqli_close($link);
					}
				}	
				else
				{
					echo"<span class='red'>你還沒登入，請先登入唷!</span>";
				}				
			?>
			</aside>
			
			
			
			
			<article>
				<h1>防災網站的會員</h1>				
				<h2>在這裡您可以看到網站的全部會員。</h2>
			</article>
			
			
			<footer>網站製作: Robert's shopping mall</footer>		
				
		</div>
		
	
	
</body>
</html>







