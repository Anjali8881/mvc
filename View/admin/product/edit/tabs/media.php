<?php $media = $this->getMedia(); ?>
<div class="container mx-auto m-5">
	<section>
		<div class="container">
         	<button type="button" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('update','admin_product_media');?>').resetParams().setParams($('#productForm').serializeArray()).setMethod('POST').load();" class="btn btn-success" >Update</button>
			<button type="button" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('delete','admin_product_media');?>').resetParams().setParams($('#productForm').serializeArray()).setMethod('POST').load();" class="btn btn-success">Remove</button>
		<div><br>
		<table class="table">
			<thead>
				<tr>
					<th class="bg-dark text-white">Image</th>
					<th class="bg-dark text-white">Label</th>
					<th class="bg-dark text-white">Small</th>
					<th class="bg-dark text-white">Thumb</th>
					<th class="bg-dark text-white">Base</th>
					<th class="bg-dark text-white">Gallery</th>
					<th class="bg-dark text-white">Remove</th>
				</tr>
			</thead>
			<tbody>
				<?php if(!$media): ?>
					<tr>
						<td>No records</td>
					</tr>
				<?php else: ?>
					<tr>
						<?php foreach($media->getData() as $key => $value): ?>
							<td><img src="<?php echo './images/'.$value->image; ?>" height="100" width="100"></td>
							<td><input type="text" name="label[<?= $value->mediaId; ?>]" value="<?php echo $value->label;?>"></td>
							<td><input type="radio" name="small" value="<?= $value->mediaId ?>" <?php if($value->small== 1):?>
							<?php echo 'checked';?> <?php endif;?> ></td>
							<td><input type="radio" name="thumb" value="<?= $value->mediaId ?>" <?php if($value->thumb== 1):?>
							<?php echo 'checked';?>
							<?php endif;?>></td>
							<td><input type="radio" name="base" value="<?= $value->mediaId ?>" <?php if($value->base== 1):?>
							<?php echo 'checked';?>
							<?php endif;?>></td>
							<td><input type="checkbox" name="gallery[<?= $value->mediaId; ?>]" <?php if($value->gallery== 1):?>
							<?php echo 'checked';?>
							<?php endif;?>></td>
							<td><input type="checkbox" name="remove[<?= $value->mediaId; ?>]"></td>
					</tr>
						<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
		<div>
			<form>
				<input type="file" name="file" id="mediaImage">
				<button type="button" name="file" id="uploadImage" 
					onclick="
						var form = new FormData();
                		var file = $('#mediaImage')[0].files;
						form.append('file',file[0]);
						object.setUrl('<?php echo $this->getUrl()->getUrl('upload','admin_product_media');?>').resetParams().setParams(form).setMethod('POST').upload();
						">Upload</button>
			</form>
		</div>
	</div>
	</div>
</section>
</div>
