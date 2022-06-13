<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CrowdinAPIController extends Controller
{
    public function manifest(): array
    {
        return [
            "identifier" => "arrays-demo-yhorodyskyy-2022",
            "name" => "Array sorters (Demo)",
            "description" => "Generates and sorts 2d arrays",
            "baseUrl" => env("CROWDIN_MANIFEST_BASEURL"),
            "logo" => "/app-logo.jpeg",
            "authentication" => [
                "type" => "authorization_code",
                "clientId" => env("CROWDIN_MANIFEST_CLIENTID")
            ],
            "events" => [
                "installed" => "/api/install"
            ],
            "scopes" => [
                "project"
            ],
            "modules" => [
                "project-tools" => [
                    [
                        "key" => "your-module-key",
                        "name" => "Demo App",
                        "description" => "Demo app description",
                        "logo" => "/app-logo.jpeg",
                        "url" => "/",
                        "environments" => [
                            "crowdin"
                        ]
                    ]
                ]
            ]
        ];
    }

    public function install(): array
    {
        return ['success' => true];
    }

    public function uninstall(): array
    {
        return ['success' => true];
    }
}
