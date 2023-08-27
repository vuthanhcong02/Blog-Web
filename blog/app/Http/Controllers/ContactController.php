<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CheckContactRequest;
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('Frontend.contact.index');
    }
    public function sendEmailContact(CheckContactRequest $request){

        if($this->isOnline()){
            $data_email = [
                'recipient' => 'daiseikou02@gmail.com',
                'fromName' => $request->name,
                'fromEmail' => $request->email,
                'subject' => $request->subject,
                'body' => $request->message
            ];
            Mail::send('Frontend.contact.emailcontact', $data_email, function($message) use ($data_email){
                $message->from($data_email['fromEmail'], $data_email['fromName']);
                $message->to($data_email['recipient']);
                $message->subject($data_email['subject']);
                $message->replyTo($data_email['fromEmail'], $data_email['fromName']);
            });
            toastr()->timeOut(2000)
                    ->addSuccess('Cảm ơn bạn đã liên hệ với chúng tôi.');
            return redirect()->back();
        }
        toastr()->timeOut(2000)
                ->addError('Vui lòng kiểm tra kết nối mạng của bạn.');
        return redirect()->back();

    }
    public function isOnline($site = 'http://youtube.com/'){
        if(@fopen($site, 'r')){
            return true;
        }
        return false;
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
