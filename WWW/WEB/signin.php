<?php
//signin.php
include 'connect.php';
include 'header.php';
 
echo '<h3>Sign in</h3>';
 
//first, check if the user is already signed in. If that is the case, there is no need to display this page
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
{
    echo 'You are already signed in, you can <a href="signout.php">sign out</a> if you want.';
}
else
{
    if($_SERVER['REQUEST_METHOD'] != 'POST')
    {
        /*the form hasn't been posted yet, display it
          note that the action="" will cause the form to post to the same page it is on */
        echo '<form method="post" action=""> 
            Username: <input type="text" name="user_name" /> <br>
            Password: <input type="password" name="user_pass"> <br>
            <input type="submit" value="Sign in" />
         </form>';
    }
    else
    {
        /* so, the form has been posted, we'll process the data in three steps:
            1.  Check the data
            2.  Let the user refill the wrong fields (if necessary)
            3.  Varify if the data is correct and return the correct response
        */
        $errors = array(); /* declare the array for later use */
         
        if(!isset($_POST['user_name']))
        {
            $errors[] = 'The username field must not be empty.';
        }
         
        if(!isset($_POST['user_pass']))
        {
            $errors[] = 'The password field must not be empty.';
        }
         
        if(!empty($errors)) /*check for an empty array, if there are errors, they're in this array (note the ! operator)*/
        {
            echo 'Uh-oh.. a couple of fields are not filled in correctly..';
            echo '<ul>';
            foreach($errors as $key => $value) /* walk through the array so all the errors get displayed */
            {
                echo '<li>' . $value . '</li>'; /* this generates a nice error list */
            }
            echo '</ul>';
        }
        else
        {
            $username = $pdo->quote($_POST['user_name']);
            $password = $pdo->quote($_POST['user_pass']);
            
            $sql = "SELECT user_id,user_name,user_pass,user_level FROM users WHERE user_name = $username";
            $result = $pdo->query($sql);
            
            if(!$result)
            {
                //something went wrong, display the error
                $error=$pdo->errorInfo()[2];
                echo "Something went wrong while registering. Please try again later. Error: $error";
            }
            else
            {
                $row = $result->fetch();
                $hashed_password = $row['user_pass'];
                if(!password_verify($password, $hashed_password))
                {
                    echo 'You have supplied a wrong user/password combination. Please try again.';
                }
                else
                {
                    $_SESSION['signed_in'] = true;
                        
                    $_SESSION['user_id']    = $row['user_id'];
                    $_SESSION['user_name']  = $row['user_name'];
                    $_SESSION['user_level'] = $row['user_level'];
                    
                    header("Location: index.php");
                    exit;
                }
            }
        }
    }
}
 
include 'footer.php';
?>