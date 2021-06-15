<?php
class building{
    public $building_id;
    public $name;
    public $open;
    public $close;
    public $job_length;
    public $techs;
    public $bulk;
    public $aon;
    public $switch;
    public $unit_type;
    public $panel;
    public $panel_loc;
    public $notes;
    public $addresses = array();
    public $stnames = array();

    public function __construct(Array $properties=array()){
      foreach($properties as $key=>$value){
        $this->$key = $value;
      }
    }

    public function buildAddress(Array $data = array()){
      foreach($data as $key=>$value){
        array_push($this->addresses, $value);
      }
    }


    public function getStNames(array $addresses){
      $stnames = array();
      foreach ($addresses as $addr) {
        $arr = explode(' ', $addr);
        $arr = array_slice($arr, 1, 3);
        $stname = ucfirst(implode(' ', $arr));
        array_push($stnames, $stname);
      }
      return array_unique($stnames);
    }


    public function printBuilding(){
      print "<div class=\"building\" id=\"building_".$this->building_id."\">";
      print "<div class=\"building_col\">";
      print "<h2 class=\"build_name\">".$this->name."</h2>";

      print "<p class=\"hours\"><em class=\"open\">".$this->open;
      if(strlen($this->open)<3){
        print "am";
      }
      print "</em>-<em class=\"close\">".$this->close;
      if(strlen($this->open)<3){
        print "pm";
      }
      print "</em></p>";
      print "<p class=\"length\"><b>Job Length: </b>".$this->job_length." hours</p>";
      print "<p class=\"techs\"><b>Techs Needed: </b>".$this->techs."</p>";

      print "<p class=\"switch\">".$this->switch."</p>";
      print "<p class=\"panel_loc\">".$this->panel_loc."</p>";
      print "<p class=\"notes\">".$this->notes."</p>";

      print "<div class=\"badge_div\">";
      print "<p data-type=\"".$this->unit_type."\">".$this->unit_type."</p>";

      if($this->bulk){
        print "<p class=\"bulk\" data-bulk=\"1\">Bulk Deal</p>";
      }
      if($this->aon){
        print "<p class=\"aon\" data-aon=\"1\">ActivE</p>";
      }
      if($this->panel){
        print "<p class=\"panel\" data-panel=\"1\">Media Panel</p>";

      }
      print "</div>";
      print "</div>";
      print "<div class =\"building_col\">";

      print "<div class=\"address_div\" open>";
      $this->stnames = $this->getStNames($this->addresses);
      foreach ($this->stnames as $sts){
        print "<details class=\"streets_div\">";
        print "<summary>".$sts."</summary>";
        foreach ($this->addresses as $addr){
          $arr = explode(' ', $addr);
          $arr = array_slice($arr, 1, 3);
          $stname = implode(' ', $arr);
          if (strcasecmp($stname, $sts) == 0){
            print "<p class=\"address\" open>". $addr."</p>";
          }
        }
        print "</details>";
      }
      print "</div>";
      print "<input type=\"button\" class=\"modify_btn\" name=\"building_".$this->building_id."\" value=\"Update\">";
      print "</div>";
      print "</div>";

    }

