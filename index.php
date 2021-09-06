<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
<!--  讓網頁不會自動因手機螢幕變小而扭曲，使得RWD網頁能正常執行-->
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
	/* 輪播照片,不是自己寫的,來源:https://www.cnblogs.com/LIUYANZUO/p/5679753.html*/
	window.onload = function() {
            var container = document.getElementById('container');
            var list = document.getElementById('list');
            var buttons = document.getElementById('buttons').getElementsByTagName('span');
            var prev = document.getElementById('prev');
            var next = document.getElementById('next');
            var index = 1;
            var timer;

            function animate(offset) {
                //获取的是style.left，是相对左边获取距离，所以第一张图后style.left都为负值，
                //且style.left获取的是字符串，需要用parseInt()取整转化为数字。
                var newLeft = parseInt(list.style.left) + offset;
                list.style.left = newLeft + 'px';
                //无限滚动判断
                if (newLeft > -1080) {
                    list.style.left = -5400 + 'px';
                }
                if (newLeft < -5400) {
                    list.style.left = -1080 + 'px';
                }
            }

            function play() {
                //重复执行的定时器
                timer = setInterval(function() {
                    next.onclick();
                }, 4750)
            }

            function stop() {
                clearInterval(timer);
            }

            function buttonsShow() {
                //将之前的小圆点的样式清除
                for (var i = 0; i < buttons.length; i++) {
                    if (buttons[i].className == "on") {
                        buttons[i].className = "";
                    }
                }
                //数组从0开始，故index需要-1
                buttons[index - 1].className = "on";
            }

            prev.onclick = function() {
                index -= 1;
                if (index < 1) {
                    index = 5
                }
                buttonsShow();
                animate(1080);
            };

            next.onclick = function() {
                //由于上边定时器的作用，index会一直递增下去，我们只有5个小圆点，所以需要做出判断
                index += 1;
                if (index > 5) {
                    index = 1
                }
                animate(-1080);
                buttonsShow();
            };

            for (var i = 0; i < buttons.length; i++) {
                (function(i) {
                    buttons[i].onclick = function() {

                        /*   这里获得鼠标移动到小圆点的位置，用this把index绑定到对象buttons[i]上，去谷歌this的用法  */
                        /*   由于这里的index是自定义属性，需要用到getAttribute()这个DOM2级方法，去获取自定义index的属性*/
                        var clickIndex = parseInt(this.getAttribute('index'));
                        var offset = 1080 * (index - clickIndex); //这个index是当前图片停留时的index
                        animate(offset);
                        index = clickIndex; //存放鼠标点击后的位置，用于小圆点的正常显示
                        buttonsShow();
                    }
                })(i)
            }

            container.onmouseover = stop;
            container.onmouseout = play;
            play();

        }


	
	
	
	</script>
	<!--END:插入TOP套件-->



</head>


<!--下面全部都是自己寫的!!-->
<body id="bg">
	
		<!--返回最上面的按鈕-->
		<div id='gotop'><center>^</center></div>
		
		<div >
			
			<!--右邊的飄浮選單,CSS裡面的語法有上網查然後自己改的唷~~-->
			
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
			
			
		
			<div class="gallery" style="width: 50px; border: 1.5px solid #c33;">
				<span class="shop_font" style="font-size: 28px;">必買商品推薦 </span>
			</div>
			
			<div class="gallery">
			  <a href="shop.php">
				<img src="images/4.jpg" alt="Cinque Terre" width="600" height="400">
			  </a>			  
			  <span class="shop_font">雨衣 </span>
			</div>

			<div class="gallery">
			  <a href="shop.php">
				<img src="images/3.jpg" alt="Forest" width="600" height="400">
			  </a>
			  <span class="shop_font">防災器具 </span>
			</div>

			<div class="gallery">
			  <a href="shop.php">
				<img src="images/1.jpg" alt="Northern Lights" width="600" height="400">
			  </a>
			  <span class="shop_font">防災背包 </span>
			</div>

			<div class="gallery">
			  <a href="shop.php">
				<img src="images/2.jpg" alt="Mountains" width="600" height="400">
			  </a>
			  <span class="shop_font">防災手錶 </span>
			</div>
			
			<div class="gallery">
			  <a href="shop.php">
				<img src="images/7.jpg" alt="Mountains" width="600" height="400">
			  </a>
			  <span class="shop_font">手電筒 </span>
			</div>
			<div class="gallery" style="width: 50px; border: 1.5px solid #c33;">
				<span class="shop_font" style="font-size: 28px;">必買商品推薦 </span>
			</div>
			
			
			<div id="container">
				
				<div id="list" style="left: -1080px;">
					<img src="https://sourceable.net/wp-content/uploads/2019/11/Safety-first-1000x600.jpg" alt="1" />
					<img src="images/Family_safity2.jpg" alt="2" />
					<img src="images/Family_safity3.jpg" alt="3" />
					<img src="images/safety_first.jpg" alt="4" />
					<img src="images/SAFETY.jpg" alt="5" />
					<img src="images/Family_safity.jpg" alt="1" />
				</div>
				<div id="buttons">
					<span index="1" class="on"></span>
					<span index="2"></span>
					<span index="3"></span>
					<span index="4"></span>
					<span index="5"></span>
				</div>
				<a href="javascript:;" id="prev" class="arrow">&lt;</a>
				<a href="javascript:;" id="next" class="arrow">&gt;</a>

			</div>
			
			
			
			<aside class="index">
				<img src="images/girl.png" >
			</aside>
			
			<article>
				<h1>安全是人人都必須注重的事情！</h1>				
				<h2>在這裡您可以買到防災用具和各種與安全有關的物品，祝福大家長命百歲，萬事平安。</h2>
			</article>
			
			
			<footer>網站製作: Robert's shopping mall</footer>		

			
			
		</div>
		
		
</body>
</html>