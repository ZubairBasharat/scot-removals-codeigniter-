<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="fa fa-2x">&times;</i>
        </button>
        <button type="button" class="btn btn-xs btn-default no-print pull-right" style="margin-right:15px;" onclick="window.print();">
            <i class="fa fa-print"></i> <?= lang('print'); ?>
        </button>
        <h4 class="modal-title" id="myModalLabel"><?= $floor->name.(SHOP && $floor->hide != 1 ? ' ('.lang('shop_views').': '.$floor->views.')' : ''); ?></h4>
    </div>
        <div class="modal-body">
            <div class="row">
            <div class="col-lg-12">
                        <div class="row">
                            <div class="col-sm-5">
                                <table class="table table-borderless dfTable table-right-left">
                                    <tbody>
                                        <!-- <tr>
                                            <td colspan="2" style="background-color:#FFF;"></td>
                                        </tr> -->
                                        <tr>
                                            <td><?= lang("floor_name"); ?></td>
                                            <td><?php echo lang($floor->name); ?></td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("slug"); ?></td>
                                            <td><?php echo lang($floor->slug); ?></td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("floor_lift_option"); ?></td>
                                            <td><?php if($floor->lift_option == 1){echo "Yes";}else{echo "No";} ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="clearfix"></div>
                        </div>

                        <?php if (!$Supplier || !$Customer) { ?>
                        <div class="buttons">
                            <div class="btn-group btn-group-justified">
                                <!-- <div class="btn-group">
                                    <a href="<?= admin_url('floors/pdf/' . $floor->id) ?>" class="tip btn btn-primary" title="<?= lang('pdf') ?>">
                                        <i class="fa fa-download"></i> <span class="hidden-sm hidden-xs"><?= lang('pdf') ?></span>
                                    </a>
                                </div> -->
                                <div class="btn-group">
                                    <a href="<?= admin_url('floors/edit/' . $floor->id) ?>" class="tip btn btn-warning tip" title="<?= lang('edit_floor') ?>">
                                        <i class="fa fa-edit"></i> <span class="hidden-sm hidden-xs"><?= lang('edit') ?></span>
                                    </a>
                                </div>
                                <div class="btn-group">
                                    <a href="#" class="tip btn btn-danger bpo" title="<b><?= lang("delete_floor") ?></b>"
                                        data-content="<div style='width:150px;'><p><?= lang('r_u_sure') ?></p><a class='btn btn-danger' href='<?= admin_url('floors/delete/' . $floor->id) ?>'><?= lang('i_m_sure') ?></a> <button class='btn bpo-close'><?= lang('no') ?></button></div>"
                                        data-html="true" data-placement="top">
                                        <i class="fa fa-trash-o"></i> <span class="hidden-sm hidden-xs"><?= lang('delete') ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
            </div>
</div>
<?php if (!$Supplier || !$Customer) { ?>
    <!-- <div class="buttons">
        <div class="btn-group btn-group-justified">
            <div class="btn-group">
                <a href="<?= admin_url('floors/pdf/' . $floor->id) ?>" class="tip btn btn-primary" title="<?= lang('pdf') ?>">
                    <i class="fa fa-download"></i>
                    <span class="hidden-sm hidden-xs"><?= lang('pdf') ?></span>
                </a>
            </div>
            <div class="btn-group">
                <a href="<?= admin_url('floors/edit/' . $floor->id) ?>" class="tip btn btn-warning tip" title="<?= lang('edit_floor') ?>">
                    <i class="fa fa-edit"></i>
                    <span class="hidden-sm hidden-xs"><?= lang('edit') ?></span>
                </a>
            </div>
            <div class="btn-group">
                <a href="#" class="tip btn btn-danger bpo" title="<b><?= lang("delete_floor") ?></b>"
                    data-content="<div style='width:150px;'><p><?= lang('r_u_sure') ?></p><a class='btn btn-danger' href='<?= admin_url('floors/delete/' . $floor->id) ?>'><?= lang('i_m_sure') ?></a> <button class='btn bpo-close'><?= lang('no') ?></button></div>"
                    data-html="true" data-placement="top">
                    <i class="fa fa-trash-o"></i>
                    <span class="hidden-sm hidden-xs"><?= lang('delete') ?></span>
                </a>
            </div>
        </div>
    </div> -->
    <script type="text/javascript">
    $(document).ready(function () {
        $('.tip').tooltip();
    });
    </script>
<?php } ?>
</div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('.change_img').click(function(event) {
        event.preventDefault();
        var img_src = $(this).attr('href');
        $('#pr-image').attr('src', img_src);
        return false;
    });
});
</script>
