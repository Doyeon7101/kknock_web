<?php session_start();

$conn=new PDO('mysql:host=localhost;dbname=db_raccoon', 'newuser', 'ehdus3048') or die("sql error");
if(isset($_POST['submit'])!=""){
    $name=$_FILES['mfile']['name'];
    $size=$_FILES['mfile']['size'];
    $type=$_FILES['mfile']['type'];
    $temp=$_FILES['mfile']['tmp_name'];
    $fname = date("YmdHis").'_'.$name;
    $chk = $conn->query("SELECT * FROM  file_drive where name = '$name' ")->rowCount();
    if($chk){
        $i = 1;
        $c = 0;
        while($c == 0){
            $i++;
            $reversedParts = explode('.', strrev($name), 2);
            $tname = (strrev($reversedParts[1]))."_".($i).'.'.(strrev($reversedParts[0]));
            $chk2 = $conn->query("SELECT * FROM  file_drive where name = '$tname' ")->rowCount();
            if($chk2 == 0){
                $c = 1;
                $name = $tname;
            }
    }
}
    $move =  move_uploaded_file($temp,"uploads/".$fname);
    if($move){
    $query=$conn->query("insert into file_drive (name,fname) values('$name','$fname')");
    if($query)
        header("location:file.php");
    else
        die("sql error");
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width" initial-scale=1.0">
	<title>raccoon</title>
</head>

<body bgcolor="LightSalmon">
	<a href="./main.php">main</a><br>
    <img src='./src/v.jpeg' width='700' alt='raccoon'>
    <h1>File Drive</h1>
    <p style='color:red'>Max file size: 100MB</p>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="mfile">
        <button type="submit" name="submit">Uploaddd</button>
    </form>
    <hr>
    <table cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th width="80%" align="center">Files</th>
					<th align="center">Download</th>	
				</tr>
			</thead>
			<?php
			$query=$conn->query("select * from file_drive order by id desc");
			while($row=$query->fetch()){
				$name=$row['name'];
			?>
			<tr>
				<td>
					&nbsp;<?php echo $name ;?>
				</td>
				<td>
                    <?php $path = "uploads/" . $row['fname'];?>
                    <p><a href="<?="$path"?>" download><?=$name;?></a></p>
				</td>
			</tr>
			<?php }?>
		</table>

</body>
</html>