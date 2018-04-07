<!-- Layout for Prime numbers test -->
<div class="grid">
<?php 
    for($x=1; $x<=$this->function_parameters[0]; $x++) 
    {
?>
        <div class="box <?php echo in_array($x, $this->function_results) ? 'prime' : '' ?>">
            <?php echo $x ?>
        </div>
<?php 
    }
?>
</div>