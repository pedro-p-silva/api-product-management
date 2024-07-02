<?php

namespace App\Helpers;

use  Illuminate\Http\JsonResponse;

class HelperMessages
{
    public static function msgNumericId(): JsonResponse
    {
        return self::structureMessage('message', 'O id deve ser numérico!', 404);
    }

    public static function msgUniqueValue($param): JsonResponse
    {
        return self::structureMessage('message', "O valor '$param', é unico, e não pode ser novamente utilizado!");
    }

    public static function msgRegisterNotFound($param): JsonResponse
    {
        return self::structureMessage('message', "Nenhum registro encontrado para o id: $param.", 404);
    }

    public static function msgRegistrationNotComplete(): JsonResponse
    {
        return self::structureMessage('message', "O cadastro não foi concluído!");
    }

    public static function msgDataHasNotBeenAltered(): JsonResponse
    {
        return self::structureMessage('message', "Os dados não foram alterados!", 200);
    }

    public static function msgNoPermissionChangeEmailOrPassword(): JsonResponse
    {
        return self::structureMessage(
            'message',
            "Sem permissão para alterar o email e senha. Só é permitido alterar o e-mail e senha do usuário que gerou o token atual.", 200);
    }

    public static function msgDataHasBeenChanged(): JsonResponse
    {
        return self::structureMessage('message', "Os dados foram alterados!", 200);
    }

    public static function msgRegistrationRemoved($param): JsonResponse
    {
        return self::structureMessage('message', "O registro de id: $param, foi removido!", 200);
    }

    public static function msgDatabaseExceptions(): JsonResponse
    {
        return self::structureMessage(
            'exception',
            "Foi encontrada uma exceção na base de dados. Se persistir, contate o ADM do sistema.");
    }

    private static function structureMessage($status, $message, $statusHttp = null): JsonResponse
    {
        $response = response()->json([$status => $message], $statusHttp);
        $response->header('charset', 'utf-8');

        return $response;
    }
}
