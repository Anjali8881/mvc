<?php $product = $this->getTableRow(); ?>

<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">SKU:</div>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="product[sku]"  value="<?php echo $product->sku; ?>" required="">
    </div>
</div>
<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Name:</div>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="product[name]" value="<?php echo $product->name; ?>"  required="">
    </div>
</div>
<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Price:</div>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="product[price]" value="<?php echo $product->price; ?>" required="">
    </div>
</div>
<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Discount:</div>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="product[discount]" value="<?php echo $product->discount; ?>" required="">
    </div>
</div>
<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Quantity:</div>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="product[quantity]" value="<?php echo $product->quantity; ?>" required="">
    </div>
</div>
<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Description:</div>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="product[description]" value="<?php echo $product->description; ?>" required="">
    </div>
</div>
<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Satus:</div>
    <div class="col-sm-8">
        <select name="product[status]" class="form-control">
            <?php foreach($product->getStatusOptions() as $key => $value): ?>
                <option value="<?php echo $key; ?>" ><?php echo $value; ?></option>
            <?php endforeach; ?>
        </select>          
    </div>
</div>
<div class="form-group row mt-5">
    <div class="col-sm-10">
        <?php if ($id = $this->getRequest()->getGet('id')): ?>
            <button type="button" class ="btn btn-primary" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('save',null,['id' => $id],true) ?>').resetParams().setParams($('#editForm').serializeArray()).setMethod('POST').load()">Save</button>
        <?php else: ?>
            <button type="button" class ="btn btn-primary" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('save',null,null,true) ?>').resetParams().setParams($('#editForm').serializeArray()).setMethod('POST').load()">Save</button>
        <?php endif; ?>
    </div>
</div>