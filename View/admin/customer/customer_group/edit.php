<!DOCTYPE html>
<html>
    <head>
    <title>Questecom</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    </head>

    <body>
        <h2 class="font-weight-bold text-center mt-5 mx-5 my-5"><?php echo $this->getTitle(); ?></h2>
        <div class="container">
            <hr style="height:1px;border-width:0;color:gray;background-color:gray">
            <form id="customerGroupForm">
            <?php echo $this->getTabContent(); ?>
            </form>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>