<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthMiddleware {

    public function verifyToken($token){
        if(!$token)
            Flight::halt(401, "Missing authentication header");

        $decoded_token = JWT::decode($token, new Key(Config::JWT_SECRET(), 'HS256'));

        
        $user = json_decode(json_encode($decoded_token->user));

        if (!isset($user->role) && isset($decoded_token->role)) {
            $user->role = $decoded_token->role;
        }

        Flight::set('user', $user);
        Flight::set('jwt_token', $token);
        return TRUE;
    }

    public function authorizeRole($requiredRole) {
        $user = Flight::get('user');
        if ($user->role !== $requiredRole) {
            Flight::halt(403, 'Access denied: insufficient privileges');
        }
    }

    public function authorizeRoles($roles) {
        $user = Flight::get('user');
        if (!in_array($user->role, $roles)) {
            Flight::halt(403, 'Forbidden: role not allowed');
        }
    }

    function authorizePermission($permission) {
        $user = Flight::get('user');
        if (!in_array($permission, $user->permissions)) {
            Flight::halt(403, 'Access denied: permission missing');
        }
    }

    public function allowAdminOrSelf($targetId) {
        $user = Flight::get('user');

        if($user->role === Roles::ADMIN) {
            return true;
        }

        if($user->id == $targetId) {
            return true;
        }
        Flight::halt(403, 'Forbidden: permission missing');

        
    }


}