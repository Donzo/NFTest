			<div id='site-footer'>
				<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/code/html/footer-links.php'); ?>
			</div>
		<!--Following Tag Marks End of Content DIV-->
		</div>	
	</body>
	
	<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/code/js/connect-wallet.php'); ?>
	<?php 
		echo "<script>
				if (!window.location.toString().includes('userAccountNum') && window['userAccountNumber']){
					alert('getting tests');
					getMyTests();
				}
			</script>";
		//If we are taking a test, load the test data file.
		if (getcwd() == '/var/www/nftest/test-taker'){
		//	require_once($_SERVER['DOCUMENT_ROOT'] . '/code/php/mysql-connect.php');
			require_once($_SERVER['DOCUMENT_ROOT'] . '/code/js/get-test-data.php');
		}
	?>
	
</html>