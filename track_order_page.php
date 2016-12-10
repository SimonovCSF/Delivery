<?
session_start();
?>
<html>
	<head>	
		<title>Отслеживание</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
		<div id="left">
		<h1 align="center">Отследить заказ</h1>
		<form name="track_order" style="align:center; margin-top:5%;" method="GET" action="http://localhost:5000/track">
				<table border="2" cellpadding="10%" align="center" valign="center">
				<tr> 
					<td align="center">Номер заказа</td>
					<td><input required type="text" name="ordernumber" maxlength="50" size="20"></td>
				</tr>
				<tr><td></td>
					<td><input type="submit" method="Post" value="Заказать!"></td>
				</tr>
				</table>
				<input hidden type="text" name="vkid" value='<?echo $_SESSION['id'];?>'/>
				</form>
				<?echo $_POST['courier_surname']?>
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
				<input class="unselected_switch" type="button" value="Оформление заказа" onClick='location.href="index.php"'><br>
				<input class="selected_switch" type="button" value="Отслеживание заказа" disabled><br>
				<input class="unselected_switch" type="button" value="О нас" onClick='location.href="about.php"'><br>
			</form>
		</div>
	</body>
</html>