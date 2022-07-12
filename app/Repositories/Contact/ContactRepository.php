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
        $newSizeLimit = $this->newListLimit($request);
        $contactBuilder = $this->contact;
        if (isset($request['search_input'])) {
            $contactBuilder = $contactBuilder->where(function ($q) use ($request) {
                $q->orWhere($this->escapeLikeSentence('first_name', $request['search_input']));
                $q->orWhere($this->escapeLikeSentence('last_name', $request['search_input']));
                $q->orWhere($this->escapeLikeSentence('first_name_furigana', $request['search_input']));
                $q->orWhere($this->escapeLikeSentence('last_name_furigana', $request['search_input']));
                $q->orWhere($this->escapeLikeSentence('email', $request['search_input']));
            });
        }
        $contacts = $contactBuilder->sortable(['first_name' => 'desc', 'last_name' => 'desc'])->paginate($newSizeLimit);
        if ($this->checkPaginatorList($contacts)) {
            Paginator::currentPageResolver(function () {
                return 1;
            });
            $contacts = $contactBuilder->paginate($newSizeLimit);
        }
        return $contacts;
    }

    public function getById($id)
    {
        return $this->contact->where('id', $id)->first();
    }

    public function store($request)
    {
        // TODO: Implement store() method.
    }

    public function update($request, $id)
    {
        $contactInfo = $this->contact->where('id', $id)->first();
        if (!$contactInfo) {
            return false;
        }
        $contactInfo->status = $request->status;
        return $contactInfo->save();
    }

    public function destroy($id)
    {
        $contactInfo = $this->contact->where('id', $id)->first();
        if (!$contactInfo) {
            return false;
        }
        if ($contactInfo->delete()) {
            return true;
        }
        return false;
    }
}
