<div class="wrap">
    <?php $key = get_option('nmi-key');?>
   <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

    <form action="" method="post">
        <input type="hidden" name="nmi_setting" value="1">
        
        Api Key <br>
        <input type="text" id="txt-key" name="txt-key" value="<?php echo $key; ?>"/><br>
        <input type="submit" value="Submit">
    </form>

   <div id="nmi-test-res">
   </div>

</div>

<?php
