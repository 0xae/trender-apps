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
                                <div class="input-group search-btn">
                                  <input type="text" class="form-control" 
                                         ng-model="query"
                                         placeholder="What's happening?" 
                                         aria-describedby="sizing-addon2">
                                  <span ng-click="search(query)" class="input-group-addon search-btn" style="" id="sizing-addon2">
                                    <a href="#">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </a>
                                  </span>
                                </div>
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
                <div class="" style="padding-left: 35px;padding-top:0px;">
                    <h2 class="tr-section-title">by source</h2>
                    <div style="margin:0px;padding:14px;padding-left:5px;padding-top:0px;">
                        <p ng-repeat="cat in type_result" class="tr-category">
                            <a href="#" ng-click="searchByType(cat)" class="category-link">
                               {{cat.key}}
                            </a>
                            <br/>
                            <span class="tr-category-stats">{{cat.value}} posts </span>
                        </p>
                    </div>
                </div>

                <div class="2" style="padding-left: 35px;padding-top:0px;">
                    <h2 class="tr-section-title">By category</h2>
                    <div style="margin:0px;padding:14px;padding-left:5px;padding-top:0px;padding-right:0px;">
                        <p ng-repeat="cat in remain_categories" class="tr-category">
                            <a ng-click="searchByCategory(cat)" href="#" class="category-link">
                               {{cat.key}}
                            </a>
                            <br/>
                            <span class="tr-category-stats">{{cat.value}} posts </span>
                        </p>

                        <p>
                            <a class="tr-category-loadmore" href="http://www.yiiframework.com/extensions/">
                                Load More
                            </a>
                        </p>
                    </div>
                </div>

        </div>

        <div class="col-lg-9" style="margin-top:20px;">
          <!-- 
           <div class="col-md-4 pull-right " style="margin-top:0px;">
                <h2 class="tr-section-title" style="margin-top:0px;">Trender Tv</h2>
                <iframe id="ytplayer" type="text/html" width="400" height="260"
                  src="https://www.youtube.com/embed/hX3j0sQ7ot8autoplay=0&origin=http://example.com"
                  frameborder="0">
                </iframe>
            </div>
            -->
            <div class="col-md-4" style="padding:0px;margin-bottom:06px;padding-bottom:0px;" ng-repeat="post in posts" >
                <div ng-if="post.type == 'twitter-post'">
                    <twitter-post  p="post">
                    </twitter-post>
                </div>

                <div ng-if="!(post.type == 'twitter-post')">
                    <trender-post  p="post">
                    </trender-post>
                </div>
            </div>
        </div>
    </div>


</div>
