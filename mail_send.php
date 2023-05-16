<?php 
include './connect.php';



if(isset($_POST['action'])){
    $action = $_POST['action'];
    if($action == 'a_p') all_parent($_POST['rest']);
    if($action == 'p') paid($_POST['rest']);
    if($action == 's_p') selected_parent($_POST['rest']);
    if($action == 'msg_a_p') msg_all_parent($_POST['rest'], $conn);
    if($action == 'msg_p') msg_paid($_POST['rest']);
    if($action == 'msg_s_p') msg_selected_parent($_POST['rest']);
}

function all_parent($info){
    print_r($info);
}
function paid($info){
    print_r($info);
}
function selected_parent($info){
    $emails = $info['p'];
print_r(json_encode($info['p']));
}


function msg_all_parent($info, $conn){
    $message = $info['msg'];
    $sql = "SELECT email FROM students";
    $result = mysqli_query($conn, $sql);
    $result = mysqli_fetch_all($result);
    if(send_mail_fnc($message, $result)) echo 'done';
    else echo 'failed';
}

function msg_paid($info){
    $message = $info['msg'];
    print_r($info);
    $sql = "SELECT email FROM students WHERE paid = 'paid'";

}
function msg_selected_parent($info){
    $emails = $info['p'];
    $message = $info['msg'];
    $sql = "SELECT email FROM students WHERE email IN ?";
print_r(json_encode($info['p']));


}
function send_mail_fnc($msg, $arr) {
           
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
                

    try {
        //Server settings
        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'example@gmail.com';                 // SMTP username
        $mail->Password = "12345";                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom($sender_email, $sender_name);
        $mail->addAddress($sender_email, $sender_name);     // Add a recipient
        $mail->addAddress($user_email, $user_name);     // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->AltBody = $message;

        $mail->send();
        return true;
    } catch (Exception $e) {
       return false;
    }
}