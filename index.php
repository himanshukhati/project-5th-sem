
<html>

	<head>
		<link rel='stylesheet' href='style.css' />

		<script type="text/javascript">
			function toggleSelect(id)
			{
				var e=document.getElementById(id);
				e.style.display=='none' ? e.style.display='block' : e.style.display='none';
			}
		</script>

	</head>

	<body>

	<h1 align="center" style="margin:10px;color:#337">
		Names Popularity
	</h1>
	<hr style="width:100%">

	<table width='90%' style="margin:auto;padding:20px;box-sizing:border-box" border=0>
		<tr>
				<td align='center' style="font-size:25px">
						Select An Option
				</td>
		</tr>
	 <tr>
	 	<td width="100%" align="center" style="vertical-align:top">
	 		<div class='header' style="color:#fff;padding:7px;font-size:18px;font-weight:bold;border:solid #999 1px;cursor:pointer;" onclick="toggleSelect('option1')">
	 			Find Popular Names By Year
	 		</div>

	 		<div id='option1' style="background-color:#fff;padding:30px 10px;font-size:16px;font-weight:bold;border:solid #222 1px;<?php
				if(empty($_GET['errorType']) || $_GET['errorType']!=1 )
				{ echo "display:none"; }
			?>" >

	 			<form action='by_year.php' method='post'  >
	 				<table align="center">
	 					<tr>
	 						<td align="left" class="home-table-td" >
	 							Which Year:
	 						</td>
	 						<td align="left">
	 							<input type='text' name='year' placeholder='Enter year [1944 to 2013]' size="30" />
	 						</td>
	 					</tr>
	 					<tr>
	 						<td align="left" class="home-table-td">
	 							How Many Top Names To Show:
	 						</td>
	 						<td align="left">
	 							<input type='text' name='limit' placeholder='Enter the number of top ranks to show' size="30" />
	 						</td>
	 					</tr>
	 					<tr>
	 						<td align="left" class="home-table-td">
	 							Gender:
	 						</td>
	 						<td align="left">
	 							<select name="gender">
	 								<option value='male' >Male</option>
	 								<option value='female' >Female</option>
	 								<option value='both' >Both</option>
	 							</select>
	 						</td>
	 					</tr>
	 					<tr>
	 						<td colspan="2" align="center">
	 							<button class='home-submit' >Submit</button>
	 						</td>
	 					</tr>

						<?php
	 						if(!empty($_GET['errorType']) && $_GET['errorType']==1 && !empty($_GET['error']))
	 						{
	 					?>
						<tr>
	 						<td colspan="2" align="center">
	 							<div style="margin:auto;color:#c22">
	 								<?php echo $_GET['error']; ?>
	 							</div>
	 						</td>
	 					</tr>
	 					<?php } ?>

	 				</table>
	 			</form>

	 		</div>
	 	</td>
	</tr>
	<tr>
	 	<td width="100%" align="center" style="vertical-align:top">
	 		<div class='header' style="color:#fff;padding:7px;font-size:18px;font-weight:bold;border:solid #999 1px;cursor:pointer" onclick="toggleSelect('option2')">
	 			Find Change In Popularity Of Name
	 		</div>
	 		<div id="option2" style="background-color:#fff;padding:30px 10px;font-size:16px;font-weight:bold;border:solid #222 1px;<?php
				if(empty($_GET['errorType']) || $_GET['errorType']!=2 )
				{ echo "display:none"; }
			?>">

				<form action='by_name.php' method='post'  >
	 				<table align="center">
	 					<tr>
	 						<td align="left" class="home-table-td" >
	 							Name:
	 						</td>
	 						<td align="left">
	 							<input type='text' name='name' placeholder='Enter a full or partial name to search for' size="30" />
	 						</td>
	 					</tr>
	 					<tr>
	 						<td align="left" class="home-table-td">
	 							Start Year:
	 						</td>
	 						<td align="left">
	 							<input type='text' name='year' placeholder='Enter the begining year' size="30" />
	 						</td>
	 					</tr>
	 					<tr>
	 						<td align="left" class="home-table-td">
	 							Gender:
	 						</td>
	 						<td align="left">
	 							<select name="gender" >
	 								<option value='male' >Male</option>
	 								<option value='female' >Female</option>
	 							</select>
	 						</td>
	 					</tr>
	 					<tr>
	 						<td colspan="2" align="center">
	 							<button class='home-submit' >Submit</button>
	 						</td>
	 					</tr>

	 					<?php
	 						if(!empty($_GET['errorType']) && $_GET['errorType']==2 && !empty($_GET['error']))
	 						{
	 					?>
						<tr>
	 						<td colspan="2" align="center">
	 							<div style="margin:auto;color:#c22">
	 								<?php echo $_GET['error']; ?>
	 							</div>
	 						</td>
	 					</tr>
	 					<?php } ?>
	 				</table>
	 			</form>

	 		</div>
	 	</td>
	 </tr>
	</table>

	</body>

</html>
