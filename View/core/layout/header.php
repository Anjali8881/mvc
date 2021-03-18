<!DOCTYPE html>
<html>
    <head>
        <title>Questecom</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
        <style>
            .text-size{
                font-size : 70%;
            }
        </style>
    </head>
    <body>

            <header>
                <!-- Navigation Bar At top -->
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <a class="navbar-brand pl-5" href="#" >Questecom</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                        <a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin_customer'); ?>').load()" class="nav-link" href="javascript:void(0);"><i class="fas fa-user" aria-hidden="true"></i> Customer <span class="sr-only">(current)</span></a>
                        </li>

                        <li class="nav-item">
                            <a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin_customer_customerGroup'); ?>').load()" class="nav-link" href="javascript:void(0);"> Customer Group</a>
                        </li>

                        <li class="nav-item">
                            <a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin_category'); ?>').load()" class="nav-link" href="javascript:void(0);"><i class="fas fa-bars"></i> Category</a>
                        </li>
                        
                        <li class="nav-item">
                            <a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin_product'); ?>').load()" class="nav-link" href="javascript:void(0);"><i class="fab fa-product-hunt"></i> Product </a>
                        </li>

                        <li class="nav-item">
                            <a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin_attribute'); ?>').load()" class="nav-link" href="javascript:void(0);"> Attribute </a>
                        </li>

                        <li class="nav-item">
                            <a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin_shippingMethod'); ?>').load()" class="nav-link" href="javascript:void(0);"><i class="fas fa-shipping-fast"></i> ShippingMethod</a>
                        </li>

                        <li class="nav-item">
                            <a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin_paymentMethod'); ?>').load()" class="nav-link" href="javascript:void(0);"></i> PaymentMethod</a>
                        </li>

                        <li class="nav-item">
                            <a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin_admin'); ?>').load()" class="nav-link" href="javascript:void(0);"></i> Admin</a>
                        </li>

                        <li class="nav-item">
                            <a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin_cms'); ?>').load()" class="nav-link" href="javascript:void(0);"></i> CMS</a>
                        </li>

                    </nav> 
                </header>
        </body>
        </head>
</html>