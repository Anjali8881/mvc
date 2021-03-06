<?php $attribute = $this->getTableRow()->getOptions();
?>
<form action="" method="post">
    <table class="table" id="existingTable">
        <thead>
            <th class="bg-dark text-white">Option Name</th>
            <th class="bg-dark text-white">Sort Order</th>
            <th class="bg-dark text-white">Action</th>
        </thead>
        <tbody>
            <?php if(!$attribute): ?>
                <tr><td></td></tr>
            <?php else: ?>
            <?php foreach($attribute->getData() as $key => $option): ?>
            <tr>
            <td><input type="text" name="exist[<?php echo $option->optionId ?>][name]" value="<?php echo $option->name;?>" class="form-control"></td>
            <td><input type="text" name="exist[<?php echo $option->optionId ?>][sortOrder]" value="<?php echo $option->sortOrder;?>" class="form-control"></td>
            <td><input type="submit" name="removeOption" onclick="removeRow(this)" value="Remove" class="btn btn-danger"></td>
            </tr>
            <?php endforeach;?>
            <?php endif; ?>
        </tbody>
        <tfoot>
            <td><button type="button" class="btn btn-success" id="addNewRow">Add</button>&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-success" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('save','admin_attribute_option');?>').resetParams().setParams($('#editForm').serializeArray()).load();">Update</button></td>
            <td></td><td></td>
        </tfoot>

    </table>
</form>

<script type="text/javascript">
    function removeRow(button) {
        $(button).closest('tr').remove();
    }
    $('#addNewRow').click(function () {
        $('#existingTable').append('<tr> <td><input type="text" name="new[name][]" class="form-control"></td> <td><input type="text" name="new[sortOrder][]" class="form-control"></td> <td><input type="button" name="removeOption" value="Remove" class="btn btn-danger" onclick="removeRow(this)"></td></tr>');
    });
</script>