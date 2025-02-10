<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    #region constants and helpers
    public const SCOPES = [
        "users" => [
            "model" => \App\Models\User::class,
            "role" => "technical",
        ],
        "standard-pages" => [
            "model" => \App\Models\StandardPage::class,
            "role" => "technical",
        ],
    ];

    public const VISIBILITIES = [
        0 => "nikt",
        1 => "zalogowani",
        2 => "wszyscy",
    ];

    private function getModelName(string $scope): string
    {
        return "App\\Models\\".(Str::of($scope)->singular()->studly()->toString());
    }

    private function getFields(string $scope): array
    {
        $modelName = $this->getModelName($scope);
        return array_merge(array_filter([
            "name" => [
                "type" => "text",
                "label" => "Nazwa",
                "icon" => "card-text",
            ],
            "visible" => in_array($scope, ["users"]) ? null : [
                "type" => "select", "options" => self::VISIBILITIES,
                "label" => "Widoczny dla",
                "icon" => "eye",
            ],
            "order" => in_array($scope, ["users"]) ? null : [
                "type" => "number",
                "label" => "Wymuś kolejność",
                "icon" => "order-numeric-ascending",
            ],
        ]), $modelName::FIELDS);
    }

    private function getConnections(string $scope): array
    {
        $modelName = $this->getModelName($scope);
        return array_filter(array_merge(
            defined($modelName."::CONNECTIONS") ? $modelName::CONNECTIONS : null,
        ));
    }
    #endregion

    public function listModel(string $scope): View
    {
        if (!User::hasRole(self::SCOPES[$scope]["role"])) abort(403);

        $modelName = $this->getModelName($scope);
        $meta = array_merge(self::SCOPES[$scope], $modelName::META);
        $data = $modelName::forAdminList()
            ->paginate(25);

        return view("admin.list-model", compact("data", "meta", "scope"));
    }

    public function editModel(string $scope, ?int $id = null): View
    {
        if (!User::hasRole(self::SCOPES[$scope]["role"])) abort(403);

        $modelName = $this->getModelName($scope);
        $meta = array_merge(self::SCOPES[$scope], $modelName::META);
        $data = $modelName::find($id);
        $fields = $this->getFields($scope);
        $connections = $this->getConnections($scope);

        return view("admin.edit-model", compact("data", "meta", "scope", "fields", "connections"));
    }

    public function processEditModel(Request $rq, string $scope): RedirectResponse
    {
        if (!User::hasRole(self::SCOPES[$scope]["role"])) abort(403);

        $modelName = $this->getModelName($scope);
        $fields = $this->getFields($scope);
        $data = $rq->except("_token", "_connections", "method");
        foreach ($fields as $name => $fdata) {
            if ($fdata["type"] == "checkbox") $data[$name] ??= false;
        }

        if ($rq->input("method") == "save") {
            $model = $modelName::updateOrCreate(
                ["id" => $rq->id],
                $data,
            );

            if ($rq->has("_connections")) {
                foreach ($rq->get("_connections") as $connection) {
                    $model->{$connection}()->sync($rq->get($connection));
                }
            }

            return redirect()->route("admin-edit-model", ["model" => $scope, "id" => $model->id])
                ->with("success", "Zapisano");
        } else if ($rq->input("method") == "delete") {
            $modelName::destroy($rq->id);
            return redirect()->route("admin-list-model", ["model" => $scope])
                ->with("success", "Usunieto");
        }
    }
}
