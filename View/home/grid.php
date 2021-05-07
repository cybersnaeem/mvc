<!-- ============================================== HEADER : END ============================================== -->
<?php echo $this->createBlock('Block\Home\Header')->toHtml(); ?>
<!-- ============================================== HEADER : END ============================================== -->

<!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row '>

            <!-- SIDE BAR -->
            <?php echo $this->createBlock('Block\Home\ShopBy')->toHtml(); ?>
            <!-- SIDE BAR END -->


            <?php echo $this->createBlock('Block\Home\Product')->toHtml(); ?>

        </div>

        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        <?php echo $this->createBlock('Block\Home\Brand')->toHtml(); ?>
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->

    </div>
</div>

<!-- ============================================================= FOOTER ============================================================= -->
<?php echo $this->createBlock('Block\Home\Footer')->toHtml(); ?>
<!-- ============================================================= FOOTER END ============================================================= -->