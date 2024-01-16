<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EmailController extends Controller
{
    protected $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function validateEmail(Request $request)
    {
        try {
            // Obtendo o e-mail do request
            $email = $request->input('email');

            // Chamando o serviço para validar e salvar o e-mail
            $this->emailService->validateAndSaveEmail($email);

            // Retornando uma resposta JSON indicando sucesso
            return response()->json(['message' => 'E-mail validado com sucesso']);
        } catch (ValidationException $e) {
            // Capturando exceções de validação
            return response()->json(['message' => 'Erro de validação', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            // Capturando outras exceções
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }
}
