<?php
/**
 * Created by PhpStorm.
 * User: gilsonmello
 * Date: 6/25/18
 * Time: 6:05 PM
 */

namespace App\Repositories\API\Contact;


use App\Contact;
use App\ContactCategory;
use App\Mail\Contact\CreateContactMail;
use App\Mail\Contact\ReplyEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class ContactRepository implements ContactContract
{

    /**
     * @param Request $request
     * @return bool|mixed
     */
    public function create(Request $request)
    {
        $attributes = $request->all();
        $contact = new Contact;
        $contact->email = $attributes['email'];
        $contact->name = $attributes['name'];
        $contact->category_id = $attributes['category'];
        $contact->description = $attributes['description'];
        $contact->subject = $attributes['subject'];
        $contact->domain = request()->root();
        $contact->locale = config('app.locale');
        if($contact->save()) {
            if ($request->hasFile('file')) {
                if($request->file('file')->isValid()) {
                    try {
                        $file = $request->file('file');
                        $name = $contact->id. '.' .$file->getClientOriginalExtension();
                        $request->file('file')->move(public_path('files/contacts'), $name);
                        //$contact->file = request()->root() . '/files/contacts/' . $name;
                        $contact->file = '/files/contacts/' . $name;
                        $contact->save();
                    } catch (\Illuminate\Filesystem\FileNotFoundException $e) {
    
                    }
                } 
            }
            Mail::to($contact->email)
                ->send(new CreateContactMail($contact));
            return true;
        }
        return false;
    }

    /**
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, array $attributes)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @return ContactCategory[]|\Illuminate\Database\Eloquent\Collection|mixed
     */
    public function categories()
    {
        return ContactCategory::all();
    }

    /**
     * @return mixed
     */
    public function replyEmail(Request $request, $id) {
        $contact = Contact::find($id);
        Mail::to($contact->email)
                ->send(new ReplyEmail($contact));

        return true;
    }
}