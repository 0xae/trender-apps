<?php
$this->title = 'Trender Home';
?>

<style>
.tr-header {
    background: url(static/img/marketplace.webp) no-repeat;
    background-position: 89% 58%;
    background-size: cover;
}

.tr-top-title {
    color: #fff;
    margin:0px;
    padding: 5px;
    text-shadow:0px 0px 4px #000;
    font-weight: bold;
}
.tr-top-menu {
}

.tr-top-menu li {
    margin:0px;
    padding-left:12px;
    
}

.tr-top-menu li a.top-link:hover,
.tr-top-menu li a.top-link:focus
{
    background-color: #337ab7;
}

.tr-top-menu li a.settings-link:hover,
.tr-top-menu li a.settings-link:focus
{
    background-color: transparent;
}

.tr-top-menu li a {
    padding:4px;
    padding-left:6px;
    padding-right:6px;
    font-size:12px;
    margin:0px;
    color: #fff;
    border-radius:0px;
}

.tr-outside {
    background-color: #EEE; /*to make it visible*/
    height: 200px;
}
.tr-inside {
    position: relative;
    height: 200px;
    top: 67%;
}
.row {
}

.search-btn .input-group-addon{
    border-top: 1px solid transparent;
    -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, .1);
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, .1);
    color: #fff;
    background-color:#d43b03;
    border:1px solid #000;
}

.search-btn .input-group-addon a{
    color: #fff;
}

.search-btn input {
    background-color: rgba(19, 10, 0, 0.9);
    border:0px;
    font-size:13px;
    color: #999;
}

.search-area {
    margin-top:70px;
    margin-bottom:50px;
}

.category-link {
    font-weight: bold;
}
a.category-link:hover,
a.category-link:focus,
a.category-link:hover {
    font-weight: bold;
    text-decoration: none;
}
a.category-link:visited {
    font-weight: bold;
    text-decoration: underline;
}
.tr-category-stats {
    color: #ccc;
    font-size: 12px;
}
.tr-section-title {
    font-size:16px;
    font-weight: bold;
}
.tr-category-loadmore {
    font-size: 12px;
}
.tr-category {
    margin:0px;
    margin-bottom: 6px;
}
.tr-type-log label {
    font-size: 12px;
    padding: 2px;
    padding-left: 8px;
    padding-right: 8px;
}
.tr-search-results-count{
    color: #999;
    margin:0px;
    padding: 0px;
    font-weight: bold;
    font-size: 12px;
    border:0px;
    margin-bottom: 20px;
}
</style>

<div ng-controller="HomeController">
    <div class="row tr-header" style="">

        <div class="col-md-12" style="">
             <div class="tr-outside tr-header" style="height:0px">
                <div class="tr-inside" style="height:0px;">
                    <div class="row" style="">
                        <div class="col-md-12 search-area" style="">
                            <div class="col-md-4"> </div>
                            <div class="col-md-4" style="background:transparent;">
                                <h2 class="tr-top-title">#Welcome to Trender</h2>
                                <form ng-submit="search(query)" name="searchForm" id="searchFormId">
                                        <div class="input-group search-btn">
                                              <input type="text" class="form-control" 
                                                     ng-model="query"
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
                            <div class="col-md-4"> </div>
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
        <div class="col-lg-2">
                <div class="2" style="padding-left: 20px;padding-top:0px;">
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
        <div class="col-lg-10" style="margin-top:10px;padding:0px">
            <div ng-if="total_found"  class="pull-left tr-search-results-count">
                About {{total_found}} results found
                <br/>
                Showing {{total_fetched}} 
                <br/>
                <!-- 
                Popularity <span style="padding-bottom:-4px;font-size:10px" class="glyphicon glyphicon-signal text-success"></span>
                <br/>
                -->
            </div>

            <div class="pull-right" style="margin-right:35px;">

                <img src="static/img/steemit-196x196.png" style="display:inline;width:25px;height:25px;" />
                <img src="static/img/twitter-192x192.png" style="display:inline;width:25px;height:25px;" />
                <img src="static/img/youtube-medium.png" style="display:inline;width:25px;height:25px;" />
                <span style="color: #fff;font-weight:bold;font:verdana; background-color: #000;padding-left:3px;padding-right:3px;display:inline;">
                B B <span style="color:orangered;">C</span>
                </span>

            </div>
        </div>

        <div class="col-lg-9" style="margin-top:10px;">

            <div class="row">
                <div class="col-md-4" ng-switch on="post.type"
                    style="padding:0px;padding-bottom:0px;" 
                    ng-repeat="post in posts" >
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
    </div>


</div>
