<?php
include("header.php");
?>
<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">FAQ</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<!-- help-page -->
	<div class="faq-w3agile">
		<div class="container"> 
			<h2 class="w3_agile_header">Frequently asked questions(FAQ)</h2> 
			<ul class="faq">
				<li class="item1"><a href="#" title="click here">How do I register?</a>
					<ul>
						<li class="subitem1"><p> You can register by clicking on the "Register" link at the top right corner of the homepage. Please provide the information in the form that appears. You can review the terms and conditions, provide your payment mode details and submit the registration information.</p></li>										
					</ul>
				</li>
				<li class="item2"><a href="#" title="click here">Are there any charges for registration?</a>
					<ul>
						<li class="subitem1"><p> No. Registration on SuperMarket is absolutely free.</p></li>										
					</ul>
				</li>
				<li class="item3"><a href="#" title="click here">Do I have to necessarily register to shop on SuperMarket?</a>
					<ul>
						<li class="subitem1"><p>You can surf and add products to the cart without registration but only registered shoppers will be able to checkout and place orders. Registered members have to be logged in at the time of checking out the cart, they will be prompted to do so if they are not logged in..</p></li>										
					</ul>
				</li>
				<li class="item4"><a href="#" title="click here">Can I have multiple registrations?</a>
					<ul>
						<li class="subitem1"><p>Each email address and contact phone number can only be associated with one SuperMarket account.</p></li>										
					</ul>
				</li> 
				<li class="item5"><a href="#" title="click here">Can I add more than one delivery address in an account?</a>
					<ul>
						<li class="subitem1"><p>Yes, you can add multiple delivery addresses in your SuperMarket account. However, remember that all items placed in a single order can only be delivered to one address. If you want different products delivered to different address you need to place them as separate orders.</p></li>										
					</ul>
				</li>
				<li class="item6"><a href="#" title="click here">Can I have multiple accounts with same mobile number and email id?</a>
					<ul>
						<li class="subitem1"><p>Each email address and phone number can be associated with one SuperMarket account only.</p></li>										
					</ul>
				</li>
				<li class="item7"><a href="#" title="click here">Is it safe to use my credit/ debit card on SuperMarket?</a>
					<ul>
						<li class="subitem1"><p>Yes it is absolutely safe to use your card on SuperMarket. A recent directive from RBI makes it mandatory to have an additional authentication pass code verified by VISA (VBV) or MSC (Master Secure Code) which has to be entered by online shoppers while paying online using visa or master credit card. It means extra security for customers, thus making online shopping safer</p></li>										
					</ul>
				</li>
				<li class="item8"><a href="#" title="click here">When will I receive my order?</a>
					<ul>
						<li class="subitem1"><p>Once you are done selecting your products and click on checkout you will be prompted to select delivery slot. Your order will be delivered to you on the day and slot selected by you. If we are unable to deliver the order during the specified time duration (this sometimes happens due to unforeseen situations).</p></li>										
					</ul>
				</li>
				<li class="item9"><a href="#" title="click here">How are the fruits and vegetables packaged?</a>
					<ul>
						<li class="subitem1"><p>Fresh fruits and vegetables are hand picked, hand cleaned and hand packed in reusable plastic trays covered with cling. We ensure hygienic and careful handling of all our products.</p></li>										
					</ul>
				</li>
				<li class="item10"><a href="#" title="click here">How will the delivery be done?</a>
					<ul>
						<li class="subitem1"><p>We have a dedicated team of delivery personnel and a fleet of vehicles operating across the city which ensures timely and accurate delivery to our customers.</p></li>										
					</ul>
				</li> 
			</ul> 
			<!-- script for tabs -->
			<script type="text/javascript">
				$(function() {
				
					var menu_ul = $('.faq > li > ul'),
						   menu_a  = $('.faq > li > a');
					
					menu_ul.hide();
				
					menu_a.click(function(e) {
						e.preventDefault();
						if(!$(this).hasClass('active')) {
							menu_a.removeClass('active');
							menu_ul.filter(':visible').slideUp('normal');
							$(this).addClass('active').next().stop(true,true).slideDown('normal');
						} else {
							$(this).removeClass('active');
							$(this).next().stop(true,true).slideUp('normal');
						}
					});
				
				});
			</script>
			<!-- script for tabs -->   
		</div>
	</div>

<?php
include("footer.php");
?>