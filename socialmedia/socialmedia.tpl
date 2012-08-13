<link rel="stylesheet" type="text/css" href="{$module_dir}/socialmedia.css" />
<!-- Block mymodule -->
<div id="mymodule_block_left" class="block">
  <h4>{l s='module title' mod='socialmedia'}</h4>
  <div class="block_content">
    <ul class="socialmedia">
    {foreach from=$socialLinks key=id item=val}
      <li>
      <a href="{$val.link}" title="{$val.title}" target="_blank">
      <img src="{$base_dir}/img/social/{$id}.jpg" width="24" height="24" alt="{$val.title}" border="0" /></a></li>
    {/foreach}
    </ul>
    <div class="clear"></div>
  </div>
</div>
<!-- /Block mymodule -->