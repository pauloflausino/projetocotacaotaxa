@extends('layouts.master')

@section('title', 'Cotações')

@section('content')

<div class="container">
<form method="post" action="formulario/cotacao" onsubmit="return checkForm()">
    @csrf
        <div class="mb-3">
            <label>Moeda de Origem:</label>
            <select name="moedaOrigem" id="moedaOrigem" disabled>
                <option value="BRL" selected>BRL</option>
                <option value="USD">USD</option>
                <option value="EUR">EUR</option>
            </select><br />
        </div>

        <div class="mb-3">

            <label>Moeda de Destino:</label>
            <select name="moedaDestino" id="moedaDestino">
                <option value="BRL">BRL</option>
                <option value="USD" selected>USD</option>
                <option value="EUR">EUR</option>
            </select><br />
        </div>

        <div class="mb-3">
        <label>Valor para conversão:</label>
        <input type="text" name="valor" id="valor" /><br />
        </div>
        
        <div class="mb-3">
        <label>Forma de pagamento:</label>
        <select name="pagamento" id="pagamento">
            <option value="boleto">Boleto</option>
            <option value="card">Cartão de Crédito</option>
        </select><br />
        </div>

        <div class="mb-3">
            <input type="submit" value="Enviar">
        </div>



    </form>
</div>    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="{{ URL::asset('assets/js/js.js')}}"></script>

@endsection
