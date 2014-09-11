<?php
Array("Page_title" => $Page_title);
?>
<html>
<head><title><?php echo  $Page_title; ?></title>
<style>
/*----- Tabs -----*/
.tabs {
    width:100%;
    display:inline-block;
}
 
    /*----- Tab Links -----*/
    /* Clearfix */
    .tab-links:after {
        display:block;
        clear:both;
        content:'';
    }
 
    .tab-links li {
        margin:0px 5px;
        float:left;
        list-style:none;
		
    }
 
        .tab-links a {
            padding:9px 15px;
            display:inline-block;
            border-radius:3px 3px 0px 0px;
            background:#fff;
            font-size:16px;
            font-weight:600;
            color:#4c4c4c;
            transition:all linear 0.15s;
			border: 1px solid;
			text-decoration: none;
        }
 
        .tab-links a:hover {
            background:#a7cce5;
            text-decoration:none;
        }
 
    li.active a, li.active a:hover {
       background:#09C;
        color:#4c4c4c;
		text-decoration: none;
    }
 
    /*----- Content of Tabs -----*/
    .tab-content {
        padding:15px;
        border-radius:3px;
        box-shadow:-1px 1px 1px rgba(0,0,0,0.15);
        background:#fff;
		border: 1px solid #ccc;
		 max-width: 600px;
		  margin-left: 44px;
		   margin-top: -15px;
    }
 
        .tab {
            display:none;
        }
 
        .tab.active {
            display:block;
        }
		
		th{
	padding:17px;
}
ul{
	margin-left:294px !important;
}

