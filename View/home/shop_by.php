<div class='col-xs-12 col-sm-12 col-md-3 sidebar'>
    <form action="">
        <div class="sidebar-module-container">
            <div class="sidebar-filter">
                <!-- ============================================== SIDEBAR CATEGORY ============================================== -->
                <div class="sidebar-widget">
                    <div class="row">
                        <h3 class="section-title ">Shop by</h3>
                        <button type="submit" class="lnk btn btn-primary col-md-12"><i class="fa fa-filter"></i> Apply Filter </button>
                    </div>

                    <div class="sidebar-widget-body">
                        <div class="accordion">
                            <!-- ============================================== PRICE SILDER============================================== -->
                            <div class="sidebar-widget">
                                <div class="widget-header">
                                    <h4 class="widget-title">Price Slider</h4>
                                </div>
                                <div class="sidebar-widget-body m-t-10">
                                    <div class="price-range-holder"> <span class="min-max"> <span class="pull-left">$200.00</span> <span class="pull-right">$800.00</span> </span>
                                        <input type="text" id="amount" style="border:0; color:#666666; font-weight:bold;text-align:center;">
                                        <input type="text" class="price-slider" value="">
                                    </div>

                                </div>
                            </div>
                            <!-- ============================================== PRICE SILDER : END ============================================== -->
                            <?php foreach ($this->getAttributes()->getData() as $key => $attribute) : ?>
                                <div class="sidebar-widget">
                                    <div class="widget-header">
                                        <h4 class="widget-title"><?php echo $attribute->name; ?></h4>
                                    </div>
                                    <?php $options = $this->getFilters($attribute); ?>
                                    <?php if ($options) : ?>

                                        <?php foreach ($options->getData() as $key => $option) : ?>
                                            <!-- ============================================== MANUFACTURES ============================================== -->

                                            <div class="sidebar-widget-body">
                                                <ul class="list">
                                                    <li><input type="checkbox" name="<?php echo $attribute->name; ?>[<?php echo $option->name; ?>]" id=""> <?php echo $option->name; ?></li>
                                                </ul>
                                            </div>

                                            <!-- ============================================== MANUFACTURES END ============================================== -->
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <!-- ============================================== SIDEBAR CATEGORY : END ============================================== -->
            </div>
        </div>
    </form>
</div>