<?php
	include ("connect_database.php");

	// 建立與MySQL資料庫的連線
	$link = mysqli_connect($hostname, $username, $password, $database) OR die("Error: Unable to connect to MySQL.");
	// 設定編碼方式為UTF-8
	// 另一種寫法	mysqli_query($link, "SET NAMES utf8");
	mysqli_set_charset($link, "utf8");
	
	
	$query3 = "select * from `product` ORDER BY `id` DESC;";
	$result3 = mysqli_query($link, $query3) or die("Connect DB Table Error!");
	
	while ($row=mysqli_fetch_array($result3))
	{
		$i=$row['id'];//取得商品裡面最大的ID值
		Setcookie("count", "".$i."", time()+3600);
		break;
	}
	
	for($j=1;$j<=$i;$j++)
	{
		if(isset($_POST["buy".$j.""]))//若按下"加入"按鈕, 就進來
		{
			Setcookie("names".$j."", "".$_POST["names".$j.""]."", time()+3600);	//Setcookie 商品名字
			Setcookie("price".$j."", "".$_POST["price".$j.""]."", time()+3600);	//Setcookie 商品價錢	
			Setcookie("text".$j."", "".$_POST["text".$j.""]."", time()+3600);	//Setcookie 商品數量
				
		}
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
					session_start();//session開始
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
			

			<h1 id="h1">購物商場</h1>
			
			
	

			<aside class="forum">
			
			
			<span class="font2"> <?php echo "姓名 : "; ?> </span>
									
			<?php 	
				
				if(isset($_SESSION['judgement'])&&isset($_COOKIE["name"])) //判斷是否登入
				{					
					echo "<span class='blue'>".$_COOKIE["name"]."</span>"; 
					echo "<br /><br />"; 
					echo "<span class='font1'>請搜尋你要尋找商品的關鍵字</span>"; 
				}
				else 
				{
					echo "<span class='blue'>你還沒登入!</span>"; 
				}
				
			?>
			
			<center>		
				<form action="" method="POST">
				<input type="text" name="Keyword" >	
				<br />
				<button type="submit" name="submit" value="submit" 
				style="width: 80px; padding: 5.5px; margin-top: 6px;" class="bt"><span>搜尋</span></button>
				</form>
			</center>
			
			<?php			
				if(isset($_SESSION['judgement'])&&isset($_COOKIE["name"])) //判斷是否登入
				{
					echo "<br /><br />"; 
					echo "<form action='cart.php' method='post'>";//前往購物車頁面
					echo "<button type='submit' name='submit' value='submit' class='bt' 
					style='background: #930000;  width: 155px;'><span>前往購物車</span></button>";
					echo "</form>";	
					
					if($_COOKIE["user1"]=="admin") 
					{
						echo "<br />"; 
						echo "<form action='add_product.php' method='post'>";//前往新增新商品頁面
						echo "<button type='submit' name='submit' value='submit' class='bt' 
						style='background: #930000;  width: 155px;'><span>新增新商品</span></button>";
						echo "</form>";	
					}
				}				
			?>
			</aside>
			
			
			
			
			<article class="shop">
				
			<?php
				
				if(isset($_SESSION['judgement'])&&isset($_COOKIE["name"])) //判斷是否登入
				{					
					echo "<span class='font1'>以下是商品的價目表</span>"; 
					
					$names=array();//宣告陣列
					$price=array();//宣告陣列
					$id=array();//宣告陣列
				
					if (isset($_POST["Keyword"]))//若有按下搜尋的按鈕, 判斷是否存在$_POST["Keyword"]
					{
						$Keyword = $_POST['Keyword'];
						echo "你要搜尋的商品名稱 : ".$Keyword;
						
						$query = "select * from `product` where `name` like '%".$Keyword."%';";//關鍵字不管出現在前面或後面都SELECT
						$result = mysqli_query($link, $query) or die("Connect DB Table Error!");
						
						
					}
					else
					{
						$query = "select * from `product` ;";//若沒有按下搜尋, 就SELECT全部的商品
						$result = mysqli_query($link, $query) or die("Connect DB Table Error!");
					}
					
					echo "<center><table>";
					//表格第一行作為說明
					echo "<tr>";
					echo "<td bgcolor='#f3e5e2'>"; 
					echo "id";
					echo "</td>";
					echo "<td bgcolor='#FFE8E8'>"; 
					echo "商品名";
					echo "</td>";
					echo "<td bgcolor='#FFDEDE'>";
					echo "價格";
					echo "</td>";
					echo "</tr>";
					
					$i=0;
					while ($row=mysqli_fetch_array($result))
					{
						echo "<tr>";
						echo "<td bgcolor='#f3e5e2'>"; 
						echo $row['id'];

						$id[]=$row['id'];//把id傳進陣列裡
						echo "</td>";
						echo "<td bgcolor='#FFE8E8'>"; 
						echo $row['name'];

						$names[]=$row['name'];//把name傳進陣列裡
						echo "</td>";
						echo "<td bgcolor='#FFDEDE'>";
						echo $row['price'];
						$price[]=$row['price'];//把price傳進陣列裡
		
						echo "</td>";
						echo "</tr>";
						$i++;
					}
					echo "</table></center>";
					
				}
				else 
				{
					echo "<img src='images/no.png' alt='你還沒登入' width='300px'>";
				}
				
				
			?>
			</article>
			
			
			
			<footer>
			
			<?php
			if(isset($_SESSION['judgement'])&&isset($_COOKIE["name"])) //判斷是否登入
			{
				
				
				echo "<form action='' method='post'>";
				echo "<ul>";
				for($j=0;$j<$i;$j++)
				{
				
					echo "<li class='product'>";
					echo "<a href='#'><img src='images/".$id[$j].".jpg' alt='' width='300' height='350'></a> <br />";//把images資料夾裡面的商品圖片顯示出來
					echo "".$names[$j]."";//把商品名稱顯示出來
					
					echo "<br />";
					echo "數量: ";
					echo "<input type='text' name='text".$id[$j]."'>";	//讓使用者輸入商品的數量
					echo "<input type='hidden' name='price".$id[$j]."' value='".$price[$j]."'/> ";//商品的價錢
					echo "<input type='hidden' name='names".$id[$j]."' value='".$names[$j]."'/> ";//商品的名稱
					echo "<br />";
					
					echo "<input type='hidden' name='count' value='".$i."'/> ";//總共有多少樣商品
					echo "<button type='submit' name='buy".$id[$j]."' value='submit' class='bt' 
					style=' margin-top: 6px; margin-bottom: 6px;'><span>加入</span></button>";//按鈕避免重複, 也是用id來命名

					echo "</li>";
						
					
				}
				echo "</ul>";
				
				
				// 釋放結果集($result)所佔用的記憶體。(若無釋放，程式可能會錯誤，尤其是用"SELECT ..."的時候)
				mysqli_free_result($result);
				mysqli_free_result($result3);
				// 關閉與MySQL資料庫的連線
				mysqli_close($link);
				
				echo "</form>";
			}
			?>
			</footer>
			
			<footer>
			
			
			<br /><br />
			網站製作: Robert's shopping mall
			
			</footer>		

					
		</div>
		
		
	
	
</body>
</html>