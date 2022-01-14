<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if ($Owner || $Admin) { ?>
    <ul id="myTab" class="nav nav-tabs">
        <li class=""><a href="#details" class="tab-grey"><?= lang('product_details') ?></a></li>
        <li class=""><a href="#chart" class="tab-grey"><?= lang('chart') ?></a></li>
        <li class=""><a href="#sales" class="tab-grey"><?= lang('sales') ?></a></li>
    </ul>

<div class="tab-content">
    <div id="details" class="tab-pane fade in">
        <?php } ?>
        <div class="box">
            <div class="box-header">
                <h2 class="blue"><i class="fa-fw fa fa-file-text-o nb"></i> <?= $product->name.(SHOP && $product->hide != 1 ? ' ('.lang('shop_views').': '.$product->views.')' : ''); ?></h2>

                <div class="box-icon">
                    <ul class="btn-tasks">
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="icon fa fa-tasks tip" data-placement="left" title="<?= lang("actions") ?>"></i>
                            </a>
                            <ul class="dropdown-menu pull-right tasks-menus" role="menu"
                                aria-labelledby="dLabel">
                                <li>
                                    <a href="<?= admin_url('products/edit/' . $product->id) ?>">
                                        <i class="fa fa-edit"></i> <?= lang('edit') ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= admin_url('products/pdf/' . $product->id) ?>">
                                        <i class="fa fa-download"></i> <?= lang('pdf') ?>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="#" class="bpo" title="<b><?= lang("delete_product") ?></b>"
                                        data-content="<div style='width:150px;'><p><?= lang('r_u_sure') ?></p><a class='btn btn-danger' href='<?= admin_url('products/delete/' . $product->id) ?>'><?= lang('i_m_sure') ?></a> <button class='btn bpo-close'><?= lang('no') ?></button></div>"
                                        data-html="true" data-placement="left">
                                        <i class="fa fa-trash-o"></i> <?= lang('delete') ?>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="box-content">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="introtext"><?php echo lang('product_details'); ?></p>

                        <div class="row">
                            <div class="col-sm-5">
                                <img src="<?= base_url() ?>assets/uploads/<?= $product->image ?>"
                                     alt="<?= $product->name ?>" class="img-responsive img-thumbnail"/>

                                <div id="multiimages" class="padding10">
                                    <?php if (!empty($images)) {
                                        echo '<a class="img-thumbnail" data-toggle="lightbox" data-gallery="multiimages" data-parent="#multiimages" href="' . base_url() . 'assets/uploads/' . $product->image . '" style="margin-right:5px;"><img class="img-responsive" src="' . base_url() . 'assets/uploads/thumbs/' . $product->image . '" alt="' . $product->image . '" style="width:' . $Settings->twidth . 'px; height:' . $Settings->theight . 'px;" /></a>';
                                        foreach ($images as $ph) {
                                            echo '<div class="gallery-image"><a class="img-thumbnail" data-toggle="lightbox" data-gallery="multiimages" data-parent="#multiimages" href="' . base_url() . 'assets/uploads/' . $ph->photo . '" style="margin-right:5px;"><img class="img-responsive" src="' . base_url() . 'assets/uploads/thumbs/' . $ph->photo . '" alt="' . $ph->photo . '" style="width:' . $Settings->twidth . 'px; height:' . $Settings->theight . 'px;" /></a>';
                                            if ($Owner || $Admin || $GP['products-edit']) {
                                                echo '<a href="#" class="delimg" data-item-id="'.$ph->id.'"><i class="fa fa-times"></i></a>';
                                            }
                                            echo '</div>';
                                        }
                                    }
                                    ?>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="table-responsive">
                                    <table class="table table-borderless table-striped dfTable table-right-left">
                                        <tbody>
                                        <tr>
                                            <td colspan="2" style="background-color:#FFF;"></td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("type"); ?></td>
                                            <td><?php echo lang($product->type); ?></td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("name"); ?></td>
                                            <td><?php echo $product->name; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("code"); ?></td>
                                            <td><?php echo $product->code; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("category"); ?></td>
                                            <td><?php echo $category->name; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?= lang("price"); ?></td>
                                            <td><?php echo $this->sma->formatMoney($product->price); ?></td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="clearfix"></div>

                            <div class="col-sm-12">
                                <?= $product->product_details ? '<div class="panel panel-primary"><div class="panel-heading">' . lang('product_details') . '</div><div class="panel-body">' . $product->product_details . '</div></div>' : ''; ?>
                            </div>
                        </div>

                        <?php if (!$Supplier || !$Customer) { ?>
                        <div class="buttons">
                            <div class="btn-group btn-group-justified">
                                <div class="btn-group">
                                    <a href="<?= admin_url('products/pdf/' . $product->id) ?>" class="tip btn btn-primary" title="<?= lang('pdf') ?>">
                                        <i class="fa fa-download"></i> <span class="hidden-sm hidden-xs"><?= lang('pdf') ?></span>
                                    </a>
                                </div>
                                <div class="btn-group">
                                    <a href="<?= admin_url('products/edit/' . $product->id) ?>" class="tip btn btn-warning tip" title="<?= lang('edit_product') ?>">
                                        <i class="fa fa-edit"></i> <span class="hidden-sm hidden-xs"><?= lang('edit') ?></span>
                                    </a>
                                </div>
                                <div class="btn-group">
                                    <a href="#" class="tip btn btn-danger bpo" title="<b><?= lang("delete_product") ?></b>"
                                        data-content="<div style='width:150px;'><p><?= lang('r_u_sure') ?></p><a class='btn btn-danger' href='<?= admin_url('products/delete/' . $product->id) ?>'><?= lang('i_m_sure') ?></a> <button class='btn bpo-close'><?= lang('no') ?></button></div>"
                                        data-html="true" data-placement="top">
                                        <i class="fa fa-trash-o"></i> <span class="hidden-sm hidden-xs"><?= lang('delete') ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                $('.tip').tooltip();
            });
        </script>
    <?php } ?>

        <?php if ($Owner || $Admin) { ?>
    </div>

    <div id="chart" class="tab-pane fade">
        <script src="<?= $assets; ?>js/hc/highcharts.js"></script>
        <script type="text/javascript">
            $(function () {
                Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
                    return {
                        radialGradient: {cx: 0.5, cy: 0.3, r: 0.7},
                        stops: [[0, color], [1, Highcharts.Color(color).brighten(-0.3).get('rgb')]]
                    };
                });
                <?php if($sold) { ?>
                var sold_chart = new Highcharts.Chart({
                    chart: {
                        renderTo: 'soldchart',
                        type: 'line',
                        width: <?= "$('#details').width()-100"; ?>
                    },
                    credits: {enabled: false},
                    title: {text: ''},
                    xAxis: {
                        categories: [<?php
                    foreach ($sold as $r) {
                        $month = explode('-', $r->month);
                        echo "'".lang('cal_'.strtolower($month[1]))." ".$month[0]."', ";
                    }
                    ?>]
                    },
                    yAxis: {min: 0, title: ""},
                    legend: {enabled: false},
                    tooltip: {
                        shared: true,
                        followPointer: true,
                        formatter: function () {
                            var s = '<div class="well well-sm hc-tip" style="margin-bottom:0;min-width:150px;"><h2 style="margin-top:0;">' + this.x + '</h2><table class="table table-striped"  style="margin-bottom:0;">';
                            $.each(this.points, function () {
                                if (this.series.name == '<?= lang("amount"); ?>') {
                                    s += '<tr><td style="color:{series.color};padding:0">' + this.series.name + ': </td><td style="color:{series.color};padding:0;text-align:right;"> <b>' +
                                    currencyFormat(this.y) + '</b></td></tr>';
                                } else {
                                    s += '<tr><td style="color:{series.color};padding:0">' + this.series.name + ': </td><td style="color:{series.color};padding:0;text-align:right;"> <b>' +
                                    formatQuantity(this.y) + '</b></td></tr>';
                                }
                            });
                            s += '</table></div>';
                            return s;
                        },
                        useHTML: true, borderWidth: 0, shadow: false, valueDecimals: site.settings.decimals,
                        style: {fontSize: '14px', padding: '0', color: '#000000'}
                    },
                    series: [{
                        type: 'spline',
                        name: '<?= lang("sold"); ?>',
                        data: [<?php
                        foreach ($sold as $r) {
                            $month = explode('-', $r->month);
                            echo "['".lang('cal_'.strtolower($month[1]))." ".$month[0]."', ".$r->sold."],";
                            // echo "['".lang('cal_'.strtolower($r->month))."', ".$r->sold."],";
                        }
                        ?>]
                    }, {
                        type: 'spline',
                        name: '<?= lang("amount"); ?>',
                        data: [<?php
                        foreach ($sold as $r) {
                            $month = explode('-', $r->month);
                            echo "['".lang('cal_'.strtolower($month[1]))." ".$month[0]."', ".$r->amount."],";
                            // echo "['".lang('cal_'.strtolower($r->month))."', ".$r->amount."],";
                        }
                        ?>]
                    }]
                });
                $(window).resize(function () {
                    sold_chart.setSize($('#soldchart').width(), 450);
                });
                <?php }?>

            });
        </script>
        <div class="box">
            <div class="box-header">
                <h2 class="blue"><i class="fa-fw fa fa-bar-chart-o nb"></i><?= lang('chart'); ?></h2>
            </div>
            <div class="box-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row" style="margin-bottom: 15px;">
                            <div class="col-sm-12">
                                <div class="box" style="border-top: 1px solid #dbdee0;">
                                    <div class="box-header">
                                        <h2 class="blue"><i class="fa-fw fa fa-bar-chart-o"></i><?= lang('sold'); ?>
                                        </h2>
                                    </div>
                                    <div class="box-content">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div id="soldchart" style="width:100%; height:450px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="sales" class="tab-pane fade">
        <script type="text/javascript">
            $(document).ready(function () {
                oTable = $('#SlRData').dataTable({
                    "aaSorting": [[0, "desc"]],
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?= lang('all') ?>"]],
                    "iDisplayLength": <?= $Settings->rows_per_page ?>,
                    'bProcessing': true, 'bServerSide': true,
                    'sAjaxSource': '<?= admin_url('reports/getSalesReport/?v=1&product='.$product->id) ?>',
                    'fnServerData': function (sSource, aoData, fnCallback) {
                        aoData.push({
                            "name": "<?= $this->security->get_csrf_token_name() ?>",
                            "value": "<?= $this->security->get_csrf_hash() ?>"
                        });
                        $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
                    },
                    'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                        nRow.id = aData[9];
                        nRow.className = (aData[5] > 0) ? "invoice_link2" : "invoice_link2 warning";
                        return nRow;
                    },
                    "aoColumns": [{"mRender": fld}, null, null, null, {
                        "bSearchable": false,
                        "mRender": pqFormat
                    }, {"mRender": currencyFormat}],
                    "fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
                        var gtotal = 0, paid = 0, balance = 0;
                        for (var i = 0; i < aaData.length; i++) {
                            gtotal += parseFloat(aaData[aiDisplay[i]][5]);
                        }
                        var nCells = nRow.getElementsByTagName('th');
                        nCells[5].innerHTML = currencyFormat(parseFloat(gtotal));
                    }
                }).fnSetFilteringDelay().dtFilter([
                    {column_number: 0, filter_default_label: "[<?=lang('date');?> (yyyy-mm-dd)]", filter_type: "text", data: []},
                    {column_number: 1, filter_default_label: "[<?=lang('reference_no');?>]", filter_type: "text", data: []},
                    {column_number: 2, filter_default_label: "[<?=lang('biller');?>]", filter_type: "text", data: []},
                    {column_number: 3, filter_default_label: "[<?=lang('customer');?>]", filter_type: "text", data: []},
                ], "footer");
            });
        </script>
        <div class="box">
            <div class="box-header">
                <h2 class="blue"><i class="fa-fw fa fa-heart nb"></i><?= $product->name . ' ' . lang('sales'); ?></h2>

                <div class="box-icon">
                    <ul class="btn-tasks">
                        <li class="dropdown">
                            <a href="#" id="xls" class="tip" title="<?= lang('download_xls') ?>">
                                <i class="icon fa fa-file-excel-o"></i>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" id="image" class="tip image" title="<?= lang('save_image') ?>">
                                <i class="icon fa fa-file-picture-o"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="box-content">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="introtext"><?php echo lang('list_results'); ?></p>

                        <div class="table-responsive">
                            <table id="SlRData" class="table table-bordered table-hover table-striped table-condensed">
                                <thead>
                                <tr>
                                    <th><?= lang("date"); ?></th>
                                    <th><?= lang("reference_no"); ?></th>
                                    <th><?= lang("biller"); ?></th>
                                    <th><?= lang("customer"); ?></th>
                                    <th><?= lang("product_qty"); ?></th>
                                    <th><?= lang("grand_total"); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="5"
                                        class="dataTables_empty"><?= lang('loading_data_from_server') ?></td>
                                </tr>
                                </tbody>
                                <tfoot class="dtFilter">
                                <tr class="active">
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><?= lang("product_qty"); ?></th>
                                    <th><?= lang("grand_total"); ?></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

    <script type="text/javascript" src="<?= $assets ?>js/html2canvas.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#pdf').click(function (event) {
                event.preventDefault();
                window.location.href = "<?=admin_url('reports/getSalesReport/pdf/?v=1&product='.$product->id)?>";
                return false;
            });
            $('#xls').click(function (event) {
                event.preventDefault();
                window.location.href = "<?=admin_url('reports/getSalesReport/0/xls/?v=1&product='.$product->id)?>";
                return false;
            });

            $('.image').click(function (event) {
                var box = $(this).closest('.box');
                event.preventDefault();
                html2canvas(box, {
                    onrendered: function (canvas) {
                        openImg(canvas.toDataURL());
                    }
                });
                return false;
            });
        });
    </script>
<?php } ?>
