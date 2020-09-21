<?php $uri = service('uri') ?>
<ol class="breadcrumb float-sm-right">
<?php foreach ($uri->getSegments() as $segment) : ?>
	<?php 
		$url = substr((string)$uri, 0, strpos((string)$uri, $segment)) . $segment;
		$is_active = ($url == (string)$uri);
	?>
	<li class="breadcrumb-item <?php echo $is_active ? 'active': '' ?>">
		<?php if($is_active) : ?>
			<?php echo ucfirst($segment) ?>
		<?php else : ?>
			<a href="<?php echo base_url($url) ?>"><?php echo ucfirst($segment) ?></a>
		<?php endif ?>
	</li>
<?php endforeach ?>
</ol>