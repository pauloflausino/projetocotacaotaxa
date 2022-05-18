<form method="post" action="formulario/cotacao">
    @csrf
        <label>Moeda de Origem:</label>
        <select name="moedaOrigem" id="moedaOrigem">
            <option value="BRL" selected>BRL</option>
            <option value="USD">USD</option>
            <option value="EUR">EUR</option>
        </select><br />

        <label>Moeda de Destino:</label>
        <select name="moedaDestino" id="moedaDestino">
            <option value="BRL">BRL</option>
            <option value="USD" selected>USD</option>
            <option value="EUR">EUR</option>
        </select><br />

        <label>Valor para conversão:</label>
        <input type="text" name="valor" id="valor" /><br />

        <label>Forma de pagamento:</label>
        <select name="pagamento" id="pagamento">
            <option value="boleto">Boleto</option>
            <option value="card">Cartão de Crédito</option>
        </select><br />

        <input type="submit" value="Enviar">




    </form>