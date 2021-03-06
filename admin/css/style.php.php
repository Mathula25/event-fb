<?php
header("Content-type: text/css; charset: UTF-8");
?>

body {
		padding-top:60px;
        padding-bottom:50px;
	}
			
	.chimages,
	ul {
		list-style:none;
		padding:0;
		margin:0
	}
    
    .menuHolder {
    	position:fixed;
        top:0;
        left:0;
        right:0;
        background:#DDD;
        z-index:9999
    }
	
	.modal-dialog {
		width:auto !important;
		max-width:1140px;
	}
	
	.modal-content {
		border:none
	}
	
	.listAllCats li {
		margin:1px;
		float:left;
		padding:3px 10px;
		background:#e0f6ff;
		cursor:pointer;
	}
	
	.listAllCats li:hover {
		background:#2BACFF;
	}
	
	.listAllCats .inActive {
		background:#2BACFF;		
	}
	
	.cpContentPlan li {
		float:left;
		margin:3px;
	}
	
	.newContentPlanSheet {
		width:247px;
		height:350px;
		border:solid 1px #DDD;
		border-radius:3px;
	}
	
	
	.pubLogo {
		height:50px;
		width:100px;
	}
	
	.show-years>li {
		border-top:solid 1px #DDD;
	}
	
	.show-years .year-disc{
		padding-left:20px
	}
	
	.firstLevel {
		padding:8px 0 8px 20px;
	}
	
	.secondLevel {
		padding:5px 0 5px 50px;
	}
	
	.thirdLevel {
		padding-left:80px;
	}
	
	.forthLevel {
		padding-left:100px;
	}
	.show-issues {
		border-top:dotted 1px #DDD;
	}
	
	.admin-form {
		margin-bottom:40px
	}
	
	.page-header-image img {
		max-height:70px;
		float:right;
		max-width:100%;
	}
	
	.page-header-image {
		max-width:120px;
		width:120px;
		float:left;
		height:82px;
		margin:2px 30px 2px 2px;
		padding:5px;
		border:solid 1px #DDD;
		background:#dedede;
	}
	
	.show-issues:after,
	.p-discri:after,
	.page-header-image:after,
	.issues-pages>li:after {
		display:table;
		content:"";
		clear:both
	}
	
	.load-page-title:hover {
		color:#3A81FF
	}
	
	.issues-pages>li:hover {
		background:#DDD;
		cursor:pointer;
		animation-delay: 2s;
	}
	
	.load-pages-excerpt {
		font-size:13px;
	}
	
	.load-page-title {
		font-weight:500
	}
	
	.ui-sortable-helper {
		opacity:.5
	}
	
	.load-pages-below {
		margin:20px 0
	}	
	
	.p-setting-panel {
		display:none
	}
	
	.create-new-menu  {
		cursor:pointer
	}
	
	
	.overColorTitle {
		white-space:nowrap;
		overflow:hidden;
		text-overflow:ellipsis
	}
	
	#createMenuList .ui-sortable-handle,
	.sm-post-list li,
	.choose-posts {
		cursor:move
	}
		
	.choose-posts>li .svh>label,
	.dropdown-item,
	.cur-pointer,
	.modal-collapse,
	.p-setting-panel span  {
		cursor:pointer;
	}
	
	
  
	#cnpcm .nms>label,
	#cnpcm .nms>span,
	.shlas .nms>label,
	.shlas .nms>span {
		font-size:13px;
		border-radius:3px;
		margin:0 2px;
		padding:3px;
		cursor:pointer;
		font-weight:600;
		font-style:italic;
        visibility:hidden;
	}
	
	.shlas .nms>label {
		margin:0
	}
	
	.actLab {
    	color:#ff0000   
    }
    
	.ual>span:hover,
	.shlas .nms>label:hover,
	.shlas .nms>span:hover {
		background:#F99899;
	}
	    
	.shlas .nms .glyphicon {
		color:#0043ff;
		margin-right:5px;		
	}
    
    .new-menu-setting span,
	.new-menu-setting label {
		visibility:hidden;
	}
    
    .actLab {
        visibility:visible !important;     	
    }
    
	.actLab>span{
        visibility:visible !important;
    }
    
	.iplat{
		display:none;
		width:100%;
		min-height:800px
	}
	
	.ual>span{
		font-size:13px;
		border-radius:3px;
		margin:0 2px;
		padding:3px;
		cursor:pointer;
		font-weight:600;
		font-style:italic
	}
	
	.psl-here:hover {
		background:#FFF;
	}
	
	.anmbc {
		margin-top:10px;
	}
	
	.anmop {
		font-size:12px;
		font-weight:600
	}
	
	.p-discri:hover {
		background:#DDD;
	}
	
	.choose-posts span:hover,
	.sm-post-list span:hover,
	.p-setting-panel span:hover {
		color:#414141
	}
	
	.overColor:hover {
		background:#f1f1f1;
	}
	
	#ps-listMenu .row{
		margin:0 50px;
		margin-bottom:-1px;
	}
	
	#load-pages-here {
		padding-bottom:50px;
	}
	
	.lipsp span {
		cursor:pointer;
		border-radius:3px;
		font-weight:600;
		padding:3px;
	}
    
    .sm-post-list .lipsp {
    	display:none
    }
	
	.choose-posts .lipsp span:hover {
		background:#FD9597;
		color:#000 !important;
	}
	
	.settingInfo {
		padding:10px;
		text-align:center
	}
	
	.ps-sqlConnectText {
		padding:10px
	}
	
	.dropdown-item {
		display: block;
		width: 100%;
		padding: 3px 1.5rem;
		clear: both;
		font-weight: 400;
		color: #292b2c;
		text-align: inherit;
		white-space: nowrap;
		background: 0 0;
		border: 0;
	}
	
	.sm-post-list {
	}
	
	.pubMenuEdit {
		border:none;
		outline:none;
		padding:0;
		margin:0;
		margin-left:20px;
		width:70%;
	}
	
	#createMenuList li {
		
	}
	
	#createMenuList label,
	#createMenuList span {
		cursor:pointer
	}
		
	.new-menu-name .glyphicon-th-list {
		float:left;
	}
	
	.sm-post-list>li,
	.choose-posts>li {
		padding:0
	}
	
	.overColor	 {
		padding:5px;
	}
	
	#pList .glyphicon {
		color:#0043ff;
		cursor:pointer;
	}
	
	.sm-post-list .svh {
		display:none
	}
	/*
	.choose-posts .svh label {
		visibility:hidden;
	}
	*/
	
	.choose-posts .input-group-text {
		padding:1px 4px;
		color:#777;
		font-size:13px;
		background:none;
		border:none;
        max-width: 116px;
	}
	
	.svhtob label:hover,
	.svhbob label:hover {
		font-weight:600;
		color:#000;
		cursor:pointer;
	}
	
	.choose-posts .svh span{
		margin-right:5px;
		color:#000;
	}
	
	.issue-setting-panel-top span,
	.sm-post-list span,
	.choose-posts span {
		color:#BBB !important;
	}
	
	.choose-posts .cptl {
		font-weight:600;
		margin-bottom:5px;
		font-size:18px;
		text-transform:uppercase
	}
	
	.choose-posts .activated[data-promeact],
	.choose-posts .activated[data-contentimage] {
		color:#025be2 !important;
	}
		
	.choose-posts .activated {
		color:#e21b1e !important;
		visibility:visible !important;
		opacity:1;
		font-weight:600
	}
	
	.choose-posts .svhbob,
	.choose-posts .svhtob {
		width:100%;
	}
	
	.svhtob label,
	.svhbob label {
		width:20%;
	}
    
    .svhbob [name="ti"] {
    	font-weight:600;        
   	}
	
    .svhbob [name="ti"] option[value="1"] {
    	color:#F00
    }
        
	.choose-posts>li {
		border-bottom:solid 1px #DDD;
		padding-bottom:10px;
		margin-bottom:10px;
	}
	
	.sm-post-list .col-sm-8 {
		width:100%;
		max-width:none;
	}
	
	.choose-posts .ui-sortable-placeholder {
		background:#FFDBDB;
		visibility:visible !important;
		border-bottom:solid 1px #FF8486		
	}
	
	
	.choose-posts {
		border:solid 1px #FFF;
		min-height:20px;
		margin-bottom:30px
	}
	
	.dotted-border {
		border:dotted 1px #5799FF;
	}
	
	#myModal .container {
		margin:50px auto;
		background:#FFF;
	}
	
	.remove-padding {
		padding:0 !important;
	}
	
	.remove-margin {
		margin:0 auto !important;
	}
	
	#ifwa {
		margin-bottom:20px;
	}
	
	nav a {
		color:#000;
	}
	
	.navbar {
		margin-bottom:0
	}
		
	#chooseFrontImage {
		display:block;
		text-align:center;
		background:#FFF;
	}
	
	#chooseFrontImage img {
		width:100%;
	}
		
	.psl-here {
		background:#FFF;
	}
	
	.socialMedia h4 {
		font-weight:bold;
		font-size:15px;
		line-height:1.3;
		margin:0 0 2px 0
	}
	
	.createNew {
		border:none;
		padding:0;
		margin:0;
		background:none;
	}
	
	.createNewOpt {
		display:none;
	}
	
	.lastCreatedIssues {
		background:#FFAAAC !important;
	}
	
	.top-header:after {
		clear:both;
		content:"";
		display:table;
	}
	
	#visibleArticles li {
		padding:5px;
		cursor:pointer;
	}
	
	#visibleArticles .choosed {
		background:#92C7FF
	}
	
	#visibleArticles .glyphicon-eye-open {
		color:#FFF;
	}
	
	#visibleArticles .col-sm-4 {
		display:none
	}
	
	#visibleArticles li:hover {
		background:#DDD;
	}
	
	#pList [data-off] {
		color:#F00
	}
    
	#pList .inactive[data-off] {
    	color:#F00
    }
    
	#pList .active[data-off] {
		color:#00b500
	}
	
	.choose-posts .svh label[data-pgset] {
		color:#ababab;
		visibility:visible
	}
	
	.choose-posts .svh label[data-pgset]:hover {
		color:#2a85ff
	}
	
	.chimages>li {
		border-bottom:dotted 1px #EEE;
		padding:2px 0;
		text-align:right;
		cursor:pointer;
	}
	
	.chimages>li:hover {
		background:#8ABFFF;
	}
	
	.chimages>li img{
		height:46px;
		width:auto;
		padding:5px;
		
	}
	
	.chimages {
		margin:10px 0 ;
	}	
	
	.choohimage {
		background:#8dbbff
	}
	
	.uhifps {
		background:none;
		text-align:left;
	}
	
	.uhifps label{			
		padding: 10px;
		color: #000;
		font-weight: bold;
		margin:0;
		display:block;
	}
	
	.listPostToMenu li {
		padding:4px 0;
		margin-bottom:2px;
		border-bottom:solid 1px #DDD;
	}
	
	.listPostToMenu li:hover {
		background:#DDD;
	}
	
	.publisherSettings h4 {
		margin-bottom:0
	}
    
    .publisherSettings h5 {
    	line-height: .8;
        margin: 10px 0 0;
    }
    
    .publisherSettings .modal-collapse .help {
    	padding-left:15px;
    }
	
	.help {
		font-size:12px;
		color:#9E9E9E;
		font-style:italic
	}
    
    .help span {
    	font-weight:600;
        color:#333
    }
	
	.shoeFevImages .help,
	.shoeLogoImages .help {
		display:none
	}
	
	.shoeFevImages ul>li,
	.shoeLogoImages ul>li {		
		display:table;
		float:left;
		margin-right:5px;
		margin-bottom:5px;
		padding:5px;
		border:solid 1px #DDD
	}
	
	.shoeLogoImages .active,
	.shoeFevImages .active {
		background:#ffb0b0
	}
	
	.shoeLogoImages ul>li img {
		height:40px;
		background:#d4d4d4;
	}
	
	.shoeFevImages ul>li img{
		height:60px;	
		background:#FFF;
	}
	
	.shoeFevImages>ul:after,
	.shoeLogoImages>ul:after {
		display:table;
		clear:both;
		content:""
	}
	
.loadWpPostForMenu span {
	visibility:hidden;
	margin:1px 2px;
	font-size:14px;
	color:#555;
	cursor:pointer;
	font-style:italic;
	border-radius:3px;
	padding:3px 10px;
}

.loadWpPostForMenu span:hover {
	color:#000;
	background:#9accff;
}

.holdingYearIssue {
	border-bottom:solid 1px #DDD;
}

.yearColleps {
	padding:7px 0
}

.p-setting-panel,
.homePubConfig {
	font-size:12px;
	font-style:italic;
}

.p-setting-panel span,
.homePubConfig>span {
	margin:0 3px;
	padding:3px 3px;
	font-weight:bold;
	border-radius:3px;
	cursor:pointer
}

.p-setting-panel span:hover,
.homePubConfig>span:hover {
	background:#F99899
}

.lblIssue {
	font-weight:600;
    font-size: 10px;
    color:#227aff;
    font-style: italic;
}

.lipea>li {
	margin:0;
	padding:0;
    width:50%;
}