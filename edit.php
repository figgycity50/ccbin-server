<?php
include_once 'header.php';
 $id = $_GET['id'];
 $response = file_get_contents("http://figgycity50.kd.io/ccbin/api.php?type=get&data=json&id=".$id);
 $paste_data = json_decode($response, true);
?>
<h1>Edit paste</h1>
<form method="POST" action="edit_script.php">
<textarea name="paste" style="width:75%; height:500px;"><?php echo $paste_data['contents']; ?></textarea><br>
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
    <input type="submit" class="btn btn-default" value="Edit Paste">
</form>