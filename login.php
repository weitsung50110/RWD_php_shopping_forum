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


<!--下面全部都是自己寫的!!-->
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
			

			<h1 id="h1">會員登入</h1>
			
			
			
			

			<aside class="register">			
				
								
				<?php		
				session_start(); //session開始
				
				if (isset($_POST["user1"])&&isset($_POST["pasd"]))//如果帳號密碼都有輸入才進來
				{
					$user1 = $_POST['user1'];
					$pasd = $_POST['pasd'];
					

					$query1 = "select * from `user` ORDER BY `id` DESC;";
					$result1 = mysqli_query($link, $query1) or die("Connect DB Table Error!");
					
					$j=0;
					while ($row=mysqli_fetch_array($result1))
					{
						if(($row['user1']==$user1)&&($row['pasd']==$pasd))//當帳號密碼 和 資料庫中的帳號密碼對上時,才進來
						{	
							
							$_SESSION['judgement']=1; //判斷登入成功, 並把1給SESSION裡面的judgement
							
							Setcookie("name", "".$row['name']."", time()+3600);//設定COOKIE的NAME為使用者的"姓名"
							//Setcookie("judgement", "1", time()+3600);		
							Setcookie("user1", "".$row['user1']."", time()+3600);//設定COOKIE的user1為使用者的"帳號"
							Header('Location: login.php'); //重新導向頁面
							exit;//在每個重定向之後都必須加上“exit”,避免發生錯誤後，繼續執行。
							$j++;//判斷帳號密碼是否正確
							
						}
					}
					if(empty($user1)&&empty($pasd))//帳號密碼若是空的就近來
					{
						unset($_SESSION['judgement']);//把$_SESSION['judgement']刪掉
						
						Setcookie("name", "", time()-3600);//把$_COOKIE["name"]刪掉
						Setcookie("user1", "", time()-3600);//把$_COOKIE["user1"]刪掉
						echo "<br />";
						echo "<span class='red'>帳號密碼是空的,請再試一次 !</span>";	
						
					}
					else if($j==0)//帳號密碼錯誤就進來
					{	
						unset($_SESSION['judgement']);//把$_SESSION['judgement']刪掉
						
						Setcookie("name", "", time()-3600);//把$_COOKIE["name"]刪掉
						Setcookie("user1", "", time()-3600);//把$_COOKIE["user1"]刪掉
						echo "<br />";
						echo "<span class='red'>帳號密碼錯誤,請再試一次 !</span>";	
						echo "<br />";
						echo "<form action='login.php' >";
						echo "<button type='submit' name='submit' value='submit' class='bt'><span>返回</span></button>";
						echo "</form>";		
						
					}
				
					// 釋放結果集($result)所佔用的記憶體。(若無釋放，程式可能會錯誤，尤其是用"SELECT ..."的時候)
					mysqli_free_result($result1);

					// 關閉與MySQL資料庫的連線
					mysqli_close($link);
				}
				?>
				
				
				
				<?php
				if (empty($_POST["user1"]))
				{
					if(isset($_SESSION['judgement'])) 
					{
						if($_SESSION['judgement']==1)//若目前是登入的狀態就進來
						{
							if (isset($_POST["logout"]))//若使用者按下"登出"的按鈕,就進來
							{
								unset($_SESSION['judgement']);//把$_SESSION['judgement']刪掉
								
								Setcookie("name", "", time()-3600);//把$_COOKIE["name"]刪掉
								Setcookie("user1", "", time()-3600);//把$_COOKIE["user1"]刪掉
								
								header('Location: login.php');//重新導向,讓使用者可以直接登出,不會卡住,害的使用者登出鍵要按兩次
								exit;
							}
							if((isset($_COOKIE["name"])))//若存在$_COOKIE["name"],就進來
							{
								echo "<span class='blue'>".$_COOKIE["name"]."</span>";
								echo "<span class='font1'> 你已經登入了!</span>";
								echo "<br />";
								echo "<span class='font1'>若要登出請按以下按鈕!</span>";
								
								echo "<form action='login.php' method='post'>";
								//這就是"logout"登出的按鈕
								echo "<button type='submit' name='logout' value='logout' class='bt'><span>登出</span></button>";
								echo "</form>";	
							}
							else
							{
								unset($_SESSION['judgement']);//把$_SESSION['judgement']刪掉
							}
						}
				?>

				<?php	
					}
					else
					{
						?>
						<form action="" method="post">
						<span class='font1'>使用者帳號：</span>
						<input type="text" name="user1" /><BR><BR>
						<span class='font1'>使用者密碼：</span>
						<input type="text" name="pasd" /><BR><BR>
						
						<button type='submit' name='submit' value='submit' class='bt'><span>登入</span></button>
						</form>
						<?php
					}
				}
				?>	
				
				
			</aside>
			
			
			
			
			<article>
				<h1>若沒有帳號，請先註冊</h1>				
				<h2>在這裡您可以登入網站，之後便可以展開購物。</h2>
			</article>
			
			
			<footer>網站製作: Robert's shopping mall</footer>		
				
		</div>
		
	
	
</body>
</html>