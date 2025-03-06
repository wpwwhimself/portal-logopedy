<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Setting;
use App\Models\StandardPage;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Illuminate\Support\Str;

class FrontController extends Controller
{
    public function index()
    {
        return view("main");
    }

    public function standardPage(string $slug): View
    {
        $page = StandardPage::visible()->get()
            ->firstWhere(fn ($page) => $page->slug == $slug);
        if (!$page) abort(404);

        return view("standard-page", compact("page"));
    }

    #region list & search
    public function list(string $model_name, Request $rq): View
    {
        if (in_array($model_name, ["specialists", "films"])) return view("errors.under-construction");

        $model = "App\\Models\\" . Str::of($model_name)->studly()->singular();
        $data = $model::visible(false)
            ->where(function ($q) use ($model, $rq) {
                // search query
                foreach ($model::queryableFields() as $field) {
                    $q = $q->orWhere($field, "like", "%{$rq->q}%");
                }
                return $q;
            })
            ->get();

        // filtering
        foreach ($rq->except(["q", "sort", "page"]) as $filter => $value) {
            $flt_data = $model::FILTERS[$filter];

            $data = $data->filter(function ($item) use ($flt_data, $value) {
                switch ($flt_data["operator"] ?? "=") {
                    case ">=": return $item->discr($flt_data) >= $value;
                    case ">": return $item->discr($flt_data) > $value;
                    case "any": return count(array_intersect(collect($item->discr($flt_data))->toArray(), $value)) > 0;
                    case "all": return count(array_intersect(collect($item->discr($flt_data))->toArray(), $value)) == count($value);
                    default: return $item->discr($flt_data) == $value;
                }
            });
        }

        // sorting
        $default_sort = "-updated_at";
        $sort_direction = ($rq->get("sort", $default_sort)[0] == "-") ? "desc" : "asc";
        $sort_field = Str::after($rq->get("sort", $default_sort), "-");

        $data = $data->sort(fn ($a, $b) => ($sort_direction == "asc")
            ? $a->discr($model::getSorts()[$sort_field]) <=> $b->discr($model::getSorts()[$sort_field])
            : $b->discr($model::getSorts()[$sort_field]) <=> $a->discr($model::getSorts()[$sort_field])
        );

        $data = new LengthAwarePaginator(
            $data->slice(($rq->get("page", 1) - 1) * 25, 25),
            $data->count(),
            25,
            $rq->get("page", 1)
        );
        $data->withPath($model_name)
            ->appends($rq->all());

        return view("pages.$model_name.list", compact(
            "data",
        ));
    }
    #endregion

    #region view models
    public function view(string $model_name, int $id): View
    {
        $model = "App\\Models\\" . Str::of($model_name)->studly()->singular();
        $data = $model::find($id);

        return view("pages.".Str::of($model_name)->plural().".view", compact(
            "data",
        ));
    }
    #endregion
}