.error, #date_error{
	color:#333;
	
	
}
#errors_place{
	text-align:left;
	background-color: #FFC0CB;
	border:dashed 1px #666;
	border-radius: 5px;
	padding-left:12px;
	-moz-box-shadow: 3px 3px 5px 6px #ccc;
	box-shadow: 3px 3px 5px 6px #ccc;
	-webkit-box-shadow: 3px 3px 5px 6px #ccc; 
}
</style>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/smoothness/jquery-ui.css"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<script>
$(document).ready(function(){
	$('#errors_place').hide();
    $('#add_new_contract').validate({
	
        rules:{
	        serial_no:{ required:true,
			            number:true
			},
			inventory_item:{ required:true},
			qty:{ required:true,
			            number:true
			},
			unit_price:{ required:true,
			            number:true
			},
			total_price:{ required:true,
			            number:true
			},
			contract_start_date: {required: true
			},
			contract_end_date: {required: true,
			                    
			},
			billing_cycle:{ required: true
			}
	
        },
        messages:{
	
	        serial_no:{ required: "Please enter serial number",
			            number:"Please entrer numbers only" 
			},
			inventory_item:{ required:"Please select an inventory item"},
			qty:{ required:"Please enter quantity",
			            number:"Please enter numbers only"
			},
			unit_price:{ required:"Please enter unit price",
			            number:"Please enter numbers only"
			},
			total_price:{ required:"Please enter total price",
			            number:"Please enter numbers only"
			},
			contract_start_date: {required: "Please enter contract start date"
			},
			contract_end_date: {required: "Please enter contract end date"
			},
			billing_cycle:{ required: "Please select billing cycle"
			}
			
        },
		
		errorContainer: "#errors_place",
        errorLabelContainer: "#errors_place",
        errorElement: "li", 
		
		   
		 submitHandler: function(form) {
			 
			 var serial_num_generated = getSerialNoGenerated();
			 var inventory_item_generated = getInventoryItemGenerated();
             var qty_generated = getQtyGenerated();
			 var unit_price_generated =  getUnitPriceGenerated();
			 var total_price_generated = getTotalPriceGenerated();
			 var customer_id = $("#customer_id").val();
			 var serial_no = $("#serial_no").val();
			 var inventory_item = $("#inventory_item").val();
			 var qty = $("#qty").val();
			 var unit_price = $("#unit_price").val();
			 var total_price = $("#total_price").val();
			 var contract_start_date = $("#contract_start_date").val();
			 var contract_end_date = $("#contract_end_date").val();
			 var billing_cycle = $("#billing_cycle").val();
			  
			   $.ajax({
			       url: "<?php echo base_url();?>contract/checkContractDates",
					type: "post",
					 data: {
					   start_date : function(){return $("#contract_start_date").val(); },
						end_date   : function(){return $("#contract_end_date").val(); }
							  },
					       	 success:function(data){
								 if(data == 'false'){
									$("#date_error").html("Contract Start Date should be less than Contract End Date"); 
									 return false;
								 }else{
									 
									 $.ajax({
										 
										 url:"<?php echo base_url(); ?>contract/addNewContractDetails",
										 type:"post",
										 data:{
											 customer_id:customer_id,
											 serial_no:serial_no,
											 inventory_item:inventory_item,
											 qty:qty,
											 unit_price:unit_price,
											 total_price:total_price,
											 serial_num_generated:serial_num_generated,
											 inventory_item_generated:inventory_item_generated,
											 qty_generated:qty_generated,
											 unit_price_generated:unit_price_generated,
											 total_price_generated:total_price_generated,
											 contract_start_date:contract_start_date,
											 contract_end_date:contract_end_date,
											 billing_cycle:billing_cycle
											 
										 },
										 success:function(data){
											window.location.href="<?php echo base_url(); ?>contract/index";
										 }
										 
										 
									 });
								 }
								 
    				    	
    				     }
    		}); 
         
		 }
	
    });	
	
	$("#contract_start_date, #contract_end_date").datepicker({
     
      dateFormat: 'yy-mm-dd',
      changeMonth: true,
      changeYear: true,
      yearRange:'-50:+50',
      
     });
	   
			   var counter = 1;
			  function createNewTextBox()
              {
	          var newTextBoxDiv = $(document.createElement('div')).attr("id", 'new_textbox' + counter);
 
	newTextBoxDiv.html('<input type="text" class="serial_no_cls" name="serial_no'+counter+'" id="serial_no'+counter+'" placeholder="SL NO" size="5"/> <select class="inventory_item_cls" name="inventory_item'+counter+'" id="inventory_item'+counter+'"><option value="">Inventory Item</option><?php foreach($inventoryArr as $key=>$val): ?><option value="<?php echo $inventoryArr[$key]["id"];?>"><?php echo $inventoryArr[$key]["label"];?></option><?php endforeach; ?></select><input type="text" class="qty_cls" name="qty'+counter+'" id="qty'+counter+'" placeholder="Qty" size="5"/> <input type="text" class="unit_price_cls" name="unit_price'+counter+'" id="unit_price'+counter+'" placeholder="Unit Price" size="8"/> <input type="text" class="total_price_cls" name="total_price'+counter+'" id="total_price'+counter+'" placeholder="Total Price" size="8"/>   <button class="removeButton" id="removeButton' + counter +'" onclick="removeTextbox(&quot;' + counter +'&quot;);">Delete</button><br/>');
	
	newTextBoxDiv.appendTo("#translations_container");
 
 
	counter++;
	  $('.serial_no_cls').each(function() {
   			 $(this).rules('add', {
        						required: true, number: true,
        		
       							 messages: {
           						 required: "Either write serial number or remove the row",
								 number: "Please enter numbers only"
           		
       					 }
						 
   		 			});
			});
	   $('.inventory_item_cls').each(function() {
   			 $(this).rules('add', {
        						required: true,
        		
       							 messages: {
           						 required: "Either write inventory item or remove the row"
           		
       					 }
   		 			});
				
			});	
		$('.qty_cls').each(function() {
   			 $(this).rules('add', {
        						required: true, number: true,
        		
       							 messages: {
           						 required: "Either write quantity or remove the row",
								 number: "Please enter numbers only"
           		
       					 }
   		 			});
			});	
		$('.unit_price_cls').each(function() {
   			 $(this).rules('add', {
        						required: true, number: true,
        		
       							 messages: {
           						 required: "Either write unit price or remove the row",
								 number: "Please enter numbers only"
           		
       					 }
   		 			});
			});	
		$('.total_price_cls').each(function() {
   			 $(this).rules('add', {
        						required: true, number: true,
        		
       							 messages: {
           						 required: "Either write total price or remove the row",
								 number: "Please enter numbers only"
           		
       					 }
   		 			});
			});					
			}
			
   
 
    $("#add_another_item").click(function () {  	
	
		createNewTextBox();
		
		
     });
	 
	function getSerialNoGenerated() {
    	var serial_num_generated = [];
	    $(".serial_no_cls").each(function () {
			serial_num_generated.push($(this).val());
		});
		return serial_num_generated;
	 }
	 
	 function getInventoryItemGenerated() {
    	var inventory_item_generated = [];
	    $(".inventory_item_cls").each(function () {
			inventory_item_generated.push($(this).val());
		});
		return inventory_item_generated;
	 }
	 
	 function getQtyGenerated() {
    	var qty_generated = [];
	    $(".qty_cls").each(function () {
			qty_generated.push($(this).val());
		});
		return qty_generated;
	 }
	 
	 function getUnitPriceGenerated() {
    	var unit_price_generated = [];
	    $(".unit_price_cls").each(function () {
			unit_price_generated.push($(this).val());
		});
		return unit_price_generated;
	 }
	 
	 function getTotalPriceGenerated() {
    	var total_price_generated = [];
	    $(".total_price_cls").each(function () {
			total_price_generated.push($(this).val());
		});
		return total_price_generated;
	 }
	 
	
	
});

