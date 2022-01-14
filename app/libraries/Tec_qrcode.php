<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
 *  ==============================================================================
 *  Author  : Ali Bin Younas
 *  Email   : alibinyounas@adroitlight.com
 *  For     : PHP QR Code
 *  Web     : http://phpqrcode.sourceforge.net
 *  License : open source (LGPL)
 *  ==============================================================================
 */

use PHPQRCode\QRcode;

class Tec_qrcode{

    public function generate($params = array()) {
        $params['data'] = (isset($params['data'])) ? $params['data'] : 'http://adroitlight.com';
        QRcode::png($params['data'], $params['savename'], 'H', 2, 0);
        return $params['savename'];
    }

}
