<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
    <?= $modal_google=='true' ? $this->element('/modal/form_google_ajax') : ''; ?>
    <?= $this->Form->create($student,['id'=>'sync_form']);?>
    <fieldset>
        <legend><?= __('Options sync') ?></legend>
             <div class="form-group">
                <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="thumbnail sync">
                                <label>
                                    <?= $this->Html->image("SyncUser.png", [
                                        "alt" => "Sync",
                                        "class"=>"col-xs-12 hidden-xs "
                                    ]);?>
                                <div class="caption">
                                    <h3 class="">Sync each student with Contingent</h3>
                                   <p class="alert alert-danger">Time of synchronization can be more than 1 minute</p>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="all_students" style="width:50px;height: 40px;">
                                        </label>
                                    </div>
                                </div>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="thumbnail sync">
                                <label>

                                <?= $this->Html->image("SyncArchiv.png", [
                                    "alt" => "Sync",
                                    "class"=>"col-xs-12 hidden-xs"
                                ]);?>
                                <div class="caption">
                                    <h3 class="">Sync SysAdmin of archive students</h3>
                                    <p class="alert alert-danger">Time of synchronization can be more than 1 minute</p>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="archive" style="width:50px;height: 40px;">
                                        </label>
                                    </div>
                                </div>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="thumbnail sync">
                                <label>
                                <?= $this->Html->image("Sync.png", [
                                    "alt" => "Sync",
                                    "class"=>"col-xs-12 hidden-xs"
                                ]);?>
                                <div class="caption">
                                    <h3 class="">Sync specialyty with Contingent</h3>
                                    <p class="alert alert-info">It syncs all speciality, what in status "use" in contingent.</p>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="special" style="width:50px;height: 40px;">
                                        </label>
                                    </div>
                                </div>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                             <div class="thumbnail sync">
                                 <fieldset >
                                 <label>
                                     <?= $this->Html->image("SyncImage.png", [
                                         "alt" => "Sync",
                                         "class"=>"col-xs-12 hidden-xs"
                                     ]);?>
                                     <div class="caption ">
                                         <h3 class="">Get photo with Contingent </h3>
                                         <p class="alert alert-danger">Time of synchronization can be more than 2 minute</p>
                                         <div class="checkbox">
                                             <label>
                                                 <input type="checkbox" name="photo" style="width:50px;height: 40px;">
                                             </label>
                                         </div>
                                     </div>
                                 </label>
                                 </fieldset>
                             </div>
                             </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                         <div class="thumbnail sync">
                             <fieldset disabled>
                                 <label>
                                     <?= $this->Html->image("g.png", [
                                         "alt" => "Sync",
                                         "class"=>"col-xs-12 hidden-xs disabled"
                                     ]);?>
                                     <div class="caption disabled">
                                         <h3 class="">Google Sync</h3>
                                         <p class="alert alert-danger">Time of synchronization can be more than ~10 minute</p>
                                         <div class="checkbox">
                                             <label>
                                                 <input type="checkbox" name="pictures" style="width:50px;height: 40px;">
                                             </label>
                                         </div>
                                     </div>
                                 </label>
                             </fieldset>
                         </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail sync">
                            <fieldset >
                                <label>
                                    <?= $this->Html->image("Api.png", [
                                        "alt" => "Sync",
                                        "class"=>"col-xs-12 hidden-xs"
                                    ]);?>
                                    <div class="caption ">
                                        <h3 class="">Send photo to google (API)</h3>
                                        <p class="alert alert-danger">Time of synchronization can be more than 30 minute</p>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="google_photo" style="width:50px;height: 40px;">
                                            </label>
                                        </div>
                                    </div>
                                </label>
                            </fieldset>
                        </div>
                    </div>
             </div>

        </div>
    </fieldset>
    <div class="form-group">
            <button type="submit" class="btn btn-success">Start</button>
    </div>
    <?= $this->Form->end() ?>

</div>

<script>
    $( "#sync_form" ).submit(function( event ) {
        if ($(this).find( "[name='google_photo']" ).prop( "checked" )==='true'){
            event.preventDefault();

        }

    });


</script>