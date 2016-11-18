<div class="auth">
	<span style="color: red;"><?=$message_auth?></span>
	<form action="functions.php" method="post" >
		<table>
			<tr>
				<td colspan='2'><input type="text" value="логин" name="login" inherit /></td>
			</tr>
			<tr>
				<td colspan='2'><input type="password" value="пароль" name="password" inherit /></td>
			</tr>
			<tr>
				<td><input type="submit" value="Войти" name="auth"/></td>
				<td><a href="<?=$address?>?view=reg">Регистрация</a></td>
			</tr>
		</table>
	</form>
</div>