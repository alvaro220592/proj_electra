<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Guzzle\Exception\GuzzleException;



class ApiController extends Controller
{
    public function token(){
        try {
            
            // criação do objeto cliente
            $guzzle = new Client([
                'headers' => [
                    'gw-dev-app-key' => config('apiCobranca.gw_dev_app_key'),
                    'Authorization' => config('apiCobranca.authorization'),
                    'content-type' => 'application/x-www-form-undercoded',
                ],

                // desativando SSL
                'verify' => false
            ]);

            // Requisição POST
            $response = $guzzle->request('POST', 'https://oauth.sandbox.bb.com.br/oauth/token?gw_dev_app_key=' . config('apiCobranca.gw_dev_app_key'),
            array(
                'form_params' => array(
                    'grant_type' => 'client_credentials',
                    'client_id' => config('apiCobranca.client_id'),
                    'client_secret' => config('apiCobranca.client_secret'),
                    'scope' => 'cobrancas.boletos-info cobrancas.boletos-requisicao'
                )));

            // Recuperar corpo da resposta da requisição
            $body = $response->getBody();

            // acessar os dados da resposta - Json
            $contents = $body->getContents();

            // converte json em array associativo
            $token = json_decode($contents);

            return $token->access_token;


        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function registrar(){
        /* Informações do Boleto */
        $body = array(
            'numeroConvenio' => 3128557,
            'numeroCarteira' => 17,
            'numeroVariacaoCarteira' => 35,
            'codigoModalidade' => 1,
            //'dataEmissao' => '09.02.2021',
            'dataEmissao' => date('d.m.Y', strtotime('now')),
            //'dataVencimento' => '12.02.2021',
            'dataVencimento' => date('d.m.Y', strtotime('+7 days', strtotime('now'))),
            'valorOriginal' => 123.50,
            'valorAbatimento' => 0,
            'quantidadeDiasProtesto' => 0,
            'indicadorNumeroDiasLimiteRecebimento' => 'N',
            'numeroDiasLimiteRecebimento' => 0,
            'codigoAceite' => 'A',
            'codigoTipoTitulo' => 4,
            'descricaoTipoTitulo' => 'DS',
            'indicadorPermissaoRecebimentoParcial' => 'N',
            'numeroTituloBeneficiario' => '000101',
            'textoCampoUtilizacaoBeneficiario' => 'TESTE',
            'codigoTipoContaCaucao' => 0,
            'numeroTituloCliente' => '00031285579999990099',
            'textoMensagemBloquetoOcorrencia' => 'TESTE',
            'pagador' => array(
                'tipoRegistro' => 1,
                'numeroRegistro' => 71128590182,
                'nome' => 'Teste',
                'endereco' => 'Endereco',
                'cep' => 70675727,
                'cidade' => 'Sao Oaulo',
                'bairro' => 'Centro',
                'uf' => 'SP',
                'telefone' => '999939669'
            ),
            'email' => 'cliente@email.com'
        );

		/* Converte array em json */
        $body = json_encode($body);

        dd($body);

        try {
            $guzzle = new Client([
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token(),
                    'Content-Type' => 'application/json',
                ],
                'verify' => false
            ]);

         
            /* Requisição */
            $response = $guzzle->request('POST', 'https://api.hm.bb.com.br/cobrancas/v1/boletos?gw-dev-app-key='. config('apiCobranca.gw_dev_app_key'),
                [
                    'body' => $body
                ]
            );

            /* Recuperar o corpo da resposta da requisição */
            $body = $response->getBody();

            /* Acessar as dados da resposta - JSON */
            $contents = $body->getContents();

            /* Conveter o JSON em array associativo PHP */
            $boleto = json_decode($contents);

            dd($boleto);

        } catch (\Exception $e) {
           echo $e->getMessage();
        }
    }

    public function listar(){
        
    }

    public function consultar(){
        
    }

    public function baixar(){
        
    }

    public function atualizar(){
        
    }
}
