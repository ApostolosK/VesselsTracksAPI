<?php

namespace App\Traits;

trait ExecutionTimer {


    private
        $start_time,
        $finish_time;

    /**
     * Start Process Timer
     */
    final public function startTimer(): void{
        $this->start_time = microtime(true);
    }

    /**
     * Finish Process Timer
     */
    final public function finishTimer(): void{
        $this->finish_time = microtime(true);
    }

    /**
     * Get Execution Time
     * @return float
     */
    final public function getExecutionTime() {
        return number_format($this->finish_time - $this->start_time, 2) .'s';
    }

}