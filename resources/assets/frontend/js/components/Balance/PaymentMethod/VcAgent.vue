<template>
    <div class="row">
        <div class="col-lg-12">
            <h4 class="choice-payment-method-msg">
                Você escolheu Agente de Pagamento como forma de pagamento (Válido só no Brasil)
            </h4>

            <h6><strong>O que é um Agente de Pagamento?</strong></h6>
            <h6 style="text-align: justify">
                Um agente de pagamentos atua como um intermediário entre os clientes e a Lottoyou.bet. O agente de pagamentos processa depósitos e retiradas para os clientes que desejam usar métodos específicos de dinheiro eletrônico ou moedas locais não oferecidos pela Lottoyou.bet.
            </h6>

            <br>
            <h6>
                <strong>Passos para realizar o pagamento:</strong>
            </h6>

            <ol>
                <li>
                    Selecionar o país onde será realizado o pagamento;
                </li>
                <li>
                    Entrar em contato com o agente de pagamento disponível da sua região
                </li>
                <li>
                    Realizar o depósito na conta do agente de pagamentos.
                </li>
                <li>
                    Encaminhar o comprovante de transferência para o e-mail: contato@lottoyou.bet
                </li>
                <li>
                    Após confirmação o valor será creditado na conta Lottoyou.bet
                </li>
            </ol>
            <h6>
                Este processo pode demorar até 3 horas após a transferência.
            </h6>
            <h6>
                <strong>
                    Importante salientar que as taxas de transferência são arcadas pelo cliente.
                </strong>
            </h6>
            <br>
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
                    É rápido e seguro.
                </li>
            </ul>
            <br>
            <table class="table table-hover table-striped table-responsive">
                <tbody>
                    <tr style="border: none;">
                        <td>{{ trans('strings.name') }}</td>
                        <td>George Telles</td>
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
        </div>
    </div>
</template>

<script>
    export default {
        name: "VcAgent"
    }
</script>

<style scoped>

</style>