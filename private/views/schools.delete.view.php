
<?php $this->view('includes/header');?>
<?php $this->view('includes/nav');?>


<div class="container-fluid p-4 shadow mx-auto" style="max-width:1000px;">
  
   <?php $this->view('includes/crumbs', ['crumbs'=> $crumbs])?>


   <?php if($row):?>
   <div class="card-group justify-content-center">

      <form method="post">
         <h3>Are you shore you want to delete?!</h3>

          
         <input disabled autofocus  class="form-control" value="<?=get_var('school', $row[0]->school)?>" type="text" name="school" placeholder="School Name"><br><br>
         <input type="hidden" name="id">
         <input class="btn btn-danger float-end" type="submit" value="Delete">

            <a href="<?=ROOT?>/schools">
               <input class="btn btn-success text-white" type="button" value="Cancle">
            </a>
      </form>
      </div>
       <?php else:?>
      <div style="text-align: center;">
      
         <h3>That school was not found</h3><br>
         <a href="<?=ROOT?>/schools">
               <input class="btn btn-danger text-white" type="button" value="Cancle">
            </a>
      <?php endif; ?>
      </div>
   
</div>


<?php $this->view('includes/footer');?>