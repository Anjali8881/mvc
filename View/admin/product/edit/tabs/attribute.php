<?php
$attributes = $this->getProductAttribute()->getData();
?>

<?php foreach($attributes as $attribute): ?>
 <?php if($attribute->inputType == "select"): ?>
    <label><?= $attribute->name ?></label>
    <select name="product[<?= $attribute->code ?>]">
        <?php foreach($attribute->getOptions()->getData() as $option): ?>
            <option value="<?= $option->optionId; ?>"><?= $option->name; ?></option>
        <?php endforeach; ?>
    </select>
 <?php elseif($attribute->inputType == "radio"): ?>
    <label><?= $attribute->name ?></label>
    <?php foreach($attribute->getOptions()->getData() as $option): ?>
        <input type="<?= $attribute->inputType ?>" id="<?= $option->optionId ?>" name="product[<?= $attribute->code ?>]" value="<?= $option->optionId; ?>"><?= $option->name; ?>
    <?php endforeach; ?>
<?php elseif($attribute->inputType == "checkbox"): ?>
    <label><?= $attribute->name ?></label>
    <?php foreach($attribute->getOptions()->getData() as $option): ?>
        <input type="<?= $attribute->inputType ?>" name="product[<?= $attribute->code ?>]" value="<?= $option->optionId; ?>"><?= $option->name; ?>
    <?php endforeach; ?>
 <?php endif; ?>
<?php endforeach; ?>
<button type="button" class ="btn btn-primary" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('save') ?>').resetParams().setParams($('#editForm').serializeArray()).setMethod('POST').load()">Save</button>