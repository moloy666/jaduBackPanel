<script src="<?= base_url() ?>assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- PAGE LEVEL PLUGINS-->
<script src="<?= base_url() ?>assets/vendors/chart.js/dist/Chart.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/vendors/jvectormap/jquery-jvectormap-2.0.3.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/vendors/jvectormap/jquery-jvectormap-us-aea-en.js" type="text/javascript"></script>
<!-- CORE SCRIPTS-->
<script src="<?= base_url() ?>assets/js/app.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/vendors/DataTables/datatables.min.js" type="text/javascript"></script>
<!-- PAGE LEVEL SCRIPTS-->
<script src="<?= base_url() ?>assets/js/scripts/dashboard_1_demo.js" type="text/javascript"></script>
<!-- Toast -->
<script src="<?= base_url() ?>assets/js/toastify-js.js" type="text/javascript"></script>


<script>
    function toast(str,position) {
        Toastify({
            text: str,
            duration: 3000,
            destination: '',
            newWindow: true,
            close: true,
            gravity: 'top',
            position: position,
            stopOnFocus: true,
            style: {
                background: "rgb(15, 52, 67)",
            },
            onClick: function() {}
        }).showToast();
    }

    function toTitleCase(str) {
        return str.replace(/(?:^|\s)\w/g, function(match) {
            return match.toUpperCase();
        });
    }
    
</script>
</body>

</html>