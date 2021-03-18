<?php
$customerGroup = $this->getTableRow();
?>
<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Group Name :</div>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="customerGroup[name]"  value="<?php echo $customerGroup->name; ?>" required="">
    </div>
</div>
<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Default:</div>
    <div class="col-sm-8">
        <select name="customerGroup[defaultType]" class="form-control">
            <?php foreach($customerGroup->getDefaultOptions() as $key => $value): ?>
            <option value="<?php echo $key; ?>" >
            <?php echo $value; ?>
            </option>
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
                
                