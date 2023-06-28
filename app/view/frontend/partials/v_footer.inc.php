 <!-- JS Script SweetAlert -->
 <script src="<?php echo Path::JS."sweetalert2.all.min.js"?>"></script>
 <!-- End script  -->
 <?php if (isset($_SESSION["status"]) && $_SESSION["status"] != "") { ?>
     <script>
         // https://sweetalert2.github.io/
         const Toast = Swal.mixin({
             toast: true,
             position: 'bottom-start',
             showConfirmButton: false,
             timer: 5000,
             timerProgressBar: true,
             didOpen: (toast) => {
                 toast.addEventListener('mouseenter', Swal.stopTimer)
                 toast.addEventListener('mouseleave', Swal.resumeTimer)
             }
         })
         Toast.fire({
             title: "<?php echo $_SESSION["status"]; ?>",
             icon: "<?php echo $_SESSION["status_code"]; ?>",
         });
     </script>
 <?php unset($_SESSION["status"]);
    } ?>
<!-- color thief -->
<script type="text/javascript" src="<?php echo Path::JS."color-thief.min.js"?>"></script>

<!-- tinyEditor -->
<script src="https://cdn.tiny.cloud/1/5c6e7bcvocs9k24usxhav7274bzgolwk9371lxlmcre761qr/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script type="text/javascript" src="<?php echo Path::JS."main.js" ?>"></script>

</body>
</html>