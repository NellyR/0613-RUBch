<?php
  require_once('../../inc/includes.inc.php');
  
  function getJson($url, $args, $arr = false) {
    $request_url = $url.$args;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $request_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    $html = curl_exec($ch);
    curl_close($ch);

    return json_decode($html, $arr);
  }

  //SEO_CANDY_SHARE
  $json = getJson(K_URL_EXT_SEO_CANDY_SHARE, "?url=".K_URL_DIR);
  
  // SECURE
  if (empty($json)) {
    $return = array();

    //facebook
    $jsonFb = getJson(K_URL_EXT_FB_COUNT_SHARE, "?ids=".K_URL_DIR, true);
    if ((empty($jsonFb['error'])) || (!empty($jsonFb)) ) $return['facebook'] = $jsonFb[0]['shares'];
    else $return['facebook'] = 0;

    //twitter
    $jsonTw = getJson(K_URL_EXT_TW_COUNT_SHARE, "?url=".K_URL_DIR);
    if ((empty($jsonTw['error'])) || (!empty($jsonTw)) ) $return['twitter'] = $jsonTw->count;
    else $return['twitter'] = 0;

    echo json_encode($return);
  } else echo json_encode($json);
?>