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
                                    <input class="form-control" type="text" required />
                                </div>
                                <div class="mt-3">
                                    <label>Mensagem:</label>
                                    <textarea class="form-control" required></textarea>
                                </div>
                                <div class="mt-3 mb-3">
                                    <label>Horário de Envio:</label>
                                    <input class="form-control" type="datetime-local" required />
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
import { Options, Vue } from 'vue-class-component';

@Options({
    components: {

    },
})
export default class WhatsScheduler extends Vue { }
</script>