<html>
    <table width="100%" border="0px">
        <tr>
            <td colspan="3"><?php echo $this->getChild('header')->toHtml(); ?></td>
        </tr>
        <tr>
            <td width="150px"><?php echo $this->getChild('left')->toHtml(); ?></td>
            <td><?php echo $this->getChild('content')->toHtml(); ?></td>
            <td width="150px"></td>
        </tr>
        <tr>
            <td height ="100px" colspan="3"><?php echo $this->getChild('footer')->toHtml(); ?></td>
        </tr>
    </table>
</html>