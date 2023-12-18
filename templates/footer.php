
    </div>
		</div>

    <script src="<?=$ROOT_DIR;?>templates/js/jquery.min.js"></script>
    <script src="<?=$ROOT_DIR;?>templates/js/popper.js"></script>
    <script src="<?=$ROOT_DIR;?>templates/js/bootstrap.min.js"></script>
    <script src="<?=$ROOT_DIR;?>templates/js/main.js"></script>
  </body>
</html>


<script type="text/javascript">
$(function () {

  <?php if ($success): ?>
    Swal.fire({
      title: "Good job!",
      text: "<?=$success?>",
      icon: "success"
    });
  <?php endif; ?>


  <?php if ($error): ?>
    Swal.fire({
      title: "Error!",
      text: "<?=$error?>",
      icon: "error"
    });
  <?php endif; ?>


  });

</script>
