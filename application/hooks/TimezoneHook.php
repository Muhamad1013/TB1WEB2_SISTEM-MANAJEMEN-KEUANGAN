<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TimezoneHook
{
    public function set_timezone()
    {
        date_default_timezone_set('Asia/Jakarta');
    }
}