    public function modifyBuilding(){

      print "<div class=\"building-update\" id=\"edit_".$this->building_id."\">";
      print "<div class=\"building_col\">";
      print "<h2>Building Name:</h2>";
      print "<input type=\"text\" name=\"build_name\" maxlength=\"64\" value=\"".$this->name."\" required><br>";


      print '<label><b>Hours:</b></label><br>';
      print "<input type=\"text\" name=\"open\" maxlength=\"4\" size=\"4\" value=\"".$this->open."\">-<input type=\"text\" name=\"close\" maxlength=\"4\" size=\"4\" value=\"".$this->close."\"><br>";
      print "<label><b>Job Length: </b></label>";
      print "<input type=\"text\" name=\"length\" maxlength=\"3\" size=\"3\" value=\"".$this->job_length."\"> hours<br>";
      print "<label><b>Techs Needed: </b></label>";
      print "<input type=\"text\" name=\"techs\" maxlength=\"3\" size=\"3\" value=\"".$this->techs."\"><br>";
      if($this->aon){
        print "<label name=\"switch_label\"><b>Switch:</b></label><br>";
        print "<input type=\"text\" name=\"switch\" maxlength=\"32\" value=\"".$this->switch."\"><br>";
      } else{
        print "<label name=\"switch_label\" hidden><b>Switch:</b></label><br>";
        print "<input type=\"text\" name=\"switch\" maxlength=\"32\" hidden><br>";
      }
      if($this->panel){
        print "<label name=\"panel_label\"><b>Panel Location:</b></label><br>";
        print "<input type=\"text\" name=\"panel_loc\" maxlength=\"32\" value=\"".$this->panel_loc."\"><br>";
      } else{
        print "<label name=\"panel_label\" hidden><b>Panel Location:</b></label><br>";
        print "<input type=\"text\" name=\"panel_loc\" maxlength=\"32\" hidden><br>";
      }
      print "<label><b>Notes:</b></label><br>";
      print "<input type=\"text\" name=\"notes\" maxlength=\"256\" value=\"".$this->notes."\"><br>";

      print "<div class=\"badge_div\">";
      if($this->unit_type == "MDU"){
        print "<p class=\"type\" data-type=\"MDU\">MDU</p>";
      }
      elseif($this->unit_type == "MDU-SA"){
        print "<p class=\"type\" data-type=\"MDU-SA\">MDU-SA</p>";
      }
      elseif($this->unit_type == "SFU"){
        print "<p class=\"type\" data-type=\"SFU\">SFU</p>";
      }
      if($this->bulk){
        print "<p class=\"bulk\" data-bulk=\"1\">Bulk Deal</p>";
      }
      else{

        print "<p class=\"bulk\" data-bulk=\"0\">Bulk Deal</p>";
      }
      if($this->aon){
        print "<p class=\"aon\" data-aon=\"1\">ActivE</p>";
      }
      else{
        print "<p class=\"aon\" data-aon=\"0\">ActivE</p>";
      }

      if($this->panel){
        print "<p class=\"panel\" data-panel=\"1\">Media Panel</p>";
      }
      else{
        print "<p class=\"panel\" data-panel=\"0\">Media Panel</p>";
      }
      print "</div>";
      print "</div>";
      print "<div class=\"building_col\">";

      print '<div class="address_div">';
      $this->stnames = $this->getStNames($this->addresses);
        if ($this->building_id != 'new') {
        foreach ($this->stnames as $sts){
          print "<details class=\"streets_div\">";
          print "<summary>".$sts."</summary>";
          foreach ($this->addresses as $addr){
            $arr = explode(' ', $addr);
            $arr = array_slice($arr, 1, 3);
            $stname = implode(' ', $arr);
            if (strcmp($stname, $sts) == 0){
              print "<input type=\"text\" class=\"address\" value=\"".$addr."\"><br>";
            }
          }
          print "</details>";
        }
      }
      else {
        print "<input type=\"text\" class=\"address\" value=\"\"><br>";
      }
      print "<input type=\"button\" onclick=\"add_addr()\" value=\"Add Address\">";
      print "</div>";
      print "<div class=\"mod_buttons\">";
      if ($this->building_id == "new"){
        print '<input type="button" id="insert" value="Add">';
      }
      else {
        print "<input type=\"button\" class=\"delete_btn\" name=\"delete_".$this->building_id.")\" value=\"Delete\">";
        print "<input type=\"button\" class=\"update_btn\" name=\"edit_".$this->building_id.")\" value=\"Save\"><br>";
      }
      print "</div>";
      print "</div>";
      print "</div>";
    }


}

