<?php
$this->title = 'Trender Home';

function renderPlugin($plugin, $params=[]) {
    echo \Yii::$app->view->renderFile(
        "@app/views/plugins/$plugin.php",
        $params
    ); 
}

?>

<div ng-controller="HomeController">
    <div class="row tr-header" style="">

        <div class="col-md-12">
             <div class="tr-outside tr-header" style="height:0px">
                <div class="tr-inside" style="height:0px;">
                    <div class="row" style="">
                        <div class="col-md-12 search-area" style="">
                            <div class="col-md-4"> </div>
                            <div class="col-md-4" style="background:transparent;">
                                <h2 class="tr-top-title">#Welcome</h2>
                                <form ng-submit="search(query)" name="searchForm" id="searchFormId">
                                        <div class="input-group search-btn">
                                              <input type="text" class="form-control" 
                                                     ng-model="query"
                                                     accesskey="s"
                                                     ng-submit="search(query)"
                                                     placeholder="What's happening?" 
                                                     aria-describedby="sizing-addon2" />
                                              <span ng-click="search(query)" class="input-group-addon search-btn" style="" id="sizing-addon2">
                                                    <a href="#">
                                                        <span class="glyphicon glyphicon-search"></span>
                                                    </a>
                                              </span>
                                        </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-12">
                        </div>
                        <div class="col-md-12" style="margin:0px;";>
                            <h2 class="tr-top-title">{{search_topic}}</h2>
                        </div>
                        <div class="col-md-12" style="background-color:rgba(0,0,0,.6);padding-top:0px;">
                            <ul class="nav nav-pills tr-top-menu">

                              <li role="presentation" ng-click="search(query)" class="active">
                                <a class="top-link" href="#">
                                    <span class="glyphicon glyphicon-home"></span>
                                </a>
                              </li>

                              <li ng-repeat="c in top_categories track by $index" 
                                  ng-click="searchByCategory(c)" 
                                  role="presentation" class="">
                                <a class="top-link" href="#">
                                    {{c.key}}
                                    <span class="badge-primary"
                                        style=""><strong>{{c.value}}</strong></span>
                                </a>
                              </li>

                              <li role="presentation" class="pull-right">
                                <a href="#" class="settings-link">
                                    <span class="glyphicon glyphicon-cog"></span>
                                </a>
                              </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- /.row -->


    <div class="row">
        <div class="col-lg-8" style="min-height:800px;margin-top:0px;padding:40px;padding-top:15px;border:1px solid #e1e6ea;">
            <div class="row" id="trender_timeline">
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
            </div>
        </div>

        <div class="col-md-4" style="padding: 10px;padding-right:0px;">
            <div class="col-md-12" style="margin-bottom: 20px;">
                <?php 
                    echo \Yii::$app->view->renderFile('@app/views/plugins/twitch_widget.php', []); 
                ?>
            </div>

            <div class="col-md-12" style="margin-bottom: 20px;">
                <?php 
                    echo \Yii::$app->view->renderFile('@app/views/plugins/coins_widget.php', []); 
                ?>
            </div>

            <div class="col-md-10" style="margin-bottom: 30px;">
                <?php 
                    echo \Yii::$app->view->renderFile('@app/views/plugins/bitcoin_newsfeed.php', []); 
                ?>
            </div>
        </div>
    </div>

</div>
