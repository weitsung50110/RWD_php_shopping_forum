<?php
	include ("connect_database.php");

	// 建立與MySQL資料庫的連線
	$link = mysqli_connect($hostname, $username, $password, $database) OR die("Error: Unable to connect to MySQL.");
	// 設定編碼方式為UTF-8
	// 另一種寫法	mysqli_query($link, "SET NAMES utf8");
	mysqli_set_charset($link, "utf8");
	
	
	$query = "select * from `product` ORDER BY `id` DESC;";
	$result = mysqli_query($link, $query) or die("Connect DB Table Error!");
	
	while ($row=mysqli_fetch_array($result))
	{
		$count=$row['id'];//取得商品裡面最大的ID值
		break;
	}
	
	// 釋放結果集($result)所佔用的記憶體。(若無釋放，程式可能會錯誤，尤其是用"SELECT ..."的時候)
	mysqli_free_result($result);
	// 關閉與MySQL資料庫的連線
	mysqli_close($link);
	
	
	if(isset($_POST['delet']))//判斷$_POST['delet']是否存在
	{
		$j=$_POST['j'];//把要刪除商品的ID傳過來
		Setcookie("names".$j."", "", time()-3600);//刪除該樣商品的COOKIE名稱
		Setcookie("price".$j."", "", time()-3600);//刪除該樣商品的COOKIE價格
		Setcookie("text".$j."", "", time()-3600);//刪除該樣商品的COOKIE數量
		Header('Location: cart.php');//重新導向, 不然COOKIE會LAG
		exit;//在每個重定向之後都必須加上“exit”,避免發生錯誤後，繼續執行。
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
			

			<h1 id="h1">購物車</h1>
			
			

			
			<footer>
				<?php 	
				session_start();//SESSION 開始
				if(isset($_SESSION['judgement'])&&isset($_COOKIE["name"])) //判斷是否登入
				{					
					echo "<span class='blue'>".$_COOKIE["name"]."</span>"; 
					echo " 會員您好，以下是您的購物清單!";
				


					
					$num=array();//宣告陣列
					$price=array();//宣告陣列
					$names=array();//宣告陣列
					$total=array();//宣告陣列
					
					echo "<center>";

					echo "<table style='border:8px #a6172c groove;' cellpadding='12' border='1' align='center'>";
					echo "<tr>";
					
					$j=1;
					$q=0;//判斷購物車是否是空的
					while(true)
					{
						if(isset($_COOKIE["text".$j.""])&&isset($_COOKIE["names".$j.""]))//判斷是否登入
						{
							$price[] = $_COOKIE["price".$j.""]; //把price傳進陣列裡						
							$names[] = $_COOKIE["names".$j.""]; //把names傳進陣列裡		
							$num[]=$_COOKIE["text".$j.""];//把數量傳進陣列裡	
							
							echo "<td bgcolor='#fdf1ec'><img src='images/".$j.".jpg' alt='' width='100' height='100'></td><br />";//顯示商品圖片
							echo "<td bgcolor='#fdf1ec'>".$_COOKIE["names".$j.""]."單價為$".$_COOKIE["price".$j.""]." 元</td>";//顯示商品單價
							
							echo "<td bgcolor='#fdf1ec'>";
							echo "<form action='' method='post'>";
							echo "<input type='hidden' name='j' value='".$j."'/> ";
							echo "<button type='submit' name='delet' value='submit' class='bt2' style='width:40px;' >
							<span>X</span></button>";//顯示刪除商品COOKIE的按鈕
							echo "</form>";
							echo "</td>";
							
							echo "</tr>";
							$q++;//判斷購物車是否是空的
						}
						if ($j==$count)//當商品的ID從 1~ID的最大值時, 就BREAK出去
						{
							break;
						}
						$j++;
						
					}
					if($q==0)//判斷購物車是否是空的
					{
						echo "<td bgcolor='#fdf1ec' align='center'>購物車目前是空的~</td>";
						echo "</tr>";
						echo "<td ><a href='shop.php'><img src='images/no_buy.png' alt='no_buy' width='200' height='250'></a></td><br />";
					}

					echo "</table>";
					echo "</center>";
					
					
					for($i=0;$i<$j;$i++)
					{
						if(isset($num[$i])&&isset($price[$i]))//判斷($num[$i])&&isset($price[$i])是否存在
							$total[]=$num[$i]*$price[$i];//把商品的數量乘以價格
					}
					echo "<center>";
					echo "</br>";
					echo "</br>";
					echo "<table style='border:8px #a6172c	 groove;' cellpadding='10' border='1'>";

					for($i=0;$i<$j;$i++)
					{
						if(isset($num[$i])&&isset($price[$i])&&isset($names[$i]))
						{
							echo "<tr>";
							echo "<td>你購買".$names[$i]." <span class='bold_deep_red'> ".$num[$i]."個</span></td>";
							echo "<td>價錢是 <span class='bold_deep_red'>$".$total[$i]."</span> 元</td>";//把購買商品的價格*數量顯示出來
							echo "</tr>";
						}
					}
					if($q==0)//判斷購物車是否是空的
					{
						echo "<td bgcolor='#fdf1ec'>請去買完東西再回來喔!</td>";
						echo "</tr>";
					}
					
					echo "</table>";
					echo "</center>";
					echo "</br>";
					
					$total2=0;
					for($i=0;$i<$j;$i++)
					{
						if(isset($num[$i])&&isset($price[$i])&&isset($names[$i]))//判斷($num[$i])&&isset($price[$i])&&isset($names[$i])是否存在
							$total2=$total2+$total["".$i.""];//把所有商品的價錢加起來
					}
					echo "<center>";
					echo "<h2>總價是".$total2."元</h2>";//顯示全部的總價
					echo "</br>";
					
					if($q!=0)//若有購買商品,送出的按鈕才會顯示出來
					{
						echo "<form action='cart2.php' method='post'>";//按下送出後, 進入cart2.php頁面
						echo "<input type='hidden' name='total2' value='".$total2."'/> ";
						echo "<button type='submit' name='submit' value='submit' class='bt'><span>送出</span></button>";
						echo "</form>";
					}
				}
				else 
				{
					echo "<span class='red'>你還沒登入!</span>"; 
					echo "</br>";
					echo "<img src='images/no.png' alt='你還沒登入' width='300px'>";
				}
				?>			
				
			<br /><br />
			網站製作: Robert's shopping mall
			</footer>
			
		

					
		</div>
		
		
	
	
</body>
</html>