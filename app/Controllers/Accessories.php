<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Accessories extends BaseController
{
    public function detail()
    {
        return view('detail_nail_file', [
            'title' => 'Detail Nail File'
        ]);
    }

    public function cuticlePusher()
    {
        return view('detail_cuticle_pusher', [
            'title' => 'Detail Cuticle Pusher'
        ]);
    }
    public function cuticleNipper()
    {
        return view('detail_cuticle_nipper', [
            'title' => 'Detail Cuticle Nipper'
        ]);
    }
    public function nailBrush()
    {
        return view('detail_nail_brush', [
            'title' => 'Detail Nail Brush'
        ]);
    }
    public function baseCoat()
    {
        return view('detail_base_coat', [
            'title' => 'Detail Base Coat'
        ]);
    }
    public function topCoat()
    {
        return view('detail_top_coat', [
            'title' => 'Detail Top Coat'
        ]);
    }
    public function nailPolisher()
    {
        return view('detail_nail_polisher', [
            'title' => 'Detail Nail Polisher'
        ]);
    }
    public function glitter()
    {
        return view('detail_glitter', [
            'title' => 'Detail Glitter'
        ]);
    }
}