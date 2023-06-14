<template>
    <div class="container my-5">
        <!-- <img class="-mt-8" src="imagem.jpg" /> -->
        <div class="px-1">
            <div class="border-2 rounded-lg">
                <form class="w-full" @submit.prevent="actionpesquisa2">
                    <span class="text-2xl font-semibold text-blue-600 px-4">
                        Consulta Cliente
                    </span>
                    <div class="inline-grid grid-cols-6 gap-4">
                        <div class="col-end-9 col-span-3 mt-2...">
                            <button type="button">
                                <router-link
                                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-md px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                                    :to="{
                                        name: 'novocliente',
                                    }"
                                >
                                    Inserir cliente
                                </router-link>
                            </button>
                        </div>
                    </div>
                    <div class="flex flex-wrap py-2 px-4">
                        <div class="w-full md:w-1/5 px-3 mb-6 md:mb-0">
                            <label
                                class="inline-block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-first-name"
                            >
                                CPF
                            </label>
                            <input
                                class="appearance-none mx-1 bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                v-model="formcpf"
                                id="formcpf"
                                type="text"
                                placeholder=""
                            />
                        </div>

                        <div class="w-full md:w-1/5 ml-3 px-3 mb-6 md:mb-0">
                            <label
                                class="inline-block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-first-name"
                            >
                                Nome
                            </label>
                            <input
                                class="appearance-none mx-1 bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                v-model="formnome"
                                id="formnome"
                                type="text"
                                placeholder=""
                            />
                        </div>

                        <div class="md:w-1/8 px-3">
                            <label
                                class="ml-5 inline-block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="inline-full-name"
                            >
                                Data de Nascimento </label
                            >&nbsp;
                            <input
                                class="border-3 rounded-lg"
                                type="date"
                                v-model="formdatanascimento"
                                id="formdatanascimento"
                            />
                        </div>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <div class="md:w-1/5">
                            <label
                                class="uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-city"
                            >
                                sexo
                            </label>
                            <input
                                type="radio"
                                value="M"
                                id="formsexo"
                                v-model="formsexo"
                                class="w-4 h-4 mx-2 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                            />
                            <label
                                for="inline-radio"
                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                >Masculino</label
                            >&nbsp;&nbsp;
                            <input
                                id="formsexo"
                                v-model="formsexo"
                                type="radio"
                                value="F"
                                name="inline-radio-group"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                            />
                            <label
                                for="inline-2-radio"
                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                >Feminino</label
                            >
                        </div>
                    </div>
                    <div class="flex flex-wrap px-4">
                        <div class="w-full px-3 mb-6">
                            <div class="inline-block md:w-1/7 px-3 mb-6">
                                <label
                                    class="uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-state"
                                >
                                    Estado
                                </label>

                                <div class="relative inline-block text-left">
                                    <select
                                        type="button"
                                        class="w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                                        v-model="formestado"
                                        id="formestado"
                                        aria-expanded="true"
                                        aria-haspopup="true"
                                    >
                                        <option>Rio de Janeiro</option>
                                        <option>Sao Paulo</option>
                                        <option>Minas Gerais</option>
                                    </select>
                                </div>
                            </div>

                            <div class="inline-block md:w-1/7 px-3 mb-6 -mt-5">
                                <label
                                    class="uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-state"
                                >
                                    Cidade
                                </label>
                                <div class="relative inline-block text-left">
                                    <select
                                        type="button"
                                        class="w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
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
                            <div class="inline-grid grid-cols-6 gap-4">
                                <div class="col-end-7 col-span-2 ...">
                                    <button
                                        type="submit"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                    >
                                        Pesquisar
                                    </button>
                                    <button
                                        type="button"
                                        class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                                        @click="limpar()"
                                    >
                                        Limpar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    ​
                </form>
            </div>
        </div>
        <div class="px-2">
            <div
                class="mt-5 relative border-2 rounded-lg overflow-x-auto shadow-md sm:rounded-lg"
            >
                <table
                    class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                >
                    <thead
                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                    >
                        <tr>
                            <th scope="col" class="px-6 py-3"></th>
                            <th scope="col" class="px-6 py-3">Cliente</th>
                            <th scope="col" class="px-6 py-3">CPF</th>
                            <th scope="col" class="px-6 py-3">Data Nasc.</th>
                            <th scope="col" class="px-6 py-3">Estado</th>
                            <th scope="col" class="px-6 py-3">Cidade</th>
                            <th scope="col" class="px-6 py-3">Sexo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(cliente, index) in clientes.data"
                            :key="cliente.id"
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                        >
                            <th
                                scope="row"
                                class="px-2 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            >
                                <button type="button">
                                    <router-link
                                        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                                        :to="{
                                            name: 'editacliente',
                                            params: {
                                                id: cliente.id,
                                            },
                                        }"
                                    >
                                        Edita
                                    </router-link>
                                </button>

                                <button
                                    type="button"
                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                    @click="deletarCliente(cliente.id)"
                                >
                                    Excluir
                                </button>
                            </th>
                            <td class="px-6 py-4">{{ cliente.nome }}</td>
                            <td class="px-6 py-4">{{ cliente.cpf }}</td>
                            <td class="px-6 py-4">
                                {{ cliente.data_nascimento }}
                            </td>
                            <td class="px-6 py-4">{{ cliente.estado }}</td>
                            <td class="px-6 py-4">{{ cliente.cidade }}</td>
                            <td class="px-6 py-4">{{ cliente.sexo }}</td>
                        </tr>
                    </tbody>
                    .
                    <!-- {{
                        current_page
                    }}
                    -per_page
                    {{
                        per_page
                    }}
                    -total
                    {{
                        total
                    }} -->
                </table>
                <!-- <Bootstrap5Pagination
                    :data="clientes"
                    @pagination-change-page="list"
                /> -->
                <div class="inline-grid grid-cols-6 gap-4">
                    <div class="col-end-7 col-span-2 -mr-5 ...">
                        <paginate
                            :page-count="total"
                            :page-range="3"
                            :margin-pages="1"
                            :click-handler="clickCallback"
                            :prev-text="'Prev'"
                            :next-text="'Next'"
                            :container-class="'pagination'"
                            :page-class="'page-item'"
                        >
                        </paginate>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
