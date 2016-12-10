<? session_start(); ?>
<html>
	<head>	
		<title>Новый заказ</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
		<div id="left">
			<h1 align="center">Новый заказ</h1>
			<form name="delivery_data" style="align:center; margin-top:5%;" method="POST" action="http://127.0.0.1:5000/NewOrder">
				<table cellpadding="10%" align="center" valign="center">
				<tr> 
					<td align="center">Привезите мне:</td>
					<td><input required type="text" name="name" maxlength="50" size="20" pattern="^[A-Za-zА-Яа-яЁё]+$"></td>
				</tr>
				<tr>
					<td align="center">Забрать по адресу (если знаете):</td>
					<td><input type="text" name="adress_from" maxlength="50" size="20"></td>
				</tr>
				<tr> 
					<td align="center">Мой адрес:</td>
					<td><input required type="text" name="adress_to" maxlength="50" size="20"></td>
				</tr>
				<tr> 
					<td align="center">Число и время доставки (число и месяц):</td>
					<td><input required type="date" name="date" maxlength="50" size="20" pattern="^[0-9]{1,2}\s(января|февраля|марта|апреля|мая|июня|августа|сентября|октября|ноября|декабря)$"></td>
				</tr>
				<tr> 
					<td align="center">Мой телефон:</td>
					<td><input required type="text" name="phone" maxlength="22" size="20" pattern="^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$"></td>
				</tr><tr> 
						
					<td align="center">Уже купил</td>
					<!--<td><input type="checkbox" name="already_paid" maxlength="50" size="20"></td>-->
					<td><input name='already_paid' type='hidden' value='0'>
					<input name='already_paid' type='checkbox' value=1></td>
				</tr>				
				<tr> 
					<td align="center" valign="top">Примечания:</td>
					<td><textarea name="comment" cols="35" rows="10"></textarea></td>
				</tr>
				<tr><td></td>
					<td><input type="submit" method="Post" value="Заказать!"></td>
				</tr>
				</table>
				<input hidden type="text" name="user_id" value='<?echo $_SESSION['id'];?>'/>
			</form>
		</div>
		<div id="right">
			<div align="center">
				<style> .photo_round { border-radius: 100%; box-shadow: 0 0 7px #666; } </style>
				<?
				
				if ($_SESSION['fn']!="")
				{
					echo '<br><img width="150pt" src="'.$_SESSION['photo'].'" class="photo_round" alt="'.$_SESSION['id'].'">';
					echo '<div style="font-size:14pt;">';
					echo ''.$_SESSION['fn'].' '.$_SESSION['ln'].'';
					echo '</div>';
					echo '<a href="exit.php" style="text-decoration:none;">';
					echo '<div style="color:black;">logout</div></a>';
				} 
				else
				{
					echo '<br><br><br><br>login with:';
					echo '<a href=https://oauth.vk.com/authorize?client_id=5680202&display=page&redirect_uri=http://pr/vk.php&scope=friends&response_type=code&v=5.59><p><input type="image" src="images/logo-vk.png" width="25px" height="25px" name="submit" value="AuthVK"></p></a>';
				}
				?>
			</div>
			<form name="pages_switch" style="position:absolute; align:center; top:40%; left:20%; right:20%;">				
				<input class="selected_switch" type="button" value="Оформление заказа" disabled><br>
				<input class="unselected_switch" type="button" value="Отслеживание заказа" onClick='location.href="track_order_page.php"'><br>
				<input class="unselected_switch" type="button" value="О нас" onClick='location.href="about.php"'><br>
			</form>
		</div>
	</body>
</html>