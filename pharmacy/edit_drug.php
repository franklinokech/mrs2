
<?php

require_once '../config.php';
require_once '../functions.php';
include 'header.php';



if($_SESSION['level']==3 || $_SESSION['level']==5 ){

  if(isset($_GET['s_no'])){
   $s_no = $_GET['s_no'];
  //  echo $s_no;
 }else{
   echo "No id found";
 }

$res = mysqli_fetch_assoc(drug($s_no));
?>

<!-- <div class="container"> -->
      <div class="row" style="padding-left: 10px; padding-right: 10px;" >
        <ul class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li><a href="drugs.php">View Drugs</a></li>
            <li class="active">Edit Drugs</li>
          </ul>
      </div>
<!-- </div> -->
<div class="row" style="padding-left: 10px; padding-right: 10px;">
      <div class="col-md-8">
<?php if ($ERROR_MSG <> "") { ?>
    <div class="alert alert-dismissable alert-<?php echo $ERROR_TYPE ?>">
      <button data-dismiss="alert" class="close" type="button">×</button>
      <p><?php echo $ERROR_MSG; ?></p>
    </div>
<?php } ?>

            <div class="panel panel-primary">
              <div class="panel-heading">

                <h3 class="panel-title">Edit Drugs </h3>
              </div>
              <div class="panel-body">

                <form class="form-horizontal" autocomplete="off" name="f" onSubmit="return validateForm();" action="process_form.php"  method="post" >
                    <fieldset>

                            <div class="form-group">
                                <label class="col-lg-4 control-label" for="bp"><span class="required">*</span> Drug name :</label>
                                <div class="col-lg-8">
                                  <input type="text"  id="lyf" class="form-control" name="lyf" value="<?php echo $res['drug']; ?>">
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-lg-4 control-label" for="temp"><span class="required">*</span> Chemical composition :</label>
                                <div class="col-lg-8">
                                  <input type="text" placeholder=" Chemical content " id="chem" class="form-control" name="chem" value="<?php echo $res['chem']; ?>">
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-lg-4 control-label" for="temp"><span class="required">*</span> Quantity :</label>
                                <div class="col-lg-8">
                                  <input type="int" placeholder=" Quantity " id="quantity" class="form-control" name="quantity" value="<?php echo $res['weight']; ?>">
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-lg-4 control-label" for="temp"><span class="required">*</span> Status (Active) :</label>
                                <div class="col-lg-8">
                                  <input type="checkbox" checked class="checkbox form-control" name="status" value="A" >
                                </div>
                              </div>

  <input type="hidden"  name="s_no" value="<?php echo $res['s_no']; ?>">

                              <div class="panel-footer centered">
                                  <div class="col-lg-4"></div>
                                  <input type="submit" name="update" class="btn btn-primary" value="Save " /> &nbsp;&nbsp;&nbsp;&nbsp;  <input type="button" class="btn btn-primary" name="" onclick="javascript:window.location = 'drugs.php';" value="Show Drugs" />  &nbsp;&nbsp;&nbsp;&nbsp;  <input type="button" class="btn btn-primary" onclick="javascript:window.location = 'missing_drugs.php';" value="Show Missing" /></td>
                                    &nbsp;&nbsp;&nbsp;&nbsp; <button data-dismiss="modal" class="btn btn-theme04 btn-danger"  onclick="javascript:window.location = 'drugs.php';" type="button">Cancel</button>
                              </div>


                    </fieldset>
                </form>



              </div>
            </div>


  </div>
<div class="col-md-4">



  <div class="panel panel-info">
    <div class="panel-heading">
     <h3 class="panel-title">Navigation</h3>
      </div>
          <div class="panel-body">
<?php include 'nav.php'; ?>
          </div>
  </div>

    <div class="panel panel-info">
    <div class="panel-heading">
     <h3 class="panel-title">Missing Drugs</h3>
      </div>
          <div class="panel-body">
 <?php
try {
   $sql = "SELECT * FROM drugs WHERE 1 AND status ='I'";
   $stmt = $DB->prepare($sql);

   $stmt->execute();
   $vist = $stmt->fetchAll();
   $resultt = count($vist);
} catch (Exception $ex) {
  echo $ex->getMessage();
}

if ($resultt> 0){
?>

            <table class="table table-striped table-hover table-bordered ">
            <tbody><tr>
                <th>S/No</th>
                <th>Drug</th>

              </tr>
                <?php foreach ($vist as $res) { ?>
                <tr>
                  <td style="text-align: center;"><?php echo $res["s_no"]; ?></td>
                  <td><?php echo $res["drug"]; ?></td>

                </tr>
  <?php } ?>
            </tbody></table>

<?php }else { ?>
        <div class="required well well-sm "> No results</div>
<?php } ?>
            </div>
     </div>

      </div>
</div>
  <?php } else {?>
<div class="col-lg-12 center alert-danger"> Access to the page is denied. Only allowed to Receptionists</div>
<!-- </div> -->
    <?php
  }
      include 'footer.php';
      ?>
      <script>


      function validateForm() {

      var lyf = document.forms['f']['lyf'].value;
      var chem = document.forms['f']['chem'].value;
      var quantity = document.forms['f']['quantity'].value;


       if (lyf == "" ) {
           alert("Drug name cannot be blank");
       $("#lyf").focus();
         return false;
       }else if (lyf.length < 2 ) {
       alert("Must be more than two characters.");
           $("#lyf").focus();
        return false;
      }

      if (chem == "" ) {
           alert("Cannot be blank");
       $("#chem").focus();
         return false;
       }else if (chem.length < 5 ) {
       alert("Must be more than 5 characters.");
           $("#chem").focus();
        return false;
       }

       if (quantity == "" ) {
             alert("Cannot be blank");
         $("#quantity").focus();
           return false;
         }else if (quantity.length < 1 ) {
         alert("Must be more than 5 characters.");
             $("#quantity").focus();
          return false;
        }else if (!$.isNumeric(quantity)) {
         alert("Must be digits Only.");
             $("#quantity").focus();
          return false;
         }



      return true;
      }


           </script>
