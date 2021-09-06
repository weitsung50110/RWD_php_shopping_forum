<?php
	include ("connect_database.php");
	if (isset($_POST["user1"]))//判斷是否存在
    {
		$user1 = $_POST['user1'];//接收從register.php傳來的值
	}
	if (isset($_POST["pasd"]))//判斷是否存在
	{
		$pasd = $_POST['pasd'];//接收從register.php傳來的值
	}
	if (isset($_POST["mail"]))//判斷是否存在
	{
		$mail = $_POST['mail'];//接收從register.php傳來的值
	}		
	if (isset($_POST["name"]))//判斷是否存在
	{
		$name = $_POST['name'];//接收從register.php傳來的值
	}
	if (isset($_POST["address"]))//判斷是否存在
	{
		$address = $_POST['address'];//接收從register.php傳來的值
	}

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
			
			
			<h1 id="h1">註冊帳號密碼</h1>
			
			
			
			
			
					
			<!--<aside><img src="images/logo.jpg"></aside>-->
			<aside class="register">			
				<?php	
					
					if(isset($_POST["submit"])) //判斷是否接收到register.php的"註冊按鈕"
					{
						//SELECT資料庫裡面的USER, 為了避免註冊的帳號密碼重複";
						$query1 = "SELECT * FROM `user`;";			
						$result1 = mysqli_query($link, $query1) or die("Connect DB Table Error!");
						
						
						if(!$user1||!$pasd)//如果帳號 和 密碼 有一個是沒有輸入的,就要求使用者返回重打
						{
							echo '<br /><br />'; 
							echo "<span class='font1'>你沒有打帳號或密碼唷 !!!</span>	";
							echo '<br />';
							echo "<form action='register.php' method='post'>";//前往註冊頁面
							echo "<button type='submit' name='submit' value='submit' class='bt'><span>返回</span></button>";
							echo "</form>";
						}
						else
						{
							$j=0;//判斷帳密是否重複
							while ($row=mysqli_fetch_array($result1))
							{
								if ($row['user1']==$user1&&$row['pasd']==$pasd)	//若帳號密碼已經被註冊過了,就要求使用者重新註冊
								{
									echo '<br /><br />'; 
									echo"<span class='font1'>帳號密碼重複,請重新輸入帳號密碼 !</span>";		
									echo '<br />';
									$j=1;
									echo "<form action='register.php' method='post'>";//前往註冊頁面
									echo "<button type='submit' name='submit' value='submit' class='bt'><span>返回</span></button>";
									echo "</form>";
									break;
								}			
								
							}
							if($j!=1)//帳密沒有重複
							{
								//把使用者註冊的資料插入 user 裡面;
								$query2 = "insert into `user` (user1, pasd, mail, name, address)
								Values('$user1','$pasd','$mail','$name','$address');";
								$result2 = mysqli_query($link, $query2) or die("Connect DB Table Error!");
								
								
								echo '<br />';
								echo "<span class='font1'>歡迎<span class='blue'>'".$name."'</span>會員註冊</span>";
								echo '<br>'; 
								echo "<span class='font1'>你已成功加入本商城會員</span>";
								echo '<br>'; 
								echo '<br>'; 
					
								echo "<span class='font1'>請選擇你要去的地方</span>";
								echo '<br />'; 
								echo "<form action='login.php' method='post' >";//前往登入頁面
								echo "<button type='submit' name='submit' value='submit' class='bt'><span>登入</span></button>";
								echo "</form>";
								
															
							}
							// 釋放結果集($result)所佔用的記憶體。(若無釋放，程式可能會錯誤，尤其是用"SELECT ..."的時候)
							mysqli_free_result($result1);
							
							
							// 關閉與MySQL資料庫的連線
							mysqli_close($link);
						}	
					}					
				?>
			</aside>
			
			
			
			
			<article>
				<h1>請輸入你的真實資料</h1>				
				<h2>在這裡您可以買到防災用具和各種與安全有關的物品，祝福大家長命百歲，萬事平安。</h2>
			</article>
			
			
			<footer>網站製作: Robert's shopping mall</footer>		
				
		</div>
		
	
	
</body>
</html>







