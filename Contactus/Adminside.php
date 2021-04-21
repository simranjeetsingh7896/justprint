<?php
use  Contactus\Model\{Contact, Database};
require_once 'vendor/autoload.php';

require_once './Model/Database.php';
require_once './Model/Contact.php';

$dbcon = Database::getDb();
$s = new Contact();
$contacts = $s->getAllContact(Database::getDb());

?>

<html lang="en">
<head>
    <title>Contact Us</title>
    <meta name="description" content="Contact Database">
    <meta name="keywords" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
<p class="h1 text-center">Contact Us Database</p>
<div class="m-1">
    <!--    Displaying Data in Table-->
    <table class="table table-bordered tbl">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Email</th>
            <th scope="col">Subject</th>
            <th scope="col">Message</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($contacts as $contact) { ?>
            <tr>
                <th><?=  $contact['userid']; ?></th>
                <td><?=  $contact['firstname']; ?></td>
                <td><?=  $contact['lastname']; ?></td>
                <td><?=  $contact['email']; ?></td>
                <td><?=  $contact['subject']; ?></td>
                <td><?=  $contact['message']; ?></td>
                
                <td>

            </tr>
            <?php } ?>

        </tbody>
    </table>
</div>
</body>
</html>