<?php

include '../nurse/header.php';
?>
<?php

if (isset($_POST["submit"])) {

    $case1 = $_POST["lyf1"] . ' &nbsp;&nbsp;&nbsp;&nbsp;  ' .' &nbsp;&nbsp;&nbsp;&nbsp;  ' . $_POST["quantity1"] ;
    $case2 = $_POST["lyf2"] . '&nbsp;&nbsp;&nbsp;&nbsp;' .'&nbsp;&nbsp;&nbsp;&nbsp; ' . $_POST["quantity2"] ;
    $case3 = $_POST["lyf3"] . '&nbsp;&nbsp;&nbsp;&nbsp; ' .'&nbsp;&nbsp;&nbsp;&nbsp; ' . $_POST["quantity3"] ;

// echo $case1;
// echo $case2;
// echo $case3;

if ($case1 & !$case2 & !$case3){
    $presc = "<ul><li>".$case1."</li></ul>";
}elseif($case1 & $case2 & !$case3) {
    $presc = "<ul><li>".$case1."</li><li>".$case2."</li></ul>";
}elseif($case1 & !$case2 & $case3) {
  $presc = "<ul><li>".$case1."</li><li>".$case3."</li></ul>";
}elseif($case1 & $case2 & $case3) {
  $presc = "<ul><li>".$case1."</li><li>".$case2."</li><li>".$case3."</li></ul>";
}
// echo $presc;
  }

 ?>
<div class="container">

<!-- <table><tr><td> </td><td> </td><td> </td></tr></table> -->


  <form class="form-horizontal" autocomplete="off" name="f" onSubmit="return validateForm();" action="try.php"  method="post" >

    <table id="table" class="table table-striped table-hover table-bordered">
      <tr>
        <th>  # </th>
        <th>  Drug </th>
        <th>  Quantity  </th>
      </tr>
      <tr>
        <td>  1. </td>
        <td> <input type="text" placeholder="Name of the drug" id="lyf1" class="form-control" name="lyf1"></td>
        <td>  <input type="int" placeholder=" Quantity " id="quantity1" class="form-control" name="quantity1">  </td>
      </tr>
      <tr>
        <td>  2.</td>
        <td>  <input type="text" placeholder="Name of the drug" id="lyf2" class="form-control" name="lyf2"></td>
        <td>  <input type="int" placeholder=" Quantity " id="quantity2" class="form-control" name="quantity2">  </td>
      </tr>
      <tr>
        <td>  3.</td>
        <td>  <input type="text" placeholder="Name of the drug" id="lyf3" class="form-control" name="lyf3"></td>
        <td> <input type="int" placeholder=" Quantity " id="quantity3" class="form-control" name="quantity3"> </td>
      </tr>
    </table>
    <table class="table table-striped table-hover table-bordered">
      <tr><td> <input type="submit" Value="Submit" name ="submit" class="btn btn-primary" > </td></tr>
    </table>

</form>
</div>

<script>


 function validateForm() {

 var lyf1 = document.forms['f']['lyf1'].value;
  var quantity1 = document.forms['f']['quantity1'].value;

  var lyf2 = document.forms['f']['lyf2'].value;
   var quantity2 = document.forms['f']['quantity2'].value;

   var lyf3 = document.forms['f']['lyf3'].value;
    var quantity3 = document.forms['f']['quantity3'].value;


   if (lyf1 == "" ) {
       alert("Drug name cannot be blank");
   $("#lyf1").focus();
     return false;
   }else if (lyf1.length < 2 ) {
   alert("Must be more than two characters.");
       $("#lyf1").focus();
    return false;
  }else if(quantity1=="" ){
    alert("Quantity Cannot be blank");
     $("#quantity1").focus();
       return false;
  }else if(!$.isNumeric(quantity1) ){
    alert("Must be an integer");
     $("#quantity1").focus();
       return false;
  }



return true;
}


       </script>

<?php include '../nurse/footer.php'; ?>
