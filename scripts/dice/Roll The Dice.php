<?php

//######################
// Roll The Dice Game
// Made by: Bin4ry
// Command: !rtd
//######################

//Database Configuration
$config = array(
	'host' => 'localhost', //Database Host
	'user' => 'root',      //Database Username
	'pass' => '',          //Database Password
	'db'   => 'spirit',    //Database Name
);

try {
	$con = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['db'], $config['user'], $config['pass']);
}
catch(PDOException $e)
{
	echo $e->getMessage();
	die();
}

if(isset($_GET['input']) && isset($_GET['user']))
{
	//Variables
	$win1 = 1; // 1x points bet
	$win2 = 1; // 1x points bet
	$win3 = 1; // 1x points bet
	$win4 = 2; // 2x points bet
	$win5 = 2; // 2x points bet
	$win6 = 3; // 3x points bet

	$input = $_GET['input'];
	$user  = $_GET['user'];

	$dice  = mt_rand(1, 12);

	if($dice > 6)
	{
		$status = 1;
	}
	else
	{
		$status = 0;
	}

	$time = time();

	//6+ = WIN
	if(is_numeric($input))
	{
		switch($dice)
		{
			case '1':
				echo $user . ' Rolled ' . $dice . ' and lost ' . $input . '!';
			break;

			case '2':
				echo $user . ' Rolled ' . $dice . ' and lost ' . $input . '!';
			break;

			case '3':
				echo $user . ' Rolled ' . $dice . ' and lost ' . $input . '!';
			break;

			case '4':
				echo $user . ' Rolled ' . $dice . ' and lost ' . $input . '!';
			break;

			case '5':
				echo $user . ' Rolled ' . $dice . ' and lost ' . $input . '!';
			break;

			case '6':
				echo $user . ' Rolled ' . $dice . ' and lost ' . $input . '!';
			break;

			case '7':
				$points = $input * $win1;
				echo $user . ' Rolled ' . $dice . ' and won ' . $points . '!';
			break;

			case '8':
				$points = $input * $win2;
				echo $user . ' Rolled ' . $dice . ' and won ' . $points . '!';
			break;

			case '9':
				$points = $input * $win3;
				echo $user . ' Rolled ' . $dice . ' and won ' . $points . '!';
			break;

			case '10':
				$points = $input * $win4;
				echo $user . ' Rolled ' . $dice . ' and won ' . $points . '!';
			break;

			case '11':
				$points = $input * $win5;
				echo $user . ' Rolled ' . $dice . ' and won ' . $points . '!';
			break;

			case '12':
				$points = $input * $win6;
				echo $user . ' Rolled ' . $dice . ' and won ' . $points . '!';
			break;

			default:
				echo 'Error: Something went wrong!';
		}

		if($dice > 6)
		{
			$input = $points;
		}
		else
		{
			$input = $input;
		}

		$data = $con->prepare("INSERT INTO `dice` (user, bet, roll, status, reward, time) VALUES(:user, :bet, :roll, :status, :reward, :time)");
		$data->execute(array(
			':user'   => $user,
			':bet'    => $input,
			':roll'   => $dice,
			':status' => $status,
			':reward' => $input,
			':time'   => $time
		));
	}
	else
	{
		echo $user . ' Thats not a valid number!';
	}
}

?>