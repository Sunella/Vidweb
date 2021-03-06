<?php
/**
 * @package		MijoVideos
 * @copyright	2009-2014 Mijosoft LLC, mijosoft.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
# No Permission
defined( '_JEXEC' ) or die ;
if (count($this->items)) {
    $utility = MijoVideos::get('utility');
    $thumb_size = $utility->getThumbSize($this->config->get('thumb_size'));
    foreach ($this->items as $item) {

        if (empty($item->videos)) {
            continue;
        } else {
            $video = $item->videos[0];
        }

        if(!empty($item->thumb)) {
            $thumb = $utility->getThumbPath($item->id, 'playlists', $item->thumb);
        } else {
            $thumb = $utility->getThumbPath($video->video_id, 'videos', $video->thumb);
        }
        $url = JRoute::_('index.php?option=com_mijovideos&view=video&video_id='.$video->video_id.'&playlist_id='.$item->id.$this->Itemid); ?>
        <div class="mijovideos_column<?php echo $this->config->get('items_per_column'); ?>">
            <div class="videos-grid-item">
                <div class="videos-aspect<?php echo $this->config->get('thumb_aspect'); ?>"></div>
                <a href="<?php echo $url; ?>">
                    <img class="videos-items-grid-thumb" src="<?php echo $thumb; ?>" title="<?php echo $item->title; ?>" alt="<?php echo $item->title; ?>"/>
                </a>
            </div>
            <div class="videos-items-grid-box-content">
				<h3 class="mijovideos_box_h3">
					<a href="<?php echo $url; ?>" title="<?php echo $item->title; ?>">
                        <?php echo $this->escape(JHtmlString::truncate($item->title, $this->config->get('title_truncation'), false, false)); ?>
					</a>
				</h3>
				<div class="videos-meta">
					<div class="mijovideos-meta-info">
						<div class="videos-view">
                            <span class="value"><?php echo number_format($item->hits); ?></span>
                            <span class="key"><?php echo JText::_('COM_MIJOVIDEOS_VIEWS'); ?></span>
						</div>
						<div class="date-created">
							<span class="key"><?php echo JText::_('COM_MIJOVIDEOS_DATE_CREATED'); ?></span>
                            <span class="value"><?php echo JHtml::_('date', $item->created, JText::_('DATE_FORMAT_LC4')); ?></span>
						</div>
					</div>
				</div>
            </div>
        </div>
    <?php } ?>
<?php } ?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        var box_width = document.getElementById("channel_items").offsetWidth;
        var thumb_size = <?php echo $thumb_size; ?>;
        var thumb_percent = Math.round((thumb_size/box_width)*100);
        jQuery('div[class="videos-items-grid-box"]').css('width', thumb_percent+'%');
    });
</script>