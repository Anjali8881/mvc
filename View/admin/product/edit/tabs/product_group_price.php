<?php
$product = $this->getTableRow();
$customerGroups = $this->getCustomerGroup();

?>
<table class="table table-hover mt-4">
  <thead>
    <tr>
      <th class="bg-dark text-white">Group Id</th>
      <th class="bg-dark text-white">Group Name</th>
      <th class="bg-dark text-white">Price</th>
      <th class="bg-dark text-white">Group Price</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php foreach($customerGroups->getData() as $key => $value): ?>
      <?php $rowStatus = ($value->entityId) ? 'exist' : 'new'; ?>
        <td><?php echo $value->groupId ?></td>
        <td><?php echo $value->name ?></td>
        <td><?php echo $value->price ?></td>
        <td><input type="text" name="groupPrice[<?php echo $rowStatus; ?>][<?php echo $value->groupId ?>]" value="<?php echo $value->groupPrice ?>"></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<div class="form-group mt-5">
    <div class="col-sm-10">
        <button type="button" class="btn btn-primary" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('save','admin_product_productGroupPrice') ?>').resetParams().setParams($('#editForm').serializeArray()).setMethod('POST').load()">Save</button>
    </div>
</div>