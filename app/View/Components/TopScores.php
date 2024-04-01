<?php

namespace App\View\Components;

use App\Contracts\ScoreTrackerInterface;
use Illuminate\View\Component;

class TopScores extends Component
{
    public $topScores;

    public function __construct(ScoreTrackerInterface $scoreTracker)
    {
        $this->topScores = $scoreTracker->getTopScores();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.top-scores');
    }
}
