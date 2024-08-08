<template>
    <div>
        <nav class="navbar navbar-expand-lg bg-success text-white">
            <h2 class="m-2">Agendar Mensagem WhatsApp</h2>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card mt-5">
                        <div class="card-body">
                            <form @submit.prevent="agendarMensagem">
                                <div>
                                    <label>Número do WhatsApp:</label>
                                    <input v-model="numero" class="form-control" type="text" required />
                                </div>
                                <div class="mt-3">
                                    <label>Mensagem:</label>
                                    <textarea v-model="mensagem" class="form-control" required></textarea>
                                </div>
                                <div class="mt-3 mb-3">
                                    <label>Horário de Envio:</label>
                                    <input v-model="horarioEnvio" class="form-control" type="datetime-local" required />
                                </div>
                                <button class="btn btn-success mt-3" type="submit">Agendar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import axios from 'axios';

export default defineComponent({
    setup() {
        const numero = ref('')
        const mensagem = ref('')
        const horarioEnvio = ref('')

        const agendarMensagem = async () => {
            try {
                await axios.post('http://localhost/Projetos/whats-scheduler/src/api/agendar_mensagem.php', {
                    numero_whatsapp: numero.value,
                    mensagem: mensagem.value,
                    horario_envio: horarioEnvio.value,
                })
                alert('Mensagem agendada com sucesso!')
            } catch (error) {
                console.error('Erro ao agendar a mensagem:', error)
            }
        }

        return {
            numero,
            mensagem,
            horarioEnvio,
            agendarMensagem,
        }
    },
});
</script>