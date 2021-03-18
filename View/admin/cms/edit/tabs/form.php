<?php
$cmsDetail = $this->getTableRow();
?>

<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Title:</div>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="cms[title]" value="<?php echo $cmsDetail->title; ?>" required="">
    </div>
</div>

<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Identifier:</div>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="cms[identifier]" value="<?php echo $cmsDetail->identifier; ?>" required="">
    </div>
</div>

<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Content:</div>
    <div class="col-sm-8">
       <textarea name="cms[content]" id="content" class="form-control" onfocus="$('#content').summernote();"><?php echo $cmsDetail->content ?></textarea>
    </div>
</div>

<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Satus:</div>
    <div class="col-sm-8">
        <select name="cms[status]" class="form-control">
            <?php foreach($cmsDetail->getStatusOptions() as $key => $value): ?>
                <option value="<?php echo $key; ?>" ><?php echo $value; ?></option>
            <?php endforeach; ?>
        </select>          
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