<?php
$customer = $this->getTableRow();
$customerGroup = $this->customerGroup()->getData();
?>
<div class="form-group row mt-5">

<div class="col-sm-2 font-weight-bold">Customer Group:</div>
<div class="col-sm-8">
   <select class="form-select" name="customer[groupId]">
    <?php if($customerGroup): ?>
        <?php foreach($customerGroup as $groupId => $name): ?>
            <option value="<?php echo $name->groupId ?>"><?php echo $name->name ?></option>
        <?php endforeach; ?>
    <?php endif; ?>
   </select>
</div>
</div>
<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">First Name :</div>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="customer[firstName]"  value="<?php echo $customer->firstName; ?>" required="">
    </div>
</div>
<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Last Name:</div>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="customer[lastName]" value="<?php echo $customer->lastName; ?>"  required="">
    </div>
</div>
<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Email address:</div>
    <div class="col-sm-8">
        <input type="email" class="form-control" name="customer[email]" value="<?php echo $customer->email; ?>" required="">
    </div>
</div>
<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Satus:</div>
    <div class="col-sm-8">
        <select name="customer[status]" class="form-control">
            <?php foreach($customer->getStatusOptions() as $key => $value): ?>
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