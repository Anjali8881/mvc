<?php 
$tabs = $this->getTabs();
foreach($tabs as $key => $tab){ ?>
    <a class = "btn btn-primary" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('edit','admin_product',['tab' => $key]); ?>').resetParams().load()" ><?php echo $tab['label']; ?></a><br><br>
<?php }
?>
