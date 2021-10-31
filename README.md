# rwd_cookie_forum_website
這個防災購物網站, 我沒有套模板, 大部分的CSS都是自己寫的!! 

▲RWD>>		我有用media query, 把網站做成RWD響應式網頁, 讓手機使用者也可以放心的上下滑動. (first2.css)

▲登入>>	使用SESSION來記錄登入和登出 (login.php) <br/>
▲註冊>>	使用者輸入帳號密碼和個人資料後, 會把資料匯入rwd_shop的user裡面. (register.php)<br/>
▲留言板>>	我有用COOKIE紀錄留言的比數, 然後以每三筆的方式由新到舊顯示. 增加新留言後也會馬上更新. (forum.php)<br/>
▲防災教育>>	告訴使用者防災的相關資訊. (disaster.php)<br/>


--登入後--<br/>
▲右側浮動選單有 "購物車" ,使用者買完的東西會用COOKIE 記錄在裡面.<br/>

▲訂單>>	把使用者的訂單select印出來, 若還沒有訂單會請使用者去商店購買商品的圖示出現. (order.php)<br/>
▲會員>>	把會員資訊select印出來.  (member.php)<br/>
▲商場>>	選想要的商品, 輸入商品數量, 點選加入後, 就會用COOKIE顯示在購物車裡面!! (shop.php)<br/>

▲購物車>>	在購物車裡面可以點選 "X" 刪除不要的商品, 也可以按下送出鍵, 把訂單傳入資料庫並且進入訂單的頁面. (cart.php)<br/>


★新增新商品>>	當登入的帳號密碼都是打 "admin" 時, 進入商場會多出一個"新增新商品" 的按鈕, 
		點選進入後可以新增商品圖片、商品名稱、商品價錢, 當顯示新增成功後, 使用者進入商城就可以購買該項商品. (add_product.php)
## Main page in desktop
This is the page looks like in desktop.
![](https://github.com/a1233z/rwd_cookie_forum_website/blob/3667e267a06b63273b71d4633b499168a1a694b5/github_images/0.png)
## Main page in mobile phone with RWD
This is the page looks like in mobile phone with RWD.

![](https://github.com/a1233z/rwd_cookie_forum_website/blob/3667e267a06b63273b71d4633b499168a1a694b5/github_images/7.png)

## Login page
![](https://github.com/a1233z/rwd_cookie_forum_website/blob/3667e267a06b63273b71d4633b499168a1a694b5/github_images/1.png)

## Shopping page
![](https://github.com/a1233z/rwd_cookie_forum_website/blob/master/github_images/2.png)
![](https://github.com/a1233z/rwd_cookie_forum_website/blob/3667e267a06b63273b71d4633b499168a1a694b5/github_images/3.png)

## Order page
![](https://github.com/a1233z/rwd_cookie_forum_website/blob/master/github_images/4.png)

## Add products page
![](https://github.com/a1233z/rwd_cookie_forum_website/blob/master/github_images/5.png)

## Membership page
![](https://github.com/a1233z/rwd_cookie_forum_website/blob/master/github_images/6.png)

## Register page
![](https://github.com/a1233z/rwd_cookie_forum_website/blob/master/github_images/8.png)
