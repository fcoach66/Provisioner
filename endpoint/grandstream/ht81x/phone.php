<?php
/**
 * GXW4004, GXW4008 File
 *
 * @author Fabrizio Cocciari
 * @license MPL / GPLv2 / LGPL
 * @package Provisioner
 *
 */
class endpoint_grandstream_gxw40xx_phone extends endpoint_grandstream_base {

	public $family_line = 'gxw40xx';

	function parse_lines_hook($line_data, $line_total) {
        $line_data['line_active'] = (isset($line_data['secret']) ? '1' : '0');
        return($line_data);
    }

    function get_gmtoffset($timezone) {
        $timezone = str_replace(":", ".", $timezone);
        $timezone = str_replace("30", "5", $timezone);
        if (strrchr($timezone, '+')) {
            $num = explode("+", $timezone);
            $num = $num[1];
            $offset = 720 + ($num * 60);
        } elseif (strrchr($timezone, '-')) {
            $num = explode("-", $timezone);
            $num = $num[1];
            $offset = 720 + ($num * -60);
        }
        return($offset);
    }

    function prepare_for_generateconfig() {
        parent::prepare_for_generateconfig();

        if (isset($this->settings['dialplan'])) {
            $this->settings['dialplan'] = str_replace("+", "%2B", $this->settings['dialplan']);
        }

    }

    function generate_file($file, $extradata, $ignoredynamicmapping=FALSE, $prepare=FALSE) {
        $data = parent::generate_file($file, $extradata, TRUE);
        return $data;
    }	
}

