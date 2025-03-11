<?php
    if (isset($_SESSION['create_dep_msg'])) :
?>

    <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Holy "<?php echo $_SESSION['username']; ?>" !</strong> <?php echo $_SESSION['create_dep_msg']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

<?php
    unset($_SESSION['create_dep_msg']);
    endif;
?>
