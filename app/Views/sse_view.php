<script>
var source = new EventSource("<?= base_url('/stream') ?>");
source.onmessage = function(event) {
    var jdata = JSON.parse(event.data);
    console.log(jdata);
    //console.log(event.data);
};
</script>