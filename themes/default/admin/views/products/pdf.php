<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <base href="<?= admin_url() ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $product->name ?> - <?= $Settings->site_name ?></title>
    <link href="<?= $assets ?>styles/pdf/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $assets ?>styles/pdf/pdf.css" rel="stylesheet">
<body>
<div class="row">
    <div class="col-lg-12">
        <?php
        $path = base_url() . 'assets/uploads/logos/' . $Settings->logo;
        if (file_exists($path)){
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            ?>
            <div class="text-center" style="margin-bottom:20px;">
                <img src="<?= $base64; ?>" alt="<?=$Settings->site_name;?>">
            </div>  
        <?php } ?>
        

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-sm-5">
                <?php if ($product->image != 'no_image.png') {
                    $path = base_url() . 'assets/uploads/' . $product->image;
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = file_get_contents($path);
                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    ?>
                    <br><div class="text-center"><img src="<?= $base64; ?>" alt="<?= $product->name ?>" /></div><br><br>
                    <?php
                } ?>
            </div>
            <div class="col-sm-7">
                <div class="clearfix"></div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped dfTable table-right-left">
                        <tbody>
                        <tr>
                            <td><?= lang("type"); ?></td>
                            <td><?= lang($product->type); ?></td>
                        </tr>
                        <tr>
                            <td><?= lang("name"); ?></td>
                            <td><?= $product->name; ?></td>
                        </tr>
                        <tr>
                            <td><?= lang("code"); ?></td>
                            <td><?= $product->code; ?></td>
                        </tr>
                        <tr>
                            <td><?= lang("category"); ?></td>
                            <td><?= $category->name; ?></td>
                        </tr>
                        <tr>
                            <td><?= lang("price"); ?></td>
                            <td><?= $this->sma->formatMoney($product->price); ?></td>
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

        <?php
        if (!empty($images)) {
            foreach ($images as $ph) {
                echo '<img class="img-responsive" src="' . base_url() . 'assets/uploads/' . $ph->photo . '" alt="' . $ph->photo . '" style="width:' . $Settings->iwidth . 'px; height:' . $Settings->iheight . 'px;" />';
            }
        }
        ?>
    </div>
</div>
</body>
</html>
