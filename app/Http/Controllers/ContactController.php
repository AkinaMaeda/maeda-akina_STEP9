<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    //①問い合わせフォームを表示
    public function showForm()
    {
        return view('contact');
    }

    //②問い合わせフォームの送信を内容
    public function submitForm(ContactRequest $request)
    {
        //バリデーションされたメール送信の詳細を設定
        $data = $request->validated();
        try {
            //管理者にメールを送信
            Mail::to(env('ADMIN_EMAIL'))->send(new ContactMail($data));

            //一覧画面にリダイレクトし、成功メッセージを表示する
            return redirect()->route('index')
                ->with('success', 'お問い合わせが送信されました！');

        } catch (\Exception $e) {
            //送信失敗時のエラーハンドリング
            \Log::error('メール送信エラー: ' . $e->getMessage());
            return back()->with('error', 'メール送信に失敗しました。後でもう一度お試しください。');
        }
       
    }
}
