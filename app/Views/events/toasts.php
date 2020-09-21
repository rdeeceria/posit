<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
  $(document).Toasts('create', {
    class: "<?= esc($class); ?>",
    autohide: <?= esc($autohide); ?>,
    delay: <?= esc($delay); ?>,
    title: "<?= esc($title); ?>",
    subtitle: "<?= esc($subtitle); ?>",
    body: "<?= esc($body); ?>",
    icon: "<?= esc($icon); ?>",
    image: "<?= esc($image); ?>",
    imageAlt: "<?= esc($imageAlt); ?>"
  });
});
</script>