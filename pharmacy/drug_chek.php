<?php
if (isset($_POST["insert"])) {

    $drug = $_POST["lyf"];
    $status = trim($_POST["status"]);
pre($_POST);
  }

?>


  <form class="form-horizontal" autocomplete="off" name="f" onSubmit="return validateForm();" action="process_form.php"  method="post" >
      <fieldset>

              <div class="form-group">
                  <label class="col-lg-4 control-label" for="bp"><span class="required">*</span> Drug name :</label>
                  <div class="col-lg-8">
                    <input type="text" placeholder="Name of the drug" id="lyf" class="form-control" name="lyf">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-4 control-label" for="temp"><span class="required">*</span> Chemical composition :</label>
                  <div class="col-lg-8">
                    <input type="text" placeholder=" Chemical content " id="chem" class="form-control" name="chem">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-4 control-label" for="temp"><span class="required">*</span> Quantity :</label>
                  <div class="col-lg-8">
                    <input type="int" placeholder=" Quantity " id="quantity" class="form-control" name="quantity">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-4 control-label" for="temp"><span class="required">*</span> Status (Active) :</label>
                  <div class="col-lg-8">
                    <input type="checkbox" checked class="checkbox form-control" name="status" value="A" >
                  </div>
                </div>



                <div class="modal-footer centered">

                    <input type="submit" name="insert" class="btn btn-primary" value="Save" /> &nbsp;&nbsp;&nbsp;&nbsp;  <input type="button" class="btn btn-primary" name="" onclick="javascript:window.location = 'drugs.php';" value="Show Drugs" />  &nbsp;&nbsp;&nbsp;&nbsp;  <input type="button" class="btn btn-primary" onclick="javascript:window.location = 'missing_drugs.php';" value="Show Missing" /></td>
                      <button data-dismiss="modal" class="btn btn-theme04 btn-danger" type="button">Cancel</button>
                </div>


      </fieldset>
</form>
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
