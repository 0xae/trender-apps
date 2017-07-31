<?php
$this->title = 'Home';
?>

<style>
.tr-header {
    background: url(static/img/marketplace.webp) no-repeat;
    background-position: 89% 38%;
    background-size: cover;
}

.tr-top-menu {
}

.tr-top-menu li {
    margin:0px;
}

.tr-top-menu li a.top-link:hover,
.tr-top-menu li a.top-link:focus
{
    background-color: #337ab7;
}

.tr-top-menu li a {
    padding:2px;
    padding-left:6px;
    padding-right:6px;
    font-size:12px;
    margin:0px;
    color: #fff;
}
</style>

<div ng-controller="HomeController">
    <div class="row tr-header" style="height:230px;background-color: #000;">
          <!--
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
                </div>
                <span ng-if="searchTerm" style="color:#ccc;font-size:10px" class="text-default">
                    Searching for 
                    <strong>
                        <a style="font-weight:bold" href="#">#{{searchTerm}}</a>
                    </strong>
                 </span>
          </div>
          -->
    </div><!-- /.row -->

    <div class="row" style="margin-top:-30px;background-color:rgba(0,0,0,.6);margin-left:0px;padding:0px;">
        <div class="col-md-12" style="padding:4px;">
            <ul class="nav nav-pills tr-top-menu">
              <li role="presentation" class="active">
                <a class="top-link" href="#">what's happening</a>
              </li>

              <li role="presentation" class="">
                <a class="top-link" href="#">news</a>
              </li>

              <li role="presentation" class="">
                <a class="top-link" href="#">trending</a>
              </li>

              <li role="presentation" class="pull-right">
                <a href="#">
                    <span class="glyphicon glyphicon-cog"></span>
                </a>
              </li>
            </ul>
        </div>
    </div>

    <div class="row">

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
