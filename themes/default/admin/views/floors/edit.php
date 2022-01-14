<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script type="text/javascript">
    $(document).ready(function () {
        $('.gen_slug').change(function(e) {
            getSlug($(this).val(), 'products');
        });

        $('#code').bind('keypress', function (e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                return false;
            }
        });
    });
</script>

<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-edit"></i><?= lang('edit_floor'); ?></h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext"><?php echo lang('update_info'); ?></p>
                <?php
                $attrib = array('data-toggle' => 'validator', 'role' => 'form');
                echo admin_form_open_multipart("floors/edit/" . $floor->id, $attrib)
                ?>
                <div class="col-md-5">
                    <div class="form-group all">
                        <?= lang("floor_name", "name") ?>
                        <?= form_input('name', (isset($_POST['name']) ? $_POST['name'] : ($floor ? $floor->name : '')), 'class="form-control" id="name" required="required"'); ?>
                    </div>

                    <div class="form-group all">
                        <?= lang("slug", "slug") ?>
                        <?= form_input('slug', (isset($_POST['slug']) ? $_POST['slug'] : ($floor ? $floor->slug : '')), 'class="form-control" id="slug" required="required"'); ?>
                    </div>

                    <div class="form-group">
                        <?= lang("floor_lift_option", "lift_option") ?>
                        <?php
                        $opts = array('0' => lang('no'), '1' => lang('yes'));
                        echo form_dropdown('lift_option', $opts, (isset($_POST['lift_option']) ? $_POST['lift_option'] : ($floor ? $floor->lift_option : '')), 'class="form-control" id="lift_option" required="required"');
                        ?>
                    </div>
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo form_submit('edit_floor', $this->lang->line("edit_floor"), 'class="btn btn-primary"'); ?>
                    </div>

                </div>
                <?= form_close(); ?>

            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('form[data-toggle="validator"]').bootstrapValidator({ excluded: [':disabled'] });

    });
</script>
