
<?php 	
    include 'dbcon.php';
	echo "Today is " . date("Y-m-d") . "<br>";
	$day = date("Y-m-d");
	
	echo '<form action="#" method="post"> <button name="submit" type="submit"> Generate Score </button> </form>';
	if(isset($_POST["submit"])) {
	
	function genscore(){
	$rn = rand(1,100);
	echo $rn;
	$day = date("Y-m-d");
	$oras = date("h:i:s");
	$sql = "INSERT INTO ranscogen (score, day, oras)
	VALUES ($rn,'$day','$oras')";
    include 'dbcon.php';
	if ($conn->query($sql) === TRUE) {
	  header('index.php');
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	}
	}
	genscore();
	
	$sql = "select distinct score,day,oras from ranscogen where day = '$day' ";
	$result = $conn->query($sql);
	echo ' <table><thead><tr><th>Score</th><th>Date</th><th>Time</th><th>Count</th></tr></thead><tbody>';
	while($row = $result->fetch_assoc()) {
			$scr = $row['score'];
			echo '<tr><td>'.$row['score']. '</td>';
			echo '<td>'.$row['day'].'</td>';
			echo '<td>'.$row['oras'].'</td>';
			$sql2 = "select count(score) as cnt from ranscogen where score = $scr ";
			$result2 = $conn->query($sql2);
			if($row2 = $result2->fetch_assoc()){
			echo '<td>'.$row2['cnt'].'</td></tr>';
			}
	}
	echo '</tbody></table>';
?>
