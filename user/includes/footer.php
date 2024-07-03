                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Himaya 2023</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <?php
            if(isset($_SESSION['alert']) && $_SESSION['alert']=="Show"){
                ?>
                    <script>
                        const Toast = Swal.mixin({
                          toast: true,
                          position: "top-end",
                          showConfirmButton: false,
                          timer: 3000,
                        });
                        Toast.fire({
                          icon: "<?=$_SESSION['icon']?>",
                          title: "<?=$_SESSION['title_alert']?>",
                        });
                    </script>
                <?php
                unset($_SESSION['alert']);
                unset($_SESSION['icon']);
                unset($_SESSION['title_alert']);
            }
        ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" defer></script>
        <script src="../assets/demo/chart-area-demo.js" defer></script>
        <script src="../assets/demo/chart-bar-demo.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    </body>
</html>
