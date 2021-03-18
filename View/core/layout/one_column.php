<html>
    <body>
    <table width="100%" border="0px">
        <tr>
            <td height="50px"><?php echo $this->getChild('header')->toHtml(); ?></td>
        </tr>
        <tr>
            <td><?php echo $this->getChild('content')->toHtml(); ?></td>
        </tr>
        <tr>
            <td height ="100px" ><?php echo $this->getChild('footer')->toHtml(); ?></td>
        </tr>
    </table> 
    </body>
</html>