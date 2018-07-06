    <footer>
      <div class="navbar navbar-inverse footer">
        <div class="container-fluid">
          <div class="copyright">
            <a href="#" target="_blank">&copy; Kenya MRS <?php echo date("Y"); ?></a> All rights reserved
          </div>
        </div>
      </div>
    </footer>
<script src="external/jquery/jquery.js"></script>
<script src="jquery-ui.js"></script>
<script src="jquery.datetimepicker.full.js"></script>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
$('#datetimepicker2').datetimepicker({

  lang:'ch',
  timepicker:false,
  format:'Y/m/d',
  formatDate:'Y/m/d',
  });
$('#datetimepicker').datetimepicker({

  lang:'ch',
  timepicker:false,
  format:'Y/m/d',
  formatDate:'Y/m/d',
  maxDate:'0'

});
$( "#accordion" ).accordion();

$( "#radioset" ).buttonset();

$( "#autocomplete" ).autocomplete({
  source: availableTags
});

$( "#tooltip" ).tooltip();

</script>

    <!-- /.container -->

    <!-- jQuery -->
    <script src="bootstrap/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
