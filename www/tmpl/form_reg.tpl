<center>
	<h3>Регистрация</h3>
	<?=$message?>
	<div id="reg">
		<form action="functions.php" method="post" name="reg">
			<table>
			<tr>
				<td>Логин:</td>
				<td><input type="text" name="login" value="<?=$login?>" /></td>
			</tr>
			<tr>
				<td>Пароль:</td>
				<td><input type="password" name="password" value="" /></td>
			</tr>
			<tr>
				<td>e-mail:</td>
				<td><input type="text" name="email"></td>
			</tr>
			<tr>
				<td colspan="2" align="right">
					<img src="captcha.php" alt="Каптча" />
				</td>
			<tr>
				<td>Проверочный код:</td>
				<td><input type="text" name="captcha" /></td>
			</tr>
			
			<tr>
				<td colspan="2">
					<input type="submit" value="Зарегистрироваться" name="reg"/>
				</td>
			</tr>
			
		</table>
		</form>
	</div>
</center>