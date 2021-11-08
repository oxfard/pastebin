<?php

namespace App\Http\Controllers;

use App\Models\Paste;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Show the main page.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Main page form handler.
     *
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'content' => 'required',
            'language' => 'required',
            'access_type' => 'required',
            'expires_at' => 'required',
        ]);
        $fields = [
            'name'  => $validated['name'],
            'access_type'  => $validated['access_type'],
            'url_path'  => Str::random(12),
            'language'  => $validated['language'],
            'content'  => $validated['content'],
        ];
        $expires_at = str_replace('-',' ',$validated['expires_at']);
        $fields['expires_at'] = $expires_at === 'never' ? null : date('Y-m-d H:i:s',strtotime('+' . $expires_at));

        if(Auth::check()){
            $fields['user_id'] = Auth::id();
        }elseif ($fields['access_type'] === 'private'){
            $fields['access_type'] = 'unlisted';
        }

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
    public function update(Request $request, Paste $paste)
    {
        // todo протестировать проверку просроченности и принадлежности пользователю
        if($paste->isExpired()){
            abort(404);
        }elseif( !Auth::check() or Auth::id() !== $paste->user_id){
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required',
            'content' => 'required',
            'language' => 'required',
            'access_type' => 'required',
            'expires_at' => 'required',
        ]);

        $fields = [
            'name'  => $validated['name'],
            'access_type'  => $validated['access_type'],
            'language'  => $validated['language'],
            'content'  => $validated['content'],
        ];

        if($validated['expires_at'] !== 'nochng'){
            // добавляем это поле в $fields
            $expires_at = str_replace('-',' ',$validated['expires_at']);
            $fields['expires_at'] = $expires_at === 'never' ? null : date('Y-m-d H:i:s',strtotime('+' . $expires_at));
        }

//        if(Auth::check()){
//            $fields['user_id'] = Auth::id();
//        }elseif ($fields['access_type'] === 'private'){
//            $fields['access_type'] = 'unlisted';
//        }


        $paste->update($fields);

        return redirect()->route('show', [$paste->url_path])->with('success','Post updated successfully');



        // return view('edit',['paste' => $paste]);
        //dd($request->all());
        //$paste = Paste::where('url_path', $url)->first();
        //return $url.' метод пост'. $request. '<<<<<<>>>>>>>>>>'. dd($paste);

        #return 'Паста обновлена';

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
