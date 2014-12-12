<?php

/**
 * @version       helper.php 2014-12-12 16:06:00 UTC zanardi
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
     * @var array $blocked_ips
     */
    private $blocked_ips = array();

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
        if (in_array($_SERVER['REMOTE_ADDR'], $this->getBlockedIps()))
        {
            return false;
        }

        return true;
    }

    /**
     * Check if the current client IP is allowed to perform the download
     *
     * @return array
     */
    public function getBlockedIps()
    {
        $blocked_ips = $this->params->get("blocked_ips", '');

        return preg_split('/\s+/', $blocked_ips);
    }
}