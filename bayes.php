<?php
$dataSet = array(
	array('cerah', 'normal', 'pelan', 'ya'), 
	array('cerah', 'normal', 'pelan', 'ya'),
	array('hujan', 'tinggi', 'pelan', 'tidak'),
	array('cerah', 'normal', 'kencang', 'ya'),
	array('hujan', 'tinggi', 'kencang', 'tidak'),
	array('cerah', 'normal', 'pelan', 'ya'));
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
	echo '<table border=1>';
	echo '<tr><th>cuaca</th><th>temperatur</th><th>kecepatan angin</th><th>label</th></tr>';
	foreach ($dataSet as $data) {
		# code...
		echo '<tr>';
		foreach ($data as $dat) {
			# code...
			echo '<th>';
			echo $dat."&nbsp&nbsp&nbsp";
			echo '</th>';
		}
		echo '</tr>';
	}
	echo '</table>';
?>
	<form method="post" enctype="multipart/form-data">
	  <h3>cuaca:</h3>
	  <input type="text" name="cuaca" >
	  <h3>temperatur:</h3>
	  <input type="text" name="temperatur" >
	  <h3>kecepatan angin:</h3>
	  <input type="text" name="kecepatan-angin" >
	  <br><br>
	  <input type="submit" name="submit" value="submit">
	</form>

<?php
if(isset($_POST['submit']))
{
	$cuaca = $_POST['cuaca'];
	$temperatur = $_POST['temperatur'];
	$kecepatanAngin = $_POST['kecepatan-angin'];
	$dataTes = array();
	array_push($dataTes, $cuaca);
	array_push($dataTes, $temperatur);
	array_push($dataTes, $kecepatanAngin);
	
	$valueYa = cekNilai($dataSet, $dataTes, 'ya');
	$valueTidak = cekNilai($dataSet, $dataTes, 'tidak');
	
	$keputusan = 'ya';
	if($valueYa < $valueTidak)
	{
		$keputusan = 'tidak';
	}
	echo 'keputusannya adalah '. $keputusan;
}

function cekNilai($dataSet, $dataTes, $class)
{
	echo $class.' = ';
	$cek=false;
	$jumPerClass = getJumPerClass($dataSet, $class);
	$value = 1;
	for($i = 0; $i< count($dataTes); $i++)
	{
		$jum = 0;
		if($dataTes[$i] != '')
		{		
			foreach ($dataSet as $data) {
				# code...
				if($data[$i] == $dataTes[$i] && $data[3] == $class)
				{
					$jum++;
				}
			}
			$jum = $jum / $jumPerClass;
			
			$value = $value*$jum;
			if($cek == false)
				echo $jum;
			else
				echo '*'.$jum;
			$cek = true;
		}
		
	}
	echo '*'.$jumPerClass .' / '. count($dataSet);
	echo '<br>'.$class. ' = '. $value*($jumPerClass / count($dataSet)). '<br>';

	return $value*($jumPerClass / count($dataSet));
}

function getJumPerClass($dataSet, $class)
{
	$jum = 0;
	foreach ($dataSet as $data) {
		# code...
		if($data[3] == $class)
		{
			$jum++;
		}

	}
	return $jum;
}
?>
</body>
</html>