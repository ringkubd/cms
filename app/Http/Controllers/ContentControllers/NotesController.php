<?php

namespace App\Http\Controllers\ContentControllers;

use App\Models\ContentModels\Notes;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class NotesController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Factory|View
   */
  public function index()
  {
//    $author = \request('author');
//    $category = \request('category');
//    $status = \request('status');
//    $start = \request('start');
//    $end = \request('end');
//    $order = \request('order');
//    $search = \request('search');

    $userNotes = Notes::where('user_id', Auth::id())->get();
    $publishNotes = Notes::where('user_id', '!=', Auth::id())->where('note_status', 'publish')->get();
    $notes = $userNotes->merge($publishNotes)->sortKeysDesc();
    if (\request()->ajax()) {
      return view('admin.pages.notes.note-table', compact('notes'));
    }

    return view('admin.pages.notes.show-note', compact('notes'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Factory|View
   */
  public function create()
  {
    return view('admin.pages.notes.create-note');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param Request $request
   * @return RedirectResponse
   * @throws ValidationException
   */
  public function store(Request $request)
  {
    $notes = $this->validate($request, [
      'note_title' => 'required|string|max:400',
      'note_content' => 'required|string',
      'note_status' => 'required|string|max:55',
      'created_at' => 'required|string|max:155',
      'schedule_time' => 'nullable|string|max:155',
      'upload_type' => 'nullable|string|max:55',
      'attachment_status' => 'nullable|string|max:55',
      'newPicture' => 'nullable|max:1536|mimes:jpeg,jpg,png,gif',
    ]);
    $notes['note_slug'] = str_replace(' ', '-', Str::slug($notes['note_title']));
    $notes['note_thumb'] = '';
    $notes['thumb_status'] = $request->input('thumb_status', 0);
    $notes['created_at'] = Carbon::parse($notes['created_at'])->toDateTimeString();
    $notes['user_id'] = Auth::id();

    $note = Notes::create($notes);

    return redirect("admin/note/{$note->id}/edit")->with('success', 'Notes Saved Successfully');
  }

  /**
   * Display the specified resource.
   *
   * @param Notes $note
   * @return Factory|View
   */
  public function show(Notes $note)
  {
    if ($note->user_id !== Auth::id() && $note->note_status !== 'publish') {
      return back()->with('error', 'You dont have permission to View this');
    }
    return view('admin.pages.notes.single-note', compact('note'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param Notes $note
   * @return Factory|View
   */
  public function edit(Notes $note)
  {
    if ($note->user_id !== Auth::id()) {
      return back()->with('error', 'you can\'t owner of this post');
    }
    return view('admin.pages.notes.edit-note', compact('note'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param Request $request
   * @param Notes $note
   * @return RedirectResponse
   * @throws ValidationException
   */
  public function update(Request $request, Notes $note)
  {
    $notes = $this->validate($request, [
      'note_title' => 'required|string|max:400',
      'note_content' => 'required|string',
      'note_status' => 'required|string|max:55',
      'created_at' => 'required|string|max:155',
      'schedule_time' => 'nullable|string|max:155',
      'upload_type' => 'nullable|string|max:55',
      'attachment_status' => 'nullable|string|max:55',
      'newPicture' => 'nullable|max:1536|mimes:jpeg,jpg,png,gif',
    ]);
    $notes['note_slug'] = str_replace(' ', '-', Str::slug($notes['note_title']));
    $notes['note_thumb'] = '';
    $notes['attachment_status'] = $request->input('attachment_status', 0);
    $notes['thumb_status'] = $request->input('thumb_status', 0);
    $notes['created_at'] = Carbon::parse($notes['created_at'])->toDateTimeString();

    $note->update($notes);

    return back()->with('success', 'Notes updated successfully');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param Request $request
   * @param Notes $note
   * @return RedirectResponse
   * @throws ValidationException
   */
  public function quick_edit(Request $request, Notes $note)
  {
    $notes = $this->validate($request, [
      'note_title' => 'required|string|max:400',
      'note_status' => 'required|string|max:55',
      'created_at' => 'required|string|max:155',
    ]);
    $notes['note_slug'] = str_replace(' ', '-', Str::slug($notes['note_title']));
    $notes['created_at'] = Carbon::parse($notes['created_at'])->toDateTimeString();

    if ($note->user_id !== Auth::id()) {
      return back()->with('error', 'you can\'t owner of this post');
    }

    $note->update($notes);

    return back()->with('success', 'Notes updated successfully');
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param Notes $note
   * @return RedirectResponse
   * @throws \Exception
   */
  public function destroy(Notes $note)
  {
    if ($note->user_id !== Auth::id()) {
      return back()->with('error', 'you can\'t owner of this post');
    }
    $note->delete();
    return redirect('admin/note')->with('success', 'Notes deleted successfully');
  }
}
