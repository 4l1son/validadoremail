<?php

// app/Services/EmailService.php

namespace App\Http\Services;

use App\Models\EmailModel;
use Illuminate\Validation\ValidationException;

class EmailService
{
    public function validateAndSaveEmail($email)
    {
        try {
            // Validação do E-mail
            $this->validateEmail($email);

            // Criando um novo modelo de e-mail
            $emailModel = new EmailModel(['email' => $email]);

            // Salvando o modelo no banco de dados
            $emailModel->save();

            return true; // Sucesso
        } catch (ValidationException $e) {
            // Capturando exceções de validação
            throw $e;
        } catch (\Exception $e) {
            // Capturando outras exceções
            throw new \Exception('Erro interno no servidor', 500);
        }
    }

    protected function validateEmail($email)
    {
        // Validação do E-mail
        validator(['email' => $email], [
            'email' => 'required|email|regex:/@/|not_regex:/,/',
        ])->validate();
    }
}
