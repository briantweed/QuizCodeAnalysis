<section class="results">

    <h3><?php echo $this->function_name ?></h3>

    <div class="row">

        <div class="col-md-5">
<?php
            if(isset($this->function_results))
            {
                if(file_exists($this->function_name.".php"))
                {
                    require($this->function_name.".php");
                }
                else 
                {
                    var_dump($this->function_results);
                }
?>
                <div>
                    <b>Average Time</b>: <?php echo $this->average_timing*1000 ?>ms
                </div>
<?php
            }
            else echo "There are no results to display";
?>
        </div>

        <div class="col-md-7">
            <div class="code">
                <pre><?php echo $this->code ?></pre>
            </div>
        </div>

    </div>
    <!-- /.row -->
    
</section>

<hr>