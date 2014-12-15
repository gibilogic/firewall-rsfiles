<?php

/**
 * @version       helper.php 2014-12-15 17:35:00 UTC zanardi
 * @package       GiBi Firewall for RsFiles
 * @author        GiBiLogic <info@gibilogic.com>
 * @authorUrl     http://www.gibilogic.com
 * @copyright     (C) 2014 GiBiLogic. All rights reserved.
 * @license       GNU/GPL v3 or later
 */
defined('_JEXEC') or die();

class plgRsfilesFirewallHelper
{
    /**
     *
     * @var array $ip_list
     */
    private $ip_list = array();

    /**
     *
     * @var \JRegistry $params
     */
    private $params;

    /**
     *
     * @param $params
     */
    public function __construct($params)
    {
        $this->params = $params;
    }

    /**
     * Check if the current client IP is allowed to perform the download
     *
     * @return boolean
     */
    public function isAllowedIp()
    {
        $is_current_ip_listed = in_array($_SERVER['REMOTE_ADDR'], $this->getIpList());

        if ($this->params->get('ip_list_type', 'E') == 'E')
        {
            return $is_current_ip_listed;
        }
        else
        {
            return !$is_current_ip_listed;
        }
    }

    /**
     * Get the IP list from configuration
     *
     * @return array
     */
    public function getIpList()
    {
        $ip_list = $this->params->get("ip_list", '');

        return preg_split('/\s+/', $ip_list);
    }
}