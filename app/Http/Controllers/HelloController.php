<?php

namespace App\Http\Controllers;

use App\Services\HelloService;
use Illuminate\Http\Request;

class HelloController extends Controller
{

    private HelloService $helloService;
    public function __construct(HelloService $helloService)
    {
        $this->helloService = $helloService;
    }

    public function hell(Request $request, $name): string
    {
        // $request->path(); // Untuk mendapatkan path
        // $request->url(); // Untuk mendapat URL tanpa query parameter
        // $request->fullUrl(); // Untuk mendapatkan URL dengan query parameter
        return $this->helloService->hello($name);
    }

    public function request(Request $request)
    {
        return $request->path() . PHP_EOL .
            $request->url() . PHP_EOL .
            $request->fullUrl() . PHP_EOL .
            $request->method() . PHP_EOL .
            $request->header('Accept') . PHP_EOL;
    }


}
