<div class="col-xs-12 col-sm-12 col-md-9 rht-col">

    <!-- SORTING FEATURE -->

    <div class="clearfix filters-container m-t-10">
        <div class="row">
            <div class="col col-sm-6 col-md-3 col-lg-3 col-xs-6">
                <div class="filter-tabs">
                    <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                        <li class="active"> <a data-toggle="tab" href="#grid-container"><i class="icon fa fa-th-large"></i>Grid</a> </li>
                        <li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-bars"></i>List</a></li>
                    </ul>
                </div>
            </div>
            <div class="col col-sm-12 col-md-5 col-lg-5 hidden-sm">
                <div class="col col-sm-6 col-md-6 no-padding">
                    <div class="lbl-cnt"> <span class="lbl">Sort by</span>
                        <div class="fld inline">
                            <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> Position <span class="caret"></span> </button>
                                <ul role="menu" class="dropdown-menu">
                                    <li role="presentation"><a href="#">position</a></li>
                                    <li role="presentation"><a href="#">Price:Lowest first</a></li>
                                    <li role="presentation"><a href="#">Price:HIghest first</a></li>
                                    <li role="presentation"><a href="#">Product Name:A to Z</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-sm-6 col-md-6 no-padding hidden-sm hidden-md">
                    <div class="lbl-cnt"> <span class="lbl">Show</span>
                        <div class="fld inline">
                            <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> 1 <span class="caret"></span> </button>
                                <ul role="menu" class="dropdown-menu">
                                    <li role="presentation"><a href="#">1</a></li>
                                    <li role="presentation"><a href="#">2</a></li>
                                    <li role="presentation"><a href="#">3</a></li>
                                    <li role="presentation"><a href="#">4</a></li>
                                    <li role="presentation"><a href="#">5</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col col-sm-6 col-md-4 col-xs-6 col-lg-4 text-right">
                <div class="pagination-container">
                    <ul class="list-inline list-unstyled">
                        <li class="prev"><a href="#"><i class="fa fa-angle-left"></i></a></li>
                        <li><a href="#">1</a></li>
                        <li class="active"><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- SORTING FEATURE END-->

    <div class="search-result-container ">
        <div id="myTabContent" class="tab-content category-list">
            <div class="tab-pane active " id="grid-container">
                <div class="category-product">
                    <div class="row">
                        <?php if ($this->getProducts()) : ?>
                            <?php foreach ($this->getProducts()->getData() as $key => $product) : ?>
                                
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="item">
                                   
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                
                                                    <div class="image">
                                                        <a href="<?php echo $this->getUrl()->getUrl('detail', 'home\home', ['id' => $product->productId], true); ?>">
                                                            <img src="./Media/images/Product/<?php echo ($this->getMedia($product->productId)) ? "{$product->productId}/{$this->getMedia($product->productId)['imageName']}" : "imageNotFound.jpg"; ?>" alt="<?php echo "{$product->imageName}"; ?>">
                                                        </a>
                                                    </div>
                                                    <!-- <div class="tag new"><span>new</span></div> -->
                                                </div>
                                                <div class="product-info text-left">
                                                    <h3 class="name"><a href="<?php echo $this->getUrl()->getUrl('detail', 'home\home', ['id' => $product->productId], true); ?>"><?php echo $product->productName; ?></a></h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="description"></div>
                                                    <div class="product-price"> <span class="price">$ <?php echo $product->productPrice; ?> </span> <span class="price-before-discount">$ <?php echo $product->productPrice; ?></span> </div>
                                                </div>
                                                <div class="cart clearfix animate-effect">
                                                    <div class="action">
                                                        <ul class="list-unstyled">
                                                            <li class="lnk add-cart-button">
                                                                <a class="add-to-cart" href="<?php echo $this->getUrl()->getUrl('addItemToCart', 'home\home', ['id' => $product->productId], true); ?>" title="Wishlist">
                                                                    <i class="icon fa fa-shopping-cart"></i>
                                                                </a>
                                                            </li>

                                                            <li class="lnk wishlist">
                                                                <a class="add-to-cart" href="#" title="Wishlist">
                                                                    <i class="icon fa fa-heart"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <h1>Products Not Found</h1>
                            </div>
                        <?php endif; ?>
                    </div>


                    <!-- /.row -->
                </div>
                <!-- /.category-product -->

            </div>
            <!-- /.tab-pane -->


            <!-- /.tab-pane #list-container -->
        </div>
        <!-- /.tab-content -->

        <!-- Pagination -->

        <div class="clearfix filters-container bottom-row">
            <div class="text-right">
                <div class="pagination-container">
                    <ul class="list-inline list-unstyled">
                        <li class="prev"><a href="#"><i class="fa fa-angle-left"></i></a></li>
                        <li><a href="#">1</a></li>
                        <li class="active"><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Pagination End-->

    </div>
</div>