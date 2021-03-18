<?php 

$billingAddress = $this->getBillingAddress();
$shippingAddress = $this->getShippingAddress();
?>
<label class="font-weight-bold ml-5">Billing Address</label>
<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Address:</div>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="billing[address]" value="<?php echo $billingAddress->address; ?>" required="">
    </div>
</div>

<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">City:</div>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="billing[city]"  value="<?php echo $billingAddress->city; ?>" required="">
    </div>
</div>

<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">State:</div>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="billing[state]" value="<?php echo $billingAddress->state; ?>" required="">
    </div>
</div>

<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Zipcode:</div>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="billing[zipcode]"  value="<?php echo $billingAddress->zipcode; ?>" required="">
    </div>
</div>

<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Country:</div>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="billing[country]"  value="<?php echo $billingAddress->country; ?>" required="">
    </div>
</div>


<label class="font-weight-bold ml-5 mt-5">Shipping Address</label>
<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Address:</div>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="shipping[address]" value="<?php echo $shippingAddress->address; ?>"required="">
    </div>
</div>

<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">City:</div>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="shipping[city]" value="<?php echo $shippingAddress->city; ?>" required="">
    </div>
</div>

<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">State:</div>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="shipping[state]" value="<?php echo $shippingAddress->state; ?>" required="">
    </div>
</div>

<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Zipcode:</div>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="shipping[zipcode]" value="<?php echo $shippingAddress->zipcode; ?>" required="">
    </div>
</div>

<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Country:</div>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="shipping[country]" value="<?php echo $shippingAddress->country; ?>" required="">
    </div>
</div>


<div class="form-group mt-5">
    <div class="col-sm-10">
    <?php if ($id = $this->getRequest()->getGet('id')): ?>
        <button type="button" class="btn btn-primary" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('save','admin_customer',['id' => $id]) ?>').resetParams().setParams($('#editForm').serializeArray()).setMethod('POST').load()">Save</button>
    <?php else: ?>
        <button type="button" class="btn btn-primary" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('save',null,null) ?>').resetParams().setParams($('#editForm').serializeArray()).setMethod('POST').load()">Save</button>
    <?php endif; ?>
    </div>
</div>