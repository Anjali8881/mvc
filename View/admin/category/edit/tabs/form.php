<?php
$category = $this->getTableRow();
$categoryOptions = $this->getCategoryOptions();
$categoryStatus = $category->getStatusOptions();
$categoryFeatured = $category->getFeaturedOptions();

?>
<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Parent Category Name:</div>
    <div class="col-sm-8">
        <select class="form-select" name="category[parentCategoryId]">
        <?php if($categoryOptions): ?>
            <?php foreach($categoryOptions as $categoryId => $name):  ?>
            <option value="<?php echo $categoryId; ?>" <?php if($categoryId == $category->parentCategoryId): ?> selected <?php endif; ?>><?php echo $name; ?></option>
            <?php endforeach; ?>
        <?php endif; ?>
        </select>
    </div>
</div>
<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Name:</div>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="category[name]" value="<?php echo $category->name; ?>" required="">
    </div>
</div>

<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Status:</div>
    <div class="col-sm-8">
        <select name="category[status]" class="form-control">
           <?php foreach($categoryStatus as $key => $value): ?>
            <option value="<?php echo $key; ?>"<?php if($category->status == $key): ?> selected <?php endif; ?>><?php echo $value; ?></option>
        <?php endforeach; ?>
        </select>
    </div>
</div>

<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Featured:</div>
    <div class="col-sm-8">
        <select name="category[featured]" class="form-control">
           <?php foreach($categoryFeatured as $key => $value): ?>
            <option value="<?php echo $key; ?>"<?php if($category->featured == $key): ?> selected <?php endif; ?>><?php echo $value; ?></option>
        <?php endforeach; ?>
        </select>
    </div>
</div>

<div class="form-group row mt-5">
    <div class="col-sm-2 font-weight-bold">Description:</div>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="category[description]" value="<?php echo $category->description; ?>" required="">
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