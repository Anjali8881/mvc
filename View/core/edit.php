<table width="100%" height="100%">
    <tbody>
        <tr>
            <td><?php echo $this->getTabHtml(); ?></td>
            <td>
                <form id="editForm" action="<?php $this->getUrl()->getUrl('save'); ?>">
                <?php echo $this->getTabContent(); ?>
                </form>
            </td>
        </tr>
    </tbody>
</table>