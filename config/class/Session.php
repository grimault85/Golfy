<?php

declare(strict_types=1);
require './model/class/PostModel.php';
/**
 * Classe représentant la session php $_SESSION
 *
 * liste de fonctionnalitées :
 *      - start(): void // Démarrage de la session, afin de pouvoir l'utiliser
 *      - destroy(): void // Destruction de la session, afin de déconnecter le user
 *      - init(id, nom, email, ... (role) ): void // Remplissage de la session avec les infos du user
 *      - isConnected(): bool // méthode retournerai un booléen pour dire si oui ou non quelqu'un est connecté
 *      - getLogged(): array // méthode retournerai les infos du user connecté
 *
 * Usage de l'opérateur static '::'
 * Pour utiliser des props ou méthodes static au sein de la class elle-même
 */
class Session
{
    public static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function destroy(): void
    {
        $_SESSION['user'] = [];
        unset($_SESSION['user']);
    }

    public static function init(int $user_id, string $nom, string $email, int $role): void
    {
        $_SESSION['user'] = [
            'id' => $user_id,
            'name'  => $nom,
            'email' => $email,
            'role' => $role
        ];
    }

    public static function isConnected(): bool
    {
        return isset($_SESSION['user']) ?? false;
    }

    public static function getId(): bool|int
    {
        return self::isConnected() ? $_SESSION['user']['id'] : false;
    }

    public static function getName(): bool|string
    {
        return self::isConnected() ? $_SESSION['user']['name'] : false;
    }

    public static function getEmail(): bool|string
    {
        return self::isConnected() ? $_SESSION['user']['email'] : false;
    }

    public static function isAdmin(): bool
    {
        return self::isConnected() && $_SESSION['user']['role'] === 1 ? true : false;
    }

    public static function setError(string $error = null): void
    {
        $_SESSION['error'] = $error;
    }

    public static function getError(): ?string
    {
        return isset($_SESSION['error']) ? $_SESSION['error'] : null;
    }

    public static function isRegistered(): bool
    {

        return isset($_SESSION['registered']) ? true : false;
    }

    public static function isPosted(): bool
    {

        return isset($_SESSION['posted']) ? true : false;
    }
}
