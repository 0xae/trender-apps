<?php
$this->title = 'Trender Home';
?>

<div ng-controller="HomeController">
    <div class="row tr-header" style="">

        <div class="col-md-12" style="">
             <div class="tr-outside tr-header" style="height:0px">
                <div class="tr-inside" style="height:0px;">
                    <div class="row" style="">
                        <div class="col-md-12 search-area" style="">
                            <div class="col-md-4"> </div>
                            <div class="col-md-4" style="background:transparent;">
                                <h2 class="tr-top-title">Welcome to Trender</h2>
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
        <!-- 
        <div class="col-lg-2">
                <div class="2" style="padding-left: 20px;padding-top:0px;padding-right:50px;">
                    <h2 class="tr-section-title">categories</h2>
                    <div style="margin:0px;padding:14px;padding-left:5px;padding-top:0px;padding-right:0px;">
                        <div ng-repeat="cat in remain_categories" class="tr-category">
                            <a ng-click="searchByCategory(cat)" href="javascript:void(0)" class="category-link">
                               {{cat.key}}
                            </a>

                            <span class="pull-right tr-category-stats">{{cat.value}} posts {{ cat.percent }}</span>

                            <div class="progress" style="height: 3px;margin-top:7px;">
                              <div class="progress-bar progress-bar-striped active" 
                                  role="progressbar" 
                                  aria-valuenow="0" 
                                  aria-valuemin="0" 
                                  aria-valuemax="100" style="width: {{cat.value}}%">
                              </div>
                            </div>
                        </div>

                        <p>
                            <a class="tr-category-loadmore" href="http://www.yiiframework.com/extensions/">
                                Load More
                            </a>
                        </p>
                    </div>
                </div>

        </div>
        -->

        <div class="col-lg-8" style="margin-top:10px;padding:40px;padding-top:0px;">
            <div class="row">
                <div class="col-md-6" ng-switch on="post.type"
                    ng-repeat="post in posts">
                    <div ng-switch-when="twitter-post">
                        <twitter-post p="post">
                        </twitter-post>
                    </div>

                    <div ng-switch-when="youtube-post">
                        <youtube-post p="post">
                        </youtube-post>
                    </div>

                    <div ng-switch-default>
                        <trender-post p="post">
                        </trender-post>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4" style="padding: 10px;padding-right:0px;">
            <h3 style="margin-top:2px;">Broadcast</h3>
            <div class="col-md-12" style="margin-bottom: 20px;margin-left:10px;">
                <?php 
                    echo \Yii::$app->view->renderFile('@app/views/plugins/twitch_widget.php', []); 
                ?>
            </div>

            <h3 style="margin-top:2px;">Markets</h3>
            <div class="col-md-12" style="margin-bottom: 20px;margin-left:10px;">
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
