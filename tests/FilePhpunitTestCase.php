<?php
use PHPUnit\Framework\TestCase; 
    
class FilePhpunitTestCase extends TestCase 
{ 
    public function testNegativeTestcaseForAssertFileExists() 
    { 
        $filename = "coding-challenge-1.jsonl"; 
    
        // Assert function to test whether given 
        // file path exists or not 
        $this->assertFileExists( 
            $filename, 
            "given filename doesn't exists"
        ); 
    } 
} 