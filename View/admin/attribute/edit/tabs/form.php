<?php
$attribute = $this->getTableRow();
$entityType = $attribute->getEntityTypes();
$inputType = $attribute->getInputTypeOptions();
$backendType = $attribute->getBackenedTypeOptions();
?>

<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Entity Type:</div>
    <div class="col-sm-8">
        <select class="form-select" name="attribute[entityTypeId]">
        <?php if($entityType): ?>
            <?php foreach($entityType as $key => $value): ?>
            <option value="<?php echo $key; ?>" <?php if($key == $attribute->entityTypeId){ ?> selected <?php } ?>><?php echo $value; ?></option>
            <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>
</div>

<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Name:</div>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="attribute[name]" value="<?php echo $attribute->name; ?>" required="">
    </div>
</div>

<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Code:</div>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="attribute[code]" value="<?php echo $attribute->code; ?>" required="">
    </div>
</div>

<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Input Type:</div>
    <div class="col-sm-8">
        <select class="form-select" name="attribute[inputType]">
        <?php if($inputType): ?>
            <?php foreach($inputType as $key => $value): ?>
            <option value="<?php echo $key; ?>" <?php if($key == $attribute->inputTypeId){ ?> selected <?php } ?>><?php echo $value; ?></option>
            <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>
</div>

<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Backend Type:</div>
    <div class="col-sm-8">
        <select class="form-select" name="attribute[backendType]">
        <?php if($backendType): ?>
            <?php foreach($backendType as $key => $value): ?>
            <option value="<?php echo $key; ?>" <?php if($key == $attribute->backendId){ ?> selected <?php } ?>><?php echo $value; ?></option>
            <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>
</div>

<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Sort Order:</div>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="attribute[sortOrder]" value="<?php echo $attribute->sortOrder; ?>" required="">
    </div>
</div>

<div class="form-group mt-5">
    <div class="col-sm-10">
    <?php if ($id = $this->getRequest()->getGet('id')): ?>
        <button type="button" class ="btn btn-primary" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('save',null,['id' => $id],true) ?>').resetParams().setParams($('#editForm').serializeArray()).setMethod('POST').load()">Save</button>
    <?php else: ?>
        <button type="button" class ="btn btn-primary" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('save',null,null,true) ?>').resetParams().setParams($('#editForm').serializeArray()).setMethod('POST').load()">Save</button>
    <?php endif; ?>
    </div>
</div>