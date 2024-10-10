<?php
$hook['post_controller_constructor'][] = array(
    'class'    => 'TimezoneHook',
    'function' => 'set_timezone',
    'filename' => 'TimezoneHook.php',
    'filepath' => 'hooks',
    'params'   => array()
);
