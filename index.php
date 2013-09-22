<?php
include_once 'header.php';
//ccbin_get - Displays paste
function ccbin_get() {
 $id = $_GET['id'];
 $con=mysqli_connect("localhost","blaizecr_ccbin","HZZq3jRS$38BamMpemp5VHr#","blaizecr_ccbin");
 $result = mysqli_query($con,"SELECT * FROM pastes WHERE id='".$id."'");
 $paste_data = mysqli_fetch_array($result);
 $resul2 = mysqli_query($con,"SELECT * FROM users WHERE email='".$_COOKIE['login']."'");
 $user_data = mysqli_fetch_array($resul2);
 //If paste is private only let the owner view it
 if ($paste_data['privacy'] == "private" and $user_data['username'] != $paste_data['owner']) {
    return "private";
 }
 return $paste_data;
}
//step 2. check for an id in the url
if ($_GET['id']) {
    $pdata = ccbin_get();
    if ($pdata == "private") {
    echo '<div class="alert alert-danger"><b>Error:</b> This paste is private and does not belong to you.</a></div>';
    exit;
    }
    if ($pdata['owner'] == "") {
        $owner = "a guest user";
    } else {
        $owner = $pdata['owner'];
    }
    if ($pdata['time'] == "0") {
        $time = "before pastes tracked time";
    } else {
        $time = "on ".date("l d F Y", $pdata['time']);
    }
if ($_GET['nyp'] == "yes") {
    echo '<div class="alert alert-danger"><b>Error:</b> This paste does not belong to you.</div>';
}

function textdecode($decodetext){ 
    $decodevaule=""; 
    for($i=0;$i<strlen($decodetext);$i++){ 
        $teil=rawurlencode(substr($decodetext, $i, 1)); 
        if($teil<32||$teil>1114111){ 
            $decodevaule.=substr($decodetext, $i, 1); 
        }else{ 
            $decodevaule.="&#".$teil.";"; 
        } 
    } 
    return html_entity_decode($decodevaule, ENT_QUOTES); 
} 

 echo '<h1>'.$pdata['name'].'</h1><h4> by '.$owner.' | made '.$time.'</h4>';
 echo '<div class="paste"><pre class="lua"><code class="lua">'.textdecode(htmlspecialchars($pdata['contents'])).'</code></pre></div>';
 echo '<a class="btn btn-primary" href="raw.php?id='.$_GET['id'].'">Raw</a> <a class="btn btn-success" id="copy" href="#">Copy</a> <a class="btn btn-warning" id="copy" href="edit.php?id='.$_GET['id'].'">Edit</a>';
 echo '</br>';
} else {?>
		<h1>New Paste</h1>
		<form id="paste_form" data-validate="parsley" method="POST" action="api.php" novalidate> 
			<div id="form_div">
				<label for="title" class="">Title:</label>
				<input type="text" name="title" class="form-control" placeholder="label set" id="title" data-required="true" data-rangelength="[1,64]" data-error-message="You must enter a title"><br>	  
				<div class="advancedmonitor-wrapper">
					<textarea id="paste" name="paste" style="width:100%; height:92px; resize:none;	overflow:hidden;
						outline: none;
						background-image: url(http://ccbin.blaizecraft.com/images/advancedmonitor-bg.png);
						border-width:32px; backgro-webkit-border-image: url(images/advancedmonitor.png) 20% fill stretch; border-image-source: url(images/advancedmonitor.png); border-image-slice: 20%; border-image-repeat: stretch;
						color:#fff;
						font-family: 'Conv_Inconsolata','Helvetica Neue',Helvetica,Arial,sans-serif;"
						class="" data-required="true" data-rangelength="[1,209712]" data-error-message="This field can't be blank."></textarea>
				</div>
				<input type="hidden" name="type" value="make">
				<input type="hidden" name="head" value="true">
				<div class="blank">&nbsp;</div>
				<div class="wrapper-button">
					<select name="privacy" class="form-control" style="width:100px; display:inline-block;""><option value="public" active="" default="">Public</option><option value="unlisted">Unlisted</option><option value="private">Private</option></select>
					<input type="submit" class="btn btn-default" value="Create Paste">	
				</div>
			</div>
<?
}
echo'<img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" height="100px">';
include_once 'footer.php';
?>