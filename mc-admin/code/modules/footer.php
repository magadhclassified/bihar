<?php if(!isset($is_caller)){die('Restricted access.');} ?>
<div id="footer">
<div id="footer_inner">
<dl class="copy">
<dt><strong><?php echo SYSTEM_NAME; ?></strong> <em>v1.0</em></dt>
<dd>&copy; <?php echo date('Y'); ?>. All rights reserved.</dd>
</dl>	
<dl class="quick_links">
<dt><strong>Quick Links:</strong></dt>
<dd>
<ul>
<li><a href="dashboard">Dashboard </a></li>
<li><a href="my">My Account</a></li>
<li><a href="<?php echo COMPANY_URL; ?>" onclick="return!window.open(this.href);">View the Website</a></li>
<li class="last"><a href="logout">Log Out</a></li>
</ul>
</dd>
</dl>
<dl class="help_links">
<dt><strong>Need Help?</strong></dt>
<dd>
<ul>
<li class="last"><a href="<?php echo SYSTEM_SUPPORT_LINK; ?>">Contact Support</a></li>
</ul>
</dd>
</dl>
</div>
</div>