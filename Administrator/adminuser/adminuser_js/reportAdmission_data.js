  	function ResetData(){
		 
		$("#SeatDetail").prop("checked",false);
		$("#seatdetail_data").html('');  
		$("#div_seatdetail").hide(); 
		$("#AdmittedDetail").prop("checked",false);
		$("#admitteddetail_data").html('');  
		$("#div_admitteddetail").hide();
		$("#CancelledDetail").prop("checked",false);
		$("#canceldetail_data").html('');  
		$("#div_canceldetail").hide();
	}
	
	
	function displaySeatDetail(obj) {
		 if(obj.checked)	 {
		$('#dvLoading').show();
		var str = "";
			$.ajax({                                      
				url: 'admissionData_seatDetail.php',                     
				data: '',
				type:"post",
				dataType: 'text',
				success: function(data)         
				{
  					 $("#seatdetail_data").html(data);  
					$("#div_seatdetail").show();
 				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
				});
		 }
		 else
		 {
			$("#seatdetail_data").html('');  
					$("#div_seatdetail").hide(); 
		 }
	}
	
	function displayAdmittedDetail(obj) {
		 if(obj.checked)	 { 
		$('#dvLoading').show();
		var str = "";
			$.ajax({                                      
				url: 'admissionData_admittedDetail.php',                     
				data: 'dateofReport='+$("#txtdate").val()+'&chodateoption='+$("#chodateoption").val(),
				type:"post",
				dataType: 'text',
				success: function(data)         
				{
  					 $("#admitteddetail_data").html(data);  
					$("#div_admitteddetail").show();
 				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
				});
		 }
		 else {
			 $("#admitteddetail_data").html('');  
			$("#div_admitteddetail").hide();
		 }
	}
	
	function displayAdmittedbyGender(obj) {
		 if(obj.checked)	 { 
		$('#dvLoading').show();
		var str = "";
			$.ajax({                                      
				url: 'admissionData_admittedByGender.php',                     
				data: 'dateofReport='+$("#txtdate").val()+'&chodateoption='+$("#chodateoption").val(),
				type:"post",
				dataType: 'text',
				success: function(data)         
				{
  					 $("#admittedByGender_data").html(data);  
					$("#div_admittedByGender").show();
 				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
				});
		 }
		 else {
			 $("#admittedByGender_data").html('');  
			$("#div_admittedByGender").hide();
		 }
	}
	
	function displayCancelDetail(obj) {
		if(obj.checked)	 {  
		$('#dvLoading').show();
		//alert($("#chodateoption").val())
		var str = "";
			$.ajax({                                      
				url: 'admissionData_cancelledDetail.php',                     
				data:  'dateofReport='+$("#txtdate").val()+'&chodateoption='+$("#chodateoption").val(),
				type:"post",
				dataType: 'text',
				success: function(data)         
				{
  					 $("#canceldetail_data").html(data);  
					$("#div_canceldetail").show();
 				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
				});
		}
		else {
			 $("#canceldetail_data").html('');  
			$("#div_canceldetail").hide();
		 }
	}
	
	function displaySeatDetail_WODate() {
		
		$('#dvLoading').show();
		var str = "";
			$.ajax({                                      
				url: 'admissionData_seatDetail_WO_DATE.php',                     
				data: '',
				type:"post",
				dataType: 'text',
				success: function(data)         
				{
  					 $("#seatdetail_data").html(data);  
					$("#div_seatdetail").show();
 				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
				});
		
	}
	function displayAdmittedDetail_WODate() {
		 
		$('#dvLoading').show();
		var str = "";
			$.ajax({                                      
				url: 'admissionData_admittedDetail_WO_DATE.php',                     
				data: '',
				type:"post",
				dataType: 'text',
				success: function(data)         
				{
  					 $("#admitteddetail_data").html(data);  
					$("#div_admitteddetail").show();
 				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
				});
	}
	
	function displayCancelDetail_WODate() {
		 
		$('#dvLoading').show();
		var str = "";
			$.ajax({                                      
				url: 'admissionData_cancelledDetail_WO_Date.php',                     
				data:  '',
				type:"post",
				dataType: 'text',
				success: function(data)         
				{
  					 $("#canceldetail_data").html(data);  
					$("#div_canceldetail").show();
 				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
				});
	}