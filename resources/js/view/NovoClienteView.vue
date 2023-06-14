<template>
    <section class="h-100 gradient-form">
        <div class="container py-5 h-100">
            <div
                class="row d-flex justify-content-center align-items-center h-100"
            >
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header text-center">
                            <h2>Novo Cliente</h2>
                        </div>
                        <p
                            v-if="errorserver"
                            class="block text-md text-red-500"
                        >
                            {{ errorserver }}
                        </p>
                        <form @submit.prevent="actionnovocliente">
                            <!--<p class="text-center">Please login to your account</p>-->

                            <div class="card-body p-md-5 mx-md-4">
                                <div>
                                    <label for="formcpf">CPF: </label>
                                    <input
                                        type="text"
                                        v-model="formcpf"
                                        id="formcpf"
                                        class="form-control"
                                        placeholder=""
                                    />
                                    <p></p>
                                </div>
                                <div>
                                    <label for="formnome">Nome: </label>
                                    <input
                                        type="text"
                                        v-model="formnome"
                                        id="formnome"
                                        class="form-control"
                                        placeholder=""
                                    />
                                    <p></p>
                                </div>
                                <div>
                                    <label for="formdatanascimento"
                                        >Data Nascimento:
                                    </label>
                                    <input
                                        type="date"
                                        v-model="formdatanascimento"
                                        id="formdatanascimento"
                                        class="form-control"
                                        placeholder=""
                                    />
                                    <p></p>
                                </div>
                                <div>
                                    <label for="formsexo">Sexo: </label><br />
                                    <select
                                        id="formsexo"
                                        v-model="formsexo"
                                        class="border-2 mr-4 p-2 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    >
                                        <option disabled>
                                            Selecione o sexo
                                        </option>
                                        <option value="M" :value="empresa.id">
                                            M
                                        </option>
                                        <option value="F" :value="empresa.id">
                                            F
                                        </option>
                                    </select>
                                </div>
                                <div>
                                    <br />
                                    <label for="formendereco">Endereco: </label>
                                    <input
                                        type="text"
                                        v-model="formendereco"
                                        id="formendereco"
                                        class="form-control"
                                        placeholder=""
                                    />
                                    <p></p>
                                </div>
                                <div>
                                    <label for="formestado">Estado: </label>
                                    <select
                                        type="button"
                                        class="border-2 w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                                        v-model="formestado"
                                        id="formestado"
                                        aria-expanded="true"
                                        aria-haspopup="true"
                                    >
                                        <option>Rio de Janeiro</option>
                                        <option>Sao Paulo</option>
                                        <option>Minas Gerais</option>
                                    </select>
                                    <p></p>
                                </div>
                                <div>
                                    <label for="formcidade">Cidade: </label>
                                    <select
                                        type="button"
                                        class="border-2 w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                                        v-model="formcidade"
                                        id="formcidade"
                                        aria-expanded="true"
                                        aria-haspopup="true"
                                    >
                                        <option>Teresopolis</option>
                                        <option>Bauru</option>
                                        <option>Belo Horizonte</option>
                                    </select>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="button">
                                    <router-link
                                        class="bg-white focus:ring-4 border-2 font-medium rounded-md text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:focus:ring-blue-800"
                                        :to="{
                                            name: 'relatoriocliente',
                                        }"
                                    >
                                        Voltar</router-link
                                    >
                                </button>
                                <button
                                    class="btn btn-primary fa-lg gradient-custom-2"
                                    type="submit"
                                >
                                    Cadastrar
                                </button>
                            </div>
                            <br />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { useVuelidate } from "@vuelidate/core";
import { required, minLength, email, sameAs } from "@vuelidate/validators";
import ClienteDataService from "@/services/ClienteDataService";

export default {
    name: "NovoclienteView",
    setup() {
        return {
            v$: useVuelidate(),
        };
    },
    data() {
        return {
            formcpf: "",
            formendereco: "",
            formestado: "",
            formcidade: "",
            formdatanascimento: "",
            formnome: "",
            formsexo: "",
            errorserver: "",
        };
    },
    validations() {
        return {
            formcpf: { required },
            formendereco: { required },
            formestado: { required },
            formcidade: { required },
            formdatanascimento: { required },
            formnome: { required },
            formsexo: { required },
        };
    },
    methods: {
        // Soumission du formulaire
        actionnovocliente: async function () {
            console.log("fdfdfd");

            this.v$.$touch(); // Déclenche la validation

            if (this.v$.$invalid) {
                // Si le formulaire est invalide, arrêtez le processus de soumission
                this.errorserver = "";
                console.log($v);
                return;
            }

            try {
                this.$emit("loading:start");
                await ClienteDataService.criar({
                    cpf: this.formcpf,
                    endereco: this.formendereco,
                    estado: this.formestado,
                    cidade: this.formcidade,
                    data_nascimento: this.formdatanascimento,
                    nome: this.formnome,
                    sexo: this.formsexo,
                });
                this.$router.push({ name: "relatoriocliente" });
                this.errorserver = "";
            } catch (erro) {
                this.errorserver = erro.response.data.erro;
            } finally {
                this.$emit("loading:end");
            }
        },
    },
};
</script>
