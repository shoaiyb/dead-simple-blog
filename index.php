<?php
include 'config.php';
include 'Parsedown.php';


if ( !empty($_GET['post']) ) {
	// Single post page
	$post_name = filter_var($_GET['post'], FILTER_SANITIZE_NUMBER_INT);
	$file_path = __DIR__.'/content/'.$post_name.'.txt';
	if ( file_exists($file_path) ) {
		$file = fopen($file_path, 'r');
		$post_title = trim(fgets($file),'#');
		fclose($file);
		// Process the Markdown
		$parsedown = new Parsedown();
		$content = $parsedown->text(file_get_contents($file_path));
	} else {
		$content = '
			<h2>Not Found</h2>
			<p>Sorry, couldn\'t find a post with that name. Please try again, or go to the 
			<a href="'.$base_url.'">home page</a> to select a different post.</p>';
	}
} else {
	// Blog main page - list all posts
	foreach (new DirectoryIterator(__DIR__.'/content/') as $file) {
		if ( $file->getType() == 'file' && strpos($file->getFilename(),'.txt') ) {
			$filename_no_ext = $file->getBasename('.txt');
			$file_path = __DIR__.'/content/'.$file->getFilename();
			$file = fopen($file_path, 'r');
			$post_title = trim(fgets($file),'#');
			fclose($file);
			$content .= '<h2 class="title"><a href="'.$base_url.'?post='.$filename_no_ext.'">'.$filename_no_ext.' - '.$post_title.'</a></h2>';
		}
	}
}

if( isset($blog_disqus) ) {
		$post_url = $base_url . '?post=' . $_GET['post'] ?? '';
		$post_id = md5($post_url);
		$comment = <<<HTML
<div id="disqus_thread"></div>
<script>
    var disqus_config = function () {
        this.page.url = '{$post_url}';
        this.page.identifier = '{$post_id}';
    };
    (function() {
        var d = document, s = d.createElement('script');
        s.src = 'https://{$blog_disqus}.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>
    Please enable JavaScript to view the 
    <a href="https://disqus.com/?ref_noscript" rel="nofollow">
        comments powered by Disqus.
    </a>
</noscript>
HTML;
} else {
		$comment = <<<HTML
		This blog does not offer comment functionality. If you'd like to discuss any of the topics 
		written about here, you can <a href="mailto:{$contact_email}">send an email</a>.
		HTML;
}

$theme = __DIR__ . '/themes/' . $blog_theme . '/theme.php';
if( file_exists($theme) ) {
		require_once $theme;
} else {
	        require __DIR__ . 'themes/default/theme.php';
}
?>
