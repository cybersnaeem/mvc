<?php echo $this->createBlock('Block\Core\Layout\Home\Header')->toHtml(); ?>

<!-- ============================================== HEADER : END ============================================== -->
<div class="body-content outer-top-vs" id="top-banner-and-menu">
    <div class="container">

        <!-- /.row -->
        <?php echo $this->createBlock('Block\Core\Layout\Home\Message')->toHtml(); ?>
        <?php echo  $this->getChild("Content")->toHtml(); ?>
        <?php echo $this->createBlock('Block\Home\Brand')->toHtml(); ?>



    </div>
    <!-- /.container -->
</div>
<!-- /#top-banner-and-menu -->
<?php echo $this->createBlock('Block\Core\Layout\Home\Footer')->toHtml(); ?>