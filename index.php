<?php
require('connection.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h2>S WAGH</h2>
        <nav>
            <a href="#">HOME</a>
            <a href="#">BLOG</a>
            <a href="#">CONTACT</a>
            <a href="#">ABOUT</a>
            
        </nav>
        <?php
                if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true){
                    echo"
                    <div class='user'>
                        $_SESSION[username]-<a href='logout.php'>LOG-OUT</a>
                    </div>
                   ";
                }
                else{
                    echo"
                    <div class='Sign-up'>
                        <button type='button' onclick=\"popup('login-popup')\">Login</button>
                        <button type='button' onclick=\"popup('register-popup')\">Register</button>
                    </div>
                    ";
                   
                }
            ?>
             <!-- <div class='Sign-up'>
                        <button type="button" onclick="popup('login-popup')">Login</button>
                        <button type="button" onclick="popup('register-popup')">Register</button>
             </div> -->
       
    </header>
    <div class="popup_container" id="login-popup">
        <div class="popup">
            <form method="POST" action="login_register.php">
                <h2>
                    <span>USER LOGIN</span>
                    <button type="reset" onclick="popup('login-popup')">X</button>
                </h2>
                <input type="text" placeholder="Email or Username" name="email_username" autocomplete="off">
                <input type="text" placeholder="Password" name="password" autocomplete="off">
                <button type="submit" class="login-btn" name="login">LOGIN</button>
            </form>
        </div>
    </div>
    <div class="popup_container" id="register-popup">
        <div class="popup">
            <form method="POST" action="login_register.php">
                <h2>
                    <span>USER REGISTER</span>
                    <button type="reset" onclick="popup('register-popup')">X</button>
                </h2>
                <input type="text" placeholder="Full Name" name="fullname" autocomplete="off">
                <input type="text" placeholder="Username" name="username" autocomplete="off">
                <input type="text" placeholder="Email" name="email" autocomplete="off">
                <input type="text" placeholder="Password" name="password" autocomplete="off">
                <input type="text" placeholder="Referral Code" name="referralcode" autocomplete="off" id="refercode">
                
                <button type="submit" class="register-btn" name="register">REGISTER</button>
            </form>
        </div>
    </div>

    <?php
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true){
            echo"<h1 style='text-align:center; margin-top:200px;'>WELCOME TO WEBSITE -$_SESSION[username]</h1>";
            
            $query="SELECT *FROM `registered_users` WHERE `username`='$_SESSION[username]'";
            $result=mysqli_query($con,$query);
            $result_fetch=mysqli_fetch_assoc($result);
    
            echo"<h3 class='box'> Your Referral Code - <p id=\"text\"> $result_fetch[referral_code]</p>
            
            <button id=\"refbtn\"> Copy</button>
            
            </h3>";
            echo"<h3 class='box'> Your Referral Points -$result_fetch[referral_point]</h3>";
            echo"<h3 class='box'> 
            Your Referral link -<a href='http://localhost/Referral_System/?refer=$result_fetch[referral_code]'>
            http://localhost/Referral_System/?refer=$result_fetch[referral_code]
            </a>
            </h3>";

            echo"
            <h3 class='box'>Your Referral link
            
            <input type=\"text\" id=\"myinp\" value=\" http://localhost/Referral_System/?refer=$result_fetch[referral_code]\">
            <button id=\"btn\"> Copy</button>
            
            </h3>";
           
        }
        // <input type=\"text\" id=\"refcode\" value=\" $result_fetch[referral_code]\">
       
    
    ?>
    <script>
        function copyText(htmlElement){
            if(!htmlElement){
                return ;
            }
            let elementText =htmlElement.innerText;

            let inputElement =document.createElement('input');
            inputElement.setAttribute('value',elementText);
            document.body.appendChild(inputElement);
            inputElement.select();
            document.execCommand('copy');
            inputElement.parentNode.removeChild(inputElement);
        }
        document.querySelector('#refbtn').onclick =
        function()
        {
            copyText(document.querySelector('#text'));
        }
    </script>

    <script>
        function popup(popup_name){
            get_popup=document.getElementById(popup_name);
            if(get_popup.style.display=="flex"){
                get_popup.style.display="none";
            }
            else{
                get_popup.style.display="flex";
            }
        }
    </script>

<script>
        const myinp=document.getElementById("myinp");
        const btn=document.getElementById("btn");

        btn.onclick=function(){
            myinp.select();

            document.execCommand("Copy");
        };
</script>
<!-- <script>
        const refcode=document.getElementById("refcode");
        const refbtn=document.getElementById("refbtn");

        refbtn.onclick=function(){
            refcode.select();

            document.execCommand("Copy");
        };
</script> -->

    <?php
        if(isset($_GET['refer']) && $_GET['refer']!=' ' ){
            if(!(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true)){
                $query=$query="SELECT *FROM `registered_users` WHERE `referral_code`='$_GET[refer]'";
                $result=mysqli_query($con,$query);
                if($result){
                    if(mysqli_num_rows($result)==1){
                        echo"
                        <script>
    
                            document.getElementById('refercode').value='$_GET[refer]';
                            popup('register-popup');
    
                        </script>
                        ";
                    }
                    else{
                        echo"
                        <script>
                            alert('Invalid Referral code');
                            
                        </script>
                    ";
                    }
                }
                else{
                    echo"
                        <script>
                            alert('GET error');
                            
                        </script>
                        ";
                    }
                }
               
            }
        
    ?>
</body>
</html>