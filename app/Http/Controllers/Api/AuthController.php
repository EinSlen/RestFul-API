<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use OpenApi\Attributes as OA;

class AuthController extends Controller {
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Authentifier un utilisateur et renvoyer un jeton JWT.
     */
    #[OA\Post(
        path: "/login",
        operationId: "login",
        description: "Authentifier un utilisateur et renvoyer un jeton JWT.",
        tags: ["Authentification"],
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "email", type: "string"),
                    new OA\Property(property: "password", type: "string"),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200,
                description: "Connexion réussie",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "status", type: "string"),
                        new OA\Property(property: "user", ref: "/App/Models/User", type: "object"),
                        new OA\Property(property: "authorization", type: "object", properties: [
                            new OA\Property(property: "token", type: "string"),
                            new OA\Property(property: "type", type: "string"),
                        ]),
                    ]
                )
            ),
            new OA\Response(response: 401, description: "Non autorisé",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "status", type: "string"),
                        new OA\Property(property: "message", type: "string"),
                    ]
                )
            ),
        ]
    )]
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Non autorisé',
            ], 401);
        }

        $user = Auth::user();
        $token = auth()->tokenById($user->id);
        return response()->json(['status' => 'success',
            'user' => $user,
            'authorization' => ['token' => $token,
                'type' => 'bearer',]]);
    }

    /**
     * Enregistrer un nouvel utilisateur et renvoyer un jeton JWT.
     */
    #[OA\Post(
        path: "/register",
        operationId: "register",
        description: "Enregistrer un nouvel utilisateur et renvoyer un jeton JWT.",
        tags: ["Authentification"],
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "name", type: "string"),
                    new OA\Property(property: "email", type: "string"),
                    new OA\Property(property: "password", type: "string"),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200,
                description: "Utilisateur créé avec succès",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "status", type: "string"),
                        new OA\Property(property: "message", type: "string"),
                        new OA\Property(property: "user", ref: "/App/Models/User", type: "object"),
                        new OA\Property(property: "authorization", type: "object", properties: [
                            new OA\Property(property: "token", type: "string"),
                            new OA\Property(property: "type", type: "string"),
                        ]),
                    ]
                )
            ),
            new OA\Response(response: 422, description: "Erreur de validation",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "status", type: "string"),
                        new OA\Property(property: "message", type: "string"),
                        new OA\Property(property: "errors", type: "object"),
                    ]
                )
            ),
        ]
    )]
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'Utilisateur créé avec succès',
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    /**
     * Déconnecter l'utilisateur authentifié.
     */
    #[OA\Post(
        path: "/logout",
        operationId: "logout",
        description: "Déconnecter l'utilisateur authentifié.",
        tags: ["Authentification"],
        security: [["bearerAuth" => []],],
        responses: [
            new OA\Response(response: 200,
                description: "Déconnexion réussie",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "status", type: "string"),
                        new OA\Property(property: "message", type: "string"),
                    ]
                )
            ),
        ]
    )]
    public function logout() {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Déconnexion réussie',
        ]);
    }

    /**
     * Rafraîchir le jeton JWT pour l'utilisateur authentifié.
     */
    #[OA\Post(
        path: "/refresh",
        operationId: "refresh",
        description: "Rafraîchir le jeton JWT pour l'utilisateur authentifié.",
        tags: ["Authentification"],
        security: [["bearerAuth" => []],],
        responses: [
            new OA\Response(response: 200,
                description: "Jeton rafraîchi avec succès",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "status", type: "string"),
                        new OA\Property(property: "user", ref: "/App/Models/User", type: "object"),
                        new OA\Property(property: "authorization", type: "object", properties: [
                            new OA\Property(property: "token", type: "string"),
                            new OA\Property(property: "type", type: "string"),
                        ]),
                    ]
                )
            ),
        ]
    )]
    public function refresh() {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorization' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}
