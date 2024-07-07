<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Menggunakan FCPATH untuk path ke autoload.php
require_once FCPATH . 'vendor/autoload.php';

use Dompdf\Dompdf;

class Pdf extends Dompdf
{
    public function __construct()
    {
        parent::__construct();
    }
}
