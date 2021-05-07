<div id="brands-carousel" class="logo-slider">
    <div class="logo-slider-inner">
        <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
            <?php foreach ($this->getBrand()->getData() as $key => $brand) : ?>
                <div class="item">
                    <a href="#" class="image">
                        <img height="100px" width="100px" src="./Media/Brand/<?php echo "{$brand->brandId}/{$brand->image}"; ?>" alt="<?php echo $brand->name; ?>">
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>