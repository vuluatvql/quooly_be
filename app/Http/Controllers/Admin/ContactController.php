<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ContactStatus;
use App\Enums\StatusCode;
use App\Http\Controllers\BaseController;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Repositories\Contact\ContactInterface;
use Illuminate\Http\Request;

class ContactController extends BaseController
{
    private $contact;
    public function __construct(ContactInterface $contact)
    {
        $this->contact = $contact;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $breadcrumbs = [
            '問い合わせ一覧',
        ];
        $newSizeLimit = $this->newListLimit($request);
        session()->forget('admin.contact.list');
        session()->push('admin.contact.list', url()->full());
        return view('admin.contact.index', [
            'title' => '問い合わせ一覧',
            'breadcrumbs' => $breadcrumbs,
            'contacts' => $this->contact->get($request),
            'request' => $request,
            'newSizeLimit' => $newSizeLimit
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $breadcrumbs = [
            [
                'url' => session()->get('admin.contact.list')[0] ?? route('admin.contact.index'),
                'name' => '問い合わせ一覧',
            ],
            '問い合わせ編集'
        ];
        $contact = $this->contact->getById($id);
        if (!$contact) {
            return redirect(session()->get('admin.contact.list')[0] ?? route('admin.contact.index'));
        }
        $contact_status_list = [
            [
                'status' => ContactStatus::NOT_SUPPORT,
                'text' => ContactStatus::getDescription(ContactStatus::NOT_SUPPORT)
            ],
            [
                'status' => ContactStatus::SUPPORTED,
                'text' => ContactStatus::getDescription(ContactStatus::SUPPORTED)
            ]
        ];
        return view('admin.contact.edit', [
            'title' => '問い合わせ編集',
            'breadcrumbs' => $breadcrumbs,
            'contact' => $contact,
            'contact_status_list' => $contact_status_list
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Contactrequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Contactrequest $request, $id)
    {
        if ($this->contact->update($request, $id)) {
            $this->setFlash(__('代理店の新規作成が完了しました。'));
            return redirect(session()->get('admin.contact.list')[0] ?? route('admin.contact.index'));
        }
        $this->setFlash(__('エラーが発生しました。'), 'error');
        return redirect()->route('admin.contact.update', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->contact->destroy($id)) {
            return response()->json([
                'message' => 'お知らせの削除が完了しました。',
                'status' => StatusCode::OK
            ], StatusCode::OK);
        }
        return response()->json([
            'message' => 'エラーが発生しました。',
            'status' => StatusCode::OK
        ], StatusCode::INTERNAL_ERR);
    }
}
