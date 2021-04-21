<?php
namespace Contactus\Model;

class Contact {

   public function getAllContact($dbcon){

        $sql = "SELECT * FROM contactus";

        $pst = $dbcon->prepare($sql);
        $pst->execute();

        $contacts = $pst->fetchAll(\PDO::FETCH_ASSOC);
        return $contacts;
    }

    public function addContact($firstname, $lastname, $email, $feedback, $message, $db)
    {
        $sql = "INSERT INTO contactus (firstname, lastname, email,subject,message) 
                VALUES (:firstname, :lastname, :email, :subject, :message) ";
        $pst = $db->prepare($sql);

        $pst->bindParam(':firstname', $firstname);   
        $pst->bindParam(':lastname', $lastname);  
        $pst->bindParam(':email', $email);
        $pst->bindParam(':subject', $feedback);   
        $pst->bindParam(':message', $message);  

        $count = $pst->execute();
        return $count;
    }

}
