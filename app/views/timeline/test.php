<?php
$this->title = 'Testing stuff';
?>

<div class="dummy" id="data-container">
</div>

<script>
requirejs(['trender/app', 'vue', 'jquery'], function(app, Vue, $) {
    $.get("./index.php?r=timeline/data")
    .then(function (data) {
        var json = JSON.parse(data);
        $("#data-container").prepend(json.html);
        new Vue({
            el: '#'+json.id,
            data: {
                content: 'hello there this is test. 1 2 3'
            },
            methods: {
                log: function (arg) {
                    console.info(arg);
                }
            }
        });
    });
});
</script>
