@extends('layouts.app')

@php
    setlocale(LC_TIME, 'pt_BR.UTF-8');
@endphp

@section('content')
    <div class="container">
        <header>
            <h2>SECRETARIA MUNICIPAL DE SAÚDE</h2>
            <h2>DIRETORIA DE VIGILÂNCIA DA SAÚDE</h2>
            <h2>COORDENAÇÃO DE VIGILÂNCIA SANITÁRIA</h2>
        </header>
        <section class="dados-empresa">
            <table>
                <tr>
                    <td colspan="2"><strong>Razão Social:</strong> {{ $service?->getEstablishment()->getCompanyName() }} </td>
                    <td colspan="2"><strong>Nome Fantasia:</strong> {{ $service?->getEstablishment()->getTradeName() }} </td>
                </tr>
                <tr>
                    <td><strong>CPF/CNPJ:</strong> {{ $service?->getEstablishment()->getDocument() }} </td>
                    <td><strong>CGA:</strong> {{ $service?->getEstablishment()->getCga() }} </td>
                    <td><strong>Validade:</strong> 20/02/2022 </td>
                    <td><strong>Exercício Fiscal:</strong> {{ $service?->getEstablishment()->getUnitAddressEntity()->getStreet() }}</td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Endereço:</strong> {{ $service?->getEstablishment()->getUnitAddressEntity()->getStreet() }}
                    </td>
                    <td colspan="2"><strong>Bairro:</strong> {{ $service?->getEstablishment()->getUnitAddressEntity()->getNeighborhood() }} </td>
                </tr>
            </table>
        </section>

        <section class="declaracao">
            <h2>
                DECLARAÇÃO DE DISPENSA DE ATO PÚBLICO - ATIVIDADE(S) BAIXO RISCO A
            </h2>
            <p>
                Fica (m) dispensado (s) de Licença Sanitária, de acordo com o Decreto
                nº 32.636 de 30 de julho de 2020, Art. 2º, Inciso III, Resolução CGSIM
                nº 57/2020, Art. 2º, Inciso I, ou outra (s) que venha (m) substituí-lo
                (s), os quais estabelecem a classificação de risco das atividades
                econômicas e instituem que as atividades classificadas como "baixo
                risco A" e estão dispensadas do ato público de liberação e não
                comportam vistoria prévia para o exercício pleno e regular da
                atividade econômica.

                Em conformidade com o Decreto nº 32.636, Art. 6º, § 3º, a fiscalização
                deverá ser realizada posteriormente pelo órgão competente e o § 4º A
                dispensa do ato público de liberação não desobriga o empresário ou
                pessoa jurídica do cadastro tributário e do respectivo pagamento das
                taxas municipais devidas em razão do exercício da atividade econômica,
                nos termos do Código Tributário Municipal.
            </p>
        </section>

        <section class="atividades">
            <h3>ATIVIDADES(S) ECONÔMICA(S) AUTORIZADA(S):</h3>
            @foreach($service?->getEstablishment()->getActivities() as $activity)
            <p>
                {{$activity?->getDescription()}}
            </p>
            @endforeach
        </section>

        <footer>
            <p>Salvador-BA, {{ $date }}</p>
            <p>Coordenador</p>
            <div class="notas">
                <p>
                    * Base Legal RDC ANVISA nº 153/2017 – artigo 10, parágrafo 4º e a
                    sua Instrução Normativa nº 66/2020 ou outra que venha a substituir.
                </p>
                <img src="{{ url($service?->getQrPath()) }}" alt="QrCode que direciona para o certificado de autenticidade"/>
            </div>
        </footer>
    </div>
@endsection
