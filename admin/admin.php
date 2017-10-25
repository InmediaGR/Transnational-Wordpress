<?php
include_once( dirname(__FILE__).'/tests.php' );

wp_enqueue_script("jquery");
function nmi_settings_page(){}
    
function nmi_tests_page(){ 
  ?>  <div class="wrap">
    
       <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    
       <input type="button" id="btn-tests" value="Run Tests"/>

       <div id="nmi-test-res">
       </div>
    
        <script type="text/javascript">
            jQuery( document ).ready( function( $ ) {
                let btn = document.getElementById('btn-tests');
                btn.onclick = () =>{
                    $.ajax({
                        url:    ajaxurl,
                        type:   'post',                
                        data:   {
                            action: "run_tests",
                        }
                    })
                    
                    .done( function( response ) { // response from the PHP action
                        $("#nmi-test-res").html( "<h2>The request was successful </h2><br>" + response );
                    })
                }
            })

        </script>
   </div>
    
<?php
}

function nmi_admin_menu(){
    add_menu_page( 'Transnational NMI', 'Transnational NMI', 'manage_options', 'Transnational/Transnational-admin-page.php', 'nmi_settings_page', 'dashicons-menu', 6 );
    add_submenu_page( 'Transnational/Transnational-admin-page.php', 'Tests', 'Tests', 'manage_options', 'Transnational/tests', 'nmi_tests_page' );
}
add_action( 'admin_menu', 'nmi_admin_menu' );
?>