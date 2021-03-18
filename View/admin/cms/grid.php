<?php
$cmsDetails = $this->getCms();
?>
<section>
    <div class="container mt-5 w-100">
        <h2>View Cms Records
            <a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('edit','admin_cms');?>').resetParams().load()"  class="btn btn-primary" style="float:right;">Add New Record</a>
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
                    <th class="bg-dark text-white">Title</th>
                    <th class="bg-dark text-white">Identifier</th>
                    <th class="bg-dark text-white">Content</th>
                    <th class="bg-dark text-white">Status</th>
                    <th class="bg-dark text-white">Created Date</th>
                    <th class="bg-dark text-white">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!$cmsDetails): ?>
                    <tr>
                        <td>No records found</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($cmsDetails->getData() as $key => $value): ?>
                        <tr>
                            <td><?php echo $value->pageId ?></td>
                            <td><?php echo $value->title ?></td>
                            <td><?php echo $value->identifier ?></td>
                            <td><?php echo $value->content ?></td>
                            <td><?php if ($value->status == 1): ?>
                                    <?php echo "Enable"; ?>
                                    <?php else: ?>
                                        <?php echo "Disable"; ?>
                                </td>
                                <?php endif; ?>
                            <td><?php echo $value->createdDate ?></td>
                            <td>
                                <a onclick="object.setUrl('<?php  echo $this->getUrl()->getUrl('edit',null,['id'=>$value->pageId]); ?>').resetParams().load()"  style="color:green">
                                <i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;
                                <a style="color:red" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('delete','admin_cms',['id'=>$value->pageId]); ?>').resetParams().load();">
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
  