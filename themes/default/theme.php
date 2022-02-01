<!DOCTYPE html>
<html>
<head>
	<title><?php if ( !empty($_GET['post']) ) { echo $post_title.' - '; } ?><?php echo $blog_title; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css" />
</head>
<body>
	<header>
		<h1 class="blog-title"><a href="<?= $base_url; ?>"><?= $blog_title; ?></a></h1>
		<hr />
	</header>
	<article>
		<?= $content; ?>
	</article>
	<footer>
		<?= $comment ?>
	</footer>
</body>
</html>
