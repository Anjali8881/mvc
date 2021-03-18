<?php
$categories = $this->getCategories();
?>
<section>
    <div class="container mt-5 w-100">
        <h2>View Category Records
            <a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('edit','admin_category');?>').resetParams().load()"  class="btn btn-primary" style="float:right;">Add New Record</a>
        </h2>
        <hr>
        <div class="center mt-2">
            <div class="col-12">
                <?php  if($success = $this->getAdminMessage()->getSuccess()): ?>
                     <?php  $this->getAdminMessage()->clearSuccess();   ?>
                    <div class="alert alert-success " role="alert"><?php echo $success;  ?></div>
                <?php endif; ?>
                <?php if($failure = $this->getAdminMessage()->getFailure()): ?> 
                    <?php  $this->getAdminMessage()->clearFailure(); ?> 
                    <div class="alert alert-danger" role="alert"><?php echo $failure;  ?></div>
                <?php endif; ?>
            </div>
        </div>
        <table class="table table-hover mt-4">
            <thead>
                <tr>
                    <th class="bg-dark text-white">Id</th>
                    <th class="bg-dark text-white">Name</th>
                    <th class="bg-dark text-white">Status</th>
                    <th class="bg-dark text-white">Featured</th>
                    <th class="bg-dark text-white">Created Date</th>
                    <th class="bg-dark text-white">Description</th>
                    <th class="bg-dark text-white">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!$categories): ?>
                    <tr>
                        <td>No records found</td>
                    </tr>
                <?php else: ?>
                <?php foreach ($categories->getData() as $key => $value): ?>
                    <tr>
                        <td><?php echo $value->categoryId ?></td>
                        <td><?php echo $this->getName($value) ?></td>
                        <td><?php if($value->status == 1): ?>
                                <?php echo "Enable"; ?>
                            <?php else: ?>
                                <?php echo "Disable"; ?>
                        </td>
                        <?php endif; ?>
                        <td><?php if($value->featured == 1): ?>
                                <?php echo "Yes"; ?>
                            <?php else: ?>
                                <?php echo "No"; ?>
                        </td>
                        <?php endif; ?>
                        <td><?php echo $value->createdDate ?></td>
                        <td><?php echo $value->description ?></td>
                        <td>
                            <a onclick="object.setUrl('<?php  echo $this->getUrl()->getUrl('edit',null,['id'=>$value->categoryId]); ?>').resetParams().load()"  style="color:green">
                            <i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;
                            <a style="color:red" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('delete','admin_category',['id'=>$value->categoryId]); ?>').resetParams().load();">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach;  ?>
                    <?php endif; ?>
                </tbody>
        </table>
    </div>
</section>
    