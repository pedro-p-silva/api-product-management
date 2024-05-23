<?php

namespace App\Helpers;

use  Illuminate\Http\JsonResponse;

class HelperMessages
{
    public static function msgNumericId(): JsonResponse
    {
        return self::structureMessage('error', 'O id deve ser numérico!');
    }

    public static function msgUniqueValue($param): JsonResponse
    {
        return self::structureMessage('error', "O valor '$param', é unico, e não pode ser novamente utilizado!");
    }

    public static function msgRegisterNotFound($param): JsonResponse
    {
        return self::structureMessage('alert', "Nenhum registro encontrado para o id: $param.");
    }

    public static function msgRegistrationNotComplete(): JsonResponse
    {
        return self::structureMessage('alert', "O cadastro não foi concluído!");
    }

    public static function msgDataHasNotBeenAltered(): JsonResponse
    {
        return self::structureMessage('alert', "Os dados não foram alterados!");
    }

    public static function msgNoPermissionChangeEmailOrPassword(): JsonResponse
    {
        return self::structureMessage(
            'alert',
            "Sem permissão para alterar o email e senha. Contate o ADM do sistema!");
    }

    public static function msgDataHasBeenChanged(): JsonResponse
    {
        return self::structureMessage('success', "Os dados foram alterados!");
    }

    public static function msgRegistrationRemoved($param): JsonResponse
    {
        return self::structureMessage('success', "O registro de id: $param, foi removido!");
    }

    public static function msgDatabaseExceptions(): JsonResponse
    {
        return self::structureMessage(
            'exception',
            "Foi encontrada uma exceção na base de dados. Se persistir, contate o ADM do sistema.");
    }

    private static function structureMessage($status, $message): JsonResponse
    {
        $response = response()->json([$status => $message]);
        $response->header('charset', 'utf-8');

        return $response;
    }
}
