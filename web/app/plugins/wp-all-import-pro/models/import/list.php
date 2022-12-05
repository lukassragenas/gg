<?php
require WP_CONTENT_DIR . '/plugins/wp-all-import-pro/models/model/list.php';

class PMXI_Import_List extends PMXI_Model_List
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable(PMXI_Plugin::getInstance()->getTablePrefix() . 'imports');
    }
}