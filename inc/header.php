<?php
	
    include 'lib/session.php';
    Session::init();
?>
<?php
	
	include 'lib/database.php';
	include 'helpers/format.php';

	spl_autoload_register(function($class){
		include_once "classes/".$class.".php";
	});
		

	$db = new Database();
	$fm = new Format();
	$ct = new cart();
	$us = new user();
	$cat = new category();
	$cs = new customer();
	$product = new product();
		
	      	 	
?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE HTML>
<head>
<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" alt="" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form action="search.php" method="post">
				    	<input type="text" placeholder="Tìm kiếm sản phẩm" name="tukhoa">
				    	<input type="submit" name="search_product" value="Tìm kiếm"> 
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Cart</span>
								<span class="no_product">
									
									<?php
									$check_cart = $ct->check_cart();
										if($check_cart){
											$sum = Session::get("sum");
											$qty = Session::get("qty");
											echo $fm->format_currency($sum).' '.'đ'.'-'.'Qty:'.$qty ;
											}else{
											echo 'Empty';
										}

									?>
								
								</span>
							</a>
						</div>
			      </div>
			<?php 
				if(isset($_GET['customer_id'])){
					$customer_id = $_GET['customer_id'];
					$delCart = $ct->del_all_data_cart();
					$delCompare = $ct->del_compare($customer_id);
					Session::destroy();
				}
			?>
		   <div class="login">
			<?php
			$login_check = Session::get('customer_login'); 
			if($login_check==false){
				echo '<a href="login.php">Login</a></div>';
			}else{
				echo '<a href="?customer_id='.Session::get('customer_id').'">Logout</a></div>';
			}
			?>

		   
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Trang Chủ</a></li>
	  <li><a href="products.php">Sản Phẩm</a> </li>
	  <li><a href="topbrands.php">Top Sản Phẩm</a></li>
	  
		<?php
		$check_cart = $ct->check_cart();
		if($check_cart==true){
			echo '<li><a href="cart.php">Cart</a></li>';
		}else{
			echo '';
		}
		?>
		<?php
		$customer_id = Session::get('customer_id');
		$check_order = $ct->check_order($customer_id);
		if($check_order==true){
			echo '<li><a href="orderdetails.php">Ordered</a></li>';
		}else{
			echo '';
		}
		?>
	  
		<?php
		$login_check = Session::get('customer_login'); 
		if($login_check==false){
			echo '';
		}else{
			echo '<li><a href="profile.php">Profile</a> </li>';
		}
		 ?>
		<?php
	
			$login_check = Session::get('customer_login'); 
			if($login_check){
				echo '<li><a href="compare.php">Compare</a> </li>';
			}
				
		?>
		<?php
	
			$login_check = Session::get('customer_login'); 
			if($login_check){
				echo '<li><a href="wishlist.php">Wishlist</a> </li>';
			}
				
		?>
		

	  <li><a href="contact.php">liên hệ</a> </li>
	  <div class="clear"></div>
	</ul>
</div>