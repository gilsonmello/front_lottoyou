<template>
    <div class="row">
        <div class="col-lg-12">
            <h6 class="choice-payment-method-msg">
                Você escolheu Agente de Pagamento como forma de pagamento (Válido só no Brasil)
            </h6>
            <h5>
            </h5>

            <table class="table table-hover table-striped table-responsive">
                <thead class="thead-dark">
                    <th class="text-left" colspan="2">Grupo Compre Segundo</th>
                </thead>
                <tbody>
                <tr style="border: none;">
                    <td>{{ trans('strings.name') }}</td>
                    <td>Grupo Compre Segundo</td>
                </tr>
                <tr>
                    <td>{{ trans('strings.coin') }}</td>
                    <td>USD</td>
                </tr>
                <tr>
                    <td>Retirada Mín/Máxima</td>
                    <td>10 / 2000</td>
                </tr>
                <tr>
                    <td>Resumo</td>
                    <td>Transferências Bancárias</td>
                </tr>
                <tr>
                    <td>Comissão sobre depósitos</td>
                    <td>1,99%</td>
                </tr>
                <tr>
                    <td>Comissão sobre retiradas</td>
                    <td>1,99%</td>
                </tr>
                <tr>
                    <td>{{ trans('strings.email') }}</td>
                    <td>george_1@hotmail.com.br</td>
                </tr>
                <tr>
                    <td>{{ trans('strings.phone') }}</td>
                    <td>+55 71 988229457</td>
                </tr>
                <tr>
                    <td>Outras informações</td>
                    <td>
                        Somos uma plataforma de pagamentos e transferência online,<br>
                        trabalhamos com: Depósitos Bancários, transferências bancárias e Bitcoin
                    </td>
                </tr>
                </tbody>
            </table>
            <br>
            <h6><strong>O que é um Agente de Pagamento?</strong></h6>
            <h6 style="text-align: justify">
                Um agente de pagamentos atua como um intermediário entre os clientes e a Lottoyou.bet. O agente de pagamentos processa depósitos e retiradas para os clientes que desejam usar métodos específicos de dinheiro eletrônico ou moedas locais não oferecidos pela Lottoyou.bet.
            </h6>

            <br>
            <h6>
                Passos:
            </h6>

            <ol>
                <li>
                    Entre em contato com o agente de pagamento disponível da sua região.
                </li>
                <li>
                    Escolha o método de pagamento que você prefere usar e envie os seus fundos ao agente de pagamento.
                </li>
                <li>
                    Encaminhar o comprovante de transferência para o agente de pagamentos.
                </li>
                <li>
                    Após confirmação o valor liquido será creditado na conta Lottoyou.bet.
                </li>
            </ol>
            <h6>
                Este processo pode demorar até 24 horas após a confirmação do valor na conta do agente de pagamento.
            </h6>
            <br>
            <h6>
                <strong>
                    Importante salientar que as taxas de transferência são arcadas pelo cliente.
                </strong>
            </h6>
            <br>
            <h6>
                <strong>
                    Por que os clientes escolhem usar agentes de pagamentos?
                </strong>
            </h6>
            <ul>
                <li>
                    Aceitar transferências bancárias locais sem necessidade de ter cartão de crédito.
                </li>
                <li>
                    Evite a necessidade de ter carteiras ou contas eletrônicas.
                </li>
                <li>
                    Permite que clientes depositem valores mais baixos (através da moeda local).
                </li>
                <li>
                    É rápido e seguro
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: "VcAgent"
    }
</script>

<style scoped>
    .choice-payment-method-msg {
        background-color: #EFEFEF;
        padding: 15px;
        font-size: 17px;
        display: inline-block;
        width: 100%;
        -webkit-transition: background-color 0.5s ease;
        -moz-transition: background-color 0.5s ease;
        -o-transition: background-color 0.5s ease;
        transition: background-color 0.5s ease;
    }
</style>