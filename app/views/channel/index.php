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
                                <h2 class="tr-top-title">#Welcome to Trender</h2>
                                <form ng-submit="search(query)" name="searchForm" id="searchFormId">
                                        <div class="input-group search-btn">
                                              <input type="text" class="form-control" 
                                                     ng-model="query"
                                                     accesskey="s"
                                                     ng-submit="search(query)"
                                                     placeholder="Search on My Channel" 
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

                        <div class="col-md-12" style="margin-left:10px;margin-bottom:5px;">
                            <div class="media">
                              <div class="media-left" style="padding-right:0px;">
                                    <a href="javascript:void(0)">
                                          <img style="border:2px solid #fff;border-radius:4px" 
                                            class="media-object" src="static/img/VR.jpg" 
                                            alt="Foto of {{p.authorName}}" 
                                            width="35" height="35"
                                          />
                                    </a>
                              </div>

                              <div class="media-body">
                                <h4 class="tr-top-title">
                                    My Channel
                                </h4>
                                <p class="tr-outdoor-content">
                                    <span class="glyphicon glyphicon-time"></span>
                                    07 Aug 2017
                                </p>
                              </div>
                            </div>
                        </div>

                        <div class="col-md-12" style="background-color:rgba(0,0,0,.6);padding-top:0px;">
                            <ul class="nav nav-pills tr-top-menu">

                              <li role="presentation" ng-click="search(query)" class="active">
                                <a class="top-link" href="#">
                                    <span class="glyphicon glyphicon-home"></span>
                                </a>
                              </li>

                             <!-- 
                              <li ng-repeat="c in top_categories track by $index" 
                                  ng-click="searchByCategory(c)" 
                                  role="presentation" class="">
                                <a class="top-link" href="#">
                                    {{c.key}}
                                    <span class="badge-primary"
                                        style=""><strong>{{c.value}}</strong></span>
                                </a>
                              </li>
                              -->

                              <li role="presentation">
                                    <a class="top-link" href="#">
                                        <span class="badge-primary" style=""><strong>
                                            <span style="color: #fff;font-weight:bold;font:verdana; background-color: #000;font-size:11px;padding-left:3px;padding-right:3px;display:inline;">
                                            B B <span style="color:orangered;">C</span>
                                            </span>
                                        </strong></span>
                                    </a>
                              </li>

                              <li role="presentation">
                                    <a class="top-link" href="#">
                                        <img src="static/img/youtube-medium.png" style="display:inline;margin-right:2px;width:18px;height:18px;" />
                                        <span class="badge-primary" style=""><strong>
                                            Youtube
                                        </strong></span>
                                    </a>
                              </li>

                              <li role="presentation">
                                    <a class="top-link" href="#">
                                        <img src="static/img/twitter-192x192.png" style="display:inline;width:18px;height:18px;" />
                                        <span class="badge-primary" style=""><strong>
                                            twitter
                                        </strong></span>
                                    </a>
                              </li>

                              <li role="presentation">
                                    <a class="top-link" href="#">
                                        <img src="static/img/steemit-196x196.png" style="display:inline;width:18px;height:18px;" />
                                        <span class="badge-primary" style=""><strong>
                                            steemit
                                        </strong></span>
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
            <div class="" style="padding-left: 20px;padding-top:0px;">
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


        <div class="col-lg-9" >
            <div class="row">
                <div class="col-lg-12" style="margin:15px;">
                    <div style="display:inline-table;margin-bottom:1px;padding:4px;" ng-repeat="cat in remain_categories" class="">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-primary cat-btn">
                                <input type="radio" name="options" id="option2" autocomplete="off"> {{cat.key}}
                              </label>
                              <label class="btn btn-primary active cat-btn">
                                <input type="radio" name="options" id="option1" autocomplete="off" checked> {{cat.value}}
                              </label>
                            </div>
                    </div>
                </div>

                <div class="col-lg-4" ng-switch on="post.type"
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

        <div class="col-lg-3 pull-right" style="margin-top:10px;padding:0px">
            <!-- 
            <div ng-if="total_found"  class="pull-left tr-search-results-count">
                About {{total_found}} results found
                <br/>
                Showing {{total_fetched}} 
                <br/>
            </div>
            -->

            <div class="" style="width:320px;">
                <h2 class="tr-section-title" style="margin-top:4px;">
                    <span class="glyphicon glyphicon-star" style="color:#ef9c0c"></span>
                    Featured video
                </h2>
                <div style="padding:12px;border-radius:4px;background-color:#000;">
                    <iframe id="ytplayer" type="text/html" width="300" height="200"
                      src="https://www.youtube.com/embed/TGfk_gWIzF0?autoplay=0&origin=http://example.com"
                      frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>


</div>
