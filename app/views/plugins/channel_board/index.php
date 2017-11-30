<?php
$featured_video = $feed->featured_video;
$sugestions = array_slice($feed->sugestions, 0, 11);
?>

<div class="col-md-5 rs-pad tr-newsfeed-board pull-right">
    <div class="row rs-row">
        <div class="col-md-12">
            <div>
                <span class="glyphicon glyphicon-random"></span>
                <h3 style="display:inline">
                    <?= $channel->name ?>
                </h3>
                <p class="tr-channel-descr">
                    <?= $channel->description ?>
                </p>
            </div>

            <?php if ($featured_video): ?>
                <?php
                    echo \Yii::$app->view->renderFile (
                        "@app/views/plugins/youtube_featured/index.php",
                        ["post" => $featured_video]
                    );
                ?>
            <?php endif; ?>
        </div>

        <!-- right now -->
        <div class="col-md-4">
            <div class="tr-section">
                <h4 class="tr-section-title">
                    Right now
                </h4>

                <div class="tr-section-content">
                    <ul class="list-unstyled">
                        <li>
                            <a href="./index.php?r=channel/watch&id="
                               class="tr-more-item">
                               Topic 1
                            </a>
                        </li>
                        <li>
                            <a href="./index.php?r=channel/watch&id="
                               class="tr-more-item">
                               Topic 2
                            </a>
                        </li>
                        <li>
                            <a href="./index.php?r=channel/watch&id="
                               class="tr-more-item">
                               Topic 3
                            </a>
                        </li>
                        <li>
                            <a href="./index.php?r=channel/watch&id="
                               class="tr-more-item">
                               Topic 4
                            </a>
                        </li>
                    </ul>
                </div>                
            </div>
        </div>

        <!-- places -->
        <div class="col-md-4">
            <div class="tr-section">
                <h4 class="tr-section-title">
                    Places
                </h4>

                <div class="tr-section-content">
                    <ul class="list-unstyled">
                        <li>
                            <a href="./index.php?r=channel/watch&id="
                               class="tr-more-item">
                               Las Vegas
                            </a>
                        </li>
                        <li>
                            <a href="./index.php?r=channel/watch&id="
                               class="tr-more-item">
                               japan
                            </a>
                        </li>
                        <li>
                            <a href="./index.php?r=channel/watch&id="
                               class="tr-more-item">
                               china
                            </a>
                        </li>
                    </ul>
                </div>                
            </div>            
        </div>

        <!-- events -->
        <div class="col-md-4">
            <div class="tr-section">
                <h4 class="tr-section-title">
                    Events
                </h4>

                <div class="tr-section-content">
                    <ul class="list-unstyled">
                        <li>
                            <a href="./index.php?r=channel/watch&id="
                               class="tr-more-item">
                               Event 1
                            </a>
                        </li>
                        <li>
                            <a href="./index.php?r=channel/watch&id="
                               class="tr-more-item">
                               Event 2
                            </a>
                        </li>
                        <li>
                            <a href="./index.php?r=channel/watch&id="
                               class="tr-more-item">
                               Event 3
                            </a>
                        </li>
                    </ul>
                </div>                
            </div>            
        </div>
    </div>

    <div class="row rs-row" style="margin-top:5px;margin-bottom:5px;">
        <!-- most popular -->
        <div class="col-md-4">
          <div class="tr-section">
              <h4 class="tr-section-title">
                  Most popular
              </h4>

              <div class="tr-section-content">
                  <ul class="list-unstyled">
                      <li>
                          <a href="./index.php?r=channel/watch&id="
                             class="tr-more-item">
                             #bitcoin
                          </a>
                      </li>
                      <li>
                          <a href="./index.php?r=channel/watch&id="
                             class="tr-more-item">
                             #worldcup2018
                          </a>
                      </li>
                      <li>
                          <a href="./index.php?r=channel/watch&id="
                             class="tr-more-item">
                             nanocheeze
                          </a>
                      </li>
                      <li>
                          <a href="./index.php?r=channel/watch&id="
                             class="tr-more-item">
                             drumz
                          </a>
                      </li>
                      <li>
                          <a href="./index.php?r=channel/watch&id="
                             class="tr-more-item">
                             sports
                          </a>
                      </li>
                      <li>
                          <a href="./index.php?r=channel/watch&id="
                             class="tr-more-item">
                             photography
                          </a>
                      </li>
                      <li>
                          <a href="./index.php?r=channel/watch&id="
                             class="tr-more-item">
                             #lybiatUN
                          </a>
                      </li>
                  </ul>
              </div>                
          </div>            
        </div>

        <!-- suggestions -->
        <div class="col-md-7">
            <div class="tr-section">                
                <h4 class="tr-section-title">
                    <span class="glyphicon glyphicon-flag"></span>
                    Suggested Channels
                </h4>
                <div class="tr-section-content">
                    <ul class="list-unstyled">
                      <?php foreach ($sugestions as $chan): ?>
                          <li>
                              <a href="./index.php?r=channel/watch&id=<?=$chan->id?>"
                                 class="tr-more-item">
                                  <?= $chan->name ?>
                              </a>
                          </li>
                      <?php endforeach; ?>
                    </ul>
                </div>                
            </div>            
        </div>
    </div>
</div>
