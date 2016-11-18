<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="=Content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="<?=$meta_desc?>" />
    <meta name="keywords" content="<?=$meta_key?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <link rel="stylesheet" href="css/style.css" />
    <link href='dist/simplelightbox.min.css' rel='stylesheet' type='text/css'>
    <link href='demo.css' rel='stylesheet' type='text/css'>
	<title><?=$title?></title>
</head>
<body>
	<header>
		<h1>Cайт закладів культури с.Осинове</h1>
	</header>
	<div class="left_side">
        <h1 class="logo_text">
            <a href=""><img src="images/selsovet.jpg" width="200" alt=""></a>
            <span>Осинівський СБК</span>
        </h1>
        <!--
        <div class="social_img">
            <a href="#" class="tw_icon"></a>
            <a href="#" class="go_icon"></a>
        </div>
        -->
        <?=$auth_user?>
        <div class="left_menu">
            <ul>
                <?=$menu?>
            </ul>
        </div>
    </div>
    <div class="left_swap">
        <a href="#"><img src="../images/swipe.png" alt=""></a>
    </div>
        <div class="wrapper">
            <div class="text_block">
                <?=$top?>
                <?=$middle?>
                <?=$bottom?>
            </div>
        </div>
	<footer>
		<p>2016 &copy; Created by Hlopjachi Vytrebenky</p>
	</footer>
    <script src="js/jquery-1.12.3.min.js"></script>
    <script src="js/sstu_script.js"></script>
</body>
</html>