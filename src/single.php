<?php
// blog

if (get_post_type() == "post"){
	$template = "blog";
} else {
	$template = "default";
}
?>
<?php require get_template_directory().'/index.php'; ?>
