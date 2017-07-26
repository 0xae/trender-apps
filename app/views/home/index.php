<?php
$this->title = 'Home';
?>

<div ng-controller="HomeController">

    <div class="row" style="padding:10px;padding-top:30px;padding-bottom:16px;background-color: #000;">
          <div class="col-lg-4">
                <h2 ng-if="!searchTerm" style="margin-bottom:0px;color:#ccc;">Home</h2>
                <h2 ng-if="searchTerm" style="margin-bottom:0px;color:#ccc;"># {{searchTerm}}</h2>
                <span style="color:#ccc;font-size:10px" class="text-default">
                    Found 10 posts and 20 media
                 </span>
          </div>

          <div class="col-lg-6 pull-right" style="padding-top:14px;">
                <div class="input-group-lg input-group">
                      <input style="color: #999" ng-model="query" type="text" class="form-control" placeholder="Search for topic...">
                      <span class="input-group-btn">
                            <button ng-click="searchFor(query)" class="btn btn-primary" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                      </span>
                </div><!-- /input-group -->
                <span ng-if="searchTerm" style="color:#ccc;font-size:10px" class="text-default">
                    Searching for 
                    <strong>
                        <a style="font-weight:bold" href="#">#{{searchTerm}}</a>
                    </strong>
                 </span>
          </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->

    <div class="row">
        <div class="col-lg-5" style="padding: 20px;padding-left:45px;">
            <div ng-repeat="post in posts_search_results" style="margin-bottom: 15px;">
                <steemit-post p="post">
                </steemit-post>
            </div>
        </div>

        <div class="col-lg-4">
            <h2>Heading</h2>

            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                fugiat nulla pariatur.</p>

            <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
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
