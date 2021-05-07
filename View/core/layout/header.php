
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <title>Document</title>

        <script type="text/javascript" src="<?php echo $this->baseUrl('Skin/js/jquery.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo $this->baseUrl('Skin/js/mage.js'); ?>"></script>

    </head>
    <body>
        
        <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #1fb8ff;">
            <a class="navbar-brand display-5" href="#">Questecom</a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation" style="background-color:black"></button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-light" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin\cms'); ?>').load();" href="javascript:void(0);">CMSPages</a>
                    </li>
                </ul>
                <ul class="navbar-nav mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-light" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin\customergroup'); ?>').load();" href="javascript:void(0);">CustomerGroup</a>
                    </li>
                </ul>
                <ul class="navbar-nav mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-light" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin\admin'); ?>').load();" href="javascript:void(0);">Admin</a>
                    </li>
                </ul>
                <ul class="navbar-nav mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-light" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin\customer'); ?>').load();" href="javascript:void(0);">Customer</a>
                    </li>
                </ul>
                <ul class="navbar-nav mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-light" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin\category'); ?>').load();" href="javascript:void(0);">Category</a>
                    </li>
                </ul>
                <ul class="navbar-nav mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-light" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin\product'); ?>').load();" href="javascript:void(0);">Product</a>
                    </li>
                </ul>
                <ul class="navbar-nav mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-light" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin\payment'); ?>').load();" href="javascript:void(0);">Payment</a>
                    </li>
                </ul>
                <ul class="navbar-nav mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-light" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin\shipment'); ?>').load();" href="javascript:void(0);">Shipment</a>
                    </li>
                </ul>
                <ul class="navbar-nav mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-light" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin\attribute'); ?>').load();" href="javascript:void(0);">Attribute</a>
                    </li>
                </ul>
                <ul class="navbar-nav mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-light" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin\brand'); ?>').load();" href="javascript:void(0);">Brand</a>
                    </li>
                </ul>
                <ul class="navbar-nav mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-light" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin\cart'); ?>').load();" href="javascript:void(0);">Cart</a>
                    </li>
                </ul>
                <ul class="navbar-nav mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-light" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin\configurationGroup'); ?>').load();" href="javascript:void(0);">ConfigGroup</a>
                    </li>
                </ul>
                <ul class="navbar-nav mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-light" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin\orderDetails'); ?>').load();" href="javascript:void(0);">Order</a>
                    </li>
                </ul>
            </div>
        </nav>
    </body>
    </html>
    