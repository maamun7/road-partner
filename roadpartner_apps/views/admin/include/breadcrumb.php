<?php 

//print_r($breadcrumbs);exit;
?>

<ol class="breadcrumb">
	{breadcrumbs}
		<li class="{class}"><a href="<?=base_url()?>{url}" title="{title}">{label}</a></li>
	{/breadcrumbs}
</ol>