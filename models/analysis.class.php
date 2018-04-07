<?php 

class Analysis
{
    private $function_name;
    private $function_parameters;
    private $number_of_tests;
    private $timings;
    private $code;
    private $average_timing;

    const DECIMAL_PLACES  = 10;
    const NUMBER_OF_TESTS = 2000;


    public function __construct($function_name, $display_name, $function_parameters, $number_of_tests = self::NUMBER_OF_TESTS)
    {
        Analysis::setFunctionName($function_name);
        Analysis::setDisplayName($display_name);
        Analysis::setNumberOfTests($number_of_tests);
        Analysis::setFunctionParameters($function_parameters);
        Analysis::setReflection();
    }


    private function setFunctionName(string $function_name)
    {
        $this->function_name = $function_name;
    }


    private function setDisplayName(string $display_name)
    {
        $this->display_name = $display_name;
    }


    private function setFunctionParameters($function_parameters)
    {
        $this->function_parameters = (array) $function_parameters;
    }


    private function setNumberOfTests(int $number_of_tests)
    {
        $this->number_of_tests = $number_of_tests;
    }


    private function setReflection()
    {
        $this->reflection = new ReflectionFunction($this->function_name);
    }


    public function analyse(int $number_of_tests = null) 
    {
        if(isset($number_of_tests)) 
        {
            Analysis::setNumberOfTests($number_of_tests);
        }

        if(function_exists($this->function_name)) 
        {
            if(Analysis::checkRequiredParameterCount())
            {
                $test_number = 0;
                do 
                {
                    $start_time = microtime(true);
                    $this->function_results = (array) call_user_func_array($this->function_name, $this->function_parameters);
                    $end_time = microtime(true);
                    $time_taken = $end_time - $start_time;
                    $this->timings[$test_number] = number_format($time_taken, self::DECIMAL_PLACES);
                    $test_number++;
                } 
                while ($test_number < $this->number_of_tests);
                Analysis::runCalculations();
            }
        }
        return $this;
    }


    private function checkRequiredParameterCount()
    {
        $required_parameter_count = $this->reflection->getNumberOfParameters();
        $actual_parameter_count = count($this->function_parameters);
        return $actual_parameter_count === $required_parameter_count;
    }


    public function display() 
    {
        require('layout/template.php');
    }


    private function runCalculations()
    {
        Analysis::calculateAverageTiming();
        Analysis::retrieveCode();
    }


    private function calculateAverageTiming()
    {
        $this->average_timing = number_format(array_sum($this->timings)/$this->number_of_tests, self::DECIMAL_PLACES); 
    }


    private function retrieveCode()
    {
        $start_line = $this->reflection->getStartLine() - 1;
        $end_line = $this->reflection->getEndLine();
        $length = $end_line - $start_line;
        $source = file($this->reflection->getFileName());
        $body = array_slice($source, $start_line, $length);
        foreach($body as $line) 
        {
            $start_line++;
            $this->code .= "<span class='line-number'>".str_pad($start_line, strlen($end_line),' ',STR_PAD_LEFT)."</span> : ". $line;
        }
    }


} // end of class