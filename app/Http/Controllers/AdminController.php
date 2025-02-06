<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    #region constants and helpers
    public const SCOPES = [
        "users" => [
            "label" => "Użytkownicy",
            "icon" => "account-multiple",
            "role" => "technical",
        ],
        "standard-pages" => [
            "label" => "Strony standardowe",
            "icon" => "script-text",
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
        return array_merge([
            "name" => [
                "type" => "text",
                "label" => "Nazwa",
                "icon" => "card-text",
            ],
            "visible" => [
                "type" => "select", "options" => self::VISIBILITIES,
                "label" => "Widoczny dla",
                "icon" => "eye",
            ],
            "order" => [
                "type" => "number",
                "label" => "Wymuś kolejność",
                "icon" => "order-numeric-ascending",
            ],
        ], $modelName::FIELDS);
    }
    #endregion

    public function listModel(string $scope): View
    {
        $modelName = $this->getModelName($scope);
        $meta = self::SCOPES[$scope];
        $data = $modelName::forAdminList()
            ->paginate(25);

        return view("admin.list-model", compact("data", "meta", "scope"));
    }

    public function editModel(string $scope, ?int $id = null): View
    {
        $modelName = $this->getModelName($scope);
        $meta = self::SCOPES[$scope];
        $data = $modelName::find($id);
        $fields = $this->getFields($scope);

        return view("admin.edit-model", compact("data", "meta", "scope", "fields"));
    }

    public function processEditModel(Request $rq, string $scope): RedirectResponse
    {
        $modelName = $this->getModelName($scope);

        if ($rq->input("method") == "save") {
            $model = $modelName::updateOrCreate(
                ["id" => $rq->id],
                $rq->except(["_token", "method"])
            );
            return redirect()->route("admin-edit-model", ["model" => $scope, "id" => $model->id])
                ->with("success", "Zapisano");
        } else if ($rq->input("method") == "delete") {
            $modelName::destroy($rq->id);
            return redirect()->route("admin-list-model", ["model" => $scope])
                ->with("success", "Usunieto");
        }
    }
}
