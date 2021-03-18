<?php $customers = $this->getCustomers()->getData(); ?>
<section>
    <div class="container mt-5 w-100 h-100">
        <h2 >View Customer Records
            <a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('edit','admin_customer') ?>').resetParams().load();" class="btn btn-primary" style="float:right;">Add New Record</a>
        </h2>
        <hr>
        <div class="center mt-2">
            <div class="col-12">
                <?php  if($success = $this->getAdminMessage()->getSuccess()): ?> <?php $this->getAdminMessage()->clearSuccess();   ?>
                    <div class="alert alert-success " role="alert"><?php echo $success;  ?> </div>
                <?php endif; ?>
                <?php if($failure = $this->getAdminMessage()->getFailure()): ?> <?php  $this->getAdminMessage()->clearFailure(); ?> 
                    <div class="alert alert-danger" role="alert"><?php echo $failure;  ?></div>
                <?php endif; ?>
            </div>
        </div>
        <table class="table table-hover mt-4">
            <thead>
                <tr>
                    <th class="bg-dark text-white">Id</th>
                    <th class="bg-dark text-white">Customer Group</th>
                    <th class="bg-dark text-white">First Name</th>
                    <th class="bg-dark text-white">Last Name</th>
                    <th class="bg-dark text-white">Address</th>
                    <th class="bg-dark text-white">Email</th>
                    <th class="bg-dark text-white">Status</th>
                    <th class="bg-dark text-white">Created Date</th>
                    <th class="bg-dark text-white">Updated Date</th>
                    <th class="bg-dark text-white">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!$customers): ?>
                    <tr>
                        <td>No records found</td>
                    </tr>
                <?php else: ?>
                        <?php foreach ($customers as $key => $value): ?>
                            <tr>
                                <td><?php echo $value->customerId ?></td>
                                <td><?php echo $this->getCustomerGroups($value) ?></td>
                                <td><?php echo $value->firstName ?></td>
                                <td><?php echo $value->lastName ?></td>
                                <td><?php echo $this->getCustomerAddress($value) ?></td>
                                <td><?php echo $value->email ?></td>
                                <td><?php if ($value->status == 1): ?>
                                    <?php echo "Enable"; ?>
                                    <?php else: ?>
                                        <?php echo "Disable"; ?>
                                </td>
                                <?php endif; ?>
                                <td><?php echo $value->createdDate ?></td>
                                <td><?php echo $value->updatedDate ?></td>
                                <td>
                                    <a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('edit',null,['id'=>$value->customerId]);?>').resetParams().load();" style="color:green">
                                    <i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp
                                    <a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('delete',null,['id'=>$value->customerId]);?>').resetParams().load();" style="color:red" >
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
