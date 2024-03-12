<?php 
   $pathModal = $_SERVER['DOCUMENT_ROOT'];
   $pathModal .= BASE_ROOT_FOLDER."/modal.php";
   include_once($pathModal);
?>

<link href="<?php echo GOOGLE_FONT_1;?>" rel="stylesheet">
<link href="<?php echo FONT_AWESOME_CSS;?>" rel="stylesheet">
<link href="<?php echo BASE_URL_HOME;?>/bootstrap/css/font-awesome-animation.min.css" rel="stylesheet">
<link href="<?php echo BASE_URL_HOME;?>/bootstrap/css/table_style.css" rel="stylesheet">
<link href="<?php echo BASE_URL_HOME;?>/bootstrap/css/multi_select.css" rel="stylesheet">
<script src="<?php echo BASE_URL_HOME;?>/bootstrap/js/popper.min.js"></script>
<script>
$(function () {
$('[data-toggle="popover"]').popover()
});
</script>
<script>
$(function () {
$('[data-toggle="tooltip"]').tooltip()
});
</script>
<script type="text/javascript" src="<?php echo BASE_URL_HOME;?>/bootstrap/js/bootstrap.min.js"></script>
<!--<script src="<?php echo BASE_URL_HOME;?>/bootstrap/js/multi_select.js"></script>-->
<script src="<?php echo BASE_URL_HOME;?>/bootstrap/js/scrollreveal.min.js"></script>
<script>
window.sr = ScrollReveal();		
	sr.reveal('.info1', {
		duration: 1600,
		origin: 'top',
		distance: '80px',
		mobile: true
	});
	sr.reveal('.info2', {
		duration: 1600,
		origin: 'bottom',
		distance: '80px',
		mobile: true
	});
	sr.reveal('.welcomeUser', {
		duration: 2000,
		origin: 'bottom',
		distance: '200px',
		rotate: { x: 50, y: 0, z: 0 },
		mobile: true
	});
	sr.reveal('.page_headerIcon', {
		duration: 1000,
		origin: 'left',
		distance: '100px',
		rotate: { x: 50, y: 0, z: 0 },
		mobile: true
	});	
	sr.reveal('.steps_follow_animation', {reset: true, mobile: false}, 40);
	sr.reveal('.steps_follow_animation2', {reset: true, mobile: false}, 30);
</script>

<?php /*?><?php 
   $pathAnalytics = $_SERVER['DOCUMENT_ROOT'];
   $pathAnalytics .= BASE_ROOT_FOLDER."/google_analytics.php";
   include_once($pathAnalytics);
?><?php */?>