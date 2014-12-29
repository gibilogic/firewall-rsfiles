Firewall for RSFiles!
=====================

Plugin for Joomla 3  that adds a basic firewall to the download feature.

## tl;dr

* Apply the diff file from the "hack" subfolder
* Create the ZIP file from the "plugin" subfolder
* Install like any other Joomla extension
* Configure and enable the plugin

## Description

With this plugin, you can add a list of IP addresses to either allow or block. Also, you can add one or more patterns to protect only selected files / folders.

## Warning

A little hack is required to one core RSFiles. I know it's not the best way, hopefully the developers of RSFiles will pick this up and include in latest versions. If you're an RSFiles developer: yes, you can take the whole code and include in your component if you want. Just let me know if you do.

## Instructions: the hack

Basically I have added a new "rsfiles" plugin group and a new "onRsfilesBeforeDownload" event, so we could check and block the download according to specific rules.

The hack consists in a few lines to paste into *components/com_rsfiles/controllers/rsfiles.php*.

You can find the diff file, containing the few added lines, in the "hack" subfolder of the project.

The hack itself is perfectly safe; if you just add these lines to the component, everything will still work as before.

## Instructions: the plugin

Create the zip package and install it like any other Joomla extension.

Open the plugin configuration and set the options:

* firewall mode: enable listed IPs (and block everything else) or block listed IP (and enable everything else)
* ip list: one per line (you can also set IP pattern like "192.168." to match subnets)
* folders list: one per line: all matching path will be protected. If none are listed, all will be protected.

## Credits

The initial version of the plugin has been proposed and paid by **Christian Macher** which then consented to release it as open source. Well done Christian!
