<?php
echo '</div>';
echo '</div>';
echo '<div class="footer">';
	echo '<div class="footer_conteiner">';
	echo '</div>';
echo '</div>';
echo '<script type="text/javascript">
		$(document).ready(function() {
    			$(".menu").dropit();
		});
</script>';
echo '<script type="text/javascript">
$(document).ready(function(){
$(".container_second_main>select").ready(function(){
    var state =  $(".container_second_main>select>option:selected").attr("value");
     $.ajax({
            type: "POST",
            url: "/index.php/welcome/change_admin/",
	    dataType:json,
            data: "state="+state,
            cache: false,
            success: function(html) {    
                $("#").html( html.name );
		$("#").html( html.image );
		$("#").html( html.position );
            }
        });
});
});
</script>';
echo '</body>';
echo '</html>';
?>