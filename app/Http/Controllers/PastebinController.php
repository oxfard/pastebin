<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreUpdatePasteRequest;
use App\Models\Paste;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PastebinController extends Controller
{
    /**
     * Show the main page.
     *
     * @return Renderable
     */
    public function index()
    {
        // Тестовый комментарий
        return view('index');
    }

    /**
     * Main page form handler.
     *
     * @return RedirectResponse
     */
    public function store(StoreUpdatePasteRequest $request)
    {

        $fields = $request->validated();

        $fields['url_path'] = Str::random(12);

        // Модифицируем имеющееся поле 'expires_at'
        $expires_at = str_replace('-',' ',$fields['expires_at']);
        $fields['expires_at'] = $expires_at === 'never' ? null : date('Y-m-d H:i:s',strtotime('+' . $expires_at));

        if( Auth::check() ){
            $fields['user_id'] = Auth::id();
        }elseif ( $fields['access_type'] === 'private' ){
            $fields['access_type'] = 'unlisted';
        }

//        dd($fields);

        $paste = Paste::create($fields);

        return redirect()->route('show', [$paste->url_path]);
    }

    /**
     * Show my pastes list.
     *
     * @return Renderable
     */
    public function my()
    {
        $date = Carbon::now();
        $user_pastes = Paste::latest()
            ->where(function ($query) use ($date) {
                $query->whereNull('expires_at')->orWhere('expires_at', '>=',$date);
            })
            ->where('user_id',Auth::id())->paginate(5);
        return view('my',['pastes'=>$user_pastes]);
    }

    /**
     * Paste edit form.
     *
     * @return Renderable
     */
    public function edit(Paste $paste)
    {

        if($paste->isExpired()){
            abort(404);
        }elseif($paste->access_type === 'private' and (!Auth::check() or Auth::id() !== $paste->user_id)){
            abort(403);
        }

        return view('edit',['paste' => $paste]);
    }

    /**
     * Paste edit handler.
     *
     * @return Renderable
     */
    public function update(StoreUpdatePasteRequest $request, Paste $paste)
    {
        // todo протестировать проверку просроченности и принадлежности пользователю
        if($paste->isExpired()){
            abort(404);
        }elseif( !Auth::check() or Auth::id() !== $paste->user_id){
            abort(403);
        }

        $fields = $request->validated();


        if($fields['expires_at'] !== 'nochng'){
            // добавляем это поле в $fields
            $expires_at = str_replace('-',' ',$fields['expires_at']);
            $fields['expires_at'] = $expires_at === 'never' ? null : date('Y-m-d H:i:s',strtotime('+' . $expires_at));
        } else {
            unset($fields['expires_at']);
        }

        $paste->update($fields);

        return redirect()->route('show', [$paste->url_path])->with('success','Post updated successfully');

    }

    /**
     * Тестовый шоу метод.
     *
     * @return Renderable
     */
    public function show(Paste $paste)
    {

        if($paste->isExpired()){
            abort(404);
        }elseif($paste->access_type === 'private' and (!Auth::check() or Auth::id() !== $paste->user_id)){
            abort(403);
        }

        return view('show',['paste' => $paste]);

    }


}
