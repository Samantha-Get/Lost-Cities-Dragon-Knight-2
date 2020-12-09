<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
2.    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
3.    <html xmlns="http://www.w3.org/1999/xhtml">
4.	
5.    <head>
6.    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
7.    <title>Dice Handler</title>
8.    </head>
9. 
10.    <body>
11. 
12. 
13.<?php // Functions ------------------------------------------
14.    function rollDice($dice)
15.    {
16.        $faceArray = array();
17.        for($i = 0; $i < $dice; $i++) {
18.            $face = rand(1, 10);
19.            $faceArray[$i] = $face;
20.        }
21.        return $faceArray;
22.    }
23.    ;
24.    function is_valid_email($email) 
25.    {
26.        return preg_match('#^[a-z0-9.!\#$%&\'*+-/=?^_`{|}~]+@([0-9.]+|([^\s]+\.+[a-z]{2,6}))$#si', $email);
27.    }
28.    function contains_bad_str($str_to_test) 
29.    {
30.        $bad_strings = array(
31.            "content-type:",
32.            "mime-version:", 
33.            "multipart/mixed",
34.            "Content-Transfer-Encoding:",
35.            "bcc:",
36.            "cc:",
37.            "to:" 
38.        );
39.        foreach($bad_strings as $bad_string) {
40.            if(eregi($bad_string, strtolower($str_to_test))) { 
41.                echo "$bad_string found. Suspected injection attempt - mail not being sent.";
42.                exit;
43.            }
44.        }
45.    }
46.    function contains_newlines($str_to_test)
47.    {
48.        if(preg_match("/(%0A|%0D|\\n+|\\r+)/i", $str_to_test) != 0) { 
49.            echo "newline found in $str_to_test. Suspected injection attempt - mail not being sent."; 
50.            exit;
51.        }
52.    }
53. 
54.// Code ------------------------------------------- 
55.    $name = $_POST['requiredname'];
56. 
57.    $dice = $_POST['requireddice'];
58. 
59.    $description = $_POST['requireddescription'];
60.    $email = $_POST['requiredemail'];
61.    if(!is_valid_email($email)) {
62.        echo 'Invalid email submitted - mail not being sent.';
63.        exit;
64.    }
65. 
66.    contains_bad_str($email);
67.    contains_bad_str($description);
68.    contains_newlines($email);
69.    contains_newlines($description);
70. 
71.    $faces = rollDice($dice);
72.    for($i = 0; $i < (count($faces) - 1); $i++) {
73.        $results = $results . $faces[$i] . ", ";
74.    }
75.    $results = $results . $faces[$i] . ", ";
76. 
77.    echo ($results);
78. 
79.    function redirect($url)
80.    {
81.        header('Location: http://www.legoandthings.com/diceform.php ' . $url, true);
82.        die();
83.    }
84. 
85. 
86.// email results //
87. 
88. 
89.    $to = 'dicerolls@nybn.org' . ',';
90.    $to .= $email;
91.    $subject = "Dice roll for $name";
92.    $message = "$name rolled a $results for $description";
93.    $headers = "From: " . $from . "\r\n" . "Reply-To: " . $from . "\r\n" . "X-Mailer: PHP/" . phpversion();
94.    $headers .= 'From: NYbN Dice Roller <dicerolls@nybn.org>' . "\r\n";
95. 
96.    mail($to, $subject, $message, $headers);
97.?>
98.    </body>
99.    </html>
