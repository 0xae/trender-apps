<?php
$this->title = 'Home';
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

                              <li ng-repeat="c in top_categories track by $index" role="presentation" class="">
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
        <div class="col-lg-3">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Category</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.</p>

                    <p>
                        <a class="btn btn-default" href="http://www.yiiframework.com/extensions/">
                            Load More
                        </a>
                    </p>
                </div>

                <div class="col-lg-12">
                    <h2>Type</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.</p>

                    <p>
                        <a class="btn btn-default" href="http://www.yiiframework.com/extensions/">
                            Load More
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <h2>Heading</h2>

            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                fugiat nulla pariatur.</p>

            <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
        </div>

        <div class="col-lg-4">
            <h2>Heading</h2>

            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                fugiat nulla pariatur.</p>

            <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
        </div>
    </div>


</div>
