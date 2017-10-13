<?php

namespace App\Http\Controllers\Publics;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Publics\ContactsModel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Lang;
use PHPMailer\PHPMailer\PHPMailer;
use Log;

class ContactsController extends Controller
{

    private $mail;

    public function index()
    {
        return view('publics.contacts', [
            'cartProducts' => $this->products,
            'head_title' => Lang::get('seo.title_contacts'),
            'head_description' => Lang::get('soe.descr_contacts')
        ]);
    }

    public function sendMessage(Request $request)
    {
        $post = $request->all();
        $this->loadSettings();
        $errors = array();
        if (!filter_var($post['client_email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = Lang::get('public_pages.invalid_email');
        }
        if (mb_strlen(trim($post['client_message'])) == 0) {
            $errors[] = Lang::get('public_pages.too_short_message');
        }
        if (empty($errors)) {
            return $this->sendEmail($post);
        } else {
            return redirect(lang_url('contacts'))->with(['msg' => $errors, 'result' => false]);
        }
    }

    private function sendEmail($post)
    {
        $this->mail->setFrom($post['client_email'], 'Client');
        $this->mail->addAddress('mail@emailaddress.com', 'My Site');
        //$this->mail->isHTML(true); 
        $this->mail->Subject = 'Message from contact form from my site';
        $this->mail->Body = $post['client_message'];
        if (!$this->mail->send()) {
            Log::critical($this->mail->ErrorInfo);
            return redirect(lang_url('contacts'))->with(['msg' => Lang::get('public_pages.problem_message_send'), 'result' => false]);
        }
        return redirect(lang_url('contacts'))->with(['msg' => Lang::get('public_pages.message_sended'), 'result' => false]);
    }

    private function loadSettings()
    {
        $this->mail = new PHPMailer();
        //$this->mail->SMTPDebug = 2; 
        $this->mail->isMail(); // Set mailer to use SMTP
        $this->mail->Host = '';  // Specify main and backup SMTP servers
        $this->mail->SMTPAuth = true; // Enable SMTP authentication
        $this->mail->Username = ''; // SMTP username
        $this->mail->Password = ''; // SMTP password
        $this->mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
        $this->mail->Port = 587; // TCP port to connect to
    }

}
