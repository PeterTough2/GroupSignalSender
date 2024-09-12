<?php
// the message
$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
$ddx = mail("fittain804@gmail.com","Native KPK",$msg);

if ($ddx) {
    echo "Mail Sent!";
}else {
    echo "Not Sent!!!";
}

?> 