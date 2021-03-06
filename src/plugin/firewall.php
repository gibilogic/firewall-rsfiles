<?php

/**
 * @version       firewall.php 2014-12-15 17:35:00 UTC zanardi
 * @package       GiBi Firewall for RsFiles
 * @author        GiBiLogic <info@gibilogic.com>
 * @authorUrl     http://www.gibilogic.com
 * @copyright     (C) 2014 GiBiLogic. All rights reserved.
 * @license       GNU/GPL v3 or later
 */
defined('_JEXEC') or die();

jimport('plugin.plugin');
require_once __DIR__ . '/helper.php';

define('EXTENSION_IDENTIFIER', 'rsfiles.firewall');

/**
 * class plgRsfilesFirewall
 */
class plgRsfilesFirewall extends JPlugin
{

    /**
     *
     * @var plgRsfilesFirewallHelper
     */
    private $helper;

    /**
     * Constructor
     *
     * @param object $subject
     * @param array $config
     */
    public function __construct(&$subject, $config = array())
    {
        parent::__construct($subject, $config);
        $this->db = JFactory::getDbo();
        $this->helper = new plgRsfilesFirewallHelper($this->params);
        if ($this->params->get('debug', 0))
        {
            JLog::addLogger(array("text_file" => EXTENSION_IDENTIFIER . "log.php"), JLog::ALL, EXTENSION_IDENTIFIER);
        }
        else
        {
            JLog::addLogger(array("text_file" => EXTENSION_IDENTIFIER . ".log.php"), JLog::ALL & ~JLog::DEBUG, EXTENSION_IDENTIFIER);
        }
    }

    /**
     * Fired before starting the download of an element
     *
     * @return boolean
     */
    public function onRsfilesBeforeDownload()
    {
        if ( ! $this->helper->isProtectedFolder())
        {
            return true;
        }

        return $this->helper->isAllowedIp();
    }

}
