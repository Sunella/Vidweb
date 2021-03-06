<?php
/**
 * @package		MijoVideos
 * @copyright	2009-2014 Mijosoft LLC, mijosoft.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
# No Permission
defined( '_JEXEC' ) or die ;


class MijovideosViewChannels extends MijovideosView {
	
	public function display($tpl = null) {
        $item = $this->get('EditData');

        if (!$this->acl->canEditOwn($item->user_id)) {
            JFactory::getApplication()->redirect('index.php?option=com_mijovideos', JText::_('JERROR_ALERTNOAUTHOR'));
        }

        $task = JRequest::getCmd('task');
        $text = ($task == 'edit') ? JText::_('COM_MIJOVIDEOS_EDIT') : JText::_('COM_MIJOVIDEOS_NEW');

        if ($this->_mainframe->isAdmin()) {
            JToolBarHelper::title(JText::_('COM_MIJOVIDEOS_CPANEL_CHANNELS').': <small><small>[ ' . $text.' ]</small></small>' , 'mijovideos' );
            JToolBarHelper::apply();
            JToolBarHelper::save();
            JToolBarHelper::save2new();
            JToolBarHelper::cancel();
            JToolBarHelper::divider();
            $this->toolbar->appendButton('Popup', 'help1', JText::_('Help'), 'http://mijosoft.com/support/docs/mijovideos/user-manual/channels?tmpl=component', 650, 500);
        }

		if ($task == "edit" and !empty($item->id)){
			$this->channel = MijoVideos::get('channels')->getChannel($item->id);
		} else {
			$this->channel = null; 
		}

        $null_date = JFactory::getDbo()->getNullDate();

        $lists['published'] = MijoVideos::get('utility')->getRadioList('published', $item->published);
        $lists['featured'] = MijoVideos::get('utility')->getRadioList('featured', $item->featured);
        $lists['default'] = MijoVideos::get('utility')->getRadioList('default', $item->default);
        $lists['share_others'] = MijoVideos::get('utility')->getRadioList('share_others', $item->share_others);
        $lists['featured'] = MijoVideos::get('utility')->getRadioList('featured', $item->featured);
        $lists['access'] = JHtml::_('access.level', 'access', $item->access, ' class="inputbox" ', false);
        $lists['language'] = JHtml::_('select.genericlist', JHtml::_('contentlanguage.existing', true, true), 'language', ' class="inputbox"', 'value', 'text', $item->language);

        JHtml::_('behavior.tooltip');
        JHtml::_('behavior.modal');

        $this->lists 		    = $lists;
		$this->item 		    = $item;
        $this->null_date		= $null_date;
		$this->fields	    	= MijoVideos::get('fields')->getVideoFields($item->id);
        $this->availableFields  = MijoVideos::get('fields')->getAvailableFields();

		parent::display($tpl);
	}
}