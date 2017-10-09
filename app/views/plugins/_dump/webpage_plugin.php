<div class="modal fade" id="webpageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{{ webpage_title }}</h4>
      </div>
      <div class="modal-body">
        <iframe src="{{webpage_url}}">
        </iframe>
      </div>
    </div>
  </div>
</div>
