<?php
	//Add additional variables here
	
?>
<style>
		#test-title{
			text-align:center;
			font-size:3em;
			margin:1em;
			line-height:2em;
		}
		#test-description{
			margin:1.5em;
			padding:1em;
		}
		.mintConditions{
			background-color: #F4F1EE;
			border:5px solid <?php echo $cssColor1; ?>;
			-moz-box-shadow: 1px 1px 3px 2px #cabaab;
  			-webkit-box-shadow: 1px 1px 3px 2px #cabaab;
  			box-shadow: 1px 1px 3px 2px #cabaab;
  			padding:2em 1em 1em 1em;
  			margin:1.5em;
		}
		.qHeading{
			text-align:center;
			font-size:2em;
			margin:1em;
			line-height:1.5em;
		}
		.questionTxt{
			margin:1em;
			font-size: 1.3em;
		}
		.mc-choice{
			margin:.5em;
			padding:1em;
		}
		.multiple-choice-q-input-div, .short-response-q-input-div{
			 background-color:#EBEBE4;
		}
		.short-response-q-input-div-container{
			margin:1em;
		}
		.short-response-q-input-div{
		}
		.short-response-field-container{
			padding:1.5em;
			display: inline-flex;
		}
		
		#submit-test-div{
			display:flex;
			justify-content:center;
		}
		.srInputField, input[type="text"] {
			width: 100%;
			margin:1em;
			display: flex;
			padding:1.5em;
		}
		.srTxtDiv{
			margin-top:1em;
		}
		/*Smallest CSS*/
		@media only screen and (max-width: 480px){
			#test-title{
				font-size:2em;
				margin:.7em;
				line-height:1.5em;
			}
			#test-description{
				margin:.5em;
				padding:.25em;
			}
			.mintConditions{
  				padding:.5em;
  				margin:.25em;
			}
			.mc-choice{
				margin:.25em;
			}
			.short-response-q-input-div-container{
				margin:.1em;
			}
			.srTxtDiv{
				margin-top:.1em;
			}
			.short-response-field-container{
				padding:.25em;
				flex-direction: column;
			}
			.srInputField, input[type="text"]{
				margin:1em .1em 1em .1em;
				padding:.25em .15em .25em .15em;
			}
		
		}
	</style>