//import Paginate from "vuejs-paginate-next";
import Paginate from "vuejs-paginate-next";
import SearchDataService from "@/services/SearchDataService";
import ClienteDataService from "@/services/ClienteDataService";
//import PaginationComponent from "@xmehdi01/vue-pagination-component";
//import pagination from "laravel-vue-pagination";
import { Bootstrap5Pagination } from "laravel-vue-pagination";
//import pagination from "vuejs-paginate-next";
export default {
    name: "clientes",
    components: {
        paginate: Paginate,
        //   Bootstrap5Pagination,
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
            clientes: [],
            current_page: "",
            // next_page_url: null,
            per_page: "",
            //  prev_page_url: null,
            to: "",
            total: "",

            // next_page_url: "http:\/\/localhost:8000\/api\/search?page=2",
            // path: "http:\/\/localhost:8000\/api\/search",
            // per_page: 2,
            // prev_page_url: null,
            // to: 2,
            // total: 3,
        };
    },
    mounted() {
        this.actionpesquisa2();
    },
    methods: {
        limpar() {
            this.formcpf = "";
            this.formendereco = "";
            this.formestado = "";
            this.formcidade = "";
            this.formdatanascimento = "";
            this.formnome = "";
            this.formsexo = "";
        },
        clickCallback(pageNum) {
            console.log(pageNum);
            this.actionpesquisa2(pageNum);
        },
        async list(page = 1) {
            await axios
                .get(`/api/cliente?page=` + page)
                .then(({ data }) => {
                    console.log(data);
                    this.clientes = data;
                })
                .catch(({ response }) => {
                    console.error(response);
                });
        },
        actionpesquisa: async function (page = 1) {
            console.log("fdfdfd");
            // let page = 1;
            await axios
                .get(`/api/cliente?page=` + page)
                .then(({ data }) => {
                    console.log(data);
                    this.clientes = data;
                })
                .catch(({ response }) => {
                    console.error(response);
                });
        },
        actionpesquisa2: async function (page = 1) {
            console.log("fdfdfd");
            // let page = 1;
            // await axios
            //     .get(`/api/cliente?page=` + page)
            //     .then(({ data }) => {
            //         console.log(data);
            //         this.clientes = data;
            //     })
            //     .catch(({ response }) => {
            //         console.error(response);
            //     });

            try {
                this.$emit("loading:start");
                const reponse = await SearchDataService.search({
                    cpf: this.formcpf,
                    //   endereco: this.formendereco,
                    estado: this.formestado,
                    cidade: this.formcidade,
                    data_nascimento: this.formdatanascimento,
                    nome: this.formnome,
                    sexo: this.formsexo,
                    page: page,
                });
                console.log(reponse.data);
                //    current_page = reponse.data.current_page;
                console.log("1111");
                console.log(reponse.data.current_page);
                this.current_page = reponse.data.current_page;
                console.log("2222");
                this.total = reponse.data.total / reponse.data.per_page;
                console.log("33333");
                this.per_page = reponse.data.per_page;

                //   console.log("ddddddd" + reponse.data.cliente);
                this.clientes = reponse.data;
                //    this.$router.push({ name: "home" });
                this.errorserver = "";
                //this.$router.push({ name: "relatoriocliente" });
            } catch (erro) {
                console.log(erro);
                // this.errorserver = erro.response.data.erro;
            } finally {
                this.$emit("loading:end");
            }
        },
        async deletarCliente(clientesid) {
            try {
                if (confirm("Deseja deletar cliente id:" + clientesid)) {
                    const response = await ClienteDataService.delete(
                        clientesid
                    );
                    this.cliente = response.data;
                }
                console.log(response.data);
                this.actionpesquisa2();
            } catch (error) {
                console.log(error);
            }
        },
    },
};
</script>

<style lang="css">
/* Adopt bootstrap pagination stylesheet. */
@import "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css";

/* Write your own CSS for pagination */
.pagination {
}
.page-item {
}
</style>
