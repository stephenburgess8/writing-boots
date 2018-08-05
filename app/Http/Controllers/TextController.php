<?php

namespace App\Http\Controllers;

use App\Services\TextService as TextService;
use Illuminate\Http\Request;

class TextController extends Controller
{
    private $textService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TextService $textService)
    {
        $this->textService = $textService;
    }

    /**
     * Analyze Submitted Text
     *
     * @return \Illuminate\Http\Response
     */
    public function analyze(Request $request)
    {
        $text = $request->input('boots-content');
        $this->textService->setText($text);
        $title = $request->input('wb-title');

        $data = $this->textService->getCounts();
        $data['frequencies'] = $this->textService->getFrequencies();
        $data['text'] = $text;
        $data['title'] = $title;
        return view('index', $data);
    }
}
