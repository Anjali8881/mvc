<?php $shippingMethods = $this->getTableRow(); ?>
<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Name:</div>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="shipping[name]" value="<?php echo $shippingMethods->name; ?>"  required="">
    </div>
</div>
<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Code:</div>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="shipping[code]" value="<?php echo $shippingMethods->code; ?>" required="">
    </div>
</div>
<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Amount:</div>
    <div class="col-sm-8">
        <input type="number" class="form-control" name="shipping[amount]" value="<?php echo $shippingMethods->amount; ?>" required="">
    </div>
</div>
<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Description:</div>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="shipping[description]" value="<?php echo $shippingMethods->description; ?>" required="">
    </div>
</div>
<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Satus:</div>
    <div class="col-sm-8">
        <select name="shipping[status]" class="form-control">
            <?php foreach($shippingMethods->getStatusOptions() as $key => $value): ?>
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