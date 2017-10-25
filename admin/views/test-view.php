<div class="wrap">

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