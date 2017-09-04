<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Impound;

class ImpoundController extends Controller
{
    public function impoudRequest()
    {
        $impounds = Impound::all();

        return view('dashboard.admin.impound.request', compact('impounds'));
    }

    public function impoundAccept($id)
    {
        $impound = Impound::find($id)->update([
            'is_accepted' => 1
        ]);

        if($impound) {
            $response = [
                'status' => 1
            ];
        } else {
            $response = [
                'status' => 0
            ];
        }
        return $response;
    }

    public function impoundDecline($id)
    {
        $impound = Impound::find($id)->update([
            'is_accepted' => 2
        ]);

        if($impound) {
            $response = [
                'status' => 1
            ];
        } else {
            $response = [
                'status' => 0
            ];
        }
        return $response;
    }
}