$host = "localhost";
$user = "anderson";
$password = "Th3reisnospoon";
$conn = new PDO('mysql:host=localhost;dbname=neo',$user,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_POST["action"]) && $_POST["action"] == "create"){
  $build = $_POST["building_data"];
  $addresses = $_POST["addr_data"];
  $conn->beginTransaction();
  $bldquery = 'INSERT INTO buildings (name, open, close, job_length, techs, aon, switch, bulk, panel, panel_loc, unit_type, notes) VALUES (:name,:open,:close,:job_length,:techs,:aon,:switch,:bulk,:panel,:panel_loc,:unit_type,:notes)';
  $conn->prepare($bldquery)->execute($build[0]);
  $build_id = $conn->query("SELECT LAST_INSERT_ID()")->fetch(PDO::FETCH_COLUMN);
  $addquery = 'INSERT INTO addresses (building_id, addr) VALUES ';
  foreach ($addresses as $key=>$addr){
    if(!empty($addr)){
      $addr = strtolower($addr);
      $arr = explode(' ', $addr);
      foreach ($arr as $k=>$val){
        $arr[$k] = ucfirst($val);
      }
      $addr = implode(' ', $arr);
      $addquery = $addquery. '(' .$build_id. ',"' .$addr.'"),';
    }
  }
  $addquery = rtrim($addquery, ',');
  $conn->query($addquery);
  $conn->commit();
}

if(isset($_POST["action"]) && $_POST["action"] == "modify"){
  $building_data = $_POST["building_data"];
  $addrs = $_POST["addr_data"];
  $build = new Building($building_data[0]);
  try{
     $build->buildAddress($addrs);
  } finally{
    $build->modifyBuilding();
  }
  }

if(isset($_POST["action"]) && $_POST["action"] == "update"){
  $build = $_POST["building_data"];
  $addresses = $_POST["addr_data"];
  $conn->beginTransaction();
  $bldquery = 'UPDATE buildings SET name=:name,open=:open,close=:close,job_length=:job_length,techs=:techs,aon=:aon,switch=:switch,bulk=:bulk,panel=:panel,panel_loc=:panel_loc,unit_type=:unit_type,notes=:notes WHERE building_id = :building_id';
  $conn->prepare($bldquery)->execute($build[0]);
  $build_id = $build[0]['building_id'];
  $conn->query('DELETE FROM addresses WHERE building_id = '.$build_id);
  $addquery = 'INSERT INTO addresses (building_id, addr) VALUES ';
  foreach ($addresses as $key=>$addr){
    $addr = strtolower($addr);
    $arr = explode(' ', $addr);
    foreach ($arr as $k=>$val){
      $arr[$k] = ucfirst($val);
    }
    $addr = implode(' ', $arr);
    if(!empty($addr)){
      $addquery = $addquery. '(' .$build_id. ',"' .$addr.'"),';
    }
  }
  $addquery = rtrim($addquery, ',');
  $conn->query($addquery);
  $conn->commit();
}

if(isset($_POST["action"]) && $_POST["action"] == "delete"){
  $build_id = $_POST["building_id"];
  $conn->beginTransaction();
  $conn->query('DELETE FROM addresses WHERE building_id = '.$build_id);
  $conn->query('DELETE FROM buildings WHERE building_id = '.$build_id);
  $conn->commit();
}

if(isset($_GET["search"])){
  $term = "%".filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING) ."%";
  $query = 'SELECT * FROM buildings RIGHT JOIN addresses ON buildings.building_id = addresses.building_id WHERE buildings.name LIKE \''.$term.'\' OR addresses.addr LIKE \''.$term.'\' GROUP BY buildings.building_id';
  //$query = 'SELECT * FROM buildings';
  $dat = $conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
  if(empty($dat)){
    $query = 'SELECT * FROM buildings WHERE name LIKE \''.$term.'\'';
    $dat = $conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
  }
    foreach ($dat as $row){
      $build = new Building($row);
      $addrs = $conn->query('SELECT addr FROM addresses WHERE building_id = ' . $row['building_id'])->fetchAll(PDO::FETCH_COLUMN);
      $build->buildAddress($addrs);
      $build->printBuilding();
  }
}
?>
