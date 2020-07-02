<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\Operation;
use Illuminate\Database\Eloquent\Model;

class StopConcurrentOperations
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param Model|null $model
     * @return mixed
     */
    public function handle($request, Closure $next, $model = null)
    {
        $modelId = current($request->route()->parameters()) ? current($request->route()->parameters()) : $request->id;
        if (auth()->check() && !empty($modelId) && $model != null) {

            if ($modelId instanceof Model)
                $modelId = $modelId->id ?? $modelId->admin_id;

            $modelInstance = resolve($model)->find($modelId);

            if ($modelInstance) {
                $activity = Operation::firstOrNew([
                    "modelable_id" => $modelId,
                    "modelable_type" => get_class($modelInstance),
                ]);
                if ($activity->is_editing && $activity->updated_at->diffInMinutes(Carbon::now()) < 15 && $activity->edit_by != auth()->id()) {
                    session()->flash("error", "Derzeit bearbeitet ein anderer Nutzer diese Seite. Sie können die Seite lediglich ansehen, aber nicht speichern.");
                    if (in_array($request->method(), ["POST", "PUT", "PATCH"]))
                        return redirect()->back();
                } else {
                    $activity->is_editing = true;
                    $activity->edit_by = auth()->id();
                    $activity->save();
                }
            }
        }
        return $next($request);
    }
}
