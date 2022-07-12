<?php

namespace App\Repositories\Contact;

use App\Models\Contact;
use App\Http\Controllers\BaseController;
use App\Repositories\Contact\ContactInterface;
use Illuminate\Support\Facades\Auth;

class ContactRepository extends BaseController implements ContactInterface
{
    private Contact $contact;
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function get($request)
    {
        return Contact::all();
    }

    public function getById($id)
    {
        return Contact::where('id',$id)->first();
    }

    public function store($request)
    {
        $this->contact->first_name = $request->first_name;
        $this->contact->last_name = $request->last_name;
        $this->contact->first_name_furigana = $request->first_name_furigana;
        $this->contact->last_name_furigana = $request->last_name_furigana;
        $this->contact->email = $request->email;
        $this->contact->content = $request->content;
        return $this->contact->save();
    }

    public function update($request, $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
//        $contact = $this->contact::where('id',$id)->first();
        $contact = Contac::where('id',$id)->first();

        $contact->delete();

    }
}
