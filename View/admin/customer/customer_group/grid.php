<?php $customerGroup = $this->getCustomerGroups(); ?>
<section>
    <div class="container mt-5 w-100 h-100">
        <h2 >View Customer Group Records
            <a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('edit','admin_customer_customerGroup') ?>').resetParams().load();" class="btn btn-primary" style="float:right;">Add New Record</a>
        </h2>
        <hr>
        <div class="center mt-2">
            <div class="col-12">
                <?php  if($success = $this->getAdminMessage()->getSuccess()): ?> <?php $this->getAdminMessage()->clearSuccess(); ?>
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
                    <th class="bg-dark text-white">Default Type</th>
                    <th class="bg-dark text-white">Created Date</th>
                    <th class="bg-dark text-white">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!$customerGroup): ?>
                    <tr>
                        <td>No records found</td>
                    </tr>
                <?php else: ?>
                <?php foreach ($customerGroup->getData() as $key => $value):?>
                    <tr>
                        <td><?php echo $value->groupId ?></td>
                        <td><?php echo $value->name ?></td>
                        <td><?php if ($value->defaultType == 1): ?>
                        <?php echo "Yes"; ?>
                        <?php else: ?>
                        <?php echo "No"; ?>
                        </td>
                        <?php endif; ?>
                        <td><?php echo $value->createdDate ?></td>
                        <td>
                            <a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('edit',null,['id'=>$value->groupId]);?>').resetParams().load();" style="color:green">
                            <i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp
                            <a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('delete',null,['id'=>$value->groupId]);?>').resetParams().load();" style="color:red" >
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
