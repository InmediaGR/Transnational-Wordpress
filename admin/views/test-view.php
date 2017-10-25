<div class="wrap">
 
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
 
    <form method="post" action="">
        <input type="hidden" name="run-tests" value="1" />
        <?php
            submit_button();
        ?>
    </form>
 
</div>