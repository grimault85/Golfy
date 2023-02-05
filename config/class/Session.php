<?php

declare(strict_types=1);

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

    public static function init(string $nom, string $email, int $role): void
    {
        $_SESSION['user'] = [
            'name'  => $nom,
            'email' => $email,
            'role' => $role
        ];
    }

    public static function isConnected(): bool
    {
        return isset($_SESSION['user']) ?? false;
    }

    public static function getLogged(): bool|array
    {
        // il faut utiliser 'self' ou le nom de la classe elle-même, ici 'Session' devant l'opérateur
        return self::isConnected() ? $_SESSION['user'] : false;
    }

    public static function get(): bool|array
    {
        // il faut utiliser 'self' ou le nom de la classe elle-même, ici 'Session' devant l'opérateur
        return self::isConnected() ? $_SESSION['email'] : false;
    }

    public static function isAdmin(): bool
    {
        // il faut utiliser 'self' ou le nom de la classe elle-même, ici 'Session' devant l'opérateur
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
}
