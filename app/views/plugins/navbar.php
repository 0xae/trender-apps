<nav class="navbar navbar-default navbar-fixed-top" style="border-color: #fff;border-radius: 0px;margin-bottom:5px;min-height:40px;">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!-- 
      <a class="navbar-brand" href="#">Trender</a>
      -->
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="menu-link <?= (Yii::$app->controller->id == 'home')? 'active': '' ?>">
            <a href="index.php?r=home/index">
               <span class="fa fa-home"></span>
               <strong>Home</strong>
            </a>
        </li>

        <li class="menu-link <?= (Yii::$app->controller->id == 'diary')? 'active': '' ?>">
            <a href="index.php?r=diary/index">
               <span class="fa fa-newspaper-o"></span>
               <strong>Journal</strong>
            </a>
        </li>

        <li class="menu-link <?= (Yii::$app->controller->id == 'tv')? 'active': '' ?>">
            <a href="index.php?r=tv/index">
               <span class="fa fa-tv"></span>
               <strong>Live Tv</strong>
            </a>
        </li>

        <li class="menu-link <?= (Yii::$app->controller->id == 'market')? 'active': '' ?>">
            <a href="index.php?r=market/index">
               <span class="fa fa-balance-scale"></span>
               <strong>Markets</strong>
            </a>
        </li>
      </ul>

      <form class="navbar-form navbar-right" role="search">
            <div class="input-group">
                  <input type="text" 
                        style="border-bottom-left-radius: 40px;border-top-left-radius: 40px;font-size:12px;border:1px solid #19CF86;"
                        class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                        <button class="btn btn-default" style="border-bottom-right-radius: 40px; border:1px solid #19CF86;border-top-right-radius: 40px;border-left: 0px" type="button">
                            <span class="glyphicon glyphicon-search">
                            </span>
                        </button>
                  </span>
            </div><!-- /input-group -->
      </form>

<!--
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
-->
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
