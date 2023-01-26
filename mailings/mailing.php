<?php    
  require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/twig.php');
  require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/templateUtils.php');
  require_once('prospects.php');
  $id = $_GET['id'];
  $type = $_GET['type'];
  $agent = getAgent();
  $location = $_GET['location'];
  $check = $_GET['check'];
  $year = date("Y");

  $agent_browser = $_SERVER["HTTP_USER_AGENT"];

  if (preg_match('/MSIE (\d+\.\d+);/', $agent_browser)) {
    echo "<link rel='stylesheet' href='https://onlyinsuranceleads.com/css/ie.css' media='all' />";
  } elseif (preg_match('/Windows NT (\d+\.\d+);/', $agent_browser)) {
    echo "<link rel='stylesheet' href='/css/ie.css' media='all' />";
  } elseif (preg_match('/Edge\/\d+/', $agent_browser)) {
    echo "<link rel='stylesheet' href='/css/edge.css' media='print, screen' />";
  }

  if ($type != "letter") {
    $type = "postcard";
  }
  if (!empty($check) && $type != "letter") {
    $check = $check;
  }
  
  echo $twig->render($type.$id.'.twig', array('prospect'=>$prospects[$id], 'letterId'=>$type.''.$id, 'agent'=>$agent, 'address'=> $location, 'popup' => $check, 'year'=>$year));
?>
