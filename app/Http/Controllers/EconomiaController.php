<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EconomiaController extends Controller
{
    const BASE_URL = 'https://economia.awesomeapi.com.br/json';

    public function consultarCotacao($moedaA, $moedaB){
        return $this->get('/last/'.$moedaA.'-'.$moedaB);
    }

    public function pagamentoBoleto($valor){
        $valorBoleto = $valor + ( (1.37/100) * $valor);
        return $valorBoleto;        
    }

    public function pagamentoCartao($valor){
        $valorBoleto = $valor + ( (7.73/100) * $valor);
        return $valorBoleto;        
    }

    public function taxaConversao($valor){
        $valorTaxa = 0;
        if($valor < 3700.00){
            $valorTaxa = ( (2/100) * $valor );
        }else{
            $valorTaxa = ( (1/100) * $valor );    
        }
        return $valorTaxa;        
    }

    public function consultarUltimosFechamentos($moedaA, $moedaB, $dias = 1){
        return $this->get('/daily/'.$moedaA.'-'.$moedaB.'/'.$dias);
    }

    public function get($resource){
        
        $endpoint = self::BASE_URL.$resource;
        
        $curl = curl_init();
        
        curl_setopt_array($curl, [
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET'
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response,true);
    }

    public function form(Request $request){
        $moedaOrigem = $request->input('moedaOrigem', 'BRL');
        $moedaDestino = $request->input('moedaDestino');
        $valorCompra = $request->input('valor');
        $tipoPagamento = $request->input('pagamento');
        
        $dadosCotacao = $this->consultarCotacao($moedaOrigem,$moedaDestino);
            
        $taxaConversao = $this->taxaConversao($valorCompra);

        if($tipoPagamento == "boleto"){ 
            $valorParcial = $this->pagamentoBoleto($valorCompra);
        }
            
        if($tipoPagamento == "card"){
            $valorParcial = $this->pagamentoCartao($valorCompra);
        }

        $valorMoeda = (float) $dadosCotacao[$moedaOrigem.$moedaDestino]['bid'];
        $valorMoeda *= $valorCompra;
        $valorMoedaDestino = $valorCompra - $valorMoeda;
        $valorCotacao = (float) $dadosCotacao[$moedaOrigem.$moedaDestino]['bid'];
        $valorCotacao *= $valorCompra;
        $calculo = $valorCompra - ($valorParcial - $valorCompra) - $taxaConversao;
        
        $data = [
            'moedaOrigem' => $moedaOrigem,
            'moedaDestino' => $moedaDestino,
            'valorCompra' => $valorCompra,
            'tipoPagamento' => $tipoPagamento,
            'dadosCotacao' => $dadosCotacao,
            'taxaConversao' => $taxaConversao,
            'valorMoedaDestino' => $dadosCotacao[$moedaOrigem.$moedaDestino]['bid'],
            'valorCompraMoedaDestino' => $valorCotacao,
            'taxaPagamento' => $valorParcial - $valorCompra,
            'taxaConversao' => $taxaConversao,
            'valorUtilizadoComTaxa' => $calculo
        ];

        return view('resultado', $data);

        /*
        echo "<br><b>Parâmetros de entrada:</b>";
        echo "<br>Moeda de origem: BRL (default)";
        echo "<br>Moeda de destino: $moedaDestino";
        echo "<br>Valor para conversão: $valorCompra";
        echo "<br>Forma de pagamento: $tipoPagamento";

        echo "<hr>";
        
        echo "<br>";
        echo "<br><b>Parâmetros de saída:</b>";
        echo "<br>";
        echo "<br>Moeda de origem: BRL (default)";
        echo "<br>Moeda de destino: $moedaDestino";
        echo "<br>Valor para conversão: $valorCompra";
        echo "<br>Forma de pagamento: $tipoPagamento";
        echo '<br>Valor da "Moeda de destino" usado para conversão: $ '.$dadosCotacao[$moedaOrigem.$moedaDestino]['bid'];
        echo '<br>Valor comprado em "Moeda de destino": $ 921,03 (taxas aplicadas no valor de compra diminuindo no valor total de conversão) '.$valorCotacao;
            
        echo "<br>Taxa de pagamento:  ". $valorParcial - $valorCompra;
        echo "<br>Taxa de conversão:  $taxaConversao";
        
        echo "<br>Valor utilizado para conversão descontando as taxas: $calculo";
        */

    }
}
