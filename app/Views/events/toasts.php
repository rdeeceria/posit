<script type="text/javascript">
window.onload = function() {
  $(document).Toasts('create', {
      class: '<?= esc($class); ?>',
      autohide: <?= esc($autohide); ?>,
      delay: <?= esc($delay); ?>,
      title: '<?= esc($title); ?>',
      subtitle: '<?= esc($subtitle); ?>',
      body: '<?= esc($body); ?>',
      icon: '<?= esc($icon); ?>',
      image: '<?= esc($image); ?>',
      imageAlt: '<?= esc($imageAlt); ?>'
  });
};
</script>