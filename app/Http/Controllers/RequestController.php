<?php

namespace App\Http\Controllers;

use App\Models\Request;
use App\Models\Tag;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = Request::with(['user', 'tag'])->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.requests.index', compact('requests'));
    }

    public function index_public()
    {
        $requests = Request::where('user_id', Auth::id())->paginate(10);
        return view('requests', compact('requests'));
    }

    public function createPublic()
    {
        $tags = Tag::orderBy('name')->get();
        return view('requests.create', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->hasRole('boss') && !Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized access');
        }

        $tags = Tag::orderBy('name')->get();
        return view('admin.requests.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HttpRequest $request)
    {
        if (Auth::user()->hasRole('boss') && !Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized access');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tag_id' => 'nullable|exists:tags,id',
        ]);

        Request::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id(),
            'status_id' => 'pending',
            'tag_id' => $request->tag_id,
        ]);

        return redirect()->route('requests.index.public')->with('success', __('Request created successfully'));
    }

    /**
     * Display the specified resource (Public View).
     */
    public function showPublic(Request $request)
    {
        // Asegurar que el usuario es el propietario
        if ($request->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access');
        }
        return view('requests.show', compact('request'));
    }

    /**
     * Show the form for editing the specified resource (Public View).
     */
    public function editPublic(Request $request)
    {
        // Asegurar que el usuario es el propietario
        if ($request->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access');
        }
        $tags = Tag::orderBy('name')->get();
        return view('requests.edit', compact('request', 'tags'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return view('admin.requests.show', compact('request'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        if (Auth::user()->hasRole('boss') && !Auth::user()->hasRole('admin')) {
            return view('admin.requests.edit', [
                'request' => $request,
                'tags' => collect(),
            ]);
        }

        $tags = Tag::orderBy('name')->get();
        return view('admin.requests.edit', compact('request', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HttpRequest $httpRequest, Request $request)
    {
        $user = Auth::user();

        if ($user->hasRole('user')) {
            if ($request->user_id !== $user->id) {
                abort(403, 'Unauthorized access');
            }

            $httpRequest->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'tag_id' => 'nullable|exists:tags,id',
            ]);

            $request->update([
                'title' => $httpRequest->title,
                'description' => $httpRequest->description,
                'tag_id' => $httpRequest->tag_id,
            ]);
        } elseif ($user->hasRole('boss') && ! $user->hasRole('admin')) {
            $httpRequest->validate([
                'status_id' => 'required|in:pending,approved,rejected',
            ]);

            $request->update([
                'status_id' => $httpRequest->status_id,
            ]);
        } else {
            $httpRequest->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'tag_id' => 'nullable|exists:tags,id',
                'status_id' => 'required|in:pending,approved,rejected',
            ]);

            $request->update([
                'title' => $httpRequest->title,
                'description' => $httpRequest->description,
                'tag_id' => $httpRequest->tag_id,
                'status_id' => $httpRequest->status_id,
            ]);
        }

        // Determinar si viene de la vista pública o del dashboard
        $referer = $httpRequest->headers->get('referer');
        if ($user->hasRole('user') && $referer && str_contains($referer, '/requests')) {
            return redirect()->route('requests.show.public', $request)->with('success', __('Request updated successfully'));
        }

        return redirect()->route('dashboard.requests.index')->with('success', __('Request updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();

        if ($user->hasRole('boss') && ! $user->hasRole('admin')) {
            abort(403, 'Unauthorized access');
        }

        if ($user->hasRole('user') && $request->user_id !== $user->id) {
            abort(403, 'Unauthorized access');
        }

        $request->delete();
        if ($user->hasRole('user')) {
            return redirect()->route('requests.index.public')->with('success', __('Request deleted successfully'));
        }

        return redirect()->route('dashboard.requests.index')->with('success', __('Request deleted successfully'));
    }
}
