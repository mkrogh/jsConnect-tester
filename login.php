<?php
session_start();

if ( !isset( $_SESSION["orgURL"] ) ) {
  $_SESSION["orgURL"] = $_SERVER["HTTP_REFERER"];
}

if (isset($_POST["submit"])){
  $url = redirectURL($_SESSION['orgURL']);
  unset($_SESSION['orgURL']);

  $user = array();
  $user["uniqueid"] = $_POST["uniqueid"];
  $user["name"] = $_POST["name"];
  $user["email"] = $_POST["email"];
  $user["photourl"] = $_POST["photourl"];

  $_SESSION["testUser"] = $user;
  
  header('Location: ' . $url);
}else{ ?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/pure/0.5.0/pure-min.css">
    <link rel="stylesheet" href="main.css">
  </head>
  <body>
    <div class="content">
      <h1>Which user would you like to be today?</h1>
      <form method="POST" class="pure-form pure-form-aligned">
        <fieldset>
          <div class="pure-control-group">
            <label for="uniqueid">Unique ID</label>
            <input id="uniqueid" name="uniqueid" type="text" class="pure-input-1-2" placeholder="Unique connect id" value="<?=e('uniqueid')?>">
            <span title="Used for linking to a user-account">?</span>
          </div>

          <div class="pure-control-group">
            <label for="name">Username</label>
            <input id="name" name="name" type="text" class="pure-input-1-2" placeholder="Username" value="<?=e('name')?>">
          </div>

          <div class="pure-control-group">
            <label for="email">Email</label>
            <input id="email" name="email" type="text" class="pure-input-1-2" placeholder="Email" value="<?=e('email')?>">
          </div>

          <div class="pure-control-group">
            <label for="photourl">Photo url</label>
            <input id="photourl" name="photourl" type="text" class="pure-input-1-2" placeholder="Photo url" value="<?=e('photourl')?>">
          </div>

          <div class="pure-controls">
              <button id="submit" name="submit" value="submit" type="submit" class="pure-button pure-button-primary">Submit</button>
          </div>
        </fieldset>
      </form>
    </div>
  </body>
</html>
<?php
} //End form

function e($var) {
  return htmlspecialchars($_SESSION['testUser'][$var]);
}

function redirectURL($referal) {
  if (empty($referal)) {
  $referal = "/";
  }
 
  $page = parse_url($referal);
  $query = explode("&", $page["query"]);
  $target = "/";
  foreach ($query as $part) {
    if (preg_match("/^p=/", $part)) {
      $target = explode("=", $part)[1];
    }
  }
  $target = urldecode($target);
  //make sure the client_id is correct.
  return "/?p=/entry/jsconnect&client_id=jsconnect-test&Target=" . urlencode($target);
}
?>
