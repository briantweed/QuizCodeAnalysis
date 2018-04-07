<!-- Layout for FizzBuzz test -->
<div class="grid">
<?php
    foreach($this->function_results as $result) 
    {
?>
        <div class="box <?php echo strtolower($result) ?>">
            <?php echo $result ?>
        </div>
<?php 
    }
?>
</div>

