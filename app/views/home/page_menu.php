<div class="row rs-row" id="page_top_menu_container">
    <div class="col-md-2">
        <div class="tr-page-title">
            <h2>   
                <?= $label ?>
            </h2>
        </div>
    </div>

    <div class="col-md-7" id="page_tab_menu">
        <div role="tabpanel">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#topStories" aria-controls="home" 
                       role="tab" data-toggle="tab">
                       Top Stories
                    </a>
                </li>

                <li role="presentation">
                    <a href="#topStories" aria-controls="home" 
                       role="tab" data-toggle="tab">
                       Activity
                    </a>
                </li>

                <li role="presentation">
                    <a href="#news" aria-controls="profile" 
                       role="tab" data-toggle="tab">
                       News
                    </a>
                </li>

                <li role="presentation">
                    <a href="#media" aria-controls="messages" 
                       role="tab" data-toggle="tab">
                       Media
                    </a>
                </li>
            <!-- Nav tabs -->
            </ul>

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="topStories">
                </div>

                <div role="tabpanel" class="tab-pane" id="news">
                </div>

                <div role="tabpanel" class="tab-pane" id="media">
                </div>
            <!-- Tab content -->
            </div>
        <!-- tabpanel -->
        </div>
    <!-- #page_tab_menu -->
</div>
