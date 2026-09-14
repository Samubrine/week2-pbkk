<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function show($type = null)
    {
        $isSecurityHarness = $type === 'security-harness';
        return view('agent', compact('isSecurityHarness', 'type'));
    }
}
