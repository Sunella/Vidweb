<?php
/**
 * @package        MijoVideos
 * @copyright    2009-2014 Mijosoft LLC, mijosoft.com
 * @license        GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
# No Permission
defined('_JEXEC') or die;

class MijovideosModelUpload extends MijovideosModel {

    public function __construct() {
        parent::__construct('upload', 'videos');
    }
}