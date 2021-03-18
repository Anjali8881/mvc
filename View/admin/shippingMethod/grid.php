<?php $shippingMethods = $this->getShippingMethods()->getData(); ?>
<section>
    <div class="container mt-5 w-100 h-100">
    <h2>View Shipping Method Records
        <a onclick="object.setUrl('<?php echo  $this->getUrl()->getUrl('edit','admin_shippingMethod') ?>').resetParams().load();" class="btn btn-primary" style="float:right;">Add New Record</a>
    </h2>
    <hr>
    <div class="center mt-2">
        <div class="col-12">
            <?php  if($success = $this->getAdminMessage()->getSuccess()): ?> <?php $this->getAdminMessage()->clearSuccess();   ?>
                <div class="alert alert-success " role="alert"><?php echo $success;  ?></div>
            <?php endif; ?>
            <?php if($failure = $this->getAdminMessage()->getFailure()): ?> <?php $this->getAdminMessage()->clearFailure(); ?> 
                <div class="alert alert-danger" role="alert"><?php echo $failure;  ?></div>
            <?php endif; ?>
        </div>
    </div>
    <table class="table table-hover mt-4">
        <thead>
            <tr>
                <th class="bg-dark text-white">Id</th>
                <th class="bg-dark text-white">Name</th>
                <th class="bg-dark text-white">Code</th>
                <th class="bg-dark text-white">Amount</th>
                <th class="bg-dark text-white">Description</th>
                <th class="bg-dark text-white">Status</th>
                <th class="bg-dark text-white">Created Date</th>
                <th class="bg-dark text-white">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!$shippingMethods): ?>
                <tr>
                    <td>No records found</td>
                </tr>
            <?php else: ?>
                <?php foreach ($shippingMethods as $key => $value): ?>
                    <tr>
                        <td><?php echo $value->shippingMethodId ?></td>
                        <td><?php echo $value->name ?></td>
                        <td><?php echo $value->code ?></td>
                        <td><?php echo $value->amount ?></td>
                        <td><?php echo $value->description ?></td>
                        <td><?php if ($value->status == 1): ?>
                            <?php echo "Enable"; ?>
                        <?php else: ?>
                            <?php echo "Disable"; ?>
                        </td>
                        <?php endif; ?>
                        <td><?php echo $value->createdDate ?></td>
                        <td>
                            <a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('edit',null,['id'=>$value->shippingMethodId]) ?>').resetParams().load();" style="color:green">
                            <i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp
                            <a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('delete',null,['id'=>$value->shippingMethodId]);?>').resetParams().load();" style="color:red" onclick="confirm('Are you sure want to delete this record')">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
