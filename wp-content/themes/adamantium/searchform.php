<?php
/**
 * @package WordPress
 * @subpackage Adamantium - Starter Kit
 * @author Alan Gabriel Dawidowicz - www.alandawi.com.ar
 */
?>
<form method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
		<input type="text" class="field" name="s" id="s" value="Search..." onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" />
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="Search" />
	</form>