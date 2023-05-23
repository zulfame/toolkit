<?php

function log_auth($tipe = "", $str = "")
{
    $CI = &get_instance();

    // if (strtolower($tipe) == "failed_login") {
    //     $log_tipe   = 0;
    // } elseif (strtolower($tipe) == "failed_pass") {
    //     $log_tipe   = 1;
    // }

    //ipinfo grabs the ip of the person requesting
    $getloc = json_decode(file_get_contents("http://ipinfo.io/"));

    // paramter
    $param['log_ip']        = $CI->input->ip_address();
    $param['log_device']    = $CI->agent->platform();
    $param['log_city']      = $getloc->city;
    $param['log_desc']      = $str;
    //$param['log_tipe']      = $log_tipe;

    //load model log
    $CI->load->model('Log_Model');

    //save to database
    $CI->Log_Model->LogAuth($param);
}
