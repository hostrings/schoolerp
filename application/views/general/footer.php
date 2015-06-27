				<?php if($this->session->userdata('roles') != "backend"){ ?>
				</div>
				<div class="clear"></div>
				<?php } ?>
			</section>
		</aside><!-- /.right-side -->
	</div><!-- ./wrapper -->
<script>
$(function(){
	var width = $(window).width(), height = $(window).height();
	<?php if($this->session->userdata('roles') != "backend"){ ?>
	var subwidth = $(".menu-sub-item").width();
	var calculatewidth = width - subwidth - 75;
	$(".contentuser").css("width",calculatewidth);
	<?php } ?>
	var maxheight = 70 / 100 * height;
	$(".modal").find(".modal-body").css("max-height",maxheight+"px");
	$( window ).resize(function() {
		var width = $(window).width(), height = $(window).height();
		<?php if($this->session->userdata('roles') != "backend"){ ?>
		var subwidth = $(".menu-sub-item").width();
		var calculatewidth = width - subwidth - 75;
		$(".contentuser").css("width",calculatewidth);
		<?php } ?>
		var maxheight = 70 / 100 * height;
		$(".modal").find(".modal-body").css("max-height",maxheight+"px");
	});
	<?php if($this->session->userdata('roles') != "backend"){ ?>
	$(".changemodule").click(function(e){
		e.stopPropagation();
		e.preventDefault();
		$(".div_side_menu").hide();
		$($(this).attr('href')).show();
		$(this).parents('li.dropdown').removeClass('open');
		$(this).parents('li').siblings('li.dropdown').removeClass('open');
	});
	<?php } ?>
});
</script>
</body>
</html>