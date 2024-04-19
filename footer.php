<!-- //footer -->
<div class="footer">
		<div class="container">
			<div class="w3_footer_grids">
				<div class="col-md-3 w3_footer_grid">
					<h3>Contact</h3>
					
					<ul class="address">
						<li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>1234k Avenue, 4th block, <span>Uttar Pradesh.</span></li>
						<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a href="mailto:contact@studentprojects.live">info@grocerystore.com</a></li>
						<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>+91 234567897</li>
					</ul>
				</div>
				<div class="col-md-3 w3_footer_grid">
					<h3>Information</h3>
					<ul class="info"> 
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="about.php">About Us</a></li>
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="contact.php">Contact Us</a></li>
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="faq.php">FAQ's</a></li>
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="offers.php">Discount Products</a></li>
					</ul>
				</div>
				<div class="col-md-3 w3_footer_grid">
					<h3>Category</h3>
					<ul class="info">
<?php
$sqlcategory = "SELECT a.*,b.catgory_title as maincat FROM category as a LEFT JOIN category  as b ON b.catid=a.sub_catid limit 4";
$qsqlcategory= mysqli_query($con,$sqlcategory);
while($rscategory= mysqli_fetch_array($qsqlcategory))
{
?>						
<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="groceries.php?catid=<?php echo $rssubcategory[0]; ?>"><?php echo $rscategory['catgory_title']; ?></a></li>
<?php
}
?>
					</ul>
				</div>
				<div class="col-md-3 w3_footer_grid">
					<h3>Profile</h3>
					<ul class="info"> 
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="groceries.php">Grocery Store</a></li>
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="orderreport.php">My Orders</a></li>
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="login.php">Login</a></li>
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="registered.php">Create Account</a></li>
					</ul>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		
		<div class="footer-copy">
			
			<div class="container">
				<p>© <?php echo date('Y'); ?> Grocery Store. All rights reserved 
				<?php
				if(!isset($_SESSION['custid']))
				{
					if(!isset($_SESSION['staffid']))
					{
				?>
					| <a href="adminlogin.php">Admin Login</a> 
				<?php
					}
				}
				?>
					</p>
			</div>
		</div>
		
	</div>	
	<div class="footer-botm">
			<div class="container">
				<div class="w3layouts-foot">
					<ul>
						<li><a href="#" class="w3_agile_facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						<li><a href="#" class="agile_twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
						<li><a href="#" class="w3_agile_dribble"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
						<li><a href="#" class="w3_agile_vimeo"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>
					</ul>
				</div>
				<div class="payment-w3ls">	
					<img src="images/card.png" alt=" " class="img-responsive">
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
<!-- //footer -->	
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- top-header and slider -->
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->
<script src="js/minicart.min.js"></script>
<script>
	// Mini Cart
	paypal.minicart.render({
		action: '#'
	});

	if (~window.location.search.indexOf('reset=true')) {
		paypal.minicart.reset();
	}
</script>
<!-- main slider-banner -->
<script src="js/skdslider.min.js"></script>
<link href="css/skdslider.css" rel="stylesheet">
<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('#demo1').skdslider({'delay':5000, 'animationSpeed': 2000,'showNextPrev':true,'showPlayButton':true,'autoSlide':true,'animationType':'fading'});
						
			jQuery('#responsive').change(function(){
			  $('#responsive_wrapper').width(jQuery(this).val());
			});
			
		});
</script>	

<script>
$('#datatable').DataTable({
    "ordering": false
});
</script>
<div id="modmycart" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Order List</h4>
      </div>
      <div class="modal-body" id="idviewcart"></div>
      <div class="modal-footer">
        <a href="billingpanel.php" type="button" class="btn btn-warning">Click Here to Order</a>
      </div>
    </div>
  </div>
</div>
<div id="modlocation" class="modal fade" role="dialog">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Select Location</h4>
      </div>
      <div class="modal-body"><div class="row"><?php
$sqlcity = "SELECT * FROM city WHERE status='Active'";
$qsqlcity= mysqli_query($con,$sqlcity);
while($rscity= mysqli_fetch_array($qsqlcity))
{
?>
<div class="col-md-3 w3layouts-brand">
	<div class="brands-w3l">
		<p><a href="index.php?&locationid=<?php echo $rscity['city_id']; ?>"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $rscity['city']; ?></a></p><br>
	</div>
</div>
<?php
}
?></div></div>
    </div>
  </div>
</div>
<script>
function load_cart()
{
	$.post("js_product_cart.php",
	function(data){
		$("#idviewcart").html(data);
	});
}
</script>
<?php
if(!isset($_SESSION['locationid']))
{
?>
<script type="text/javascript">
    $(window).on('load', function() {
       $('#modlocation').modal({
			backdrop: 'static',
			keyboard: false
		});
    });
</script>
<?php
}
?>
<script>
function load_change_qty(purchid,qty,cost)
{
	var totacost = qty * cost;
	$.post("js_update_qty.php",
	{
		purchid: purchid,
		qty: qty,
		btnqtysubmit: "btnqty"
	},
	function(data){
		
		$("#totasum"+purchid).html("₹" + totacost);
		$("#tprice").html(data);
	});
}
</script>
<script>
function delfromcart(purchid)
{
	$.post("js_update_qty.php",
	{
		purchid: purchid,
		btndelsubmit: "btndelete"
	},
	function(data){
		
		$("#trow"+purchid).remove();
		$("#tprice").html(data);
	});
}
</script>
</body>
</html>