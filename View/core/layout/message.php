<div class="container-fluid">
  <?php if ($success = $this->getMessage()->getSuccess()):
    $this->getMessage()->clearSuccess();
  ?>
    <div class="alert alert-success" role="alert">
      <p class="mb-0 text-center">
        <?php echo $success; ?>
      </p>
    </div>
  <?php 
  endif;
  if ($failure = $this->getMessage()->getFailure()):
    $this->getMessage()->clearFailure();
  ?>
    <div class="alert alert-danger" role="alert">
      <p class="mb-0 text-center">
        <?php echo $failure; ?>
      </p>
    </div>
  <?php 
    endif;
  ?>