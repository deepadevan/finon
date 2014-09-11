<html>
<head>
<title><?php echo  $Page_title; ?></title>
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
		
#add-new-client{
	margin-left:50px;
}

#customer-selected{
	float:left;
	margin-left: 168px;
}

#customer-name{
	 float: left;
    margin-left: 87px;
}

#customer-submit{
	margin-left: 175px;
}

.error{
	color:#F00;
	
}
ul{
	margin-left:294px !important;
}
#customer_select{
	border:1px solid #999;
}
</style>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/smoothness/jquery-ui.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<script>
$(document).ready(function(){
	$('#customer_select').html('No records to display');
$('#customer_name').autocomplete({
                  source: function( request, response ) {
					  
                      $.ajax({
                          url : '<?php echo base_url(); ?>contract/getUserNameInTextBox',
                          dataType: "json",
                        data: {
                           name_startsWith: request.term,
                           
                        },
						type: 'post',
                         success: function (data) {
						response(data);
					}
					
				});
			},
			
			select: function (event, ui) {
				 var customer_id = ui.item.id;
				
				 var customer_name = ui.item.label;
				
			
				 $('#customer_id').val(customer_id);
				 $('#customer_select').html('<label id=customer-name>'+customer_name+'</label><input type="radio" name="customer_selected" value="'+customer_id+'" id="customer-selected"/><br/><input type="submit" value="Select" id="customer-submit"/>'
				
				 );
			},
			
                  autoFocus: true,
                  minLength: 0          
              });
			  
			  
$('#customer').validate({
	
rules:{
	customer_selected:{ required:true }
	
},
messages:{
	
	customer_selected:{ required: "Please select the customer" }
}
	
});



});
</script>
</head>
<body>

<h1 align="center">Add a New Contract Check Customer</h1>
<div class="tabs" align="center">
    <ul class="tab-links">

    <li <?php if($Page_title == 'List'){?>class="active" <?php } ?>><a href="<?php echo base_url(); ?>contract/index">List Of Contracts</a></li>
    <li <?php if($Page_title == 'Create'){?>class="active" <?php } ?>><a href="<?php echo base_url(); ?>contract/createContracts">Create Contracts</a></li>
    
   </ul>
<div class="tab-content">
<form id="customer" method="post" action="<?php echo base_url(); ?>contract/addNewContract">
Select Customer
<input type="hidden" id="customer_id" name="customer_id" />
<input type="text" name="customer_name" id="customer_name" class="form-control txt-auto"/>

<button id="add-new-client">Add New Client</button>

<div id="customer_select">

</div>
</form>
</div>
</div>
</body>
</html>