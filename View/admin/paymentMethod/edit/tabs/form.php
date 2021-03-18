<?php $paymentMethod = $this->getTableRow(); ?>
<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Name:</div>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="payment[name]" value="<?php echo $paymentMethod->name; ?>"  required="">
    </div>
</div>
<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Code:</div>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="payment[code]" value="<?php echo $paymentMethod->code; ?>" required="">
    </div>
</div>
<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Description:</div>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="payment[description]" value="<?php echo $paymentMethod->description; ?>" required="">
    </div>
</div>
<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Satus:</div>
    <div class="col-sm-8">
        <select name="payment[status]" class="form-control">
            <?php foreach($paymentMethod->getStatusOptions() as $key => $value): ?>
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
            <button type="button" class ="btn btn-primary"  onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('save',null,null,true) ?>').resetParams().setParams($('#editForm').serializeArray()).setMethod('POST').load()">Save</button>
        <?php endif; ?>
    </div>
</div>