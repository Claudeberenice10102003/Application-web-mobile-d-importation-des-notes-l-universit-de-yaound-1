<?php $title = "Sign UP";?>

<?php ob_start();?>
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="container row">
            <form action="index.php?action=signup" class="col-lg-6 col-md-12" method="post">
                <h2>Sign UP</h2>
                <?php 
                    if(isset($_GET["message"])){
                        $message = $_GET["message"];
                        echo"<span class='badge bg-danger'>".$message."</span>";
                    }
                ?>
                <p>If you have an account, <a href="templates/login.php">login here!</a></p>
                <div class="form-group">
                    <label for="first_name">Prénom</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Nom</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                </div>
                <div class="form-group">
                    <label for="date_of_birth">Date de naissance</label>
                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                </div>
                <div class="form-group">
                    <label for="matricule">Matricule</label>
                    <input type="text" class="form-control" id="matricule" name="matricule" required>
                </div>
                <div class="form-group">
                    <label for="gender">Genre</label>
                    <select class="form-control" id="gender" name="gender" required>
                    <option value="">Sélectionner un genre</option>
                    <option value="M">Masculin</option>
                    <option value="F">Féminin</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_sector">Filière :</label>
                    <select class="form-control" id="id_sector" name="id_sector" required>
                        <?php
                            foreach ($sectors as $key => $value) {
                                echo "<option value=".$value->id.">".$value->name."</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_level">Niveau :</label>
                    <select class="form-control" id="id_level" name="id_level" required>
                        <?php
                            foreach ($levels as $key => $value) {
                                echo "<option value=".$value->id.">".$value->name."</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_department">Département :</label>
                    <select class="form-control" id="id_department" name="id_department" required>
                        <?php
                            foreach ($departments as $key => $value) {
                                echo "<option value=".$value->id.">".$value->name."</option>";
                            }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-3">S'inscrire</button>
            </form>
            <div class="col-md-12 col-lg-6 text-white d-flex justify-content-center align-items-center p-4 rounded mt-4" style="background-color: #000842;">
                    <img src="templates/assets/image/Saly-10.png" alt="Login Image" />
            </div>
        </div>
    </div>
<?php $content = ob_get_clean();?>

<?php require 'layout.php'?>
