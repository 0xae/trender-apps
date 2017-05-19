<?php require_once 'header.php'; ?>
<body tabindex="0" class="b c d e">

<!-- Menu Area -->
<div class="g" id="toggleHeader">
    <div id="toggleHeaderContent" class="h">
        <div class="i">
            <div class="j">
                <span class="k">Welcome to Trender Platform!</span>
            </div>
            <div class="o">
                <a class="p r" href="javascript:void(0)">
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Menu Area -->
<div class="t">
    <div class="u v" role="banner" id="header">
        <form method="get" action="/search/" class="w x">
            <table class="y" role="presentation">
                <tbody>
                    <tr>
                        <td class="z">
                        </td>
                        <td class="be bf">
                            <input class="bg bh bi" name="query" placeholder="Search Posts, Listings, Profiles, Trends, ..." autocomplete="off" autocorrect="off" spellcheck="false" type="text">
                        </td>
                        <td class="z">
                            <input value="Search" type="submit" class="p bj bk bl">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <div role="navigation" class="bm">
            <a class="bn bo bp" href="javascript:void(0)" aria-current="page">Trending Now <sup> <span class="alarm-syrene"></span></sup></a>
            <a class="bn bp" href="javascript:void(0)">Profiles</a>
            <a class="bn bp" href="javascript:void(0)">Recent</a>
            <a class="bn bp" href="javascript:void(0)">Profiles</a>
            <a class="bn bp" href="javascript:void(0)">Settings</a>
        </div>
    </div>
</div>

<!-- Feed Area -->
<div class="f">
    <div id="viewport">

        <div id="objects_container" style="">
            <div class="bq e" id="root" role="main">
                <div id="m_home_notice"></div>
                <div id="m_newsfeed_stream" style="background-color: #fff;">
                    <div id="m-top-of-feed"></div>
                    <div id="posts_container" class="dp dq dr" style="padding:0px;">
                        <div class="ds di" id="posts_loader" style="display:none">
                            <a href="javascript:void(0)" id="load_more_posts">
                                <p style="text-align: center"> <span id="post_count">0</span> new posts comming... </p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="sidebar" style="">
            <?php require_once 'brands.php'; ?>
        </div>

    </div> <!-- .viewport -->
</div> <!-- .f -->

<!-- jquery -->
<script src="static/lib/jquery/jquery-2.1.4.min.js" type="text/javascript"></script>
<script src="static/lib/moment/min/moment.min.js" type="text/javascript"></script>
<script src="static/lib/lodash/lodash.js" type="text/javascript"></script>
<script src="static/app/app.js" type="text/javascript"></script>
<script src="static/app/services/PostService.js" type="text/javascript"></script>
<script src="static/app/services/ProfileService.js" type="text/javascript"></script>
<script src="static/app/controllers/brandController.js" type="text/javascript"></script>
<script src="static/app/controllers/homeController.js" type="text/javascript"></script>
<script src="static/app/controllers/profilesController.js" type="text/javascript"></script>
<script src="static/app/crawlers/picture_update.js" type="text/javascript"></script>

<!--
<script src="static/js/" type="text/javascript"></script>
<script src="static/js/app" type="text/javascript"></script>
-->
</body>
</html>
