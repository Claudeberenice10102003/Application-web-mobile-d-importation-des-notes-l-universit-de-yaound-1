<?php

    //connexion
    function login($username, $password, $resultat){
        if (count($resultat) > 0) {
            $_SESSION['id']=$resultat[0][0];
            $_SESSION['name']=$username;
            header('Location:dash.php');
        }
        else{
            echo "<br><br><p style='color:red;'>Veuillez verifier vos entres.</p>";
        }
    }

    //afficher ue
    function printUe($resultat){
        for ($i=0; $i < count($resultat); $i++) { 
            echo "<li class='nav-item'>
                    <form action='' method='post'>
                        <input type='hidden' name='id' value='".$resultat[$i][0]."'>
                        <button type='submit' name='btn' class='nav-link' id='btn'>
                            <i class='fas fa-file-text'></i>
                            ".$resultat[$i][0]."
                        </button>
                    </form> 
                </li>";
        }
        $_SESSION['ue'] = $resultat[0][0];
    }
?>