<?php
/**
 * Created by PhpStorm.
 * User: gilsonmello
 * Date: 6/25/18
 * Time: 6:05 PM
 */

namespace App\Repositories\Frontend\Contact;


use App\Contact;
use App\ContactCategory;
use App\Mail\Contact\CreateContactMail;
use Illuminate\Support\Facades\Mail;

class ContactRepository implements ContactContract
{

    /**
     * @param array $attributes
     * @return bool|mixed
     */
    public function create(array $attributes)
    {
        $contact = new Contact;
        $contact->email = $attributes['email'];
        $contact->name = $attributes['name'];
        $contact->category_id = $attributes['category'];
        $contact->description = $attributes['description'];
        $contact->subject = $attributes['subject'];
        if($contact->save()) {
            Mail::to('contacts@lottoyou.bet')
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
}