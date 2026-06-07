<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Panggil autoloader-nya DomPDF
require_once APPPATH . 'libraries/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

class Dompdf_gen extends Dompdf
{
    public function __construct()
    {
        parent::__construct();
    }
}
