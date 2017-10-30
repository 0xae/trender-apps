<?php 
use app\models\Post;
use app\models\Utils;
$count = count($posts);
if ($count > 0): 
?>

<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <?php for ($i=0; $i<$count; $i++): ?>
        <li data-target="#carousel-example-generic" 
            data-slide-to="<?= $i ?>" 
            class="<?= ($i==0)?'active':'' ?>">
        </li>
        <?php endfor; ?>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <?php for ($i=0; $i<$count; $i++): 
                $p=$posts[$i]; 
                $category=Utils::category($p);
        ?>

        <div class="item <?= ($i==0)?'active':'' ?>">
            <img src="<?= Utils::cached($p) ?>" alt="..." />
            <div class="carousel-caption">
                <img src="static/img/youtube-small.ico" width="15px" />
                <span><strong><?= $p->authorName ?></strong></span>
                <span style="float: right">
                    <span class="fa fa-clock-o"></span>
                    <strong><?= $p->timestamp ?></strong>
                </span>

                <br/>
                <?= $p->description ?>

                <!--
                <br/>
                <span class="tr-badge-k badge" style="float: right">
                    <?= $category ?>
                </span>                
                -->
            </div>
        </div>

        <?php endfor; ?>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<?php endif; ?>
