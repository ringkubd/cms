<?php

namespace App\Http\Controllers\SupportController;

use App\Home;
use App\Http\Controllers\Controller;
use App\Mail\email\ContactReply;
use App\Models\Contact;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Factory|View
   */
  public function index()
  {
    $contacts = Contact::where('reply_id', null)->orderByDesc('created_at')->paginate(15);
    return view('admin.pages.contact.contact-data-table', compact('contacts'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Factory|View
   */
  public function create()
  {
    $contact = Home::get_single_post(31);
    return view("themes.default.contact", compact('contact'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param Request $request
   * @return Response
   */
  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'name' => 'string|required|max:255',
      'subject' => 'string|required|max:250',
      'phone' => 'string|required|max:20',
      'email' => 'email|required|max:155',
      'message' => 'string|required|max:400',
      'captcha' => 'required|captcha',
    ],
    ["messages" => [
      'captcha.required' => "Captcha can't be blank.",
      'captcha.captcha' => "Captcha doesn't match.",
    ]]);
    $validatedData["ip_address"] = $request->ip();

    $lastEmail = Contact::where('email', $request->email)->orderByDesc('created_at')->first();
    $lastPhone = Contact::where('phone', $request->phone)->orderByDesc('created_at')->first();
    $limit = 30; // 30 minutes
    if ($lastEmail) {
      $differ = Carbon::parse($lastEmail->created_at)->diffInMinutes();
      if ($differ < $limit) {
        $after = $limit - $differ;
        return back()->with("error", "You can submit Contact message after {$after} minutes");
      }
    }
    if ($lastPhone) {
      $differ = Carbon::parse($lastPhone->created_at)->diffInMinutes();
      if ($differ < $limit) {
        $after = $limit - $differ;
        return back()->with("error", "You can submit Contact message after {$after} minutes");
      }
    }
    $contact = Contact::create($validatedData);
    return back()->with("success", "Your Contact message now on pending");
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return Factory|View
   */
  public function show($id)
  {
    $contact = Contact::find($id);
    $contact->update(
      [
        'viewed' => 1,
        'viewed_by' => Auth::id(),
      ]
    );
    return view("admin.pages.contact.show-contact", compact('contact'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return Response
   */
  public function edit($id)
  {
    Contact::find($id)->update(
      [
        'viewed' => 1,
        'viewed_by' => Auth::id(),
      ]
    );
    return back()->with('success', 'mark as read');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param Request $request
   * @param int $id
   * @return RedirectResponse
   */
  public function update(Request $request, $id)
  {
    $data = $request->validate([
      'reply_id' => 'required|numeric',
      'name' => 'required|string|max:255',
      'subject' => 'required|string|max:250',
      'phone' => 'required|string|max:255',
      'email' => 'required|email|max:255',
      'message' => 'required|string|max:1800',
      'subject' => 'required|string|max:255',
    ]);

    $mailObj = new \stdClass();
    $mailObj->sender = 'noreply@isdb-bisew.org';
    $mailObj->name = $data['name'];
    $mailObj->receiver = $data['email'];
    $mailObj->subject = $data['subject'];
    $mailObj->message = $data['message'];

    Mail::to($data['email'])->send(new ContactReply($mailObj));

    $data['ip_address'] = $request->getClientIp();
    $data['name'] = Auth::user()->firstName . ' ' . Auth::user()->LastName; // reply information
    $data['phone'] = 'not set'; //replier phone
    $data['email'] = Auth::user()->email; // replier email
    $data['viewed_by'] = Auth::id(); // truck replier id

    Contact::Create($data);

    return back()->with('success', 'email send successfully');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return Response
   */
  public function destroy($id)
  {
    $contact = Contact::findOrFail($id);
    $contact->delete();
    return back()->with('success', 'Successfully deleted.');
  }
}
