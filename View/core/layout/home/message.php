<?php if ($success = $this->getMessage()->getSuccess()) : ?>
    <?php $this->getMessage()->clearSuccess(); ?>
    <button type="button" name="failureMessage" class="btn btn-primary" data-toggle="modal" data-target="#failureMessage" style="display: none;">
    </button>

    <!-- Modal -->
    <div class="modal fade" id="failureMessage" tabindex="-1" role="dialog" aria-labelledby="failureMessageLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" name="close" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <h3><?php echo $success; ?></h3>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if ($failure = $this->getMessage()->getFailure()) : ?>
    <?php $this->getMessage()->clearFailure(); ?>
    <button type="button" name="failureMessage" class="btn btn-primary" data-toggle="modal" data-target="#failureMessage" style="display: none;">
    </button>

    <!-- Modal -->
    <div class="modal fade" id="failureMessage" tabindex="-1" role="dialog" aria-labelledby="failureMessageLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" name="close" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <h3><?php echo $failure; ?></h3>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>