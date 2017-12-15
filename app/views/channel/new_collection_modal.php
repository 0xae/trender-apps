<?php
use app\models\Collection;
$collection->channelId = $channel->id;
$collection->audience = 'private';
?>

<!-- Modal -->
<div class="tr-modal modal fade" id="collectionModal" 
     tabindex="-1"  role="dialog" 
     aria-labelledby="collectionModal" 
     aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                </button>

                <h4 class="modal-title" id="myModalLabel">
                    <span class="glyphicon glyphicon-unchecked"></span>
                    <span v-if="!obj.id">
                        <?= ($collection->id) ? "Collection {$collection->name}" : "Create a collection" ?>
                    </span>
                    <span v-if="obj.id">
                        {{obj.name}}
                    </span>
                </h4>
            </div>

            <div class="modal-body">
            </div>
        </div>
    </div>

</div>

