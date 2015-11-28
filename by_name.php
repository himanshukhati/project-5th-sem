<?php

	$error=null;


	if( empty($_POST['name']) )
	{
		$error="Please enter a Name";
		header("location: index.php?errorType=2&error=".$error);
		die();
	}

	//Input validation
	if(empty($_POST['year']) || ((int)$_POST['year'] < 1944 ) || ((int)$_POST['year'] > 2013 ) )
	{
		$error="Please enter a valid Year between 1944 to 2013";
		header("location: index.php?errorType=2&error=".$error);
		die();
	}

	//Set the year
	$year=(int)$_POST['year'];
	$name=$_POST['name'];
	$name_upper=strtoupper($_POST['name']);
	$gender=$_POST['gender'];

	$nameList=array(); //Holds the matched names incase its a partial search

	for($i=$year;$i<2014;$i++)
	{
		$fh=fopen("names/".$gender."_cy".$i."_top.csv","r");

		while(!feof($fh))
		{
			$record=fgetcsv($fh);

			if(strpos($record[0],$name_upper) === 0 )
			{
					if(empty($nameList[$record[0]]))
					{
						$nameList[$record[0]]=array();
					}
					$record[2]=(int)preg_replace("/[^0-9]/", "", $record[2]);
					$nameList[$record[0]][$i]=array($record[1],$record[2]);
			}

		}
		fclose($fh);
	}


	//Make bar graphs for the names
	foreach($nameList as $_name=>$data)
	{
		$amounts=array();
		foreach($data as $val)
		{
			$amounts[]=$val[0];
		}
		$nameList[$_name]['graph']=makeGraph($amounts);
	}

?>


<html>

	<head>
		<title>::Baby Names::</title>
		<link rel='stylesheet' href='style.css' />
	</head>

	<body>

	<h1 align="center" style="margin:10px;color:#003">
		Names Popularity
	</h1>
	<hr style="width:100%">
	<div align='center'>
			<span style="font-size:18px" >
			<a href='index.php' style="color:#227" > Go Back </a>
		</span>
	</div>

	<table width='99%' style="margin:auto;padding:20px;box-sizing:border-box" border=0>
	 <tr>

	 	<td width="100%" align="center" style="padding-right:20px;vertical-align:top">

	 		<?php
	 			foreach($nameList as $name=>$record )
	 			{
	 				$img=$record['graph'];
	 				unset($record['graph']);
	 		?>
		 		<div style="background-color:#fff;padding:20px 10px;font-size:16px;font-weight:bold;">

		 			<div style="margin:10px;background-color:#fff;border-radius:10px;padding:10px;border:solid #222 1px;text-align:center;color:#233;font-size:25px">
		 				<span style='color:#666;' >Name:</span> <?php echo $name; ?>
		 				<table width="100%">
			 				<tr>
			 					<td  align="center" >
			 						<?php echo "<img src='data:image/jpeg;base64,".$img."' style='border:solid #ddd 1px;padding:10px;border-radius:20px' />"; ?>
			 					</td>
			 					<td align="left" style="vertical-align:top;font-size:15px;color:#227">

			 						<table align="center" style="color:#444;padding:10px;width:50%;">

			 							<tr>
			 								<td align="center" width="33%">
			 									<u>Year</u>
			 								</td>
			 								<td align="center" width="34%">
			 									<u>Number Of Babies</u>
			 								</td>
			 							</tr>
			 							<?php
			 								foreach($record as $year=>$data)
			 								{
			 							?>
			 								<tr>
				 								<td align="center">
				 									<?php echo $year; ?>
				 								</td>
				 								<td align="center">
				 									<?php echo $data[0]; ?>
				 								</td>
				 							</tr>
			 							<?php
			 								}
			 							?>
			 						</table>
			 					</td>
			 				</tr>
		 				</table>
		 			</div>

		 		</div>
		 	<?php
		 		}
		 	?>
	 	</td>
	 </tr>

	</table>

	</body>

</html>


<?php
function makeGraph($values)
{
	ob_start();

// Get the total number of columns we are going to plot

    $columns  = count($values);

// Get the height and width of the final image

    $width = 300;
    $height = 200;

// Set the amount of space between each column

    $padding = 5;

// Get the width of 1 column

    $column_width = $width / $columns ;

// Generate the image variables

    $im        = imagecreate($width,$height);
    $gray      = imagecolorallocate ($im,195,100,200);
    $gray_lite = imagecolorallocate ($im,0xee,0xee,0xee);
    $gray_dark = imagecolorallocate ($im,0x7f,0x7f,0x7f);
    $white     = imagecolorallocate ($im,0xff,0xff,0xff);

// Fill in the background of the image

    imagefilledrectangle($im,0,0,$width,$height,$white);

    $maxv = 0;

// Calculate the maximum value we are going to plot

    for($i=0;$i<$columns;$i++)$maxv = max($values[$i],$maxv);

// Now plot each column

    for($i=0;$i<$columns;$i++)
    {
        $column_height = ($height / 100) * (( $values[$i] / $maxv) *100);

        $x1 = $i*$column_width;
        $y1 = $height-$column_height;
        $x2 = (($i+1)*$column_width)-$padding;
        $y2 = $height;

        imagefilledrectangle($im,$x1,$y1,$x2,$y2,$gray);

// This part is just for 3D effect

        imageline($im,$x1,$y1,$x1,$y2,$gray_lite);
        imageline($im,$x1,$y2,$x2,$y2,$gray_lite);
        imageline($im,$x2,$y1,$x2,$y2,$gray_dark);

    }

// Send the PNG header information. Replace for JPEG or GIF or whatever
    imagejpeg($im,NULL,100);

    $img=ob_get_clean();
    $img=base64_encode($img);

    return $img;

}

?>