function removeTextbox(counter_value){
		
		 $('#new_textbox'+counter_value).remove();
		 $('#errors_place').hide();
		 return false;
	 }
	 

	


 



</script>
</head>
<body>
<h1 align="center">Add New Contracts</h1>
<div class="tabs" align="center">
    
    <ul class="tab-links">
        <li <?php if($Page_title == 'List'){?>class="active" <?php } ?>><a href="<?php echo base_url(); ?>contract/index">List of Contracts</a></li>
        <li <?php if($Page_title == 'Create'){?>class="active" <?php } ?>><a href="<?php echo base_url(); ?>contract/createContracts">Create Contracts</a></li>
        <li <?php if($Page_title == 'Add New Contract'){?>class="active" <?php } ?>><a href="">Add New Contract</a></li>
        
    </ul>
 
    <div class="tab-content">
    <form id="add_new_contract" method="post">
    <div id="errors_place"> <strong>Errors</strong> </div>
    <p>Add New Contract for the Customer >>> <?php echo $customer_name;?> </p>
    <input type="hidden" name="customer_id" id="customer_id" value="<?php echo $customer_id; ?>"/>
    <input type="text" name="serial_no" id="serial_no" placeholder="SL NO" size="5"/>
    <select name="inventory_item" id="inventory_item">
    <option value="">Inventory Item</option>
    <?php foreach($inventoryArr as $key=>$val): ?><option value="<?php echo $inventoryArr[$key]["id"];?>"><?php echo $inventoryArr[$key]["label"];?></option><?php endforeach; ?>
    </select>
    <input type="text" name="qty" id="qty" placeholder="Qty" size="5"/>
    <input type="text" name="unit_price" id="unit_price" placeholder="Unit Price" size="8"/>  
    <input type="text" name="total_price" id="total_price" placeholder="Total Price" size="8"/> 
    
    <br/>
    <div id="new_textbox">
       <div id="translations_container"> 
	   </div>
       <div id="error_for_same_project" style="color:#F00;"></div>
    </div>
    <input type="button" value="Add Another Item"  name="add_another_item" id="add_another_item" onClick=""/>
    <br/>
    <input type="text" name="contract_start_date" id="contract_start_date" placeholder="Contract Start Date"/>
    <input type="text" name="contract_end_date" id="contract_end_date" placeholder="Contract End Date"/>
   
    <select name="billing_cycle" id="billing_cycle">
    <option value="">Billing Cycle</option>
    <option value="monthly">Monthly</option>
    <option value="weekly">Weekly</option>
    <option value="quarterly">Quarterly</option>
    </select>
    <br/>
     <div id="date_error"></div>
    
    <input type="submit" value="Create Contract"/>
    </form>
    </div>
</div>

</body>
</html>