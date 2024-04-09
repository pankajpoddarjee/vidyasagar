<?php /*?><?php include("modals.php");?><?php */?>
<link href="<?php echo GOOGLE_FONT_1;?>" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
<link href="<?php echo FONT_AWESOME_CSS;?>" rel="stylesheet">
<script src="https://kit.fontawesome.com/3b1cd5c4d8.js" crossorigin="anonymous"></script>
<link href="<?php echo BASE_URL_HOME;?>/bootstrap/css/font-awesome-animation.min.css" rel="stylesheet">
<link href="<?php echo BASE_URL_HOME;?>/bootstrap/css/table_style.css" rel="stylesheet">
<link href="<?php echo BASE_URL_HOME;?>/bootstrap/css/multi_select.css" rel="stylesheet">
<link href="<?php echo BASE_URL_HOME;?>/bootstrap/toast/toast.css" rel="stylesheet">
<!-- <style type="text/css" media="screen">@import "/bootstrap/css/filtergrid.css";</style> -->
<link href="<?php echo BASE_URL_HOME;?>/bootstrap/css/filtergrid.css" rel="stylesheet">
<script src="<?php echo BASE_URL_HOME;?>/bootstrap/js/popper.min.js"></script>
<script language="javascript" type="text/javascript"  src="<?php echo BASE_URL_HOME;?>/bootstrap/js/tablefilter.js"></script>
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
<script src="<?php echo BASE_URL_HOME;?>/bootstrap/js/multi_select.js"></script>
<script src="<?php echo BASE_URL_HOME;?>/bootstrap/js/scrollreveal.min.js"></script>
<script src="<?php echo BASE_URL_HOME;?>/bootstrap/toast/toast.js"></script>
<!--Data Table Start-->

<script type="text/javascript" src="<?php echo BASE_URL_HOME;?>/bootstrap/data_table/js/dataTables.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL_HOME;?>/bootstrap/data_table/js/dataTables.buttons.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL_HOME;?>/bootstrap/data_table/js/buttons.dataTables.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL_HOME;?>/bootstrap/data_table/js/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL_HOME;?>/bootstrap/data_table/js/pdfmake.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL_HOME;?>/bootstrap/data_table/js/vfs_fonts.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL_HOME;?>/bootstrap/data_table/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL_HOME;?>/bootstrap/data_table/js/buttons.print.min.js"></script>

<!--Data Table Ends-->


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
	sr.reveal('.steps_follow_animation3', {reset: true, mobile: false}, 150);
</script>
<script>

var table_filter_Props = {
        col_0: "select",
        col_1: "select",
        col_2: "select",
        col_3: "select",
        col_4: "select",
        col_5: "select",
        col_6: "select",
        col_7: "select",
        col_8: "select",
        col_9: "select",
        col_10: "select",
        col_11: "select",
        col_12: "select",
        col_13: "select",
        col_14: "select",
        col_15: "select",
        col_16: "select",
        display_all_text: "All",
        sort_select: true
    };
    setFilterGrid("table-for-filter", table_filter_Props);
</script>
<style>
.lds-roller {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
.lds-roller div {
  animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
  transform-origin: 40px 40px;
}
.lds-roller div:after {
  content: " ";
  display: block;
  position: absolute;
  width: 7px;
  height: 7px;
  border-radius: 50%;
  margin: -4px 0 0 -4px;
}
.lds-roller div:nth-child(1) {
  animation-delay: -0.036s; background:#F00;
}
.lds-roller div:nth-child(1):after {
  top: 63px;
  left: 63px; background: #007bff;
}
.lds-roller div:nth-child(2) {
  animation-delay: -0.072s;
}
.lds-roller div:nth-child(2):after {
  top: 68px;
  left: 56px; background: #6c757d;
}
.lds-roller div:nth-child(3) {
  animation-delay: -0.108s;
}
.lds-roller div:nth-child(3):after {
  top: 71px;
  left: 48px; background: #F36;
}
.lds-roller div:nth-child(4) {
  animation-delay: -0.144s;
}
.lds-roller div:nth-child(4):after {
  top: 72px;
  left: 40px; background: #28a745;
}
.lds-roller div:nth-child(5) {
  animation-delay: -0.18s;
}
.lds-roller div:nth-child(5):after {
  top: 71px;
  left: 32px; background: #dc3545;
}
.lds-roller div:nth-child(6) {
  animation-delay: -0.216s;
}
.lds-roller div:nth-child(6):after {
  top: 68px;
  left: 24px; background: #ffc107;
}
.lds-roller div:nth-child(7) {
  animation-delay: -0.252s;
}
.lds-roller div:nth-child(7):after {
  top: 63px;
  left: 17px; background: #17a2b8;
}
.lds-roller div:nth-child(8) {
  animation-delay: -0.288s;
}
.lds-roller div:nth-child(8):after {
  top: 56px;
  left: 12px; background: #B68F49;
}
@keyframes lds-roller {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>
<!-- LOADER START-->    
<div id="dvLoading" style="display:none; position:fixed; top:0; left:0; background:rgba(0,0,0,0.8); width:100%; height:100%; padding:0; margin:0 auto; z-index:9999999999">
    <div class="lds-roller" style="padding:5px; border-radius:5px;height:100px;width:100px; position:absolute; top:50%; left:50%;margin-left:-50px;    margin-top:-50px; display:block;">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div class="text-white" style="padding:5px; border-radius:5px;height:100px;width:100px; position:absolute; top:50%; left:50%;margin-left:-50px; margin-top:30px; display:block;">Please wait...</div>
</div>
<!-- LOADER ENDS-->