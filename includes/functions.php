<?php

if(!function_exists("get_url"))
{
  function get_url()
  {
    return (!empty($_SERVER["HTTPS"]) ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"];
  }

}

// Check if logged in
if(!function_exists("isLoggedin"))
{
  function isLoggedin()
  {
  	if(isset($_SESSION['userData']))
    {
  		return true;
    }
  	else
    {
  		return false;
    }

  }

}


if(!function_exists("Guid"))
{
  function Guid()
  {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
      // 32 bits for "time_low"
      mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

      // 16 bits for "time_mid"
      mt_rand( 0, 0xffff ),

      // 16 bits for "time_hi_and_version",
      // four most significant bits holds version number 4
      mt_rand( 0, 0x0fff ) | 0x4000,

      // 16 bits, 8 bits for "clk_seq_hi_res",
      // 8 bits for "clk_seq_low",
      // two most significant bits holds zero and one for variant DCE1.1
      mt_rand( 0, 0x3fff ) | 0x8000,

      // 48 bits for "node"
      mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );

  }

}

if(!function_exists("time_elapsed_string"))
{
  function time_elapsed_string($datetime, $full = false)
  {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
      'y' => 'year',
      'm' => 'month',
      'w' => 'week',
      'd' => 'day',
      'h' => 'hour',
      'i' => 'minute',
      's' => 'second',
    );
    foreach ($string as $k => &$v)
    {
      if($diff->$k)
      {
        $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
      }
      else
      {
        unset($string[$k]);
      }

    }

    if(!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';

  }

}

if(!function_exists("get_real_ip"))
{
  /**
   * Gets the real IP of the user
   * @return string IP address
   */
  function get_real_ip()
  {
    $ip = file_get_contents('http://phihag.de/ip/');

    return $ip;

  }

}

if(!function_exists("wurmSecondsToTime"))
{
  function wurmSecondsToTime($seconds)
  {
    $times = "";

    if($seconds < 60000)
    {
      $secs = $seconds / 1000;
      $times = $times . $secs . " seconds";
    }
    else
    {
      $daysLeft = round($seconds / 86400000);
      $hoursLeft = round(($seconds - $daysLeft * 86400000) / 3600000);
      $minutesLeft = round(($seconds - $daysLeft * 86400000 - $hoursLeft * 3600000) / 60000);

      if($daysLeft == 1)
      {
        $times = $times . $daysLeft . " day";
      }
      else if($daysLeft > 0)
      {
        $times = $times . $daysLeft . " days";
      }

      if($hoursLeft > 0)
      {
        $aft = "";
        if($daysLeft > 0 && $minutesLeft > 0)
        {
          $times = $times . ", ";
          $aft = $aft . " and ";
        }
        else if($daysLeft > 0)
        {
          $times = $times . " and ";
        }
        else if($minutesLeft > 0)
        {
          $aft = $aft . " and ";
        }

        $times = $times . $hoursLeft . " hrs" . $aft;

      }

      if($minutesLeft > 0)
      {
        $aft = "";
        if($daysLeft > 0 && $hoursLeft == 0)
        {
          $aft = " and ";
        }

        $times = $times . $aft . $minutesLeft . " mins";

      }

    }

    if(count($times) == 0)
    {
      $times = "nothing";
    }

    return $times;

  }

}

if(!function_exists("wurmConvertMoney"))
{
  function wurmConvertMoney($ironValue)
  {
    $goldCoins = (int) round($ironValue / 1000000, 1);
    $reset = $ironValue % 1000000;
    $silverCoins = (int) round($reset / 10000, 1);
    $reset = $ironValue % 10000;
    $copperCoins = (int) round($reset / 100, 1);
    $reset = $ironValue % 100;
    $ironCoins = $reset;

    $toSend = "";

    if($goldCoins > 0)
    {
      $toSend = $toSend . $goldCoins . " gold";
    }

    if($silverCoins > 0)
    {
      if($goldCoins > 0)
      {
        if($copperCoins > 0 || $ironCoins > 0)
        {
          $toSend = $toSend . ", ";
        }
        else
        {
          $toSend = $toSend . " and ";
        }

      }

      $toSend = $toSend . $silverCoins . " silver";

    }

    if($copperCoins > 0)
    {
      if($silverCoins > 0 || $goldCoins > 0)
      {
        if($ironCoins > 0)
        {
          $toSend = $toSend . ", ";
        }
        else
        {
          $toSend = $toSend . " and ";
        }

      }

      $toSend = $toSend . $copperCoins . " copper";

    }

    if($ironCoins > 0)
    {
      if($silverCoins > 0 || $goldCoins > 0 || $copperCoins > 0)
      {
        $toSend = $toSend . " and ";
      }

      $toSend = $toSend . $ironCoins . " iron";

    }

    if(empty($toSend))
    {
      return "0 irons";
    }

    return $toSend;

  }

}

?>