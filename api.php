<?php
$prefix=""; //In case you want have more that 1 database
$con=mysqli_connect("localhost","root","NtioNt10","ccbin_pastes");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
if ($_GET['type'] == 'get') {
    $result = mysqli_query($con,"SELECT * FROM ".prefix."pastes WHERE id='".$_GET['id']."'");
    $paste_data = mysqli_fetch_array($result);
    //temp vardump.
    //var_dump($paste_data);
    if ($paste_data['title'] == "") $paste_data['title'] = "Untitled";
    if ($_GET['data'] == 'json') {
       $json_paste = json_encode($paste_data);
       echo $json_paste;
    } else {
        echo '{id='.$paste_data['id'].', name="'.$paste_data['name'].'", contents= "'.$paste_data['contents'].'"}';
    }
}
if ($_POST['type'] == 'make') {
    //make a paste id
function get_random_string($valid_chars, $length)
{
    // start with an empty random string
    $random_string = "";

    // count the number of chars in the valid chars string so we know how many choices we have
    $num_valid_chars = strlen($valid_chars);

    // repeat the steps until we've created a string of the right length
    for ($i = 0; $i < $length; $i++)
    {
        // pick a random number from 1 up to the number of valid chars
        $random_pick = mt_rand(1, $num_valid_chars);

        // take the random character out of the string of valid chars
        // subtract 1 from $random_pick because strings are indexed starting at 0, and we started picking at 1
        $random_char = $valid_chars[$random_pick-1];

        // add the randomly-chosen char onto the end of our string so far
        $random_string .= $random_char;
    }

    // return our finished random string
    return $random_string;
}
$pattern = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
$code = get_random_string($pattern, 6);
mysqli_query($con,"INSERT INTO pastes SET id = '" . $code . "', name = '" . $_POST['title'] . "', contents = '" . $_POST['paste'] . "'");
if ($_POST['head'] == 'true') {
    header("Location: index.php?id=".$code);
} else
echo $code;
}
?>
