<?
session_start();
?>
<html>
	<head>	
		<title>О нас</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
		<div id="left">
			<h1 align="center">О нас</h1>
			<form name="contacts_data" style="align:center; margin-top:5%;">
				<table cellpadding="10%" align="center">
					<tr>
						<td><a href="https://vk.com/e.i.simonov"><img class="photo" src="images/Evgeny.jpg" width="200pt"></a></td>
						<td><a href="https://vk.com/berdoleg"><img class="photo" src="images/Oleg.jpg" width="200pt"></a></td>
					</tr>
					<tr  style="font-size:150%; text-align:center;">					
						<td>Евгений Симонов</td>
						<td>Олег Бердников</td>
					</tr>				
				</table>
				<font size="4">Простые и душевные ребята, которые, вполне возможно, позднее вставят сюда какой-нибудь нормальный текст о себе.</font>
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
				<input class="unselected_switch" type="button" value="Оформление заказа" onClick='location.href="index.php"'><br>
				<input class="unselected_switch" type="button" value="Отслеживание заказа" onClick='location.href="track_order_page.php"'><br>
				<input class="selected_switch" type="button" value="О нас" disabled><br>
			</form>
		</div>
	</body>
</html>