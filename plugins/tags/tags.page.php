<?php
/* ====================
Copyright (c) 2008, Vladimir Sibirov.
All rights reserved. Distributed under BSD License.
[BEGIN_SED]
File=plugins/tags/tags.page.php
Version=121
Updated=2008-dec-19
Type=Plugin
Author=Trustmaster
Description=
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=tags
Part=page
File=tags.page
Hooks=page.tags
Tags=page.tpl:{PAGE_TAGS_ROW_TAG},{PAGE_TAGS_ROW_URL}
Order=10
[END_SED_EXTPLUGIN]
==================== */
if (!defined('SED_CODE')) { die('Wrong URL.'); }

if($cfg['plugin']['tags']['pages'])
{
	require_once(sed_langfile('tags'));
	$item_id = $pag['page_id'];
	$tags = sed_tag_list($item_id);
	foreach($tags as $tag)
	{
		$tag_u = sed_urlencode($tag, $cfg['plugin']['tags']['translit']);
		$tl = $lang != 'en' && $tag_u != urlencode($tag) ? '&tl=1' : '';
		$t->assign(array(
		'PAGE_TAGS_ROW_TAG' => $cfg['plugin']['tags']['title'] ? sed_cc(sed_tag_title($tag)) : sed_cc($tag),
		'PAGE_TAGS_ROW_URL' => sed_url('plug', 'e=tags&a=pages&t='.$tag_u.$tl)
		));
		$t->parse('MAIN.PAGE_TAGS_ROW');
	}
}
?>