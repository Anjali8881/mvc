<?php
$attributes = $this->getAttributes();
?>

            <section>
                <div class="container mt-5 w-100">
                    <h2>View Attributes Records
                    <a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('edit','admin_attribute');?>').resetParams().load()"  class="btn btn-primary" style="float:right;">Add New Record</a>
                    </h2>
                    <hr>
                    <div class="center mt-2">
                        <div class="col-12">
                            <?php  if($success = $this->getAdminMessage()->getSuccess()) { $this->getAdminMessage()->clearSuccess();   ?>
                            <div class="alert alert-success " role="alert"><?php echo $success;  ?>
                            </div>
                            <?php } ?>
                            <?php if($failure = $this->getAdminMessage()->getFailure()) { $this->getAdminMessage()->clearFailure(); ?> 
                            <div class="alert alert-danger" role="alert"><?php echo $failure;  ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <table class="table table-hover mt-4">
                        <thead>
                            <tr>
                                <th class="bg-dark text-white">Attribute Id</th>
                                <th class="bg-dark text-white">Entity Type Id</th>
                                <th class="bg-dark text-white">Name</th>
                                <th class="bg-dark text-white">Code</th>
                                <th class="bg-dark text-white">Input Type</th>
                                <th class="bg-dark text-white">Backend Type</th>
                                <th class="bg-dark text-white">Sort Order</th>
                                <th class="bg-dark text-white">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!$attributes): ?>
                                <tr>
                                    <td>No records found</td>
                                </tr>
                                <?php else: ?>
                            <?php
                                
                                foreach ($attributes->getData() as $key => $value) {
                                ?>
                                <tr>
                                <td><?php echo $value->attributeId ?></td>
                                <td><?php echo $value->entityTypeId ?></td>
                                <td><?php echo $value->name ?></td>
                                <td><?php echo $value->code ?></td>
                                <td><?php echo $value->inputType ?></td>
                                <td><?php echo $value->backendType ?></td>
                                <td><?php echo $value->sortOrder ?></td>
                                <td>
                                    <a onclick="object.setUrl('<?php  echo $this->getUrl()->getUrl('edit',null,['id'=>$value->attributeId]); ?>').resetParams().load()"  style="color:green">
                                    <i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;
                                    <a style="color:red" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('delete','admin_attribute',['id'=>$value->attributeId]); ?>').resetParams().load();">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </td>
                                </tr>
                            <?php }  ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>
  