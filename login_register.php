<?php

require('connection.php');
session_start();

function updateReferral(){
    $query="SELECT * FROM `registered_users` WHERE `referral_code`='$_POST[referralcode]'";
    $result=mysqli_query($GLOBALS['con'],$query);
    $result_fetch=mysqli_fetch_assoc($result);

    if($result){
        if(mysqli_num_rows($result)==1){
            $point=$result_fetch['referral_point']+10;
            $update_query="UPDATE `registered_users` SET `referral_point`='$point' WHERE `email`='$result_fetch[email]'";
            
            if(!mysqli_query($GLOBALS['con'],$update_query)){
                echo" 
                    <script>
                        alert('Update query cannot run');
                        window.location.href='index.php';
                    </script>
            "   ; 
            exit;
            }
        }
        else{
            echo" 
                <script>
                    alert('Invalid referral code');
                    window.location.href='index.php';
                </script>
            ";
            exit;
        }

    }
    else{
        echo" 
            <script>
                alert('Query can not run');
                window.location.href='index.php';
            </script>
        ";
        exit;
    }
}

if(isset($_POST['login'])){
    $query="SELECT * from `registered_users` WHERE `username`='$_POST[email_username]' or `email`='$_POST[email_username]'";
    $result=mysqli_query($con,$query);

    if($result){
        if(mysqli_num_rows($result)==1){
            $result_fetch=mysqli_fetch_assoc($result);
            if(password_verify($_POST['password'],$result_fetch['password'])){
                $_SESSION['logged_in']=true;
                $_SESSION['username']=$result_fetch['username'];
                header("location:index.php");
            }
            else {
                echo" 
                <script>
                        alert('Wrong password');
                        window.location.href='index.php';
                </script>";
            }
        }
        else{
            echo" 
                <script>
                    alert('Invalid login credentials ');
                    window.location.href='index.php';
                </script>
            ";
        }
    }
    else{
        echo"
            <script>
                alert('can not run query');
                window.location.href='index.php';
            </script>
        ";
}
}

if(isset($_POST['register'])){
    $user_exist="SELECT * from `registered_users` WHERE `username`='$_POST[username]' or `email`='$_POST[username]'";
    $result=mysqli_query($con,$user_exist);


    if($result){
        //user already exists
        if(mysqli_num_rows($result)>0){
            $result_fetch=mysqli_fetch_assoc($result);
            //if username issame otherwise email is same
            if($result_fetch['username']==$_POST['username']){
                echo"
                    <script>
                        alert('$result_fetch[username]-username is exists');
                        window.location.href='index.php';
                    </script>
                ";     
            }
            else{
                echo"
                    <script>
                        alert('$result_fetch[email]-Email is exists');
                        window.location.href='index.php';
                    </script>
            ";     
            }
        }//registration
        else{

            if($_POST['referralcode']!=''){
                updateReferral();
            }

            $referral_code=strtoupper(bin2hex(random_bytes(4)));
            

            $password=password_hash($_POST['password'],PASSWORD_BCRYPT);
            $query="INSERT INTO `registered_users`(`fullname`, `username`, `email`, `password`,`referral_code`,`referral_point`) VALUES ('$_POST[fullname]','$_POST[username]','$_POST[email]','$password','$referral_code','0')";
            if(mysqli_query($con,$query)){
                echo"
                    <script>
                        alert('Register successfully');
                        window.location.href='index.php';
                    </script>
                ";
            }
            else{
                echo"
                    <script>
                        alert('Insert query can not run');
                        window.location.href='index.php';
                    </script>
                ";
            }
        }

    }
    else{
        echo"
        <script>
            alert('Cannot run query');
            window.location.href='index.php';
        </script>
        ";
    }

}

?>