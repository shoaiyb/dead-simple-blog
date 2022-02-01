<!DOCTYPE html>
<html>
<head>
	<title><?php if ( !empty($_GET['post']) ) { echo $post_title.' - '; } ?><?php echo $blog_title; ?></title>
	<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Trirong">
	<link rel="stylesheet" href="<?= $blog_url ?>themes/rare/css/style.css" />
</head>
<body>
	<header>
		<h1 class="title"><a href="<?= $base_url; ?>"><?= $blog_title; ?></a></h1>
		<hr />
	</header>
	<article class="content">
		<?= $content; ?>
	</article>
	<footer class="footer">
		<?= $comment ?>
	</footer>
</body>
</html>
