<?php $title = "Login Form";?>

<?php ob_start();?>

<div class="container">
<?php $title = "Login Form";?>

<?php ob_start();?>

<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
  <div class="container row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header bg-primary text-white">
          Informations de l'étudiant
        </div>
        <div class="card-body">
          <p><strong>Nom :</strong> <?php echo $student->first_name; ?></p>
          <p><strong>Prénom :</strong> <?php echo $student->last_name; ?></p>
          <p><strong>Date de naissance :</strong> <?php echo $student->date_of_birth; ?></p>
          <p><strong>Matricule :</strong> <?php echo $student->matricule; ?></p>
          <p><strong>Genre :</strong> <?php echo $student->gender; ?></p>
          <p><strong>Secteur :</strong> <?php echo $student->id_sector; ?></p>
          <p><strong>Niveau :</strong> <?php echo $student->id_level; ?></p>
          <p><strong>Département :</strong> <?php echo $student->id_department; ?></p>
        </div>
      </div>
    </div>
  </div>
</div>


<?php $content = ob_get_clean();?>

<?php require 'layout.php'?>

</div>

<?php $content = ob_get_clean();?>

<?php require 'layout.php'?>
