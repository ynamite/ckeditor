<?php
// set default config values
if (!$this->hasConfig('smart_strip')) {
    $this->setConfig('smart_strip', 1);
}

// to apply patches...
$this->setConfig('patches_applied', 0);


