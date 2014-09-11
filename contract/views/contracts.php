<?php
Array("Page_title" => $Page_title);
?>
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
		
		th{
	padding:17px;
}
ul{
	margin-left:294px !important;
}
td{
	text-align:center;
}
th{
	border:solid 1px #09c;
}
</style>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/smoothness/jquery-ui.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>

</script>
</head>
<body>
<h1 align="center">Contracts</h1>

<div class="tabs" align="center">
    
    <ul class="tab-links">
        <li <?php if($Page_title == 'List'){?>class="active" <?php } ?>><a href="<?php echo base_url(); ?>contract/index">List of Contracts</a></li>
        <li <?php if($Page_title == 'Create'){?>class="active" <?php } ?>><a href="<?php echo base_url(); ?>contract/createContracts">Create Contracts</a></li>
        
    </ul>
 
    <div class="tab-content">
    
    <table style="border:1px solid #CCC;">
<thead style="border:1px solid #999;">
<th>Column 1</th>
<th>Contract Name</th>
<th>Start Date</th>
<th>End Date</th>
<th>Edit Options</th>
</thead>

<?php 
foreach($recordsArr as $key=>$val){
?>
<tr>
<td><?php echo $recordsArr[$key]['contract_id']; ?></td>
<td><?php echo $recordsArr[$key]['name']; ?></td>
<td><?php echo $recordsArr[$key]['start_date']; ?></td>
<td><?php echo $recordsArr[$key]['end_date']; ?></td>
<td></td>
<tr>
<?php
}
?>
</table>
        
    </div>
</div>

</body>
</html>