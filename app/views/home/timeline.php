<?php foreach ($posts as $post): ?>
    <div class="col-md-6">
        <?php 
            $param = ['post' => $post];
            if ($post["type"] == "youtube-post"):
                renderPlugin('youtube_post', $param);
            elseif ($post["type"] == "twitter-post"): 
                renderPlugin('twitter_post', $param);
            elseif ($post["type"] == "steemit-post"):
                renderPlugin('steemit_post', $param);
            else: 
                renderPlugin('trender_post', $param);
            endif; 
        ?>
    </div>
<?php endforeach; ?>
