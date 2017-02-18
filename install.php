<?php
// set default config values
if (!$this->hasConfig('smart_strip')) {
    $this->setConfig('smart_strip', 1);
}

if (!$this->hasConfig('patches_applied')) {
    $this->setConfig('patches_applied', 0);
}


