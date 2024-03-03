<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class LandingController extends Controller
{
    public function search(Request $request)
    {
        // $category = Input::get('category', 'default category');
        $query = $request->input('q');
        $rank = $request->input('rank');

        // C:\Users\LAB SISTER\AppData\Local\Programs\Python\Python312\python.exe
        $process = new Process(['C:\Users\LAB SISTER\AppData\Local\Programs\Python\Python312\python.exe', 'query.py', 'pahedb', $rank, $query]);
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $list_data = array_filter(explode("\n",$process->getOutput()));
        
        $data = array();

        foreach ($list_data as $book) {
            $dataj =  json_decode($book, true);
            array_push($data, '
            <div class="col-lg-5">
                <div class="card mb-2" style="background-color: #393838;">
                    <div style="display: flex; flex: 1 1 auto;">
                        <div class="img-square-wrapper">
                            <img class="rounded" src="'.$dataj['image'].'">
                        </div>
                        <div class="card-body">
                            <h6 class="card-title"><a class="text-light" target="_blank" href="'.$dataj['url'].'"><b>'.$dataj['title'].'</b></a></h6>
                            <p class="card-text text-white">Synopsis : '.substr($dataj['price'], 0, 200).'.. <a class="text-light" target="_blank" href="'.$dataj['url'].'">Baca Selengkapnya</a></p>
                        </div>
                    </div>
                </div>
            </div>
            ');
        }
        echo json_encode($data);
    }
}